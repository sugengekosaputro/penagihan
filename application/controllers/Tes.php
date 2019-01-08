<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function index()
	{
		$this->load->view('gudang/surat_jalan_view');
	}

	public function nota()
	{
		$this->load->view('gudang/nota_view');
	}

}

/* End of file Tes.php */
