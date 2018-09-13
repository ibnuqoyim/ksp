<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

$config['web_title'] 		= 'Koperasi Simpan Pinjam';
$config['vendor_name']		= 'Faizul Mubarak';
$config['vendor_email'] 	= 'arachnoid.dewa@gmail.com';
$config['vendor_hp']		= '085774462015';
$config['keyLogin'] 		= 'f4y5';
$config['page_num']			= '10';
$config['page_num_emp']		= '30';
$config['page_num_report']	= '20';
$config['autocomplete_limit']= '100';
$config['pengelola']		= 'Sutopo Yudhaning Tyas';

$config['simpanan']	= 'SN';
$config['pinjaman']	= 'PN';
$config['angsuran']	= 'AN';

$config['currency_format']['thousand_sep']		= ','; 	// Separator ribuan
$config['currency_format']['decimal_sep']		= '.'; 	// Separator Desimal
$config['currency_format']['decimal_use']		= TRUE; // Desimal Digunakan TRUE OR FALSE
$config['currency_format']['decimal_digit']		= 2;	// Jumlah Digit dibelakang koma

$config['bulan'] = array(
	1 => 'Januari',
	2 => 'Februari',
	3 => 'Maret',
	4 => 'April',
	5 => 'Mei',
	6 => 'Juni',
	7 => 'Juli',
	8 => 'Agustus',
	9 => 'September',
	10 => 'Oktober',
	11 => 'Nopember',
	12 => 'Desember',
);
