<?php
if( ! function_exists('employee_dropdown'))
{
	function employee_dropdown($userid=0)
	{
		$CI = &get_instance();
		$CI->load->database();
		$where = '';
		if($userid){
			$where = 'WHERE user.id != '.$userid.' ';
		}
		$CI->db->where('id NOT IN (SELECT employeeid FROM user '.$where.')');
		$q = $CI->db->get('employee');
		
		$return = array();
		
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->name;
			}
		}
		
		return $return;
	}
}


if( ! function_exists('role_dropdown'))
{
	function role_dropdown()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('id','ASC');
		$q = $CI->db->get('role');
		
		$return = array();
		
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->description;
			}
		}
		
		return $return;
	}
}

if( ! function_exists('employee_all_dropdown'))
{
	function employee_all_dropdown()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('name','ASC');
		$q = $CI->db->get('employee');
		
		$return = array();
		
		$return[] = '- - - Employee - - -';
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->name;
			}
		}
		
		return $return;
	}
}

if( ! function_exists('member_all_dropdown'))
{
	function member_all_dropdown()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('concat(no_member,\'-\',name)','ASC');
		$q = $CI->db->get('member');
		
		$return = array();
		
		$return[''] = '- - - Pilih Anggota - - -';
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->no_member.' - '.$rows->name;
			}
		}
		
		return $return;
	}
}
if( ! function_exists('member_all_dropdown2'))
{
	function member_all_dropdown2()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('concat(no_member,\'-\',name)','ASC');
		$q = $CI->db->get('member');
		
		$return = array();
		
		$return[''] = '- - - Pilih Anggota - - -';
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->no_member.' - '.$rows->name;
			}
		}
		
		return $return;
	}
}
if( ! function_exists('company_all_dropdown'))
{
	function company_all_dropdown()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('name','ASC');
		$q = $CI->db->get('company');
		
		$return = array();
		
		$return[''] = '- - - Pilih Kelas - - -';
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->name;
			}
		}
		
		return $return;
	}
}


if( ! function_exists('pinjaman_dropdown'))
{
	function pinjaman_dropdown()
	{
		$CI = &get_instance();
		$CI->load->database();
		$CI->db->order_by('no_loan','ASC');
		$q = $CI->db->get('loan');
		
		$return = array();
		
		$return[''] = '- - - Pilih No Pinjaman - - -';
		if($q->num_rows() > 0)
		{
			foreach ($q->result() as $rows)
			{
				$return[$rows->id] = $rows->no_loan;
			}
		}
		
		return $return;
	}
}


