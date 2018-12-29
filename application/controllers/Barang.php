<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public $data = array(
		'content' => 'barang/barang_view',
		'libarang' => 'active',
		'ulbarang' => 'display:block',
		'lidaftarbarang' => 'active'

	);

  public function __construct()
	{
		parent::__construct();
	}

  public function index()
  	{
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang'));
    $this->load->view('layout/main', $this->data);
	}

	public function stok_barang()
  	{
		$this->data['content'] = 'barang/stok_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang/stok'));
    	$this->load->view('layout/main', $this->data);
	}

	public function barang()
	{
		$barang = json_decode($this->guzzle_get(base_url().'api/','barang'));
		echo json_encode($barang);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'barang/tambah_barang_view';
		$this->data['kategori'] = json_decode($this->guzzle_get(base_url().'api/','barang/kategori'));
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		if(empty($_FILES['foto_barang']['name'])){
			echo 'harus upload bro';
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'id_kategori',
					'contents' => $this->input->post('jenis_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => fopen($_FILES['foto_barang']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_barang']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			
			];
			$response = json_decode($this->guzzle_post(base_url().'api/','barang',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}
	}

	public function edit($id)
	{
		$this->data['content'] = 'barang/edit_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function update()
	{
		if(empty($_FILES['foto_barang']['name'])){
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => $this->input->post('foto_lama'),
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];

			$response = json_decode($this->guzzle_put(base_url().'api/','barang/update',$body));
			if($response->status){
				redirect('barang','refresh');
			}
			// var_dump($body);
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => fopen($_FILES['foto_barang']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_barang']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];
			
			$response = json_decode($this->guzzle_put(base_url().'api/','barang/update',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}
	}

	public function hapus($id_barang)
	{
		$body = [
			'id_barang' => $id_barang,
		];
		$response = json_decode($this->guzzle_delete(base_url().'api/','barang',$body));
		 if($response->status){
			redirect('barang','refresh');
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
			redirect('barang','refresh');
		}
	}

	public function guzzle_delete($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('DELETE',$uri,[
			'form_params' => $body,
		]);
		return $response->getBody()->getContents();
	}
}