<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public $data = array(
            'content' => 'index_view'
    );

    public function __construct()
	{
		parent::__construct();

	}

    public function index()
    {
        $this->load->view('layout/main', $this->data);
        
    }

}
