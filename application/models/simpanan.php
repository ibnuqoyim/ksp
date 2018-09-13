<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpanan extends CI_Model 
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
			$where .= 'm.name LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR m.no_member LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR d.no_trans LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('d.*,m.no_member,m.name',false);
		$this->db->from('deposit d');
		$this->db->join('member m','m.id=d.memberid');
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
			$where .= 'm.name LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR m.no_member LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR d.no_trans LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('count(d.id) as total');
		$this->db->from('deposit d');
		$this->db->join('member m','m.id=d.memberid');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('d.*,m.no_member,m.name',false);
		$this->db->from('deposit d');
		$this->db->join('member m','m.id=d.memberid');
		$this->db->where('d.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}


	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('deposit',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('deposit',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('deposit');
	}

	public function get_default_simpanan($date='',$memberid)
	{
		$this->db->select('md.*',false);
		$this->db->from('member_deposit md');
		if($memberid!=''){
			$this->db->where('md.memberid',$memberid);
		}
		if($date!=''){
			$this->db->where('md.date <=',$date);
		}
		$this->db->order_by('md.date','DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();

	}


	public function check_date($date='',$memberid,$id='')
	{
		if($memberid!=''){
			$this->db->where('memberid',$memberid);
		}
		if($date!=''){
			$month = date('m',strtotime($date));
			$year = date('Y',strtotime($date));
			$this->db->where('MONTH(date)',$month);
			$this->db->where('YEAR(date)',$year);
		}
		if($id>0){
			$this->db->where('id != '.$id.' ');
		}
		$query = $this->db->get('deposit');
		return $query->result_array();
		
	}




}
?>