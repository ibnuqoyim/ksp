<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pinjaman extends CI_Model 
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
			$where .= 'OR l.date LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.amount LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.bunga LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.lama_angsuran LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.perbulan LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.no_loan LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('l.*,m.no_member,m.name',false);
		$this->db->from('loan l');
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
			$where .= 'OR l.date LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.amount LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.bunga LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.lama_angsuran LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.perbulan LIKE \'%'.$keyword.'%\' ';
			$where .= 'OR l.no_loan LIKE \'%'.$keyword.'%\' ';
			$where .= ')';
			$this->db->where($where);
		}

		$this->db->select('count(l.id) as total');
		$this->db->from('loan l');
		$this->db->join('member m','m.id=l.memberid');
		return $this->db->get()->row()->total;
	}
	
	function detail_data($id=0)
	{
		$this->db->select('l.*,m.no_member,m.name,c.name as company_name',false);
		$this->db->from('loan l');
		$this->db->join('member m','m.id=l.memberid');
		$this->db->join('company c','c.id=m.companyid');
		$this->db->where('l.id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}


	function insert_data($data=array())
	{
		if(count($data)>0){
			$this->db->insert('loan',$data);
		}
	}

	function update_data($data=array(),$id=0)
	{
		if(count($data)>0){
			$this->db->where('id',$id);
			$this->db->update('loan',$data);
		}
	}

	function delete_data($id=0)
	{
		$this->db->where('id',$id);
		$this->db->delete('loan');
	}

	public function get_maksimal_pinjam($date='',$memberid)
	{
		$this->db->select('md.pokok',false);
		$this->db->from('member_deposit md');
		if($memberid!=''){
			$this->db->where('md.memberid',$memberid);
		}
		if($date!=''){
			$this->db->where('md.date <=',$date);
		}
		$this->db->where('md.pokok >',0);
		$this->db->order_by('md.date','ASC');
		$this->db->limit(1);
		$query = $this->db->get();
		$pokok = $query->row_array();

		$this->db->select('SUM(d.wajib) as total_wajib',false);
		$this->db->from('deposit d');
		if($memberid!=''){
			$this->db->where('d.memberid',$memberid);
		}
		if($date!=''){
			$this->db->where('d.date <=',$date);
		}
		$query2 = $this->db->get();
		$wajib = $query2->row_array();

		$this->db->select('SUM(d.sukarela) as total_sukarela',false);
		$this->db->from('deposit d');
		if($memberid!=''){
			$this->db->where('d.memberid',$memberid);
		}
		if($date!=''){
			$this->db->where('d.date <=',$date);
		}
		$query3 = $this->db->get();
		$sukarela = $query3->row_array();
		
		$data['pokok'] = count($pokok)>0 ? $pokok['pokok'] : 0;
		$data['wajib'] = count($wajib)>0 ? $wajib['total_wajib'] : 0;
		$data['sukarela'] = count($sukarela)>0 ? $sukarela['total_sukarela'] : 0;
		return $data;

	}




}
?>