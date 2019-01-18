<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

	public $data = array(

		'lipemesanan' => 'active',
		'ulpemesanan' => 'display:block',
		'lidaftarpesanan' => 'active'
	);

  public function __construct()
	{
		parent::__construct();
	}

  public function detail()
	{
    $id_order = $this->uri->segment(3);
    $sj = $this->uri->segment(4);
    $info = json_decode($this->guzzle_get(base_url().'api/','pemesanan/'.$id_order));
		$this->data['pelanggan'] = $info[0]->nama_pelanggan;
		$this->data['tanggal'] = $info[0]->tanggal_order;
		$this->data['alamat'] = $info[0]->alamat;

		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan/getDetailOrder/'.$id_order));
		$tagihan = json_decode($this->guzzle_get(base_url().'api/','tagihan/'.$id_order));
		if($tagihan == false){
			$this->data['tagihan'] = null;
		}else{
			$this->data['tagihan'] = $tagihan;
    }
    
    $this->data['rincian'] = json_decode($this->guzzle_get(base_url().'api/','tagihan/rincian/'.$sj));

		$this->data['content'] = 'penagihan/tagihan_view';
		$this->load->view('layout/main', $this->data);
	}
  
  public function guzzle_get($url,$uri)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('GET',$uri);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody();
			return null;
		}
	}


}