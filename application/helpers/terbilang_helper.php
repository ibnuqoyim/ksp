<?php
/** 
*  Function:   convert_number 
*
*  Description: 
*  Converts a given integer (in range [0..1T-1], inclusive) into 
*  alphabetical format ("one", "two", etc.)
*
*  @int
*
*  @return string
*
*/ 
function convert_number($number) 
{
	$number_real = $number;
	$CI = &get_instance();
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Angka Melebihi Batas");
    }  
	$Gn = floor($number / 1000000);  /* Millions (giga) */ 
    $number -= $Gn * 1000000; 
    $kn = floor($number / 1000);     /* ribuan (kilo) */ 
    $number -= $kn * 1000; 
	$Hn = floor($number / 100);      /* seratus (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 
	$res = "";  
	if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Juta"; 
        
    } 

    if ($kn) 
    { 
		if($kn > 1)
		{
        	$res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Ribu "; 
		}
		else
		{
			$res .= (empty($res) ? "" : " "). " Seribu "; 
		}
    } 
	if ($Hn) 
    { 
		if($Hn > 1)
		{
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Ratus "; 
		}
		else
		{
			 $res .= (empty($res) ? "" : " ") . " Seratus "; 
		}
    } 
    $ones = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", 
        "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas", "Dua belas", "Tiga Belas", 
        "Empat Belas", "Lima Belas", "Enam Belas", "Tujuh Belas", "Delapan Belas", 
        "Sembilan Belas"); 
    $tens = array("", "", "Dua Puluh", "Tiga Puluh", "Empat Puluh", "Lima Puluh", "Enam Puluh", 
        "Tujuh Puluh", "Delapan Puluh", "Sembilan Puluh"); 
    if ($Dn || $n) 
    { 
        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
			
			if($number_real > 0)
			{  
				$str=explode('.',$number_real);
				if(isset($str[1]))
				{
					$res .= " Koma ".convert_number($str[1]);	
				}
			}
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= " " . $ones[$n]; 
            } 
			if($number_real > 0)
			{ 
				$str=explode('.',$number_real);
				if(isset($str[1]))
				{
					if($str[1] != 0)
					$res .= " Koma ".convert_number($str[1]);	
				}
			}
        } 
    } 

    if (empty($res)) 
    { 
        $res = ""; 
    } 

    return ($res); 
} 

?>