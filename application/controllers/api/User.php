<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class User extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
	}
	
	public function index_get()
	{
		$id = $this->uri->segment(3);
		$res = $this->user_model->tampilUser();
		$resId = $this->user_model->tampilUserById($id);

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
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|';
		$config['max_size']  = '100000';
		$config['max_width']  = '100000';
		$config['max_height']  = '100000';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->post('username');

		$this->load->library('upload', $config);

		if (! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->response($error);
		} else{
			$upload = $this->upload->data();
			//compress image
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/upload/'.$upload['file_name'];
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = FALSE;
			$config['quality'] = '75%';
			$config['width'] = 600;
			$config['height'] = 400;
			$config['new_image'] = './assets/upload/'.$upload['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$body = array(
				'username' => $this->post('username'),
				'password' => $this->post('password'),
				'nama' => $this->post('nama'),
				'foto' => base_url().'assets/upload/'.$upload['file_name'], 
				'role' => $this->post('role'),
			);
			
			$insert = $this->user_model->insertUser($body);
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
		$config['upload_path'] = 'assets/upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '100000';
		$config['max_width']  = '100000';
		$config['max_height']  = '100000';
		$config['overwrite'] = TRUE;
		$config['file_name'] = $this->post('username');

		$this->load->library('upload', $config);

		if(empty($_FILES['foto'])){
			$id = $this->post('id_user');
			$body = array(
				'username' => $this->post('username'),
				'password' => $this->post('password'),
				'nama' => $this->post('nama'),
				'foto' => $this->post('foto'),
				'role' => $this->post('role'),
			);

			$update = $this->user_model->updateUser($id,$body);
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
			if (! $this->upload->do_upload('foto')){
				$error = array('error' => $this->upload->display_errors());
				$this->response($error);
			} else{
				$upload = $this->upload->data();
				//compress image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/upload/'.$upload['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['quality'] = '75%';
				$config['width'] = 600;
				$config['height'] = 400;
				$config['new_image'] = './assets/upload/'.$upload['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
	
				$id = $this->post('id_user');
				$body = array(
					'id_user' => $id,
					'username' => $this->post('username'),
					'password' => $this->post('password'),
					'nama' => $this->post('nama'),
					'foto' =>  base_url().'assets/upload/'.$upload['file_name'],
					'role' => $this->post('role'),
				);
	
				$update = $this->user_model->updateUser($id,$body);
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
		$id = $this->delete('id_user');
		$res = $this->user_model->tampilUserById($id);
		$foto_path = substr($res[0]->foto,27);

		$delete = $this->user_model->deleteUser($id);
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
			'username' => $this->post('username'),
			'password' => $this->post('password'),
			'nama' => $this->post('nama'),
			'foto' => $this->post('foto'),
			'role' => $this->post('role'),
		);
		$insert = $this->user_model->insertUser($body);
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
