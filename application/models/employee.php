<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}


	public function list_data($offset,$sort_by, $sort_order,$keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '(e.name LIKE \'%'.$keyword.'%\' 
						 OR e.email LIKE \'%'.$keyword.'%\' 
						 OR e.gender LIKE \'%'.$keyword.'%\' 
						 OR e.position LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('e.*',false);
		$this->db->from('employee e');
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
						 OR e.email LIKE \'%'.$keyword.'%\' 
						 OR e.gender LIKE \'%'.$keyword.'%\' 
						 OR e.position LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('count(e.id) as total');
		$this->db->from('employee e');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('e.*');
		$this->db->from('employee e');
		$this->db->where('e.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}


	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('employee',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('employee',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('employee');
	}




}
?>