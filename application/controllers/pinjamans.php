<?php

class Pinjamans extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('pinjaman');
		$this->title = 'Pinjaman';
		$this->func = 'pinjaman';
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
							'sortby'		=> "l.id",
							'sortorder' 	=> "DESC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata($this->func);

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "l.id" : $sample['sortby'];
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

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "l.id";
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

		$data['result'] 	= $this->pinjaman->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->pinjaman->jumlah_data($data['keywords']);

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
				'l.no_loan'				=> 'No. Pinjaman',
				'l.date'				=> 'Tanggal',
				'concat(m.no_member,\'-\',m.name)' => 'Anggota',
				'l.amount'				=> 'Pinjaman',
				'l.bunga'				=> 'Bunga',
				'l.lama_angsuran'		=> 'Lama',
				'l.perbulan'			=> 'Angsuran /bln',
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
		
		$data['member'] = member_all_dropdown();
		
		$this->template->write_view('content',$this->func.'/add',$data);
		$this->template->render();
	}
	
	function add_process(){

		$entry['memberid']		= $this->input->post('memberid');
		$entry['no_loan']		= no_transaksi_pinjaman();
		$entry['date']			= format_date_us($this->input->post('date'));
		$entry['amount']		= clean_separator($this->input->post('amount'));
		$entry['bunga']			= clean_separator($this->input->post('bunga'));
		$entry['lama_angsuran']	= clean_separator($this->input->post('lama_angsuran'));
		$entry['perbulan']		= clean_separator($this->input->post('perbulan'));
		$entry['flag']			= $this->input->post('flag');
		$entry['status']		= 0;
		$entry['create_on']		= date('Y-m-d H:i:s');
		$entry['create_by']		= $this->session->userdata('userid');
		
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->pinjaman->insert_data($entry);
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
		
		$data['result'] = $this->pinjaman->detail_data($this->uri->segment(4));
		$data['member'] = member_all_dropdown();

		$this->template->write_view('content',$this->func.'/edit',$data);
		$this->template->render();
	}

	function edit_process(){

		$id = $this->uri->segment(4);

		$entry['memberid']		= $this->input->post('memberid');
		$entry['date']			= format_date_us($this->input->post('date'));
		$entry['amount']		= clean_separator($this->input->post('amount'));
		$entry['bunga']			= clean_separator($this->input->post('bunga'));
		$entry['lama_angsuran']	= clean_separator($this->input->post('lama_angsuran'));
		$entry['perbulan']		= clean_separator($this->input->post('perbulan'));
		$entry['flag']			= $this->input->post('flag');
		$entry['update_on']		= date('Y-m-d H:i:s');
		$entry['update_by']		= $this->session->userdata('userid');

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->pinjaman->update_data($entry,$id);
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
		$this->pinjaman->delete_data($id);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
	}
	
	function get_maksimal_pinjam(){
		$date = format_date_us($this->input->post('date'));
		$memberid = $this->input->post('memberid');
		$detail = $this->pinjaman->get_maksimal_pinjam($date,$memberid);
		$max = ($detail['pokok']*20)+($detail['wajib']*20)+($detail['sukarela']*4);
		if($max>40000000){
			$max = 40000000;
		}
		echo 'Maksimal pinjaman adalah Rp. '.format_uang($max);
	}


	function print_data(){

		$data['detail'] = $this->pinjaman->detail_data($this->uri->segment(4));

		if(count($data['detail']>0)){

			$this->load->helper( 'tcpdf' );
				
			$pdf = tcpdf('P', 'mm', 'A4', true, 'UTF-8');
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetTitle('ANGSURAN PINJAMAN');

			$logo = base_url('template/images/logo2.jpg');

			$header = '<table width="100%" border="0">';
			$header .= '<tr>';
			$header .= '<td width="40%"><img src="'.$logo.'" width="110px"></td>';
			$header .= '<td width="60%" align="center">&nbsp;</td>';
			$header .= '</tr>';
			$header .= '<tr>';
			$header .= '<td align="center">&nbsp;</td>';
			$header .= '<td align="left"><strong>TABEL ANGSURAN PINJAMAN</strong></td>';
			$header .= '</tr>';
			$header .= '</table>';
	
			// set header
			$pdf->setPrintHeader(TRUE);
			$pdf->set_enable_header(TRUE);
			$pdf->setHeaderFont(Array('helvetica', '', 13));
			$pdf->setHeaderData($header);
			$pdf->setHeaderMargin(5);
			
	
			// set footer
			$pdf->setPrintFooter(true);
			$page = 'Page '.$pdf->getAliasNumPage().' / '.$pdf->getAliasNbPages().'';	
			$pdf->set_footer_text($page);
			$pdf->set_enable_footer_number(true);
			$pdf->setFooterFont(Array('helvetica', '', 8));
			$pdf->set_y_footer(-11);
	
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			
			// set margins
			$pdf->SetMargins(10, 40, 10, 5);
			
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 20);
			
			$pdf->AddPage('P','A4');
			$pdf->SetFont('helvetica', 'N', 9);
			
	
			$html =	$this->load->view($this->func.'/print',$data,TRUE);
			$pdf->writeHTML($html, true, 0, true, 0);
			$pdf->Output('ANGSURA_PINJAMAN.pdf', 'I');
		}
	}



}


?>