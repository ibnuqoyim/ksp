<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Model 
{

	public function list_data($offset,$sort_by, $sort_order,$keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '(e.name LIKE \'%'.$keyword.'%\' 
						 OR u.username LIKE \'%'.$keyword.'%\' 
						 OR r.description LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('u.*,r.description,e.name');
		$this->db->from('user u');
		$this->db->join('employee e','e.id=u.employeeid');
		$this->db->join('role r','r.id=u.roleid');
		$this->db->order_by($sort_by,$sort_order);
		$this->db->limit($this->config->item('page_num'),$offset);
		$result = $this->db->get()->result_array();
		if(count($result)>0){
			return $result;
		} else {
			$offset = $offset-$this->config->item('page_num');
			if($offset >= 0){
				return $this->list_data($offset,$sort_by, $sort_order,$keyword);
			} else {
				return array();
			}
		}
	}

	public function jumlah_data($keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '(e.name LIKE \'%'.$keyword.'%\' 
						 OR u.username LIKE \'%'.$keyword.'%\' 
						 OR r.description LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('count(u.id) as total');
		$this->db->from('user u');
		$this->db->join('employee e','e.id=u.employeeid');
		$this->db->join('role r','r.id=u.roleid');
		return $this->db->get()->row()->total;
	}

	function detail_data($userid='')
	{
		$this->db->where('id',$userid);
		$query = $this->db->get('user');
		return $query->row_array();
		
	}

	public function check_username($username='')
	{
		$this->db->where('username',$username);
		$query = $this->db->get('user');
		return $query->result_array();
		
	}

	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('user',$data);
		}
	}

	function update_data($data=array(),$userid=0)
	{
		if(count($data)>0){
			$this->db->where('id',$userid);
			$this->db->update('user',$data);
		}
	}

	function delete_data($userid=0)
	{
		$this->db->where('id',$userid);
		$this->db->delete('user');
	}


}
?>