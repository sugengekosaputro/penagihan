<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pelanggan extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelanggan_model');
	}
	
	public function index_get()
	{
		$id = $this->uri->segment(3);
		$res = $this->pelanggan_model->tampilPelanggan();
		$resId = $this->pelanggan_model->tampilPelangganById($id);

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
	
	public function index_post()
	{	
			$body = array(
				'nama_pelanggan' => $this->post('nama_pelanggan'),
				'alamat' => $this->post('alamat'),
				'nomor_telepon' => $this->post('nomor_telepon'),
				'email' => $this->post('email'), 
				'harga_pelanggan' => $this->post('harga_pelanggan'),
			);
			
			$insert = $this->pelanggan_model->insertPelanggan($body);
			if($insert){
				$this->response([
					'status' => TRUE,
					'message' => 'Data Berhasil Ditambahkan',
				],REST_Controller::HTTP_CREATED);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Gagal Ditambahkan',
				],REST_Controller::HTTP_BAD_REQUEST);
			}
		
	}

	public function update_post()
	{
		$id = $this->post('id_pelanggan');
		$body = array(
			'nama_pelanggan' => $this->post('nama_pelanggan'),
			'alamat' => $this->post('alamat'),
			'nomor_telepon' => $this->post('nomor_telepon'),
			'email' => $this->post('email'), 
			'harga_pelanggan' => $this->post('harga_pelanggan'),
		);

        $update = $this->pelanggan_model->updatePelanggan($id,$body);
		if ($update) {
			$this->response([
				'status' => TRUE,
				'message' => 'Data Berhasil Diperbarui'
			],REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Gagal Diperbarui WITH FILE '
			],REST_Controller::HTTP_BAD_REQUEST);
		}
		
	}

	public function index_delete()
	{
		$id = $this->delete('id_pelanggan');
		$res = $this->pelanggan_model->tampilPelangganById($id);

		$delete = $this->pelanggan_model->deletePelanggan($id);
		if ($delete) {
			$this->response([
				'status' => TRUE,
				'message' => 'Data Berhasil Dihapus'
			],REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Gagal Dihapus'
			],REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	public function insert_post(){
		$body = array(
			'id_barang' => $this->post('id_barang'),
			'nama_barang' => $this->post('nama_barang'),
			'ukuran' => $this->post('ukuran'),
			'gramatur' => $this->post('gramatur'),
			'foto_barang' => $this->post('foto_barang'), 
			'harga_beli' => $this->post('harga_beli'),
			'harga_jual' => $this->post('harga_jual'),
		);
		$insert = $this->barang_model->insertBarang($body);
		if($insert){
			$this->response([
				'status' => TRUE,
				'message' => 'Data Berhasil Ditambahkan',
			],REST_Controller::HTTP_CREATED);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Gagal Ditambahkan',
			],REST_Controller::HTTP_BAD_REQUEST);
		}
	}
}

/* End of file User.php */
