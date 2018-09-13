<?php

class Employees extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('employee');
		$this->title = 'Pegawai';
		$this->func = 'employee';
	}

	function index() {
		
		if($this->session->userdata('roleid') != 1){
			redirect('berandas');
		}
		//$this->template->add_css('template/assets/vendors/DataTables/media/css/dataTables.bootstrap.css');

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
							'sortby'		=> "e.name",
							'sortorder' 	=> "DESC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata($this->func);

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "e.name" : $sample['sortby'];
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

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "e.name";
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

		$data['result'] 	= $this->employee->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->employee->jumlah_data($data['keywords']);

		$config['base_url']			= base_url() . 'index.php/'.$this->func.'s/load_data/';
		$config['post_var'] 		= $this->input->post('page');
		$config['per_page'] 		= $this->config->item('page_num_emp');
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['full_tag_open'] 	= '<div class="pagination dataTables_paginate paging_simple_numbers">';
		$config['full_tag_close'] 	= '</div>';
		$config['total_rows'] 		= $jumlah;

		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['fields'] = array(
				'e.name'			=> 'Nama',
				'e.email'	 		=> 'Email',
				'e.gender'	 		=> 'Gender',
				'e.status'	 		=> 'Status',
		);

		$url = $this->func.'s/index';

		$html = $this->load->view($this->func.'/load_data', $data);
		echo $html;
    }


	function add() {            

		if($this->session->userdata('roleid') != 1){
			redirect('berandas');
		}

		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');
		
		##file updaload
		$this->template->add_css('template/assets/bootstrap-fileupload/bootstrap-fileupload.css');
		$this->template->add_js('template/assets/bootstrap-fileupload/bootstrap-fileupload.min.js');



		##combobox
		$this->template->add_css('template/addon/select2/select2-custom.css');
		$this->template->add_css('template/addon/bootstrap-select/bootstrap-select.min.css');
		$this->template->add_css('template/addon/multi-select/css/multi-select-madmin.css');


		$this->template->add_js('template/addon/select2/select2.min.js');
		$this->template->add_js('template/addon/bootstrap-select/bootstrap-select.min.js');
		$this->template->add_js('template/addon/multi-select/js/jquery.multi-select.js');
		$this->template->add_js('template/addon/form-select.js');

		$this->template->add_js('jQuery(document).ready(function () {
    			form_select.init();
				});
				','embed');




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
		
		$data['keterangan'] = array();
		$data['ambil_dari'] = array();

		$this->template->write_view('content',$this->func.'/add',$data);
		$this->template->render();
	}
	
	function add_process(){
		if($_FILES['photo']['name']){ //jika ada dokumen
			$filename = strtolower(basename($_FILES['photo']['name']));
			$filenameArr = explode('.',$filename);
			$ori_name = str_replace(' ','_',$filenameArr[0]);
			$ext = $filenameArr[count($filenameArr)-1];
			$ran = date("mdYHis");
			$ran2 = $ran.".";
			$target = 'template/images/employee/';
			$target = $target.$ori_name.'_'.$ran2.$ext;

			if(@move_uploaded_file($_FILES['photo']['tmp_name'], $target))
			{
				$entry['photo'] = $ori_name.'_'.$ran2.$ext;
			}
		}

		$entry['name']			= $this->input->post('name');
		$entry['gender']		= $this->input->post('gender');
		$entry['position']		= $this->input->post('position');
		$entry['address']		= $this->input->post('address');
		$entry['email']			= $this->input->post('email');
		$entry['hp']			= $this->input->post('hp');
		$entry['birthplace']	= $this->input->post('birthplace');
		$entry['birthdate']		= format_date_us($this->input->post('birthdate'));
		$entry['create_on']		= date('Y-m-d H:i:s');
		$entry['create_by']		= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->employee->insert_data($entry);
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil disimpan!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s');
	}
	
	function detail(){

		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/'.$this->func.'/detail.js');

		$this->template->add_title('DETAIL '.strtoupper(strtoupper($this->title)));
		$breadcrumb = array(
			'berandas'				=> 'Beranda',
			$this->func.'s' 		=> $this->title,
			$this->func.'s/detail/id/'.$this->uri->segment(4) => 'Detail',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['result'] = $this->employee->detail_data($this->uri->segment(4));
		//print_rr($data['result']);
		//die();

		$this->template->write_view('content',$this->func.'/detail',$data);
		$this->template->render();
	}
	

	function edit() {
		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');
		
		##file updaload
		$this->template->add_css('template/assets/bootstrap-fileupload/bootstrap-fileupload.css');
		$this->template->add_js('template/assets/bootstrap-fileupload/bootstrap-fileupload.min.js');



		##combobox
		$this->template->add_css('template/addon/select2/select2-custom.css');
		$this->template->add_css('template/addon/bootstrap-select/bootstrap-select.min.css');
		$this->template->add_css('template/addon/multi-select/css/multi-select-madmin.css');


		$this->template->add_js('template/addon/select2/select2.min.js');
		$this->template->add_js('template/addon/bootstrap-select/bootstrap-select.min.js');
		$this->template->add_js('template/addon/multi-select/js/jquery.multi-select.js');
		$this->template->add_js('template/addon/form-select.js');

		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/user/validasi.js');

		$this->template->add_js('jQuery(document).ready(function () {
    			form_select.init();
				});
				','embed');




		##VALIDASI
		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/'.$this->func.'/validasi.js');

		$this->template->add_title('EDIT '.strtoupper($this->title));
		$breadcrumb = array(
			'berandas'		=> 'Beranda',
			$this->func.'s' 		=> $this->title,
			$this->func.'s/detail/id/'.$this->uri->segment(4) => 'Detail',
			$this->func.'s/edit/id/'.$this->uri->segment(4) => 'Edit',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['result'] = $this->employee->detail_data($this->uri->segment(4));

		$this->template->write_view('content',$this->func.'/edit',$data);
		$this->template->render();
	}

	function edit_process(){

		$id = $this->uri->segment(4);


		if($_FILES['photo']['name']){ //jika ada dokumen

			$filename = strtolower(basename($_FILES['photo']['name']));
			$filenameArr = explode('.',$filename);
			$ori_name = str_replace(' ','_',$filenameArr[0]);
			$ext = $filenameArr[count($filenameArr)-1];
			$ran = date("mdYHis");
			$ran2 = $ran.".";
			$target = 'template/images/employee/';
			$target = $target . $ori_name.'_'.$ran2.$ext;
					
					
			if(@move_uploaded_file($_FILES['photo']['tmp_name'], $target))
			{
				$entry['photo'] = $ori_name.'_'.$ran2.$ext;
			}
		}

		$entry['name']			= $this->input->post('name');
		$entry['gender']		= $this->input->post('gender');
		$entry['position']		= $this->input->post('position');
		$entry['address']		= $this->input->post('address');
		$entry['email']			= $this->input->post('email');
		$entry['hp']			= $this->input->post('hp');
		$entry['birthplace']	= $this->input->post('birthplace');
		$entry['birthdate']		= format_date_us($this->input->post('birthdate'));
		$entry['update_on']		= date('Y-m-d H:i:s');
		$entry['update_by']		= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->employee->update_data($entry,$id);
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dirubah!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s/detail/id/'.$id);
	}


	function delete_data(){
		$id = $this->input->post('id');
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->employee->delete_data($id);
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