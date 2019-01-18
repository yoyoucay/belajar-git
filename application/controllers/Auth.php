<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_models');
        $this->load->model('confide_models');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]|alpha_numeric|trim');
        $this->form_validation->set_rules('full_name', 'Full_name', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password','required|matches[password]');

        if($this->form_validation->run() === false){
            
            $this->load->view('layouts/header');
            $this->load->view('auth/register');
            $this->load->view('layouts/footer');

        } else {
            // user
            $password = $this->input->post('password');
            $this->user_models->add_user($password);
            // verify
            $this->kirim_email($this->input->post('email'), $_SESSION['token']);
            
        }    
    }
    
    public function activationUser()
    {

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('token', 'Token', 'required');

        $user_role = $this->user_models->get_user('email', $this->input->post('email'));
       

            if($this->form_validation->run() === false){
            // Kondisi salah
            
            die('Data email tidak tersalurkan!');

            }else {

                 if ($user_role['role']==0) {

                    // Kondisi Benar dan setelah mengirim email otomatis redirect activation Page jika role masih 0.
                    $this->kirim_email($this->input->post('email'), $this->input->post('token'));
                    
                }else {
                    redirect('login');
                }
            }
           
    }

    
    public function kirim_email($email, $token)
    {
        $data['email'] = $email;
        $data['token'] = $token;

        // Konfigurasi email
        $config = [
               'protocol'  => 'smtp',
               // 'mailpath'  => '/usr/sbin/sendmail',
               'smtp_host' => 'ssl://mail.kaca-beta.com',
               'smtp_user' => 'support@kaca-beta.com',
               'smtp_pass' => 'c%G*liZky16[',
               'smtp_port' => 465,
               'smtp_keepalive' => TRUE,
               // 'smtp_crypto' => 'SSL',
               'wordwrap'  => TRUE,
               'wrapchars' => 80,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'validate'  => TRUE,
               'crlf'      => "\r\n",
               'newline'   => "\r\n",
           ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('no-reply@kaca-beta.com', 'Kaca Inc.');

        // Email penerima
        $this->email->to($email); // Ganti dengan email tujuan Anda

        // Lampiran email, isi dengan url/path file
        // $this->email->attach('http://kaca-beta.com/assets/img/logo5.png');

        // Subject email
        $this->email->subject('Authentication for registration');

        // Isi email
         $this->email->message("Klik link untuk melanjutkan verifikasi akun anda ! <a href='http://m.kaca-beta.com/verify/$email/$token'> Konfirmasi Email </a>");
    
        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            $this->load->view('layouts/header');
            $this->load->view('pages/activation', $data);
            $this->load->view('layouts/footer');
        } else {
            die($this->email->print_debugger());
        }
    }

    public function verify_register($email, $token)
    {
        $user = $this->user_models->get_user('email', $email);		

        // cek email ada / tidak
            if(!$user)
            die('email not exist');
            
            if ($user['token'] !== $token){ 
            die('Token not match');
            }
            $checkfollow = $this->db->query("SELECT COUNT(user_id) AS follow_me FROM `followers` WHERE follow = (SELECT id FROM `users` WHERE token = '".$token."')")->row_array();
            // update role users
            if($checkfollow['follow_me'] == 0){
            $this->user_models->update_follow($user['id'], $user['id']);
            $this->user_models->update_role($user['id'], 1);
            }

            // Set Session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;

            // redirect profile user
            redirect('home');
            
    }

    public function login()
    {
    if($this->user_models->is_LoggedIn()){
            redirect('home');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|callback_checkEmail');
        $this->form_validation->set_rules('password', 'Password', 'required|callback_checkPassword');
        
        $check_user =  $this->user_models->get_user('email', $this->input->post('email'));

        if($this->form_validation->run() === false)
        {
            $this->load->view('layouts/header');
            $this->load->view('auth/login');
            $this->load->view('layouts/footer');

        }elseif($check_user['role'] == 0) {
                   
                $data['token'] = $check_user['token'];
                $data['email'] = $this->input->post('email');
                $this->load->view('layouts/header');
                $this->load->view('pages/activation', $data);
                $this->load->view('layouts/footer');

        } elseif ($check_user['hak'] == 1) {

            $user = $this->user_models->get_user('email', $this->input->post('email'));
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['akses'] = $check_user['hak'];
            $_SESSION['logged_in'] = true;
            redirect('admin');
        }

        else {

            $user = $this->user_models->get_user('email', $this->input->post('email'));
            
            // set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = true;



            // redirect
            redirect('home');
        }
    }



    public function checkEmail($email)
    {
        // Check email pada saat login
            if (!$this->user_models->get_user('email', $email)) { 
            $this->form_validation->set_message('checkEmail', 'email tidak ada pada database');
            return false;
            }

            return true;
    }

    public function checkPassword($password)
    {
        $user = $this->user_models->get_user('email',$this->input->post('email'));

        if (!$this->user_models->checkPassword($user['email'], $password)) {
            $this->form_validation->set_message('checkPassword', 'Password tidak benar');
            return false;
        }
        
        return true;
    }

    public function checkRole($email)
    {
        $user = $this->user_models->get_user('email', $email);

        if ($user['role'] == 0) {
            $this->form_validation->set_message('checkRole', 'Email Belum diaktivasi');
            return false;
        }

        return true;
    }

    public function logout()
    {
        // unset($_SESSION['user_id'], $_SESSION['logged_in']);
        $this->session->sess_destroy();
        redirect('login');
    }

    public function follow(){
		$this->user_models->set_follow();
		redirect('home');
    }
    
    public function unfollow(){
		$this->user_models->set_unfollow();
		redirect('home');
    }
    
    // fungsi untuk melakukan pencarian
    public function search()
    {
        // $this->load->model('users_model');
        $search = $this->input->post('txt_username');
        $query = $this->user_models->searchppl($search);
        if (!$query) {
			$this->load->view('layouts/header');
            $this->load->view('layouts/error');
            $this->load->view('layouts/footer');
		}else {
        $data['users'] =  $this->user_models->searchppl($search);
        $data['user'] = $this->user_models->get_user('id', $_SESSION['user_id']);
        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar_top');
        $this->load->view('pages/search',$data);
        $this->load->view('layouts/navbar_bottom');
        $this->load->view('layouts/footer');
        }
    }

    public function set_settings(){
		$data = array();
		$upload = $this->confide_models->avatarProfile();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada untuk menyimpan data ke database
				$this->confide_models->set_settingsProfile($upload);
				
				redirect('home'); // Redirect kembali ke halaman awal / halaman view data
			}else if($upload['result'] == "failed"){ // Jika proses Settings tanpa mengupload foto sukses
				 // Panggil function save yang ada untuk menyimpan data ke database
				$this->confide_models->set_settingsProfileZ();
				
				redirect('home'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				die($data['message']);
			}
		// $this->load->view('gambar/form', $data);
	}
	
	// FEEDBACK FUNCTION
	 public function view_feedback(){
	    $this->load->view('layouts/header'); 
        $this->load->view('pages/feedback');
        $this->load->view('layouts/footer'); 
    }
	
	public function set_feedback(){
	    
		$this->confide_models->set_feedback();
		redirect('home');
	
    }
    
    //////////////////////////////////////////////////////////////////////////////

    public function administrator()
    {
        if(!$this->user_models->is_LoggedIn()){
        redirect('login');
        }

            $check_user = $this->user_models->get_user('id', $_SESSION['user_id']);
            if(@$_SESSION['akses'] == 1){
                $data['nickname'] = $check_user['username'];
                $data['account'] = $this->user_models->getAll_user();
                $this->load->view('pages/adminpage', $data);
            }else{
                show_404();
            }
    }

    public function set_settings_admin(){
		$data = array();
		$upload = $this->confide_models->avatarProfile();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada untuk menyimpan data ke database
				$this->confide_models->set_settingsProfile($upload);
				
				redirect('admin'); // Redirect kembali ke halaman awal / halaman view data
			}else if($upload['result'] == "failed"){ // Jika proses Settings tanpa mengupload foto sukses
				 // Panggil function save yang ada untuk menyimpan data ke database
				$this->confide_models->set_settingsProfileZ();
				
				redirect('admin'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				die($data['message']);
			}
		// $this->load->view('gambar/form', $data);
    }
    
    public function search_akun(){
        $keyword = $this->input->post('keyword');
        $check_user = $this->user_models->get_user('id', $_SESSION['user_id']);

        if(@$_SESSION['akses'] == 1){
            $data['nickname'] = $check_user['username'];
            $data['account']=$this->user_models->get_account_keyword($keyword);
            $this->load->view('pages/adminpage', $data);
        } else {
        $this->load->view('pages/adminpage', $data);
        }
	}
    
}
