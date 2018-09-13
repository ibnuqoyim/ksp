<?php

class Angsurans extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('angsuran');
		$this->title = 'Angsuran';
		$this->func = 'angsuran';
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
							'sortby'		=> "i.id",
							'sortorder' 	=> "DESC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata($this->func);

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "i.id" : $sample['sortby'];
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

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "i.id";
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

		$data['result'] 	= $this->angsuran->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->angsuran->jumlah_data($data['keywords']);

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
			'i.no_trans'			=> 'No. Transaksi',
			'i.date'				=> 'Tanggal',
			'l.no_loan'				=> 'No. Pinjaman',
			'concat(m.no_member,\'-\',m.name)' => 'Anggota',
			'i.transaction'			=> 'Ke',
			'i.amount'				=> 'Nominal',
		);

		$url = $this->func.'s/index';

		$html = $this->load->view($this->func.'/load_data', $data);
		echo $html;
    }


	function add() {            

		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');
		

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
		
		$data['pinjaman'] = pinjaman_dropdown();
		
		$this->template->write_view('content',$this->func.'/add',$data);
		$this->template->render();
	}
	
	function add_process(){

		$entry['loanid']		= $this->input->post('loanid');
		$entry['transaction']	= $this->input->post('transaction');
		$entry['no_trans']		= no_transaksi_angsuran();
		$entry['date']			= format_date_us($this->input->post('date'));
		$entry['amount']		= clean_separator($this->input->post('amount'));
		$entry['create_on']		= date('Y-m-d H:i:s');
		$entry['create_by']		= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->angsuran->insert_data($entry);

		if($this->input->post('transaction')==$this->input->post('total_transaction')){##lunas

			$entry2['status']			= 1;##LUNAS
			$entry2['update_on']		= date('Y-m-d H:i:s');
			$entry2['update_by']		= $this->session->userdata('userid');

			$this->load->model('pinjaman');
			$this->pinjaman->update_data($entry2,$this->input->post('loanid'));

		}

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

		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');
		

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

		$this->template->add_title('EDIT '.strtoupper($this->title));
		$breadcrumb = array(
			'berandas'		=> 'Beranda',
			$this->func.'s' 		=> $this->title,
			$this->func.'s/edit/id/'.$this->uri->segment(4) => 'Edit',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['result'] = $this->angsuran->detail_data($this->uri->segment(4));
		$data['pinjaman'] = pinjaman_dropdown();

		$this->template->write_view('content',$this->func.'/edit',$data);
		$this->template->render();
	}

	function edit_process(){

		$id = $this->uri->segment(4);

		$entry['loanid']		= $this->input->post('loanid');
		$entry['transaction']	= $this->input->post('transaction');
		$entry['date']			= format_date_us($this->input->post('date'));
		$entry['amount']		= clean_separator($this->input->post('amount'));
		$entry['update_on']		= date('Y-m-d H:i:s');
		$entry['update_by']		= $this->session->userdata('userid');

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->angsuran->update_data($entry,$id);

		if($this->input->post('transaction')==$this->input->post('total_transaction')){##lunas

			$entry2['status']			= 1;##LUNAS
			$entry2['update_on']		= date('Y-m-d H:i:s');
			$entry2['update_by']		= $this->session->userdata('userid');

			$this->load->model('pinjaman');
			$this->pinjaman->update_data($entry2,$this->input->post('loanid'));

		}

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
		$result = $this->angsuran->detail_data($id);
		if(count($result)>0){
			if($result['status']==1){##sudah lunas
				$entry2['status']			= 0;##BELUM LUNAS
				$entry2['update_on']		= date('Y-m-d H:i:s');
				$entry2['update_by']		= $this->session->userdata('userid');
	
				$this->load->model('pinjaman');
				$this->pinjaman->update_data($entry2,$result['loanid']);
			}
		}

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->angsuran->delete_data($id);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
	}
	
	function get_detail_information(){
		$loanid = $this->input->post('loanid');
		$installmentid = $this->input->post('installmentid');
		$detail = $this->angsuran->get_detail_information($loanid,$installmentid);
		echo json_encode($detail);
	}


	
}


?>