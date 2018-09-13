<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if( ! function_exists('detail_employee'))
{
	function detail_employee($employeeid)
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->where('id',$employeeid);
		$q = $CI->db->get('employee');
		return $q->row_array();
	}
}

if (! function_exists('format_bulan_tahun'))
{
	function format_bulan_tahun($tanggal)
	{
		$CI=& get_instance();
		$bulan = $CI->config->item('bulan');

		if($tanggal !='' && $tanggal != '0000-00-00'){
			$res = $bulan[date('n',strtotime($tanggal))].' '.date('Y',strtotime($tanggal));
		} else {
			$res = '---';
		}
		return $res;
	}
}

if (! function_exists('format_tanggal_khusus'))
{
	function format_tanggal_khusus($tanggal)
	{
		$CI=& get_instance();
		$bulan = $CI->config->item('bulan');

		if($tanggal !='' && $tanggal != '0000-00-00'){
			$res = date('d',strtotime($tanggal)).' '.$bulan[date('n',strtotime($tanggal))].' '.date('Y',strtotime($tanggal));
		} else {
			$res = '---';
		}
		return $res;
	}
}


if (! function_exists('format_tanggal'))
{
	function format_tanggal($tanggal)
	{
		if($tanggal !='' && $tanggal != '0000-00-00'){
			$res = date('F j, Y',strtotime($tanggal));
		} else {
			$res = '---';
		}
		return $res;
	}
}



if (! function_exists('format_tanggal_khusus_indo'))
{
	function format_tanggal_khusus_indo($tanggal)
	{
		$CI=& get_instance();
		$bulan = $CI->config->item('bulan');
		if($tanggal !='' && $tanggal != '0000-00-00'){
			$res = date('j',strtotime($tanggal)).' '.$bulan[date('n',strtotime($tanggal))].' '.date('Y',strtotime($tanggal));
		} else {
			$res = '---';
		}
		return $res;
	}
}


if (! function_exists('format_jam'))
{
	function format_jam($tanggal)
	{
		$res=date('H:i:s',strtotime($tanggal));
		return $res;
	}
}

if (! function_exists('format_tanggal_hari'))
{
	function format_tanggal_hari($date)
	{
		$CI=& get_instance();
		$CI->load->config();
		$nama_hari=$CI->config->item('hari');
		$nama_bulan=$CI->config->item('bulan');
		$hari=$nama_hari[date("w",strtotime($date))];
		$tanggal=date("j",strtotime($date));
		$bulan=$nama_bulan[date("n",strtotime($date))];
		$tahun=date("Y",strtotime($date));
		
		$tanggal_indonesia = $hari .', '. $tanggal.' '.$bulan.' '.$tahun;
		
		return $tanggal_indonesia;
		
	}
}

if(! function_exists('format_date_us'))
{
	function format_date_us($tanggal)
	{
		if($tanggal !="")
		{
			$arraytanggal 	= explode('/',$tanggal);
			if(count($arraytanggal)>=3){
				$var_tanggal 	= $arraytanggal[0];
				$var_bulan 		= $arraytanggal[1];
				$var_tahun 		= $arraytanggal[2];
				$tanggal 		= $var_tahun . '-' . $var_bulan . '-' . $var_tanggal;
			} else {
				$tanggal		= '';
			}
			
			return  $tanggal;
		}
	}
}



if(!function_exists('currency_format')){
	function currency_format($val,$precision,$thousand_sep,$dec_sep,$nol='tidak'){
		if($val != 0){
			$data = number_format($val,$precision,$dec_sep,$thousand_sep);
		}else{
			if($nol == 'ya'){
				$data = number_format(0,$precision,$dec_sep,$thousand_sep);
			}else{
				$data = number_format(0,$precision,$dec_sep,$thousand_sep);
			}
		}
		return $data;
	}
}

