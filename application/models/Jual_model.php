<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jual_model extends CI_Model {

	private $tabel = 'tb_master_jual';
	
	public function tampilHargaJualById($id_pelanggan)
	{
		$this->db->select("tb_master_jual.*, tb_pelanggan.*, tb_master_barang.*");
		$this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_master_jual.id_pelanggan');
		$this->db->join('tb_master_barang', 'tb_master_barang.id_barang = tb_master_jual.id_barang');
		$this->db->where('tb_master_jual.id_pelanggan',$id_pelanggan);
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
  }
  
  public function tampilHargaJualByPelangganBarang($id_pelanggan,$id_barang)
	{
		$this->db->select("tb_master_jual.*");
		$this->db->join('tb_pelanggan', 'tb_pelanggan.id_pelanggan = tb_master_jual.id_pelanggan');
		$this->db->join('tb_master_barang', 'tb_master_barang.id_barang = tb_master_jual.id_barang');
    $this->db->where('tb_master_jual.id_pelanggan',$id_pelanggan);
    $this->db->where('tb_master_jual.id_barang',$id_barang);
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
  }
  
  public function insertHargaJual($data)
	{
		$this->db->insert($this->tabel, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
  }
  
  public function updateHargaJual($id_master_jual,$data)
	{
		$this->db->where('id_master_jual', $id_master_jual)->update($this->tabel, $data);
		
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
  }
  
  public function deleteHargaJual($id_master_jual)
	{
		$this->db->where('id_master_jual', $id_master_jual)
		->delete($this->tabel);

		if ($this->db->affected_rows()>0) {
			return true;
		}else {
			return false;
		}
	}
}