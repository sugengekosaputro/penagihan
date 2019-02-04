<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Penagihan extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('penagihan_model');
		$this->load->model('pelanggan_model');
		$this->load->model('tagihan_model');
    }
    
	public function index_get()
	{
		$id = $this->uri->segment(3);
		$res = $this->penagihan_model->tampilPenagihan();
		$resId = $this->penagihan_model->tampilPenagihanByIdOrder($id);
		if(empty($id)){
			if ($res) {
				$this->response($res,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			if ($resId) {
				$this->response($resId,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
		}
  }

  public function notaPemesanan_get()
	{
		$id_order = $this->uri->segment(4);
		$listbarang = $this->penagihan_model->tampilListBarang($id_order);
		$pelanggan = $this->penagihan_model->tampilPelanggan($id_order);
		$jumlah = $this->penagihan_model->tampilJumlah($id_order);

		$data = array(
			'pelanggan' => $pelanggan,
			'listbarang' => $listbarang,
			'jumlah' => $jumlah,
		);
		$this->response($data,REST_Controller::HTTP_OK);
		
	}

	public function notaPelunasan_get()
	{
		$id_order = $this->uri->segment(4);
		$listbarang = $this->penagihan_model->tampilListBarangSJ($id_order);
		$pelanggan = $this->penagihan_model->tampilPelanggan($id_order);
		$pembayaran = $this->penagihan_model->tampilPembayaran($id_order);

		foreach($listbarang as $res){
			$hargabarang[] = $res->harga * $res->dikirim; 
			$tanggalkirimarr[] = $res->tanggalkirim;
			
		}

		$jumlah = array_sum($hargabarang);
		$data = array(
			'listbarang' => $listbarang,
			'tanggalkirim' => end($tanggalkirimarr),
			'pelanggan' => $pelanggan,
			'pembayaran' => array(	'id_order' => $pembayaran->id_order,
									'id_pembayaran' => $pembayaran->id_pembayaran,
									'jumlah'=>$jumlah,
								    'dibayar'=>$pembayaran->dibayar),
		);
		$this->response($data,REST_Controller::HTTP_OK);
		
	}


  public function riwayat_get()
	{
		$res = $this->penagihan_model->tampilRiwayatPenagihan();
			if ($res) {
				$this->response($res,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
	}

	public function suratjalan_post()
	{
		$sj = $this->post('surat_jalan');
		$insertSj = $this->tagihan_model->insertSuratJalan($sj);
		if($insertSj){
			$this->response([
				'status' => TRUE,
				'message' => 'Berhasil Input Surat Jalan',
			],REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
			 'message' => 'Gagal Input Surat Jalan',
		 ],REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}