<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Angsuran extends CI_Model 
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
			$where .= 'OR l.no_loan LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR i.no_trans LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('i.*,m.no_member,m.name,l.no_loan,l.status',false);
		$this->db->select('(SELECT i2.transaction FROM installment i2 WHERE i2.loanid = i.loanid ORDER BY i2.transaction DESC LIMIT 1) as last_trans',false);
		$this->db->from('installment i');
		$this->db->join('loan l','l.id=i.loanid');
		$this->db->join('member m','m.id=l.memberid');
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
			$where .= 'OR l.no_loan LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR i.no_trans LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('count(i.id) as total');
		$this->db->from('installment i');
		$this->db->join('loan l','l.id=i.loanid');
		$this->db->join('member m','m.id=l.memberid');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('i.*,m.no_member,m.name,l.no_loan,l.status',false);
		$this->db->from('installment i');
		$this->db->join('loan l','l.id=i.loanid');
		$this->db->join('member m','m.id=l.memberid');
		$this->db->where('i.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}


	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('installment',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('installment',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('installment');
	}

	public function get_detail_information($loanid='',$installmentid=0)
	{
		$where_sub = '';
		if($installmentid!=0){
			$where_sub = 'AND i.id!='.$installmentid.'';
		}
		$this->db->select('IF(l.flag="Bulan",l.lama_angsuran,(l.lama_angsuran*12)) as lama_angsuran,l.perbulan,m.no_member,m.name',false);
		$this->db->select('IFNULL((SELECT (i.transaction+1) FROM installment i WHERE i.loanid='.$loanid.' '.$where_sub.' ORDER BY i.transaction DESC LIMIT 1),1) as angsuran_ke',false);
		$this->db->from('loan l');
		$this->db->join('member m','m.id=l.memberid');
		if($loanid!=''){
			$this->db->where('l.id',$loanid);
		}
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->row_array();

	}




}
?>