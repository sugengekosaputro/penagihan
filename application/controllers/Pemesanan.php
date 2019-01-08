<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public $data = array(
		'content' => 'pemesanan/pemesanan_view',
		'lipemesanan' => 'active',
		'ulpemesanan' => 'display:block',
		'lidaftarpesanan' => 'active'
	);

	public function __construct()
	{
		parent::__construct();
	}

  public function index()
	{
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan'));
		$this->load->view('layout/main', $this->data);
	}

  public function riwayat()
  	{
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan/riwayat'));
		$this->data['content'] = 'pemesanan/riwayat_view';
    $this->load->view('layout/main', $this->data);
	}

	public function detail()
	{
		$id_order = $this->uri->segment(3);
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan/getDetailOrder/'.$id_order));
		$this->data['content'] = 'pemesanan/detail_view';
		$this->load->view('layout/main', $this->data);
	}

	public function surat_jalan()
	{
		$id_order = $this->uri->segment(3);
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan/getDetailOrder/'.$id_order));
		$this->data['content'] = 'pemesanan/surat_jalan_view';
		$this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'pemesanan/tambah_pemesanan_update';
//		$this->data['content'] = 'pemesanan/tambah_pemesanan_view';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		$id_order = $this->input->post('id_order');
		$barang = $this->input->post('id_barang');
		$jumlah = $this->input->post('jumlah_order');
		$status = $this->input->post('cekdp');
		if(isset($status)){
			$dp = 'DP';
		}else{
			$dp = 'Belum DP';
		}

		foreach(array_combine($barang,$jumlah) as $brg => $jml){
			$array[] = array(
				'id_order' => $id_order,
				'id_barang' => $brg,
				'jumlah' => $jml,
			);
		}
		$body = [
			'id_order' => $id_order,
			'id_pelanggan' => $this->input->post('id_pelanggan'),
			'order_list' => $array,
			'status' => $dp,
		];
//		echo json_encode($body);
		$response = json_decode($this->guzzle_post(base_url().'api/','pemesanan',$body));		
		if($response->status){
			echo json_encode($response);
		}else{
			redirect('pemesanan','refresh');
		}
	}

	public function edit($id)
	{
		$this->data['content'] = 'barang/edit_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function editform()
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

	public function cari_pelanggan(){
		$keyword = urldecode($this->uri->segment(3));
			$body = [
				'keyword' => $keyword,
			];
		echo $this->guzzle_post(base_url().'api/','pemesanan/pelanggan',$body);
	}

	public function cari_barang(){
		$keyword = urldecode($this->uri->segment(3));
			$body = [
				'keyword' => $keyword,
			];
		echo $this->guzzle_post(base_url().'api/','pemesanan/barang',$body);
	}

	public function getId()
	{
		$response = json_decode($this->guzzle_get(base_url().'api/','pemesanan/getid'));
		echo json_encode($response);
	}

	public function getLaba()
	{
		
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
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('POST',$uri,[
				'form_params' => $body,
			]);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			redirect('pemesanan','refresh');
		}
	}

	public function guzzle_put($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
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