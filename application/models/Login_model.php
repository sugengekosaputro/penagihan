<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	private $tb_user = 'tb_user';
	
	public function cekUser($email,$password)
	{
		$this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get($this->tb_user);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function getUsername($email)
	{  

		$this->db->where('email', $email);

		$query = $this->db->get($this->tb_user);
		return $query->row();
	}

}

