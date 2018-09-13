<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('encrypt');
	}

	function getData($username,$password)
	{
		$this->db->select('u.*');
		$this->db->from('user u');
		$this->db->join('employee e','e.id=u.employeeid');
		$this->db->where('u.username',$username);
		$this->db->limit(1);
		$detail = $this->db->get()->row_array();
		if(count($detail)>0){
			$passwordOri = $this->encrypt->decode($detail['password'],$this->encrypt->hash(config_item('keyLogin')));
			if($passwordOri==$password){
				$data['userid'] 	= $detail['id'];
				$data['roleid'] 	= $detail['roleid'];
				$data['employeeid']	= $detail['employeeid'];
				$data['username'] 	= $detail['username'];
				$data['login']		= true;
				$this->session->set_userdata($data);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


}
?>