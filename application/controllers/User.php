<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $data = array(
		'content' => 'user/index_view',
		'liuser' => 'active'
	);

    public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','user'));
        $this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'user/form_view';
		$this->load->view('layout/main', $this->data);
	}

	public function edit($id)
	{
		$this->data['content'] = 'user/form_update_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','user/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		if(empty($_FILES['foto']['name'])){
			echo 'harus upload bro';
		}else{
			$body = [
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => $this->input->post('password'),
				],
				[
					'name' => 'nama',
					'contents' => $this->input->post('nama'),
				],
				[
					'name' => 'foto',
					'contents' => fopen($_FILES['foto']['tmp_name'], 'r'),
					'filename' => $_FILES['foto']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_post(base_url().'api/','user',$body));
			if($response->status){
				redirect('user','refresh');
			}
		}
	}

	public function update()
	{
		if(empty($_FILES['foto']['name'])){
			$body = [
				[
					'name' => 'id_user',
					'contents' => $this->input->post('id_user'),
				],
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => $this->input->post('password'),
				],
				[
					'name' => 'nama',
					'contents' => $this->input->post('nama'),
				],
				[
					'name' => 'foto',
					'contents' => $this->input->post('foto_path'),
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_put(base_url().'api/','user/update',$body));
			if($response->status){
				redirect('user','refresh');
			}
		}else{
			$body2 = [
				[
					'name' => 'id_user',
					'contents' => $this->input->post('id_user'),
				],
				[
					'name' => 'username',
					'contents' => $this->input->post('username'),
				],
				[
					'name' => 'password',
					'contents' => $this->input->post('password'),
				],
				[
					'name' => 'nama',
					'contents' => $this->input->post('nama'),
				],
				[
					'name' => 'foto',
					'contents' => fopen($_FILES['foto']['tmp_name'], 'r'),
					'filename' => $_FILES['foto']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'role',
					'contents' => $this->input->post('role'),
				],
			];
			$response = json_decode($this->guzzle_put(base_url().'api/','user/update',$body2));
			if($response->status == TRUE){
				redirect('user','refresh');
			}
		}
	}

	public function hapus($id_user)
	{
		$body = [
			'id_user' => $id_user,
		];
		$response = json_decode($this->guzzle_delete(base_url().'api/','user',$body));
		if($response->status){
			redirect('user','refresh');
		}
	}

	public function guzzle_get($url,$uri)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('GET',$uri);
		return $response->getBody();
	}

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
	}

	public function guzzle_put($url,$uri,$body)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('POST',$uri,[
				'multipart' => $body,
			]);
			return $response->getBody()->getContents();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			redirect('user','refresh');
		}
	}

	public function guzzle_delete($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('DELETE',$uri,[
			'form_params' => $body,
		]);
		return $response->getBody();
	}
}