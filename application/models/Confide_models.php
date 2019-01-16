<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Confide_models extends CI_Model {
		
		public function set_confide(){
			
			date_default_timezone_set('Asia/Jakarta');
			$now = date('Y-m-d H:i:s');

			$data = array(
				'deskripsi' => $this->input->post('input_deskripsi'),
				'user_id' => $this->input->post('user_id'),
				'created_at' => $now,
			);

			return $this->db->insert('confide', $data);
		}

    public function upload_confidePhoto(){
		$config['upload_path'] = '.././images/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '8192';
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('input_gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}
    
    public function save_confidePhoto($upload){
    	date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');
		
		$data = array(
			'deskripsi'=>$this->input->post('input_deskripsi'),
			'nama_file' => $upload['file']['file_name'],
			'ukuran_file' => $upload['file']['file_size'],
			'tipe_file' => $upload['file']['file_type'],
			'user_id' => $this->input->post('user_id'),
			'created_at' => $now,
			
		);
		
		$this->db->insert('confide', $data);
    }
    
    public function upload_confideVideo(){
		$config['upload_path'] = '.././videos/';
		$config['allowed_types'] = 'avi|mp4|mpeg|webm|mkv|gif|wmv|3gp';
		$config['max_size']	= '100000';
		$config['overwrite'] = FALSE;
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('input_video')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :

            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
            
// 			echo "<script>alert('Gagal upload Video. Kembali ke home..')</script>";
			
			}
			redirect('home');

    }
    
    public function save_confideVideo($upload){

    	date_default_timezone_set('Asia/Jakarta');
		$now = date('Y-m-d H:i:s');

		$data = array(

      		'judul'=>$this->input->post('judul'),
			'deskripsi'=>$this->input->post('input_deskripsi'),
			'nama_file' => $upload['file']['file_name'],
			'ukuran_file' => $upload['file']['file_size'],
			'tipe_file' => $upload['file']['file_type'],
			'user_id' => $this->input->post('user_id'),
			'created_at' => $now,
			
		);
		
		$this->db->insert('confide', $data);
    }
	
	public function get_content(){
		$query = $this->db->query(
			"SELECT 
			users.full_name,
			users.username,
			users.nama_avatar,
			confide.id,
			confide.user_id,
			confide.judul, 
			confide.nama_file,
			confide.tipe_file,
			confide.created_at,
			confide.deskripsi
			FROM confide INNER JOIN users ON users.id = confide.user_id
			WHERE user_id in (SELECT follow FROM followers WHERE user_id IN (SELECT user_id FROM followers WHERE user_id='".$_SESSION['user_id']."')) ORDER BY created_at DESC"
		);
        return $query->result_array();
	}

    public function get_confide($username){
		$query = $this->db->query(
			"SELECT 
			users.id, 
			users.username, 
			users.full_name,
			users.nama_avatar, 
			users.biodata,  
			confide.id, 
			confide.user_id, 
			confide.judul,
			confide.nama_file,
			confide.tipe_file, 
			confide.deskripsi, 
			confide.created_at 
			FROM users INNER JOIN confide ON users.id = confide.user_id WHERE 
			users.username='".$username."' ORDER BY created_at DESC"
		);
        return $query->result_array();
    }

    public function avatarProfile(){
		$config['upload_path'] = '.././images/avatar/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size']	= '2048';
		$config['remove_space'] = TRUE;
	
		$this->load->library('upload', $config); // Load konfigurasi uploadnya
		if($this->upload->do_upload('avatar')){ // Lakukan upload dan Cek jika proses upload berhasil
			// Jika berhasil :
			$return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			return $return;
		}else{
			// Jika gagal :
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			return $return;
		}
	}

	// Setting Profile memakai attribute foto
	public function set_settingsProfile($upload){
		$data = array(
			'email'=>$this->input->post('email'),
			'username'=>$this->input->post('username'),
			'full_name'=>$this->input->post('fullname'),
			'biodata'=>$this->input->post('biodata'),
			'lokasi_user'=>$this->input->post('user_lokasi'),
			'nama_avatar' => $upload['file']['file_name'],
			'ukuran_avatar' => $upload['file']['file_size'],
			'tipe_avatar' => $upload['file']['file_type']
			
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data);
    }
    
    	// Setting Profile tanpa Foto..
    public function set_settingsProfileZ(){
		$data = array(
			'email'=>$this->input->post('email'),
			'username'=>$this->input->post('username'),
			'full_name'=>$this->input->post('fullname'),
			'biodata'=>$this->input->post('biodata'),
			'lokasi_user'=>$this->input->post('user_lokasi'),
		);
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('users', $data);
    }
   
  // MENGAMBIL data CONFIDE 
   public function get_confideUpdate($username,$confideid){
		$query = $this->db->query(
			"SELECT 
			users.username,
			confide.id, 
			confide.user_id, 
			confide.judul,
			confide.nama_file,
			confide.tipe_file, 
			confide.deskripsi, 
			confide.created_at 
			FROM users INNER JOIN confide ON users.id = confide.user_id WHERE 
			users.username='".$username."' AND confide.id = '".$confideid."'"
		);
        return $query->row_array();
	}
	

/* ==========================================================
				MODEL untuk Mengupdate status Teks
=========================================================== */
	public function set_confideUpdate($confideid){

		$data = array(
			'user_id'=>$this->input->post('user_id'),
			'deskripsi'=>$this->input->post('input_deskripsi'),
		);
		$this->db->where('id', $confideid);
		$this->db->set('updated_at', 'DATE_ADD(NOW(), INTERVAL 1 MINUTE)', FALSE);
		$this->db->update('confide', $data);
	}

/* ==========================================================
				MODEL untuk Mengupdate status Photo
=========================================================== */

  public function set_confidePhotoUpdate($confideid){
		$data = array(
			'deskripsi'=>$this->input->post('input_deskripsi'),
			// 'nama_file' => $upload['file']['file_name'],
			// 'ukuran_file' => $upload['file']['file_size'],
			// 'tipe_file' => $upload['file']['file_type'],
			'user_id' => $this->input->post('user_id')
			
		);
		$this->db->where('id', $confideid);
		$this->db->set('updated_at', 'DATE_ADD(NOW(), INTERVAL 1 MINUTE)', FALSE);
		$this->db->update('confide', $data);
    }

/* ==========================================================
				MODEL untuk Mengupdate status Video
=========================================================== */

public function set_confideVideoUpdate($confideid){
		$data = array(
     		'judul'=>$this->input->post('judul'),
			'deskripsi'=>$this->input->post('input_deskripsi'),
			// 'nama_file' => $upload['file']['file_name'],
			// 'ukuran_file' => $upload['file']['file_size'],
			// 'tipe_file' => $upload['file']['file_type'],
			'user_id' => $this->input->post('user_id')
			
		);
		$this->db->where('id', $confideid);
		$this->db->set('updated_at', 'DATE_ADD(NOW(), INTERVAL 1 MINUTE)', FALSE);
		$this->db->update('confide', $data);
    }


	public function delete_confideUpdate($confideid){
		return $this->db->delete('confide', array('id' => $confideid));
	}
   
 	/* ==========================================================
				MODEL untuk Menghapus status (SEMUA)
	=========================================================== */
    
    
    public function set_feedback(){
			
			$data = array(
			    'user_id' => $this->input->post('txt_userid'),
				'judul_feedback' => $this->input->post('txt_judulfeedback'),
				'isi_feedback' => $this->input->post('txt_isifeedback'),
				
			);

			return $this->db->insert('feedback', $data);
	}
	
	public function get_details($confideid){
    	$query = $this->db->query(
    		"SELECT 
    		users.full_name,
    		users.username,
    		users.nama_avatar,
    		confide.id,
    		confide.user_id,
    		confide.judul, 
    		confide.nama_file,
    		confide.tipe_file,
    		confide.created_at,
    		confide.deskripsi
    		FROM confide INNER JOIN users ON users.id = confide.user_id
    		WHERE confide.id = '$confideid'"
    	);
	    return $query->row_array();
    }
    
    // ================================================
		// Menambah Jumlah Like  Pada Confide dari User. //
	// ================================================[]

    public function set_likeConfide(){
			
        $data = array(
            'confide_id' => $this->input->post('id_status'),
            'user_id' => $this->input->post('id_user')
        );

        return $this->db->insert('likes', $data);
	}

	// ================================================
		// Mengurangi Jumlah Like  Pada Confide dari User. //
	// ================================================[]

    public function set_unlikeConfide(){
			
        $data = array(
            'confide_id' => $this->input->post('id_status'),
            'user_id' => $this->input->post('id_user')
        );

        return $this->db->delete('likes', $data);
	}
    
    
    	// ================================================
		// Menghitung Jumlah Like  Pada Confide dari User. //
	// ================================================[]

    public function count_likeConfide($confideid){
        $query= $this->db->query("select count(confide_id) AS status_like FROM likes WHERE confide_id = ".$confideid."");
        return $query->row_array();
		}
		
	// ================================================
					// Check Like pada status //
	// ================================================

	public function check_like($confideid){
			$query = $this->db->query("SELECT user_id, confide_id FROM likes WHERE user_id = '".@$_SESSION['user_id']."' AND confide_id = ".$confideid."");
			return $query->result_array();
	}
	
 	/* ==========================================================
			MODEL untuk Memasukkan Kommentar Pada Status.
	=========================================================== */

	public function set_Comment($confideid, $userid)
	{
			$data = array(
				'deskripsi' => $this->input->post('comment_txt'),
				'user_id' => $userid,
				'confide_id' => $confideid,
			);

			return $this->db->insert('comment_confide', $data);
	}

	// ================================================
		// Menampilkan Comment pada status //
	// ================================================[]

	public function get_comment($confideid){
		$query = $this->db->query(
			"SELECT 
			comment_confide.id,
			comment_confide.confide_id,
			users.full_name,
			comment_confide.deskripsi,
			comment_confide.created_at 
			FROM comment_confide INNER JOIN users ON users.id = comment_confide.user_id
			WHERE comment_confide.confide_id = '".$confideid."'"
		);
        return $query->result_array();
	}
	
	// Jumlah Komentar
    public function count_comment($confideid){
        $query= $this->db->query("SELECT COUNT(id) AS jumlah_kiriman FROM `comment_confide` WHERE confide_id = '".$confideid."'");
        return $query->row_array();
    }

}