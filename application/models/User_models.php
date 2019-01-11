<?php

class user_models extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }

    public function add_user($password)
    {
        $this->load->helper('string');
        $_SESSION['token'] = random_string('alnum', 16);

        $data = [
                'username' => $this->input->post('username'),
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'token' => $_SESSION['token']

        ];

        $this->db->insert('users', $data);
    }

    public function get_user($key, $value)
    {
        $query = $this->db->get_where('users', array($key=>$value));
        if(!empty($query->row_array())){
            return $query->row_array();
        }

        return false;
    }
    

    public function get_userid($username)
    {
        $this->db->select('id');
        $this->db->where('username', $username);
        $q = $this->db->get('users');
        $data = $q->result_array();
        // die(var_dump($data[0]['id']));
        return $data[0]['id'];
    }

        
    public function update_role($user_id, $role_num)
    {
        $data = array('role' => $role_num ); // menerima data role dari auth.php/verify_register

        $this->db->where('id', $user_id); // mencari berdasarkan id user
        return $this->db->update('users', $data); // mengupdate kolom role dari array $data;

    }

    public function update_follow($user_id, $follow)
    {
        $data = array(
            'user_id' => $user_id,
            'follow' => $follow
        );

        return $this->db->insert('followers', $data);
    }

    public function is_LoggedIn()
    {
        // menguji session
        if(!isset($_SESSION['logged_in'])){
            return false;
        }	
        return true;
    }

    public function checkPassword($email, $password)
    {
        $hash = $this->get_user('email', $email)['password'];
            if (password_verify($password, $hash)) {
                return true;
            }

        return false;
    }
    
    public function get_users($username = FALSE)
    {
        $query = $this->db->get_where('users', array('username' => $username));
        return $query->row_array();
    }
    
    public function get_confide()
    {
        $query = $this->db->get('confide');
        return $query->result_array();
    }

    public function set_follow(){
			
        $data = array(
            'user_id' => $this->input->post('aku'),
            'follow' => $this->input->post('dia')
        );

        return $this->db->insert('followers', $data);
    }

    public function set_unfollow(){
			
        $data = array(
            'user_id' => $this->input->post('aku'),
            'follow' => $this->input->post('dia')
        );

        return $this->db->delete('followers', $data);
    }

    public function check_follow($username){
		$query = $this->db->query("SELECT user_id, follow FROM followers WHERE user_id = '".@$_SESSION['user_id']."' AND follow = (SELECT id FROM users WHERE username = '".$username."')");
        return $query->result_array();
    }
    
    // Mengambil nilai jumlah Followers untuk ditampilkan ke Profile Page
    public function ambil_followers($username){
        $query= $this->db->query("select count(user_id)-1 AS pengikut from followers where follow = (select id from users where username='".$username."')");
        return $query->row_array();
        }
    
    // Mengambil nilai jumlah Following untuk ditampilkan ke Profile Page
    public function ambil_following($username){
        $query= $this->db->query("select count(user_id)-1 AS mengikuti from followers where user_id = (select id from users where username='".$username."')");
        return $query->row_array();
            }
    
    // Mengambil nilai jumlah Followers untuk ditampilkan ke Profile Page dengan avatar
    public function ambil_followers_avatar($username){
        $query= $this->db->query(
            "SELECT 
            users.username, 
            users.full_name,
            users.nama_avatar
            FROM users
            WHERE id IN (SELECT user_id FROM followers WHERE follow IN (SELECT id from users where username = '".$username."'))
            "
        );
        return $query->result_array();
    }
    
    // Mengambil nilai jumlah Following untuk ditampilkan ke Profile Page dengan avatar
    public function ambil_following_avatar($username){
        $query= $this->db->query(
            "SELECT 
            users.username, 
            users.full_name,
            users.nama_avatar
            FROM users
            WHERE id IN (SELECT follow FROM followers WHERE user_id IN (SELECT id from users where username = '".$username."'))"
        );
        return $query->result_array();
    }
    
    // Menampilkan user online
    public function get_online(){
        $query= $this->db->query(
            "SELECT 
            users.username, 
            users.full_name,
            users.nama_avatar
            FROM users
            WHERE id IN (SELECT follow FROM followers WHERE user_id IN (SELECT id from users where id = '".$_SESSION['user_id']."'))"
        );
        return $query->result_array();
    }
    
    public function getChat($accountid, $userid)
    {
                    $chats = $this->db
                    ->select('chat.*, users.username')
                    ->from('chat')
                    ->join('users', 'chat.send_by = users.id')
                    ->where('(send_by = '. $userid.' AND send_to = '.$accountid .')')
                    ->or_where('(send_to = '. $userid.' AND send_by = '. $accountid .')')
                    ->order_by('chat.time', 'ASC')
                    ->limit(100)
                    ->get()
                    ->result();
                    return $chats;
    }
    
    
    // Fungsi untuk mencari Akun dari username, maupun Full name
    public function searchppl($search)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->like('username',$search);
        $this->db->or_like('full_name',$search);
        $query = $this->db->get();
        return $query->result();
    }
    
    // Jumlah Kiriman User
    public function jumlah_kiriman($username){
        $query= $this->db->query("select count(id) AS kiriman from confide where user_id = (select id from users where username='".$username."')");
        return $query->row_array();
    }
}