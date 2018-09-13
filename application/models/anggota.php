<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}


	public function list_data($offset,$sort_by, $sort_order,$keyword='')
	{
		$keyword = clean_char_search($keyword);
		if($keyword){
			$where = '(m.name LIKE \'%'.$keyword.'%\' 
						 OR m.no_member LIKE \'%'.$keyword.'%\' 
						 OR m.birthplace LIKE \'%'.$keyword.'%\' 
						 OR m.gender LIKE \'%'.$keyword.'%\' 
						 OR m.relationship LIKE \'%'.$keyword.'%\' 
						 OR c.name LIKE \'%'.$keyword.'%\' 
						 OR m.phone LIKE \'%'.$keyword.'%\' 
						 OR m.hp LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('m.*,c.name as company_name',false);
		$this->db->from('member m');
		$this->db->join('company c','c.id=m.companyid');
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
						 OR m.no_member LIKE \'%'.$keyword.'%\' 
						 OR m.birthplace LIKE \'%'.$keyword.'%\' 
						 OR m.gender LIKE \'%'.$keyword.'%\' 
						 OR m.relationship LIKE \'%'.$keyword.'%\' 
						 OR c.name LIKE \'%'.$keyword.'%\' 
						 OR m.phone LIKE \'%'.$keyword.'%\' 
						 OR m.hp LIKE \'%'.$keyword.'%\' )';
			$this->db->where($where);
		}

		$this->db->select('count(m.id) as total');
		$this->db->from('member m');
		$this->db->join('company c','c.id=m.companyid');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('m.*,c.name as company_name,(SELECT date FROM member_deposit md WHERE md.memberid=m.id ORDER BY date ASC LIMIT 1) as member_date');
		$this->db->from('member m');
		$this->db->join('company c','c.id=m.companyid');
		$this->db->where('m.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function detail_deposit($id=0)
	{
		$this->db->select('md.*');
		$this->db->from('member_deposit md');
		$this->db->where('md.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function deposit_by_memberid($id=0)
	{
		$this->db->select('md.*');
		$this->db->from('member_deposit md');
		$this->db->where('md.memberid',$id);
		$this->db->order_by('md.date','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	function list_summary_deposit_by_memberid($id=0)
	{
		$this->db->select('SUM(md.pokok) as total_pokok');
		$this->db->select('SUM(md.wajib) as total_wajib');
		$this->db->select('SUM(md.sukarela) as total_sukarela');
		$this->db->from('member_deposit md');
		$this->db->where('md.memberid',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	function list_pinjaman($memberid=0)
	{
		$this->db->select('l.*');
		$this->db->from('loan l');
		$this->db->where('l.memberid',$memberid);
		$this->db->where('l.status',0);
		$query = $this->db->get();
		return $query->result_array();
	}

	function total_angsuran_masuk($loanid=0)
	{
		$this->db->select('IFNULL(SUM(i.amount),0) as total_amount');
		$this->db->from('installment i');
		$this->db->where('i.loanid',$loanid);
		$query = $this->db->get();
		return $query->row()->total_amount;
	}





	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('member',$data);
			return $this->db->insert_id();
		}
	}
	
	function insert_data_detail($data=array())
	{
		if(count($data)>0){
			$this->db->insert('member_deposit',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('member',$data);
		}
	}


	function update_data_deposit($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('member_deposit',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('member');
	}

	function delete_data_deposit($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('member_deposit');
	}





}
?>