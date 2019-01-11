<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require '.././vendor/autoload.php';
class Confide extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('confide_models');
		$this->load->model('user_models');
	}
	
	public function tambah_confide(){
		$this->confide_models->set_confide();
		redirect('home');
	}

	public function tambah_confidePhoto(){
		$data = array();
		$upload = $this->confide_models->upload_confidePhoto();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->confide_models->save_confidePhoto($upload);
				
				redirect('home'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				die($data['message']);
			}
		// $this->load->view('gambar/form', $data);
	}

	public function tambah_confideVideo(){
		$data = array();
		$upload = $this->confide_models->upload_confideVideo();
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				 // Panggil function save yang ada di GambarModel.php untuk menyimpan data ke database
				$this->confide_models->save_confideVideo($upload);
				
				redirect('home'); // Redirect kembali ke halaman awal / halaman view data
			}else{ // Jika proses upload gagal
				$data['message'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file form dan ditampilkan
				die($data['message']);
			}
		
		// $this->load->view('gambar/form', $data);
	}



// ================================================
			// Mengedit Status Teks //
// ================================================
	public function update_confide($username,$confideid){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_id','Owner Confide', 'required');
		$this->form_validation->set_rules('input_deskripsi','Deskripsi', 'required');

		if($this->form_validation->run() === FALSE){
			$data['content'] = $this->confide_models->get_confideUpdate($username,$confideid);
			$data['user'] = $this->user_models->get_user('id', $_SESSION['user_id']);
			$this->load->view('layouts/header');
			$this->load->view('layouts/navbar_top');
			$this->load->view('pages/edit', $data);
			$this->load->view('layouts/navbar_bottom');
			$this->load->view('layouts/footer');
		} else {
			$this->confide_models->set_confideUpdate($confideid);

			redirect('home');
		}
	}

// ================================================
			// Mengedit Status Foto //
// ================================================
	public function update_confidePhoto($username,$confideid){

		$data = array();
		$upload = $this->confide_models->upload_confidePhoto();


		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_id','Owner Confide', 'required');
		$this->form_validation->set_rules('input_deskripsi','Deskripsi', 'required');


		if($this->form_validation->run() === FALSE){

			// Jika ada Form yang Belum diisi dengan benar maka akan meredirect halaman kembali.

			$data['content'] = $this->confide_models->get_confideUpdate($username,$confideid);			
			$this->load->view('layouts/header');
			$this->load->view('updateconfide/editConfidePhoto', $data);
			$this->load->view('layouts/footer');
		} else {

			$this->confide_models->set_confidePhotoUpdate($confideid);
			redirect('home');
		}



		
	}

// ================================================
			// Mengedit Status Video //
// ================================================
	public function update_confideVideo($username,$confideid){

		$data = array();
		$upload = $this->confide_models->upload_confideVideo();


		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_id','Owner Confide', 'required');
		$this->form_validation->set_rules('judul','Judul', 'required');
		$this->form_validation->set_rules('input_deskripsi','Deskripsi', 'required');


		if($this->form_validation->run() === FALSE){

			// Jika ada Form yang Belum diisi dengan benar maka akan meredirect halaman kembali.

			$data['content'] = $this->confide_models->get_confideUpdate($username,$confideid);			
			$this->load->view('layouts/header');
			$this->load->view('updateconfide/editConfideVideo', $data);
			$this->load->view('layouts/footer');
		} else {

			$this->confide_models->set_confideVideoUpdate($confideid);
			redirect('home');
		}
	}

// ================================================
	// F{ungsi untuk Menghapus semua jenis status //
