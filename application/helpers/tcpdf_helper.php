<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	require_once('tcpdf/config/lang/eng.php');
	require_once('tcpdf/tcpdf.php');
	
	
	class MYPDF extends TCPDF 
	{
		var $header_data;
		var $footer_text;
		var $enable_header = FALSE;
		var $enable_footer = FALSE;
		var $enable_footer_number = FALSE;
		var $y_footer = -48;
		/*
		function __construct()
		{
			parent::TCPDF();
		}
		*/
		public function setHeaderData($data)
		{
			$this->header_data = $data;
		}
		
		public function set_footer_text($text = array())
		{
			
				$this->footer_text = $text;		
		}

		public function set_enable_header($val = 'FALSE')
		{
			$this->enable_header = $val;
		}
		public function set_enable_footer($val = 'FALSE')
		{
			$this->enable_footer = $val;
		}
		public function set_enable_footer_number($val = 'FALSE')
		{
			$this->enable_footer_number = $val;
		}
		public function set_y_footer($val)
		{
			$this->y_footer = $val;
		}
    	// Page footer
	    public function Footer() 
	    {
	        // Position at 15 mm from bottom
	       
	        $CI 	= & get_instance();
			$CI->load->config();
			$use 	= $CI->config->item('footer_report');
			if($use == TRUE)
			{
		        $this->SetY(-20);
		        // Set font
				$fontname = $CI->config->item('font_print') ? $CI->config->item('font_print') : 'helvetica';
				$fontsize = $CI->config->item('fontsize_print') ? $CI->config->item('fontsize_print') : 7;
				$this->SetFont($fontname, 'N', $fontsize);
		        //$this->SetFont('helvetica', 'R', 7);
		       
		        $this->writeHTML($this->footer_template(), true, 0, true, 0);
			}
			if($this->enable_footer == TRUE)
			{
		        $this->SetY($this->y_footer);
		        // Set font
		        //$this->SetFont('helvetica', 'R', 9);
		       
		        $this->writeHTML($this->footer_template(), true, 0, true, 0);
			}
			if($this->enable_footer_number == TRUE)
			{
		        $this->SetY($this->y_footer);
		        // Set font
		        //$this->SetFont('helvetica', 'R', 9);
		       
				$this->Cell(0, 0, $this->footer_text, 'T', 0, 'R');
			}
	      
	    }
	    
	   
	    public function header()
	    {
	    	$CI 	= & get_instance();
			$CI->load->config();
			$use 	= $CI->config->item('header_report');
			if($use == TRUE)
			{
		    	if(!empty($this->header_data))
		    	{
		    		$this->writeHTML($this->header_data, true, 0, true, 0);
		    	}
		    	else 
		    	{
		    		$this->writeHTML($this->header_template(), true, 0, true, 0);
		    	}
			}
			elseif ($this->enable_header == TRUE)
			{
				if(!empty($this->header_data))
		    	{
		    		$this->writeHTML($this->header_data, true, 0, true, 0);
		    	}
		    	else 
		    	{
		    		$this->writeHTML($this->header_template(), true, 0, true, 0);
		    	}
			}
	    }
	    
	    
	    function header_template()
	    {
	    	
				$CI 	= & get_instance();
				$CI->load->config();
				$logo 	= $CI->config->item('pdf_header_logo');
				$header  = '<br/>';
				$header .= '<br/>';
				$header .= '<table width="100%" border="0">';
				$header .= '<tr>';
				$header .= '<td align="center"><img src="'.$logo.'" width="264" height="79"/></td>';
				$header .= '</tr>';
				$header .= '</table>';
				$header .= '<br/>';
				
				return $header;
	    }
	    
	    
	    private function footer_template()
	    {
	    	$CI 	= & get_instance();
			$CI->load->config();
			$template = $CI->config->item('footer_pdf');
			$tbl ="";
			
			if($this->enable_footer == TRUE)
			{
				$tbl .=$this->footer_text;
			}
			else
			{
				if(is_array($this->footer_text) && !empty($this->footer_text))
				{			
					$txt = implode('<br/>', $this->footer_text);				
					$tbl .= '<table width="100%" border="0" cellpadding="2" cellspacing="0">';
					$tbl .= '<tr>';
					$tbl .= '<td align="center" valig="middle">';
					$tbl .= $txt;
					$tbl .= '</td>';
					$tbl .= '</tr>';
					$tbl .= '</table>';
				}
				else if(is_array($template) && !empty($template))
				{
					$txt = implode('<br/>', $template);				
					$tbl .= '<table width="100%" border="0" cellpadding="2" cellspacing="0">';
					$tbl .= '<tr>';
					$tbl .= '<td align="center" valig="middle">';
					$tbl .= $txt;
					$tbl .= '</td>';
					$tbl .= '</tr>';
					$tbl .= '</table>';
				}
				else 
				{
					$tbl .= "Footer text is empty or is not array";
				}
			}
			
			return $tbl;
	    }
	   
	   
}
	
	function tcpdf()
	{
		return new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);
	}
?>