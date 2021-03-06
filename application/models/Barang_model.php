<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	private $tabel = 'tb_master_barang';
	private $tb_kategori_barang = 'tb_kategori_barang';
	private $tb_stok_barang = 'tb_stok_barang';
	
	public function tampilBarang()
	{
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilBarangById($id)
	{
		$this->db->where('id_barang', $id);
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilKategori()
	{
		$query = $this->db->get($this->tb_kategori_barang);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}

	public function tampilStok()
	{
		$this->db->select('tb_stok_barang.*, tb_master_barang.*');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang = tb_stok_barang.id_barang');
		$query = $this->db->get($this->tb_stok_barang);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}

	public function tampilStokById($id_barang)
	{
		$this->db->select('tb_stok_barang.*, tb_master_barang.*');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang = tb_stok_barang.id_barang');
		$this->db->where('tb_stok_barang.id_barang', $id_barang);
		$query = $this->db->get($this->tb_stok_barang);
		if ($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return FALSE;
		}
	}

	public function caribarang($keyword){
		$this->db->like('nama_barang',$keyword, 'both');
		$this->db->group_by('nama_barang', 'ASC');
		return $this->db->get('tb_master_barang')->result();
	}

	public function caripartisi($keyword){
		$this->db->select('tb_master_barang.*,tb_kategori_barang.*');
		$this->db->join('tb_kategori_barang','tb_kategori_barang.id_kategori = tb_master_barang.id_kategori');
		$this->db->where('tb_kategori_barang.jenis_barang', 'partisi');
		$this->db->like('nama_barang',$keyword, 'both');
		$this->db->group_by('nama_barang', 'ASC');
		return $this->db->get('tb_master_barang')->result();
	}

	public function insertBarang($data)
	{
		$this->db->insert($this->tabel, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updateBarang($id,$data)
	{
		$this->db->where('id_barang', $id)->update($this->tabel, $data);
		
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function deleteBarang($id)
	{
		$this->db->where('id_barang', $id)
		->delete($this->tabel);

		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}
}

