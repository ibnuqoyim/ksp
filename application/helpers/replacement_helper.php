<?php

if(! function_exists('clean_separator'))
{

    function clean_separator($val="")
    {
            $new_val = ($val !="" ? $val : 0);
            $result = preg_replace(REPLACEMENT, '', $new_val);
			
			if($result !="")
			{
				return trim($result);
			}
			else
			{
				return 0;
			}
				
    }
}

if(! function_exists('check_separator'))
{

    function check_separator($val="")
    {
		$new_val = ($val !="" ? $val : 0);
		$satu = $new_val[0];
		$dua = substr($new_val,-1);
		if($satu=='(' && $dua == ')'){
			$newst_val = str_replace('(','-',$new_val);
			$newst_val2 = str_replace(')','',$newst_val);
			return clean_separator($newst_val2);
			
		} else {
			return 0;
		}
				
    }
}


if(!function_exists('clean_caracter'))
{
    function clean_caracter($str,$remove ="&")
    {
        return preg_replace("[$remove]", "", $str);
    }
}


##MNIPULASI KEYWORD SEARCH
if(!function_exists('clean_char_search'))
{
    function clean_char_search($keyword='')
    {
		if($keyword=="'"){
			return '';
		} else {
			return addslashes(trim($keyword));
		}
    }
}