if (! function_exists('format_uang'))
{
	function format_uang($uang)
	{
		$CI = &get_instance();
		$CI->load->config();
		
		$param = $CI->config->item('currency_format');
		
		$uangs = (float)($uang);

		if($param['decimal_use'] == TRUE && $param['decimal_digit'] > 0)
		{
				$res	=	number_format($uangs,$param['decimal_digit'],$param['decimal_sep'],$param['thousand_sep']);
		}
		else 
		{
				$res	= number_format($uang,0,"",$param['thousand_sep']);
		}

		
		
		return $res;
	}
}

if(!function_exists('format_uang_idr')){
    function format_uang_idr($uang){
        return number_format($uang,0,'.',',');
    }
}

if(!function_exists('cut_decimal')){
    function cut_decimal($nominal,$digit){
		$uang = explode('.',$nominal);
		if(count($uang)>1){ /*MEMILIKI DESIMAL*/
			$nilai = $uang[0];
			$des = substr($uang[1],0,$digit);
			$hasil = $nilai.'.'.$des;
		} else {
			$hasil = $uang[0];
		}
		return $hasil;
    }
}


//example  Result : 10 February 2011
if(! function_exists('date_longs'))
{
	function date_longs($tanggal)
	{
		if($tanggal !="")
		{
			$res = date('d F Y',strtotime($tanggal));
		}
		else 
		{
			$res = "--";
		}
		
		return $res;
	}
}

if(! function_exists('date_longs_ind'))
{
	function date_longs_ind($tanggal)
	{
		if($tanggal !="")
		{
			$tgl = date('d',strtotime($tanggal));
			$bln = namaBulan(date('m',strtotime($tanggal)));
			$thn = date('Y',strtotime($tanggal));
			$res = $tgl.' '.$bln.' '.$thn;
		}
		else 
		{
			$res = "--";
		}
		
		return $res;
	}
}


if( ! function_exists('mata_uang'))
{
	function mata_uang()
	{
		$CI = &get_instance();
		$CI->load->config();
		
		$cur_symbol = $CI->config->item('currency');
		
		if($cur_symbol !="")
		{
			return $cur_symbol;
		}
		else 
		{
			return 'Rp. ';
		}
		
	}
}


//example  Result : 10 Feb 2011
if(! function_exists('date_simple'))
{
	function date_simple($tanggal)
	{
		if($tanggal !="")
		{
			$res = date('M d Y',strtotime($tanggal));
		}
		else 
		{
			$res = "--";
		}
		
		return $res;
	}
}


if(! function_exists('format_number'))
{
	function format_number($val,$thoussand="",$decimal=".",$digit = 2)
	{
		if($val >= 0)
		{
			return number_format($val,$digit,$decimal,$thoussand);
		}
		else 
		{
			return '--';
		}
		
	}
}



if (! function_exists('format_datepicker'))
{
	function format_datepicker($tanggal)
	{
		if($tanggal !='' && $tanggal != '0000-00-00' && $tanggal != 0){
			$res = date('d/m/Y',strtotime($tanggal));
		} else {
			$res = '';
		}
		return $res;
	}
}

if (! function_exists('default_date'))
{
	function default_date()
	{
		return date('d/m/Y');
	}
}

if (! function_exists('get_month'))
{
	function get_month($tanggal=NULL,$separator='/')
	{
		if($tanggal){
			$a = explode("".$separator."",$tanggal);
			$month = intval($a[0]);
		} else {
			$month = '';
		}
		return $month;
	}
}

if (! function_exists('format_period'))
{
	##format tanggal parameter berbentuk us
	function format_period($startdate,$finishdate)
	{
		$period = 'All Period';
		if($finishdate && !$startdate){##hanya end date
			$period = ' < '.format_datepicker($finishdate);
		} elseif(!$finishdate && $startdate){##hanya start date
			$period = ' > '.format_datepicker($startdate);
		} elseif($finishdate && $startdate){##hanya start date
			$period = format_datepicker($startdate).' - '.format_datepicker($finishdate);
		}
		return $period;

	}
}

