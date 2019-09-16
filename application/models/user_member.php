<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_member extends CI_Model 
{

	public function list_data($offset,$sort_by, $sort_order,$keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '(m.name LIKE \'%'.$keyword.'%\' 
						 OR um.username LIKE \'%'.$keyword.'%\' 
						 OR r.description LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('um.*,r.description,m.name');
		$this->db->from('user_member um');
		$this->db->join('member m','m.id=um.member_id');
		$this->db->join('role r','r.id=um.roleid');
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
			$where = '(m.name LIKE \'%'.$keyword.'%\' 
						 OR um.username LIKE \'%'.$keyword.'%\' 
						 OR r.description LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('count(um.id) as total');
		$this->db->from('user_member um');
		$this->db->join('member m','m.id=um.member_id');
		$this->db->join('role r','r.id=um.roleid');
		return $this->db->get()->row()->total;
	}

	function detail_data($userid='')
	{
		$this->db->where('id',$userid);
		$query = $this->db->get('user_member');
		return $query->row_array();
		
	}

	public function check_username($username='')
	{
		$this->db->where('username',$username);
		$query = $this->db->get('user_member');
		return $query->result_array();
		
	}

	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('user_member',$data);
		}
	}

	function update_data($data=array(),$userid=0)
	{
		if(count($data)>0){
			$this->db->where('id',$userid);
			$this->db->update('user_member',$data);
		}
	}

	function delete_data($userid=0)
	{
		$this->db->where('id',$userid);
		$this->db->delete('user_member');
	}


}
?>