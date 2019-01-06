<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Token_model extends CI_Model {

	public function getAll()
	{
		$this->db->select('token');
        return $this->db->get('tb_user')->result_array();

	}

}