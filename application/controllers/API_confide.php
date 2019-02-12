<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH .'/libraries/JWT.php';
require_once APPPATH .'/libraries/SignatureInvalidException.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\SignatureInvalidException;

class API_confide extends CI_Controller {

    private $secret = 'efficient and simple';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_models');
        $this->load->model('confide_models');
        $this->load->model('api_models');
    }

    public function response($data, $status = 200)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();

        exit;
    }


    public function send_register()
    {
      return $this->response($this->api_models->save_Account());
    }

    public function send_login()
  	{
  		$date = new DateTime();

  		if (!$this->api_models->is_valid()) {
  			return $this->response([
  					'success' => false,
  					'message' => 'Email atau password salah'
  			]);
  		}

  		$user = $this->api_models->get_pengguna('email', $this->input->post('email'));

  		// Lanjut jika login berhasil
  		$payload['id'] 		= $user->id;
  		$payload['iat'] 	= $date->getTimestamp();
  		$payload['exp'] 	= $date->getTimestamp() + 60*60*2;

  		$output['id_token'] = JWT::encode($payload, $this->secret);

  		$this->response($output);
  	}

    public function check_token()
  	{
  		$jwt = $this->input->get_request_header('Authorization');
  		// die($this->secret);

  		try {
  			$decoded = JWT::decode($jwt, $this->secret, array('HS256'));
        // die(var_dump($decoded));
  			return $decoded->id;
  		} catch (\Exception $e) {
  			return $this->response([
  					'success' => false,
  					'message' => 'Gagal Token ERROR'
  			], 401);
  		}
  	}

    public function protected_method($id)
  	{
  		// Check user login
  		if ($id_user_token = $this->check_token()) {
        // die($id_user_token);
  			// Orang yg login yang mau hapus
  			if ($id_user_token == $id) {
  				return true;
  			}else {
  				return $this->response([
  						'success' => false,
  						'message' => 'Gagal Akun User berbeda'
  				], 403);
  			}
  		} else {
        die('Token tidak valid!');
      }
  	}

  public function login_token()
	{
		$data = $this->get_input();
    $decoded = JWT::decode($data->id_token, $this->secret, array('HS256'));
    $user = $this->api_models->get_pengguna('id', $decoded->id);

		if ($this->protected_method($user->id)) {

      // set session
      $_SESSION['user_id'] = $user->id;
      $_SESSION['logged_in'] = true;

      // redirect
      redirect('home');
		}else {
      die('Fail');
    }
	}

	public function get_input()
	{
		return json_decode(file_get_contents('php://input'));
	}

}
