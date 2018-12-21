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

	public function updateHarga_post()
	{
		$id_master_jual = $this->post('id_master_jual');
		$body = array(
			'laba' => $this->post('laba'),
		);

        $update = $this->pelanggan_model->updateHargaJual($id_master_jual,$body);
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


	public function harga_get()
	{
		$id_pelanggan = $this->uri->segment(4);
		$res = $this->pelanggan_model->tampilHargaJual($id_pelanggan);

			if ($res) {
				$this->response($res,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
	}

	public function harga_post(){
		$body = array(
			'id_pelanggan' => $this->post('id_pelanggan'),
			'id_barang' => $this->post('id_barang'),
			'laba' => $this->post('laba'),
		);
		$insert = $this->pelanggan_model->insertHargaJual($body);
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

	public function hargaJual_delete()
	{
		$id_master_jual = $this->delete('id_master_jual');
		$delete = $this->pelanggan_model->deleteHargaJual($id_master_jual);
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

}

/* End of file User.php */
