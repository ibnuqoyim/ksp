<?php

class Berandas extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		//$this->load->model('item');
	}

	function index() {

		/*$this->template->add_js('template/js/ui-typography.js');
		$this->template->add_js('jQuery(document).ready(function () {
    		ui_typography.init();
		});','embed');*/

		$this->template->add_title('BERANDA');
		$breadcrumb = array(
			'berandas' => 'Beranda',
		);
		$this->template->add_breadcrumb($breadcrumb);

		$data['result'] = array();//$this->item->list_stok();

		$this->template->write_view('content','beranda/list',$data);
		$this->template->render();
	}



}


?>