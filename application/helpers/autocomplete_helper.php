<?php

if(!function_exists('display_all_member')){
    function display_all_member($keyword){

		$CI = &get_instance();
		$CI->load->database('default',true);
		

		$arrkata = explode(" ", clean_char_search($keyword));
		$sql  = " SELECT e.* FROM employee e ";
		if (count($arrkata) > 0)
		{
			$sql .= " WHERE ";
			$i = 0;
			foreach ($arrkata as $ikata)
			{
					$i++;
					$sql .= "(e.name  LIKE '%$ikata%'";
					$sql .= " OR e.no_member LIKE '%$ikata%' )";
				    if ($i < count($arrkata)) $sql .= " AND ";
			}
		}
		$sql .= " ORDER BY e.name ASC ";
		if($CI->config->item('autocomplete_limit') > 0)
		{
			$sql .= " LIMIT ".$CI->config->item('autocomplete_limit')."";
		}
		$query=$CI->db->query($sql);
		
		if ($query->num_rows()>0)
		{
			$xx = array();
			foreach($query->result() as $rows)
			{
                $view = $rows->no_member." - ".$rows->name;
				$xx[] = array('id'=>$rows->id,'view'=> $view,'name'=>$rows->name,'no_member'=>$rows->no_member);
			}	
		  return $xx;
		}
		else
		{	
			return array();
		}
    }
}
