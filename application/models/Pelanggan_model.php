<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model {

	private $tb_pelanggan = 'tb_pelanggan',
			$tb_master_jual = 'tb_master_jual';
	
	public function tampilPelanggan()
	{
		$query = $this->db->get($this->tb_pelanggan);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilPelangganById($id)
	{
		$this->db->where('id_pelanggan', $id);
		$query = $this->db->get($this->tb_pelanggan);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function insertPelanggan($data)
	{
		$this->db->insert($this->tb_pelanggan, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updatePelanggan($id,$data)
	{
		$this->db->where('id_pelanggan', $id)->update($this->tb_pelanggan, $data);
		
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deletePelanggan($id)
	{
		$this->db->where('id_pelanggan', $id)
		->delete($this->tb_pelanggan);

		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}
}

