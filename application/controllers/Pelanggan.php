<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	public $data = array(
		'content' => 'pelanggan/pelanggan_view',
		'lipelanggan' => 'active'
	);

    public function __construct()
	{
		parent::__construct();
	}

    public function index()
    {
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pelanggan'));
        $this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'pelanggan/tambah_pelanggan_view';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		$body = [
            [
                'name' => 'nama_pelanggan',
                'contents' => $this->input->post('nama_pelanggan'),
            ],
            [
                'name' => 'alamat',
                'contents' => $this->input->post('alamat'),
            ],
            [
                'name' => 'nomor_telepon',
                'contents' => $this->input->post('nomor_telepon'),
            ],
            [
                'name' => 'email',
                'contents' => $this->input->post('email'),
            ],
            [
                'name' => 'harga_pelanggan',
                'contents' => $this->input->post('harga_pelanggan'),
            ],	
        ];
        $response = json_decode($this->guzzle_post(base_url().'api/','pelanggan',$body));
        if($response->status){
        redirect('pelanggan','refresh');
    	}
	}

	public function edit($id)
	{
		$this->data['content'] = 'pelanggan/edit_pelanggan_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pelanggan/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function update()
	{
        $body = [
            [
                'name' => 'id_pelanggan',
                'contents' => $this->input->post('id_pelanggan'),
            ],
            [
                'name' => 'nama_pelanggan',
                'contents' => $this->input->post('nama_pelanggan'),
            ],
            [
                'name' => 'alamat',
                'contents' => $this->input->post('alamat'),
            ],
            [
                'name' => 'nomor_telepon',
                'contents' => $this->input->post('nomor_telepon'),
            ],
            [
                'name' => 'email',
                'contents' => $this->input->post('email'),
            ],
            [
                'name' => 'harga_pelanggan',
                'contents' => $this->input->post('harga_pelanggan'),
            ],	
          ];
			
			$response = json_decode($this->guzzle_put(base_url().'api/','pelanggan/update',$body));
			if($response->status){
				redirect('pelanggan','refresh');
			}
		
	}

	public function update_harga_jual()
	{
		$id_pelanggan = $this->input->post('id_pelanggan');
        $body = [
            [
                'name' => 'id_master_jual',
                'contents' => $this->input->post('id_master_jual'),
            ],
            [
                'name' => 'laba',
                'contents' => $this->input->post('laba'),
            ],	
          ];
			
			$response = json_decode($this->guzzle_put(base_url().'api/','pelanggan/updateHarga',$body));
			if($response->status){
				redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
			}
		
	}

	public function harga($id_pelanggan)
	{
		$this->data['content'] = 'pelanggan/harga_pelanggan_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pelanggan/harga/'.$id_pelanggan));
		$this->load->view('layout/main', $this->data);
	}

	public function tambah_harga()
	{
		$this->data['content'] = 'pelanggan/tambah_harga_view';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan_harga()
	{
		$id_pelanggan =  $this->input->post('id_pelanggan');
		$body = [
            [
                'name' => 'id_pelanggan',
                'contents' => $this->input->post('id_pelanggan'),
            ],
            [
                'name' => 'id_barang',
                'contents' => $this->input->post('id_barang'),
            ],
            [
                'name' => 'laba',
                'contents' => $this->input->post('laba'),
            ],
        ];
        $response = json_decode($this->guzzle_post(base_url().'api/','pelanggan/harga',$body));
        if($response->status){
        redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
    	}
	}

	public function hapus($id_pelanggan)
	{
		$body = [
			'id_pelanggan' => $id_pelanggan,
		];
		$response = json_decode($this->guzzle_delete(base_url().'api/','pelanggan',$body));
		 if($response->status){
			redirect('pelanggan','refresh');
		}
	}

	public function hapus_harga_jual($id_master_jual,$id_pelanggan)
	{
		$body = [
			'id_master_jual' => $id_master_jual,
		];
		$response = json_decode($this->guzzle_delete(base_url().'api/','pelanggan/hargaJual',$body));
		 if($response->status){
			redirect('pelanggan/harga/'.$id_pelanggan,'refresh');
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
			redirect('pelanggan','refresh');
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