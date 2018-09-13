<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}


	public function list_data($offset,$sort_by, $sort_order,$keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '( ';
			$where .= 'c.name LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR c.address LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('c.*',false);
		$this->db->from('company c');
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
			$where = '( ';
			$where .= 'c.name LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR c.address LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('count(c.id) as total');
		$this->db->from('company c');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('c.*',false);
		$this->db->from('company c');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}


	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('company',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('company',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('company');
	}




}
?>