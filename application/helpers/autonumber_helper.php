<?php


if( ! function_exists('no_member'))
{
	function no_member()
	{
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT m.no_member ';
		$sql .= 'FROM member m ';
		$sql .= 'ORDER BY m.no_member DESC ';
		$query = $CI->db->query($sql);
		$result = $query->row_array();

		$tahun_skrg = date('y');

		if(count($result)>0){
			$no_member = $result['no_member'];
			$tahun = substr($no_member,0,2);
			if($tahun==$tahun_skrg){//jika thn masih saat ini
				$number = $no_member+1;
			} else {
				$number = $tahun_skrg.sprintf('%04d',1);
			}
		} else {
			$number = $tahun_skrg.sprintf('%04d',1);
		}
		return $number;

	}
}

if( ! function_exists('no_transaksi'))
{
	function no_transaksi()
	{
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT no_trans ';
		$sql .= 'FROM deposit ';
		$sql .= 'ORDER BY no_trans DESC ';
		$query = $CI->db->query($sql);
		$result = $query->row_array();
		$number = 1;
		if(count($result)>0){
			$number = substr($result['no_trans'],2);
			$number = $number+1;
		}
		$number = sprintf('%06d',$number);
		return config_item('simpanan').$number;

	}
}


if( ! function_exists('no_transaksi_pinjaman'))
{
	function no_transaksi_pinjaman()
	{
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT no_loan ';
		$sql .= 'FROM loan ';
		$sql .= 'ORDER BY no_loan DESC ';
		$query = $CI->db->query($sql);
		$result = $query->row_array();
		$number = 1;
		if(count($result)>0){
			$number = substr($result['no_loan'],2);
			$number = $number+1;
		}
		$number = sprintf('%06d',$number);
		return config_item('pinjaman').$number;

	}
}


if( ! function_exists('no_transaksi_angsuran'))
{
	function no_transaksi_angsuran()
	{
		$CI = &get_instance();
		$CI->load->database();

		$sql = 'SELECT no_trans ';
		$sql .= 'FROM installment ';
		$sql .= 'ORDER BY no_trans DESC ';
		$query = $CI->db->query($sql);
		$result = $query->row_array();
		$number = 1;
		if(count($result)>0){
			$number = substr($result['no_trans'],2);
			$number = $number+1;
		}
		$number = sprintf('%06d',$number);
		return config_item('angsuran').$number;

	}
}


