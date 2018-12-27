<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Barang extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model');
	}
	
	public function index_get()
	{
		$id = $this->uri->segment(3);
		$res = $this->barang_model->tampilBarang();
		$resId = $this->barang_model->tampilBarangById($id);

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

	public function stok_get()
	{
		$id_barang = $this->uri->segment(4);
		$res = $this->barang_model->tampilStok();
		$resId = $this->barang_model->tampilStokById($id_barang);

		if(empty($id_barang)){
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

	public function kategori_get()
	{
		$res = $this->barang_model->tampilKategori();
		if ($res) {
			$this->response($res,REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada'
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}
	
	public function index_post()
	{	
		$config['upload_path'] = './assets/upload/barang/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|';
		$config['max_size']  = '100000';
		$config['max_width']  = '100000';
		$config['max_height']  = '100000';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->post('id_barang');

		$this->load->library('upload', $config);

		if (! $this->upload->do_upload('foto_barang')){
			$error = array('error' => $this->upload->display_errors());
			$this->response($error);
		} else{
			$upload = $this->upload->data();
			//compress image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/upload/barang/'.$upload['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '75%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['new_image'] = './assets/upload/barang/'.$upload['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$body = array(
				'id_barang' => $this->post('id_barang'),
				'id_kategori' => $this->post('id_kategori'),
				'nama_barang' => $this->post('nama_barang'),
				'ukuran' => $this->post('ukuran'),
				'gramatur' => $this->post('gramatur'),
				'foto_barang' => base_url().'assets/upload/barang/'.$upload['file_name'], 
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

	public function update_post()
	{
		$config['upload_path'] = 'assets/upload/barang/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '100000';
		$config['max_width']  = '100000';
		$config['max_height']  = '100000';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->post('username');

		$this->load->library('upload', $config);

		if(empty($_FILES['foto_barang'])){
			$id = $this->post('id_barang');
			$body = array(
				'nama_barang' => $this->post('nama_barang'),
				'ukuran' => $this->post('ukuran'),
				'gramatur' => $this->post('gramatur'),
				'foto_barang' => $this->post('foto_barang'),
				'harga_beli' => $this->post('harga_beli'),
				'harga_jual' => $this->post('harga_jual'),
			);

			$update = $this->barang_model->updateBarang($id,$body);
			if ($update) {
				$this->response([
					'status' => TRUE,
					'message' => 'Data Berhasil Diperbarui'
				],REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Gagal Diperbarui NO FILES'
				],REST_Controller::HTTP_BAD_REQUEST);
			}
		}else{
			if (! $this->upload->do_upload('foto_barang')){
				$error = array('error' => $this->upload->display_errors());
				$this->response($error);
			} else{
				$upload = $this->upload->data();
				//compress image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/upload/barang/'.$upload['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '75%';
				$config['width'] = 600;
				$config['height'] = 400;
				$config['new_image'] = './assets/upload/barang/'.$upload['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
	
				$id = $this->post('id_barang');
				$body = array(
					'nama_barang' => $this->post('nama_barang'),
					'ukuran' => $this->post('ukuran'),
					'gramatur' => $this->post('gramatur'),
					'foto_barang' =>  base_url().'assets/upload/barang/'.$upload['file_name'],
					'harga_beli' => $this->post('harga_beli'),
					'harga_jual' => $this->post('harga_jual'),
				);
	
				$update = $this->barang_model->updateBarang($id,$body);
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
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id_barang');
		$res = $this->barang_model->tampilBarangById($id);
		$foto_path = substr($res[0]->foto_barang,27);

		$delete = $this->barang_model->deleteBarang($id);
		if ($delete) {
			unlink($foto_path);
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
