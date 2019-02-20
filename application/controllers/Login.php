<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
        $this->load->view('login');
	}

	public function login()
	{
		$body = [
			[
				'name' => 'email',
				'contents' => $this->input->post('email')
			],
			[
				'name' => 'password',
				'contents' => $this->input->post('password')
			],
		];
		
		$cek = json_decode($this->guzzle_post(base_url().'api/','login',$body));

		if($cek->status == TRUE){
			$getUser = array(
							'username' => $cek->username,
							'foto' => $cek->foto
						);
			$this->session->set_userdata($getUser);
			redirect('home');
		}else{
			$this->session->set_flashdata("failed","<div class=\"alert alert-danger alert-dismissible\">
			<a  class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
			email atau password salah
			</div>");
			redirect('login');
		}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
		# code...
	}
	

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
	}


}