if (! function_exists('format_period_month'))
{
	##format tanggal parameter berbentuk us
	function format_period_month($startdate,$finishdate)
	{
		$period = 'Semua Periode';
		if($finishdate && !$startdate){##hanya end date
			$period = ' < '.format_bulan_tahun($finishdate);
		} elseif(!$finishdate && $startdate){##hanya start date
			$period = ' > '.format_bulan_tahun($startdate);
		} elseif($finishdate && $startdate){##hanya start date
			$period = format_bulan_tahun($startdate).' sampai '.format_bulan_tahun($finishdate);
		}
		return $period;

	}
}

if (! function_exists('format_datepicker_full'))
{
	function format_datepicker_full($tanggal)
	{
		if($tanggal !='' && $tanggal != '0000-00-00'){
			$res = date('d/m/Y H:i:s',strtotime($tanggal));
		} else {
			$res = '';
		}
		return $res;
	}
}

//exm = January 12, 2011
if (! function_exists('hitung_jumlah_hari'))
{
	function hitung_jumlah_hari($tgl_join)
	{			
			$pecah1 = explode("-", $tgl_join);
			$date1 = $pecah1[2];
			$month1 = $pecah1[1];
			$year1 = $pecah1[0];
					
			$jd1 = GregorianToJD($month1, $date1, (int)$year1);
			return $jd1;
	}
}
function countDatePerMonth($month,$year){
		if($year%400 == 0){
			$kabisat = 29;
		}else{
			if($year%100 == 0){
				$kabisat = 28;
			}else{
				if($year%4 == 0){
					$kabisat = 29;
				}else{
					$kabisat = 28;
				}
			}
		}
		
		if($month == 1 or $month == 3 or $month == 5 or $month == 7 or $month == 8 or $month == 10 or $month == 12){
			$end_date = 31;
		}else if($month == 4 or $month == 6 or $month == 9 or $month == 11){
			$end_date = 30;
		}else{
			$end_date = $kabisat;
		}
		
		return $end_date;
	}
	


function totalDayOnRangeDate($startdate,$finishdate){
     	$days = round(abs(strtotime($startdate)-strtotime($finishdate))/86400);
		return $days;
}




if(!function_exists('round_numbers')){
    function round_numbers($is_round,$currid,$value,$excel=false){
        if($is_round == 0){ #=> Jika tidak round
			if($excel)
				return $value;
            if($currid == 2){ #=> Jika IDR 
                return format_uang_idr($value);
            }else{
                return format_uang($value);
            }
        }else{ #=> Jika Round
			if($excel)
				return $value;
            if($currid == 2){ #=> Jika IDR
                return format_uang_idr(round($value,0));
            }else{
                return format_uang(round($value,2));
            }
        }
    }
}
if(!function_exists('print_rr')){
	function print_rr($array){
		$count = count($array);
		foreach($array as $key=>$value){
			if(is_array($value)){
				$id = md5(rand());
				echo '[<a href="#" onclick="return expandParent(\''.$id.'\')">'.$key.'</a>]<br />';
				echo '<div id="'.$id.'" style="display:none;margin:10px;border-left:1px solid; padding-left:5px;">';
				print_rr($value, $count);
				echo '</div>';
			} else {
				echo "<b>&nbsp;&nbsp;&nbsp;&nbsp;$key</b>: ".$value."<br />";
			}
		}
			echo '
			<script language="Javascript">
			function expandParent(id){
				toggle="block";
				if(document.getElementById(id).style.display=="block"){
					toggle="none"
				}
				document.getElementById(id).style.display=toggle
				return false;
			};
			</script>
			';
	}
}


if (! function_exists('monthOfName'))
{
	function monthOfName($date)
	{
		$month	= array(1=>'January','February','March','April','May','June','July','August','September','October','November','December');
		return $month[intval($date)];
	}
}

if (! function_exists('namaBulan'))
{
	function namaBulan($date)
	{
		$month	= array(1=>'Januari','Februari','Mart','April','Mai','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');
		return $month[intval($date)];
	}
}


