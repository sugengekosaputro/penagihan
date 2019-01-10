<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Tagihan extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
    $this->load->model('tagihan_model');
    $this->load->model('pemesanan_model');
  }

  public function index_get()
  {
    $id = $this->uri->segment(3);
    $arrayIdDetail = $this->pemesanan_model->tampilDetailOrder($id);
    foreach($arrayIdDetail as $arr){
      $arrayId[] = $arr->id_detail_order;
    }
    $res = $this->tagihan_model->tampilTagihanByIdOrder($arrayId);
    if ($res) {
      $this->response($res,REST_Controller::HTTP_OK);
    } else {
      $this->response([
        'status' => FALSE,
        'message' => 'Data Tidak Ada'
      ],REST_Controller::HTTP_NOT_FOUND);
    }
  }

  public function input_post()
  {
    $body_tagihan = array(
      'no_sj' => $this->post('no_sj'),
      'id_detail_order' => $this->post('id_detail_order'),
      'dikirim' => $this->post('dikirim'),
    );
  }
}