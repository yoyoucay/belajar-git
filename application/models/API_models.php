<?php

class API_models extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function get_pengguna($key = null, $value = null)
    {

      if($key != null){
        $query = $this->db->get_where('users', array($key => $value));
        return $query->row();
      }

      $query = $this->db->get('users');
      return $query->result();
    }

    public function save_Account()
    {
      
      $this->load->helper('string');

      $_SESSION['token'] = random_string('alnum', 16);
      $data = [
              'username' => $this->input->post('username'),
              'full_name' => $this->input->post('full_name'),
              'email' => $this->input->post('email'),
              'password' =>password_hash($this->input->post('password'), PASSWORD_DEFAULT),
              'token' => $_SESSION['token']
      ];

      if($this->db->insert('users', $data)){
        return [
            'id'      => $this->db->insert_id(),
            'success' => true,
            'message' => 'Akun berhasil dibuat!'
        ];
      }
    }

    public function is_valid()
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $hash = $this->get_pengguna('email', $email)->password;

      if (password_verify($password, $hash)) {
        return true;
      }

      return false;
    }




}
