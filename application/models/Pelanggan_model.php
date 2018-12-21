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

	public function tampilHargaJual($id_pelanggan)
	{
		$this->db->select("tb_master_jual.*, tb_pelanggan.*, tb_master_barang.*");
		$this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_master_jual.id_pelanggan');
		$this->db->join('tb_master_barang', 'tb_master_barang.id_barang = tb_master_jual.id_barang');
		$this->db->where('tb_master_jual.id_pelanggan',$id_pelanggan);
		$query = $this->db->get($this->tb_master_jual);
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

	public function insertHargaJual($data)
	{
		$this->db->insert($this->tb_master_jual, $data);
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

	public function updateHargaJual($id_master_jual,$data)
	{
		$this->db->where('id_master_jual', $id_master_jual)->update($this->tb_master_jual, $data);
		
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

	public function deleteHargaJual($id_master_jual)
	{
		$this->db->where('id_master_jual', $id_master_jual)
		->delete($this->tb_master_jual);

		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}
}