// ================================================

	public function delete_confide($confideid)
	{
		$this->confide_models->delete_confideUpdate($confideid);
		
		redirect('home');
	}
	
	public function view_post($confideid){
	    
	    $data['user'] = $this->user_models->get_user('id', $_SESSION['user_id']); // Menampilkan Data User
		$data['details'] = $this->confide_models->get_details($confideid); // Menampilkan Data Confide
		$data['count_suka'] = $this->confide_models->count_likeConfide($confideid); // Menampilkan Data Jumlah Like yang terhubung dengan ID CONFIDE.
		$data['check_suka'] = $this->confide_models->check_like($confideid); // Menampilkan Data Like Sudah atau belum.
		$data['comment'] = $this->confide_models->get_comment($confideid); // Menampilkan Data Comment yang terhubung dengan ID CONFIDE, ID USER.
		$data['count_comment'] = $this->confide_models->count_comment($confideid);

	    $this->load->view('layouts/header');
	    $this->load->view('layouts/navbar_top');
		$this->load->view('pages/details', $data);
		$this->load->view('layouts/navbar_bottom');
		$this->load->view('layouts/footer');
	}
	
    // ================================================
    			// Menambah Like pada status //
    // ================================================
    
    	public function likeConfide(){
    		$this->confide_models->set_likeConfide();
    		redirect('home');
    	}
    	
    // ================================================
    			// Mengurangi Like pada status //
    // ================================================
    
    public function unlikeConfide(){
    	$this->confide_models->set_unlikeConfide();
    	redirect('home');
    }
    
// ================================================
			// Menambah Comment pada status //
// ================================================

	public function insert_comment()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('confide_id','Owner Confide', 'required');
		$this->form_validation->set_rules('user_id','Owner Comment', 'required');
		$this->form_validation->set_rules('comment_txt','Deskripsi', 'required');


		if($this->form_validation->run() === FALSE){

			die('gagal memasukkan Komentar!');

		} else {
			$confideid = $this->input->post('confide_id');
			$userid = $this->input->post('user_id');
			$this->confide_models->set_Comment($confideid,$userid);
			redirect('home');
		}
	}
	
	// Jumlah Komentar
    public function count_comment($confideid){
        $query= $this->db->query("SELECT COUNT(id) FROM `comment_confide` WHERE confide_id = .$confideid.");
        return $query->row_array();
	}
	
    // 	Menampilkan User Online
    public function onlineuser(){
        $this->load->view('layouts/header');
        $this->load->view('layouts/navbar_top');
        $this->load->view('pages/chat');
        $this->load->view('layouts/navbar_bottom');
        $this->load->view('layouts/footer');
    }
	
	// Menampilkan chat
	public function viewchat($username)
	{
		$query = $this->user_models->get_user('username',$username);
		if (!$query) {
			$this->load->view('layouts/header');
            $this->load->view('404_notfound/index.html');
            $this->load->view('layouts/footer');
		}else {
		$data = array(
			'user' => $this->user_models->get_user('id', @$_SESSION['user_id']), 
			'user_item' => $this->user_models->get_users($username)
		);
		$dataaccountid = $this->user_models->get_userid($username);
		$data['chat']= $this->user_models->getChat($dataaccountid, @$_SESSION['user_id']);
		// json_encode($user['id']);
        $this->load->view('layouts/header');
		$this->load->view('pages/directchat', $data);
		$this->load->view('layouts/footer');
		}		
	}

	// Menginput data chat kedalam table chat.
	public function sendChat()
	{
		$userid = $this->input->post('send_by');	
		$accountid = $this->input->post('send_to');

		$data = array(
            'message' => htmlentities($this->input->post('message', true)),
            'send_to' => $this->input->post('send_to'),
            'send_by' => $this->input->post('send_by')
			);
	
			$options = array(
				'cluster' => 'ap1',
				'useTLS' => true
			  );
			  $pusher = new Pusher\Pusher(
				'e40a215b58bb53333b27',
				'e72d60367df0a6cd4b36',
				'674230',
				$options
			  );
			  
			if ($this->db->insert('chat', $data)) {
	
				// $push = $this->db->order_by('time','ASC');
				// $push = $this->db->get('chat')->result();

				$push = $this->db->select('chat.message, chat.send_by, chat.time, users.username')
                    ->from('chat')
                    ->join('users', 'chat.send_by = users.id')
                    ->where('(send_by = '.$userid.' AND send_to = '.$accountid.')')
                    ->or_where('(send_to = '.$userid.' AND send_by = '.$accountid.')')
					->order_by('chat.time', 'ASC')
					->get()
                    ->result();
	  
				foreach ($push as $key) {
					$data_pusher[] = $key;
				}
				$pusher->trigger('my-channel', 'my-event', $data_pusher);
			}
		}
}