if (! function_exists('convert_length'))
{
	function convert_length($time)
	{
		$waktu = explode(':',$time);
		if (count($waktu) > 1){
			$time2 = $time;
		} else {
			$time2 = $time.':00';
		}


		$times = explode(':',$time2);
		if ($times[0]!=''){
			$jum = strlen($times[0]);
			if ($jum == 1) {
				$jam = '0'.$times[0];
			} else {
				$jam = $times[0];
			}
		} else {
				$jam = '00';
		}

		if ($times[1]!=''){
			$jum = strlen($times[1]);
			if ($jum == 1) {
				$menit = '0'.$times[1];
			} else {
				$menit = $times[1];
			}
		} else {
				$menit = '00';
		}
		return $jam.':'.$menit;
	}
}



if (! function_exists('convert_unit'))
{
	function convert_unit($time)
	{
		$waktu = explode('.',$time);
		if (count($waktu) > 1){
			$time2 = $time;
		} else {
			$time2 = $time.'.00';
		}

		$times = explode('.',$time2);

		if ($times[0]!=''){
			$jum = strlen($times[0]);
			if ($jum == 1) {
				$jam = '0'.$times[0];
			} else {
				$jam = $times[0];
			}
		} else {
				$jam = '00';
		}

		if ($times[1]!=''){
			$jum = strlen($times[1]);
			if ($jum == 1) {
				$menit = $times[1].'0';
			} else {
				$menit = $times[1];
			}
		} else {
				$menit = '00';
		}
		$menits = substr($menit,0,2);
		return $jam.'.'.$menits;
	}
}

if (! function_exists('manipulasi_detik'))
{
	function manipulasi_detik($datetime,$lama)
	{

		$newdate = strtotime ($lama.' seconds', strtotime($datetime));
		return date('Y-m-d H:i:s',$newdate);

/*		$date = date_create($datetime);
		date_add($date, date_interval_create_from_date_string($lama.' seconds'));
		return date_format($date, 'Y-m-d H:i:s');
*/
	}
}

if (! function_exists('manipulasi_tanggal'))
{
	function manipulasi_tanggal($datetime,$lama)
	{

		$newdate = strtotime ('"'.$lama.'"', strtotime($datetime));
		return date('Y-m-d H:i:s',$newdate);

/*		$date = date_create($datetime);
		date_add($date, date_interval_create_from_date_string($lama));
		return date_format($date, 'Y-m-d H:i:s');
*/

	}
}


if(!function_exists('encode_quote')){
    function encode_quote($string){
		return htmlspecialchars($string, ENT_QUOTES);
    }
}

if(!function_exists('encode_quote_arr')){
    function encode_quote_arr($arr){
		$data = array();
		if(count($arr)>0){
			foreach ($arr as $key => $val) {
				if(is_array($val)==1)
					$data[$key] = encode_quote_arr($val);
				else
					$data[$key] = htmlspecialchars($val, ENT_QUOTES);
			}
		}
		return $data;
    }
}

if(!function_exists('decode_quote')){
    function decode_quote($string){
		return htmlspecialchars_decode($string);
    }
}




if(!function_exists('decode_quote_arr')){
    function decode_quote_arr($arr){
		$data = array();
		if(count($arr)>0){
			foreach ($arr as $key => $val) {
				if(is_array($val)==1)
					$data[$key] = decode_quote_arr($val);
				else
					$data[$key] = htmlspecialchars_decode($val);
			}
		}
		return $data;
    }
}



if (! function_exists('generate_date'))
{
	function generate_date()
	{
		return date('d/m/Y H:i:s');
	}
}

if(!function_exists('design_currencyid')){
    function design_currencyid($currencyid1,$currencyid2){
		$CI = & get_instance();

		$CI->db->select('cr.*');
		$CI->db->from('currency_range cr');
		if($currencyid1 && $currencyid2){
			$where = '(cr.currencyid = '.$currencyid1.' OR cr.currencyid = '.$currencyid2.')';
			$CI->db->where($where);
		}
		$CI->db->order_by('cr.range','ASC');
		$query = $CI->db->get();
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
    }
}

if(! function_exists('dateDiff'))
{
	function dateDiff($startdate, $enddate) 
	{
	  	return round((strtotime($enddate)-strtotime($startdate))/86400);
	}
}

?>