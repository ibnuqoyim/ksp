<?php

class Anggotas extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('anggota');
		$this->title = 'Anggota';
		$this->func = 'anggota';
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
							'sortby'		=> "m.no_member",
							'sortorder' 	=> "ASC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata($this->func);

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "m.no_member" : $sample['sortby'];
		$data['sortorder'] = $sample['sortorder'] == "" ? "ASC" : $sample['sortorder'];
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

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "m.no_member";
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

		$data['result'] 	= $this->anggota->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->anggota->jumlah_data($data['keywords']);

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
				'm.name'			=> 'Nama',
				'm.email'	 		=> 'Email',
				'm.gender'	 		=> 'Gender',
				'm.status'	 		=> 'Status',
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
		
		$data['company'] = company_all_dropdown();
		
		$this->template->write_view('content',$this->func.'/add',$data);
		$this->template->render();
	}
	
	function add_process(){
		//print_rr($_POST);
		//die();
		$entry['no_member']			= no_member();
		$entry['name']				= $this->input->post('name');
		$entry['gender']			= $this->input->post('gender');
		$entry['birthplace']		= $this->input->post('birthplace');
		$entry['birthdate']			= format_date_us($this->input->post('birthdate'));
		$entry['relationship']		= $this->input->post('relationship');
		$entry['partner']			= $this->input->post('partner');
		$entry['heir']				= $this->input->post('heir');
		$entry['address']			= $this->input->post('address');
		$entry['current_address']	= $this->input->post('current_address');
		$entry['phone']				= $this->input->post('phone');
		$entry['hp']				= $this->input->post('hp');
		$entry['companyid']			= $this->input->post('companyid');
		$entry['join_date']			= format_date_us($this->input->post('join_date'));
		$entry['position']			= $this->input->post('position');
		$entry['create_on']			= date('Y-m-d H:i:s');
		$entry['create_by']			= $this->session->userdata('userid');


		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$memberid = $this->anggota->insert_data($entry);

		$entry2['memberid']		= $memberid;
		$entry2['date']			= format_date_us($this->input->post('date'));
		$entry2['pokok']		= clean_separator($this->input->post('pokok'));
		$entry2['wajib']		= clean_separator($this->input->post('wajib'));
		$entry2['sukarela']		= clean_separator($this->input->post('sukarela'));
		$entry2['create_on']	= date('Y-m-d H:i:s');
		$entry2['create_by']	= $this->session->userdata('userid');
		$this->anggota->insert_data_detail($entry2);

		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil disimpan!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s');
	}
	
	function add_deposit_process(){
		$memberid = $this->uri->segment(4);


		$entry2['memberid']		= $memberid;
		$entry2['date']			= format_date_us($this->input->post('perubahan_date'));
		$entry2['pokok']		= clean_separator($this->input->post('perubahan_pokok'));
		$entry2['wajib']		= clean_separator($this->input->post('perubahan_wajib'));
		$entry2['sukarela']		= clean_separator($this->input->post('perubahan_sukarela'));
		$entry2['create_on']	= date('Y-m-d H:i:s');
		$entry2['create_by']	= $this->session->userdata('userid');
		$this->anggota->insert_data_detail($entry2);

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil disimpan!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s/detail/id/'.$memberid);
	}
	
	function detail(){

		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');


		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/'.$this->func.'/detail.js');
		$this->template->add_js('template/js/'.$this->func.'/validasi.js');

		$this->template->add_title('DETAIL '.strtoupper(strtoupper($this->title)));
		$breadcrumb = array(
			'berandas'				=> 'Beranda',
			$this->func.'s' 		=> $this->title,
			$this->func.'s/detail/id/'.$this->uri->segment(4) => 'Detail',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['result'] = $this->anggota->detail_data($this->uri->segment(4));
		$data['deposit'] = $this->anggota->deposit_by_memberid($this->uri->segment(4));
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
		
		$data['result'] = $this->anggota->detail_data($this->uri->segment(4));
		$data['company'] = company_all_dropdown();

		$this->template->write_view('content',$this->func.'/edit',$data);
		$this->template->render();
	}

	function edit_process(){

		$id = $this->uri->segment(4);


		$entry['name']				= $this->input->post('name');
		$entry['gender']			= $this->input->post('gender');
		$entry['birthplace']		= $this->input->post('birthplace');
		$entry['birthdate']			= format_date_us($this->input->post('birthdate'));
		$entry['relationship']		= $this->input->post('relationship');
		$entry['partner']			= $this->input->post('partner');
		$entry['heir']				= $this->input->post('heir');
		$entry['address']			= $this->input->post('address');
		$entry['current_address']	= $this->input->post('current_address');
		$entry['phone']				= $this->input->post('phone');
		$entry['hp']				= $this->input->post('hp');
		$entry['companyid']			= $this->input->post('companyid');
		$entry['join_date']			= format_date_us($this->input->post('join_date'));
		$entry['position']			= $this->input->post('position');
		$entry['create_on']			= date('Y-m-d H:i:s');
		$entry['create_by']			= $this->session->userdata('userid');
		$entry['update_on']			= date('Y-m-d H:i:s');
		$entry['update_by']			= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->anggota->update_data($entry,$id);
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dirubah!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s/detail/id/'.$id);
	}
	
	function edit_deposit_process(){
		$id = $this->uri->segment(4);

		$entry2['date']			= format_date_us($this->input->post('date'));
		$entry2['pokok']		= clean_separator($this->input->post('pokok'));
		$entry2['wajib']		= clean_separator($this->input->post('wajib'));
		$entry2['sukarela']		= clean_separator($this->input->post('sukarela'));
		$entry2['update_on']	= date('Y-m-d H:i:s');
		$entry2['update_by']	= $this->session->userdata('userid');

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->anggota->update_data_deposit($entry2,$this->input->post('frm_id_deposit'));
		$this->db->trans_complete();

		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dirubah!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect($this->func.'s/detail/id/'.$id);

	}

	function detail_deposit_ajax(){
		$id = $this->input->post('id');
		$deposit = $this->anggota->detail_deposit($id);
		$data['id'] = $deposit['id'];
		$data['date'] = format_datepicker($deposit['date']);
		$data['pokok'] = $deposit['pokok'];
		$data['wajib'] = $deposit['wajib'];
		$data['sukarela'] = $deposit['sukarela'];
		echo json_encode($data);
	}


	function delete_data(){
		$id = $this->input->post('id');
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->anggota->delete_data($id);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
	}

	function delete_data_deposit(){
		$id = $this->input->post('id');
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->anggota->delete_data_deposit($id);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
	}

	function print_data(){

		$data['detail'] = $this->anggota->detail_data($this->uri->segment(4));
		$data['deposit'] = $this->anggota->list_summary_deposit_by_memberid($this->uri->segment(4));
		$data['pinjam'] = $this->anggota->list_pinjaman($this->uri->segment(4));
		//print_rr($data['pinjam']);

		if(count($data['detail']>0)){

			$this->load->helper( 'tcpdf' );
				
			$pdf = tcpdf('P', 'mm', 'A4', true, 'UTF-8');
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetTitle('SALDO SIMPAN PINJAM');

			$logo = base_url('template/images/logo2.jpg');

			$header = '<table width="100%" border="0">';
			$header .= '<tr>';
			$header .= '<td width="40%"><img src="'.$logo.'" width="110px"></td>';
			$header .= '<td width="60%" align="center">&nbsp;</td>';
			$header .= '</tr>';
			$header .= '</table>';
	
			// set header
			$pdf->setPrintHeader(TRUE);
			$pdf->set_enable_header(TRUE);
			$pdf->setHeaderFont(Array('helvetica', '', 13));
			$pdf->setHeaderData($header);
			$pdf->setHeaderMargin(15);
			
	
			// set footer
			$pdf->setPrintFooter(false);
			$page = 'Page '.$pdf->getAliasNumPage().' / '.$pdf->getAliasNbPages().'';	
			$pdf->set_footer_text($page);
			$pdf->set_enable_footer_number(true);
			$pdf->setFooterFont(Array('helvetica', '', 8));
			$pdf->set_y_footer(-11);
	
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			$pdf->SetMargins(10, 17, 10, 5);
			
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 20);
			
			$pdf->AddPage('L','A4');
			$pdf->SetFont('helvetica', 'N', 11);
			
	
			$html =	$this->load->view($this->func.'/print',$data,TRUE);
			$pdf->writeHTML($html, true, 0, true, 0);
			$pdf->Output('SALDO_SIMPAN_PINJAM.pdf', 'I');
		}
	}




}


?>