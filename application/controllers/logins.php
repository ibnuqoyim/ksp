<?php

class Logins extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('login');
		$this->load->library('encrypt');
	}

	function index() {
		
		$data['username'] = '';
		$data['warning'] = 'hide';
		$data['pesan'] = '';
		$this->load->view('login/login',$data);
	}
	
	function login_process(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$login = $this->login->getData($username,$password);
		if($login==true){
			redirect('berandas');
		} else {
			$this->session->sess_destroy();
			$data['username'] = $username;
			$data['warning'] = '';
			$data['pesan'] = 'Pengguna & password invalid!';
			$this->load->view('login/login',$data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect('logins');
	}

	function expired(){
		$this->session->sess_destroy();
		$data['username'] = '';
		$data['warning'] = '';
		$data['pesan'] = 'Aplikasi telah EXPIRED, silahkan hubungi '.config_item('vendor_email').' atau '.config_item('vendor_hp');
		$this->load->view('login/login',$data);
	}


}


?>