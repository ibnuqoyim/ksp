<?php

class User_members extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user_member');
		$this->load->model('login');
		$this->load->library('encrypt');
	}

	function index() {

		$this->template->add_js('template/js/user_member/list.js');
		$this->template->add_title('USER MEMBER');
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			'users' 	=> 'User Member',
		);
		$this->template->add_breadcrumb($breadcrumb);

		if(!$this->session->userdata('user_member')) {
			$arr_sess = array(
					'user_member' => array(
							'page' 			=> "",
							'sortby'		=> "um.id",
							'sortorder' 	=> "DESC",
							'keyword' 		=> ""
					),
			);
			$this->session->set_userdata($arr_sess);
		}
		
		$sample = $this->session->userdata('user_member');

		$data['page'] = $sample['page'] == "" ? "0" : $sample['page'];
		$data['sortby'] = $sample['sortby'] == "" ? "u.id" : $sample['sortby'];
		$data['sortorder'] = $sample['sortorder'] == "" ? "DESC" : $sample['sortorder'];
		$data['keyword'] = $sample['keyword'] == "" ? "" : $sample['keyword'];


		$this->template->add_js('$(document).ready(function(){
					$("#hid_paging").val("'.$data['page'].'");
					$("#hid_sort_by").val("'.$data['sortby'].'");
					$("#hid_sort_order").val("'.$data['sortorder'].'");
					$("#txt_keywords").val("'.$data['keyword'].'");

					loda_data('.$data['page'].');
                });
				','embed');


		$this->template->write_view('content','user_member/list',$data);
		$this->template->render();
	}
	
	
    function load_data() {
        
		if($this->input->post('page') !=NULL) {
			$data['page'] = $this->input->post('page');
		} else {
			$data['page'] = 0;
		}

		$data['sort_by'] 	= isset($_POST['sort_by']) ? $_POST['sort_by'] : "u.id";
		$data['sort_order']	= isset($_POST['sort_order']) ? $_POST['sort_order'] : "DESC";
		$data['keywords']	= isset($_POST['keywords']) ? $_POST['keywords'] : "";

		$arr_sess = array(
				'user_member' => array(
						'page' 			=> $data['page'],
						'sortby'		=> $data['sort_by'],
						'sortorder' 	=> $data['sort_order'],
						'keyword' 		=> $data['keywords']
				),
		);
		$this->session->set_userdata($arr_sess);

		$data['result'] 	= $this->user_member->list_data($data['page'],$data['sort_by'],$data['sort_order'],$data['keywords']);
		$jumlah 		 	= $this->user_member->jumlah_data($data['keywords']);

		$config['base_url']			= base_url() . 'index.php/users/load_data/';
		$config['post_var'] 		= $this->input->post('page');
		$config['per_page'] 		= $this->config->item('page_num');
		$config['first_link'] 		= 'First';
		$config['last_link'] 		= 'Last';
		$config['full_tag_open'] 	= '<div class="pagination pagination-colory">';
		$config['full_tag_close'] 	= '</div>';
		$config['total_rows'] 		= $jumlah;

		$this->ajax_pagination->initialize($config);
		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['fields'] = array(
				'm.name'			=> 'Nama',
				'um.username'	 	=> 'Username',
				'r.description'	 	=> 'Role',
		);

		$url = 'user_members/index';

		$html = $this->load->view('user_member/load_data', $data);
		echo $html;
    }
	
	
	function add() {            

		$this->template->add_css('template/addon/select2/select2-custom.css');
		$this->template->add_css('template/addon/bootstrap-select/bootstrap-select.min.css');
		$this->template->add_css('template/addon/multi-select/css/multi-select-madmin.css');


		$this->template->add_js('template/addon/select2/select2.min.js');
		$this->template->add_js('template/addon/bootstrap-select/bootstrap-select.min.js');
		$this->template->add_js('template/addon/multi-select/js/jquery.multi-select.js');
		$this->template->add_js('template/addon/form-select.js');

		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/user/validasi.js');

		$this->template->add_js('jQuery(document).ready(function () {
    			form_select.init();
				});
				','embed');



		$this->template->add_title('TAMBAH USER MEMBER');
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			'users' 	=> 'User Member',
			'users/add' => 'Tambah User Member',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['role'] = role_dropdown_member();
		$data['member'] = member_all_dropdown2();
		$this->template->write_view('content','user_member/add',$data);
		$this->template->render();
	}
	
	function add_process(){
		$entry['roleid']	= $this->input->post('roleid');
		$entry['member_id']= $this->input->post('member_id');
		$entry['username']	= $this->input->post('username');
		$entry['password']	= $this->encrypt->encode(trim($this->input->post('password')),$this->encrypt->hash(config_item('keyLogin')));

		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		
		$this->user_member->insert_data($entry);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil disimpan!';
		$pesan .= '</div>';

		$this->session->set_flashdata('pesan',$pesan);
		redirect('user_members');
	}
	function get_dropdown_user(){
		$idrole = $this->input->post('idrole');
		
			echo '<?php $employee = member_all_dropdown(); ?>';
		
	}
	function edit() {            


		$this->template->add_css('template/addon/select2/select2-custom.css');
		$this->template->add_css('template/addon/bootstrap-select/bootstrap-select.min.css');
		$this->template->add_css('template/addon/multi-select/css/multi-select-madmin.css');


		$this->template->add_js('template/addon/select2/select2.min.js');
		$this->template->add_js('template/addon/bootstrap-select/bootstrap-select.min.js');
		$this->template->add_js('template/addon/multi-select/js/jquery.multi-select.js');
		$this->template->add_js('template/addon/form-select.js');

		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/user/validasi.js');

		$this->template->add_js('jQuery(document).ready(function () {
    form_select.init();
});
				','embed');

		$this->template->add_title('EDIT USER MEMBER');
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			'users' 	=> 'User Member',
			'users/edit/id/'.$this->uri->segment(4) => 'Edit User Member',
		);
		$this->template->add_breadcrumb($breadcrumb);
		
		$data['role'] = role_dropdown_member();
		$data['member'] = member_all_dropdown2($this->uri->segment(4));
		$data['detail'] = $this->user_member->detail_data($this->uri->segment(4));

		$this->template->write_view('content','user_member/edit',$data);
		$this->template->render();
	}

	function edit_process(){
		$userid = $this->uri->segment(4);
		$entry['roleid']	= $this->input->post('roleid');
		$entry['member_id']= $this->input->post('member_id');
		if($this->input->post('password')){
			$entry['password']	= $this->encrypt->encode(trim($this->input->post('password')),$this->encrypt->hash(config_item('keyLogin')));
		}
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->user->update_data($entry,$userid);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil diedit!';
		$pesan .= '</div>';

		$this->session->set_flashdata('pesan',$pesan);
		redirect('users');
	}


	function check_username(){
		$username = $this->input->post('username');
		$check = $this->user_member->check_username($username);
		if(count($check)>0){
			echo 'false';
		} else {
			echo 'true';
		}
	}
	function check_member(){
		$member_id = $this->input->post('member_id');
		if($member_id!=''){
			echo 'true';
		} else {
			echo 'false';
		}
	}

	function delete_data(){
		$userid = $this->input->post('userid');
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->user_member->delete_data($userid);
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Data telah berhasil dihapus!';
		$pesan .= '</div>';

		$this->session->set_flashdata('pesan',$pesan);
	}


	function ganti_password(){
		$this->template->add_js('template/assets/jquery-validation/dist/jquery.validate.min.js');
		$this->template->add_js('template/js/user/ganti_password.js');

		$this->template->add_title('GANTI PASSWORD');
		$breadcrumb = array(
			'berandas'	=> 'Beranda',
			'users/ganti_password' => 'Ganti Password',
		);
		$this->template->add_breadcrumb($breadcrumb);

		$this->template->write_view('content','user_member/ganti_password');
		$this->template->render();
	}
	
	function process_ganti_password(){
		$userid = $this->session->userdata('userid');
		$entry['password']	= $this->encrypt->encode(trim($this->input->post('password_baru')),$this->encrypt->hash(config_item('keyLogin')));
		$this->db->trans_start(); /*untuk rollback jika data gagal*/
		$this->user_member->update_data($entry,$userid);
		
		$this->db->trans_complete();
		$pesan = '<div class="alert alert-success">';
		$pesan .= '<button class="close" data-dismiss="alert">×</button>';
		$pesan .= '<strong>Info!</strong>';
		$pesan .= ' Password telah berhasil diganti!';
		$pesan .= '</div>';
		$this->session->set_flashdata('pesan',$pesan);
		redirect('user_members/ganti_password');
	}

	function check_password_lama(){
		$username		= $this->input->post('username');
		$password_lama	= $this->input->post('password_lama');
		$login = $this->login->getDataMember($username,$password_lama);
		
		if($login==true){
			echo 'true';
		} else {
			echo 'false';
		}

	}

}


?>