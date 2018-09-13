<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_potongan extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
	}


	public function list_data_simpanan($offset='',$sort_by='', $sort_order='')
	{
		$sess = $this->session->userdata($this->func);
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		$memberid		= $sess['memberid'] ? $sess['memberid'] : '';
		$companyid		= $sess['companyid'] ? $sess['companyid'] : '';

		$this->db->select('d.date as tgl_simpan,m.id as  memberid,m.name,m.no_member,d.pokok,d.wajib,d.sukarela');
		$this->db->from('deposit d');
		$this->db->join('member m','m.id=d.memberid');
		if($memberid){
			$this->db->where('d.memberid',$memberid);
		}
		if($companyid){
			$this->db->where('m.companyid',$companyid);
		}
		if($tgl_dari){
			$this->db->where('d.date >=',$tgl_dari);
		}
		if($tgl_sampai){
			$this->db->where('d.date <=',$tgl_sampai);
		}
		//$this->db->order_by($sort_by,$sort_order);
		//$this->db->limit($this->config->item('page_num_report'),$offset);
		$result = $this->db->get()->result_array();
		if(count($result)>0){
			return $result;
		} else {
			$offset = $offset-$this->config->item('page_num_report');
			if($offset >= 0){
				return $this->list_data_simpanan($offset,$sort_by, $sort_order,$keyword);
			} else {
				return array();
			}
		}

	}

	public function list_data_pinjaman($offset='',$sort_by='', $sort_order='')
	{
		$sess = $this->session->userdata($this->func);
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		$memberid		= $sess['memberid'] ? $sess['memberid'] : '';
		$companyid		= $sess['companyid'] ? $sess['companyid'] : '';

		$this->db->select('i.date as tgl_simpan,m.id as  memberid,m.name,m.no_member,i.amount');
		$this->db->from('installment i');
		$this->db->join('loan l','i.loanid=l.id');
		$this->db->join('member m','m.id=l.memberid');

		if($memberid){
			$this->db->where('l.memberid',$memberid);
		}
		if($companyid){
			$this->db->where('m.companyid',$companyid);
		}
		if($tgl_dari){
			$this->db->where('i.date >=',$tgl_dari);
		}
		if($tgl_sampai){
			$this->db->where('i.date <=',$tgl_sampai);
		}
		//$this->db->order_by($sort_by,$sort_order);
		//$this->db->limit($this->config->item('page_num_report'),$offset);
		$result = $this->db->get()->result_array();
		if(count($result)>0){
			return $result;
		} else {
			$offset = $offset-$this->config->item('page_num_report');
			if($offset >= 0){
				return $this->list_data_pinjaman($offset,$sort_by, $sort_order,$keyword);
			} else {
				return array();
			}
		}

	}


	public function jumlah_data()
	{
		$sess = $this->session->userdata($this->func);
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		$memberid		= $sess['memberid'] ? $sess['memberid'] : '';
		$companyid		= $sess['companyid'] ? $sess['companyid'] : '';

		$this->db->select('count(d.id) as total');
		$this->db->from('deposit d');
		$this->db->join('member m','m.id=d.memberid');
		if($memberid){
			$this->db->where('d.memberid',$memberid);
		}
		if($companyid){
			$this->db->where('m.companyid',$companyid);
		}
		if($tgl_dari){
			$this->db->where('d.date >=',$tgl_dari);
		}
		if($tgl_sampai){
			$this->db->where('d.date <=',$tgl_sampai);
		}
		return $this->db->get()->row()->total;



	}
	
	function get_pinjam_angsuran($memberid=0,$tgl_simpan=''){
		$sess = $this->session->userdata($this->func);
		$tgl_dari	= $sess['tgl_dari'] ? format_date_us('01/'.$sess['tgl_dari']) : '';
		$tgl_sampai_arr	= explode('/',$sess['tgl_sampai']);
		$tgl_sampai = '';
		if(count($tgl_sampai_arr)>0 && $sess['tgl_sampai']!=''){
			$tgl_sampai = $tgl_sampai_arr[1].'-'.$tgl_sampai_arr[0].'-'.countDatePerMonth($tgl_sampai_arr[0],$tgl_sampai_arr[1]);
		}
		
		$blnArr = explode('-',$tgl_simpan);
		$bln = $blnArr[1];
		$thn = $blnArr[0];

		$this->db->select('i.amount as angsuran,i.transaction as angsuran_ke');
		$this->db->select('l.amount as pokok_pinjaman,l.bunga,l.lama_angsuran,l.perbulan,l.flag');
		$this->db->from('installment i');
		$this->db->join('loan l','l.id=i.loanid');
		if($memberid){
			$this->db->where('l.memberid',$memberid);
		}
		if($bln){
			$this->db->where('month(i.date)',$bln);
		}
		if($thn){
			$this->db->where('year(i.date)',$thn);
		}
		$query = $this->db->get();
		return $query->row_array();
	}
	

	function get_company($companyid=0){
		
		if($companyid){
			$this->db->select('c.name');
			$this->db->from('company c');
			$this->db->where('c.id',$companyid);
			$query = $this->db->get();
			return $query->row_array();
		} else {
			return array();
		}
	}
	


}
?>