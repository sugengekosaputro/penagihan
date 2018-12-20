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
}