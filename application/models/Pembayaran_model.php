<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model {

	private $tabel = 'tb_pembayaran';
	private $tabel_detail = 'tb_detail_pembayaran';
	// public function tampilBarang()
	// {
	// 	$query = $this->db->get($this->tabel);
	// 	if ($query->num_rows() > 0) {
	// 		return $query->result();
	// 	} else {
	// 		return FALSE;
	// 	}
	// }

  public function tampilPembayaranById($id_pembayaran)
	{
		$this->db->where('id_pembayaran', $id_pembayaran);
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
  }
    
	public function tampilPembayaranByIdOrder($id_order)
	{
		$this->db->where('id_order', $id_order);
		$query = $this->db->get($this->tabel);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
  }

	public function insertPembayaran($data)
	{
		$this->db->insert($this->tabel, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
    }
    
	public function insertDetailPembayaran($data)
	{
		$this->db->insert($this->tabel_detail, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function updateHargaKirim($id_order,$data)
	{
		$this->db->where('id_order', $id)->update($this->tabel, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

