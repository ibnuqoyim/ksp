<?php

class Laporan_potongans extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('laporan_potongan');
		$this->title = 'Laporan Pemotongan Gaji';
		$this->func = 'laporan_potongan';
	}

	function index() {

		##datepicker
		$this->template->add_css('template/assets/bootstrap-datepicker/css/datepicker.css');
		$this->template->add_css('template/assets/bootstrap-daterangepicker/daterangepicker.css');

		$this->template->add_js('template/assets/bootstrap-datepicker/js/bootstrap-datepicker.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/date.js');
		$this->template->add_js('template/assets/bootstrap-daterangepicker/daterangepicker.js');


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

		$this->template->add_js('template/js/'.$this->func.'/list.js');
		$this->template->add_title(strtoupper($this->title));
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			$this->func.'s' 	=> $this->title,
		);
		$this->template->add_breadcrumb($breadcrumb);
		$data['member'] = member_all_dropdown();
		$data['company'] = company_all_dropdown();


		$this->template->write_view('content',$this->func.'/list',$data);
		$this->template->render();
	}


    function load_data() {
        
		if($this->input->post('page') !=NULL) {
			$data['page'] = $this->input->post('page');
		} else {
			$data['page'] = 0;
		}

		$data['sort_by'] 	= isset($_POST['sort_by']) && $_POST['sort_by'] != '' ? $_POST['sort_by'] : "trans_number";
		$data['sort_order']	= isset($_POST['sort_order']) && $_POST['sort_order'] != '' ? $_POST['sort_order'] : "DESC";
		$data['memberid']	= isset($_POST['memberid']) && $_POST['memberid'] != '' ? $_POST['memberid'] : "0";
		$data['companyid']	= isset($_POST['companyid']) && $_POST['companyid'] != '' ? $_POST['companyid'] : "0";

		$arr_sess = array(
				$this->func => array(
						'page' 			=> $data['page'],
						'sortby'		=> $data['sort_by'],
						'sortorder' 	=> $data['sort_order'],
						'memberid' 		=> $data['memberid'],
						'companyid' 	=> $data['companyid'],
						'tgl_dari' 		=> $this->input->post('tgl_dari'),
						'tgl_sampai' 	=> $this->input->post('tgl_sampai'),
				),
		);
		$this->session->set_userdata($arr_sess);

		$data['result_simpanan'] 	= $this->laporan_potongan->list_data_simpanan($data['page'],$data['sort_by'],$data['sort_order']);
		$data['result_pinjaman'] 	= $this->laporan_potongan->list_data_pinjaman($data['page'],$data['sort_by'],$data['sort_order']);
		/*$jumlah 		 	= $this->laporan_potongan->jumlah_data();

		$config['base_url']			= base_url() . 'index.php/'.$this->func.'s/load_data/';
		$config['post_var'] 		= $this->input->post('page');
		$config['per_page'] 		= $this->config->item('page_num_report');
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['full_tag_open'] 	= '<div class="pagination dataTables_paginate paging_simple_numbers">';
		$config['full_tag_close'] 	= '</div>';
		$config['total_rows'] 		= $jumlah;

		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();*/
		$data['fields'] = array(
				'm.name'		=> 'Anggota',
				'm.no_member'	=> 'No. Anggota',
				'd.pokok'		=> 'Pokok',
				'd.wajib'		=> 'Wajib',
				'd.sukarela'	=> 'Sukarela',
		);

		$url = $this->func.'s/index';

		$html = $this->load->view($this->func.'/load_data', $data);
		echo $html;
    }


	function print_data(){
		$sess = $this->session->userdata($this->func);
		$memberid		= $sess['memberid'];
		$companyid		= $sess['companyid'];
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		$data['period'] = format_period_month($tgl_dari,$tgl_sampai);

		$data['result_pinjaman'] 	= $this->laporan_potongan->list_data_pinjaman();
		$data['result_simpanan'] 	= $this->laporan_potongan->list_data_simpanan();
		$company 	= $this->laporan_potongan->get_company($companyid);
		$data['perusahaan'] 	= '';
		if(count($company)>0){
			$data['perusahaan'] 	= $company['name'];
		}

		if(count($data>0)){

			$this->load->helper( 'tcpdf' );
				
			$pdf = tcpdf('P', 'mm', 'A4', true, 'UTF-8');
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetTitle('LAPORAN PEMOTONGAN GAJI');

			$header  = '<br/>';

			// set header
			$pdf->setPrintHeader(false);
			$pdf->set_enable_header(TRUE);
			$pdf->setHeaderFont(Array('helvetica', '', 10));
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
			$pdf->SetMargins(10, 10, 10, 5);
			
			// set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, 20);
			
			$pdf->AddPage('L','A4');
			$pdf->SetFont('helvetica', 'N', 8);
			
	
			$html =	$this->load->view($this->func.'/print',$data,TRUE);
			$pdf->writeHTML($html, true, 0, true, 0);
			$pdf->Output('LAPORAN_PEMOTONGAN_GAJI.pdf', 'I');
		}
	}


	function export_data(){
		$sess = $this->session->userdata($this->func);
		$memberid		= $sess['memberid'];
		$companyid		= $sess['companyid'];
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		
		$data['period'] = format_period_month($tgl_dari,$tgl_sampai);

		$data['result_pinjaman'] 	= $this->laporan_potongan->list_data_pinjaman();
		$data['result_simpanan'] 	= $this->laporan_potongan->list_data_simpanan();

		if(count($data>0)){

	
			$html =	$this->load->view($this->func.'/print',$data);
			
			echo $html;


			$name = "LAPORAN_PEMOTONGAN_GAJI_" . date('YmdHis');
	
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=$name.xls");
			header("Pragma: no-cache");
			header("Expires: 0");

		}
	}

}


?>