<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_models');
		$this->load->model('confide_models');
	}
    
	public function view($pages = NULL)
	{
		
		if($pages == "user"){
			show_404();
		}else if(!file_exists(APPPATH."views/pages/".$pages.".php")){
		    show_404();
		}

		if (!$this->user_models->is_LoggedIn()) {
			redirect('login');
		}
		$data['user'] = $this->user_models->get_user('id', $_SESSION['user_id']);
		$data['content'] = $this->confide_models->get_content();
		$data['online'] = $this->user_models->get_online();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navbar_top');
		$this->load->view('pages/'.$pages, $data);
		$this->load->view('layouts/navbar_bottom');
		$this->load->view('layouts/footer');

	}

	public function views($username = NULL)
	{

		$query = $this->user_models->get_users($username);
        if (!$query) {
			$this->load->view('layouts/header');
            $this->load->view('layouts/error');
            $this->load->view('layouts/footer');
		}else {
	    // following / followers untuk ditampikan ke page profile
		$data['count_follower'] = $this->user_models->ambil_followers($username);
		$data['count_follow'] = $this->user_models->ambil_following($username);
		$data['avatar_follower'] = $this->user_models->ambil_followers_avatar($username);
		$data['avatar_follow'] = $this->user_models->ambil_following_avatar($username);
		
		$data['user'] = $this->user_models->get_user('id', @$_SESSION['user_id']);
		$data['user_item'] = $this->user_models->get_users($username);
		$data['confide'] = $this->confide_models->get_confide($username);
		$data['follow'] = $this->user_models->check_follow($username);
		$data['kiriman'] = $this->user_models->jumlah_kiriman($username);
        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar_top');
		$this->load->view('pages/user',$data);
		$this->load->view('layouts/navbar_bottom');
		$this->load->view('layouts/footer');
		}
	}
	
	

	public function settings(){
		$data['user'] = $this->user_models->get_user('id', $_SESSION['user_id']);
		$this->load->view('layouts/header');
		$this->load->view('pages/settings', $data);
		$this->load->view('layouts/footer');
	}

}