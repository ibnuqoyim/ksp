<?php

class Perusahaans extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('perusahaan');
		$this->title = 'Kelas';
		$this->func = 'perusahaan';
	}

	function index() {

		$this->template->add_js('template/js/'.$this->func.'/list.js');
		$this->template->add_title(strtoupper($this->title));
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			$this->func.'s' 	=> $this->title,
		);
		$this->template->add_breadcrumb($breadcrumb);

		if(!$this->session->userdata($this->func)) {
			$arr_sess = array(
					$this->func => array(
							'page' 			=> "",
							'sortby'		=> "c.id",
							'sortorder' 	=> "DESC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata($this->func);

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "c.id" : $sample['sortby'];
		$data['sortorder'] = $sample['sortorder'] == "" ? "DESC" : $sample['sortorder'];
		$data['keyword'] = $sample['keyword'] == "" ? "" : $sample['keyword'];


		$this->template->add_js('$(document).ready(function(){
					$("#hid_paging").val("'.$data['page'].'");
					$("#hid_sort_by").val("'.$data['sortby'].'");
					$("#hid_sort_order").val("'.$data['sortorder'].'");
					$("#txt_keywords").val("'.$data['keyword'].'");

					loda_data('.$data['page'].');
                });
				','embed');


		$this->template->write_view('content',$this->func.'/list',$data);
		$this->template->render();
	}


    function load_data() {
        
		if($this->input->post('page') !=NULL) {
			$data['page'] = $this->input->post('page');
		} else {
			$data['page'] = 0;
		}

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "c.id";
		$data['sort_order']	= isset($_POST['sort_order']) ? $_POST['sort_order'] : "DESC";
		$data['keywords']	= isset($_POST['keywords']) ? $_POST['keywords'] : "";

		$arr_sess = array(
				$this->func => array(
						'page' 			=> $data['page'],
						'sortby'		=> $data['sort_by'],
						'sortorder' 	=> $data['sort_order'],
						'keyword' 		=> $data['keywords']
				),
		);
		$this->session->set_userdata($arr_sess);

		$data['result'] 	= $this->perusahaan->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->perusahaan->jumlah_data($data['keywords']);

		$config['base_url']			= base_url() . 'index.php/'.$this->func.'s/load_data/';
		$config['post_var'] 		= $this->input->post('page');
		$config['per_page'] 		= $this->config->item('page_num');
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['full_tag_open'] 	= '<div class="pagination dataTables_paginate paging_simple_numbers">';
		$config['full_tag_close'] 	= '</div>';
		$config['total_rows'] 		= $jumlah;

		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['fields'] = array(
				'c.name'			=> 'Nama',
				'c.address'			=> 'Alamat',
		);

		$url = $this->func.'s/index';

		$html = $this->load->view($this->func.'/load_data', $data);
		echo $html;
    }


	function add() {            

		##VALIDASI
		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/'.$this->func.'/validasi.js');

		$this->template->add_title('TAMBAH '.strtoupper($this->title));
		$breadcrumb = array(
			'berandas'		=> 'Beranda',
			$this->func.'s'		=> $this->title,
			$this->func.'s/add'	=> 'Tambah',
		);
		$this->template->add_breadcrumb($breadcrumb);
		$data['result'] = array();
		
		$this->template->write_view('content',$this->func.'/add',$data);
		$this->template->render();
	}
	
	function add_process(){

		$entry['name']			= $this->input->post('name');
		$entry['address']		= $this->input->post('address');
		$entry['create_on']		= date('Y-m-d H:i:s');
		$entry['create_by']		= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->perusahaan->insert_data($entry);
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil disimpan!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s');
	}
	

	function edit() {

		##VALIDASI
		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/'.$this->func.'/validasi.js');

		$this->template->add_title('EDIT '.strtoupper($this->title));
		$breadcrumb = array(
			'berandas'		=> 'Beranda',
			$this->func.'s' 		=> $this->title,
			$this->func.'s/edit/id/'.$this->uri->segment(4) => 'Edit',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['result'] = $this->perusahaan->detail_data($this->uri->segment(4));

		$this->template->write_view('content',$this->func.'/edit',$data);
		$this->template->render();
	}

	function edit_process(){

		$id = $this->uri->segment(4);

		$entry['name']			= $this->input->post('name');
		$entry['address']		= $this->input->post('address');
		$entry['update_on']		= date('Y-m-d H:i:s');
		$entry['update_by']		= $this->session->userdata('userid');

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->perusahaan->update_data($entry,$id);
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dirubah!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s');
	}


	function delete_data(){
		$id = $this->input->post('id');
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->perusahaan->delete_data($id);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
	}
	

	

}


?>