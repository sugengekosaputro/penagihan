<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}
	
	public function index_post()
	{
        $email = $this->post('email');
        $password = md5($this->post('password'));
		$cek = $this->Login_model->cekUser($email,$password);
			if ($cek) {
                $tampil = $this->Login_model->getUsername($email);
                $userdata = array(  
                                    'status'   => TRUE, 
                                    'username' => $tampil->username,
                                    'foto' => $tampil->foto,
                                );
                $this->response($userdata,REST_Controller::HTTP_OK);      
			} else {
				$this->response([
					'status' => FALSE
				],REST_Controller::HTTP_OK);
			}
	}

}