<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_model extends CI_Model {

    private $tb_master_barang = 'tb_master_barang', 
						$tb_order = 'tb_order_rev',
						$tb_detail_order = 'tb_detail_order_rev',
            $tb_pelanggan='tb_pelanggan';
	
	// public function tampilPemesanan()
	// {   
	// 	$this->db->select("tb_order_rev.*, tb_pelanggan.*, tb_master_barang.*");
	// 	$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan=tb_order_rev.id_pelanggan');
	// 	$this->db->join('tb_master_barang','tb_master_barang.id_barang=tb_order_rev.id_barang');
	// 	$this->db->where('tb_order_rev.status_order','Proses Pengiriman');
	// 	$this->db->order_by('tb_order_rev.id_order','DESC');
	// 	$query = $this->db->get($this->tb_order);
	// 	if ($query->num_rows() > 0) {
	// 		return $query->result();
	// 	} else {
	// 		return FALSE;
	// 	}
	// }

	public function tampilPemesanan($tgl)
	{ 
		$this->db->like('id_order',$tgl);
		$this->db->order_by('log_time','DESC');
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilRiwayatPemesanan()
	{   
        $this->db->select("tb_order.*, tb_pelanggan.*, tb_master_barang.*, tb_pembayaran.*");
        $this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan=tb_order.id_pelanggan');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang=tb_order.id_barang');
		$this->db->join('tb_pembayaran','tb_pembayaran.id_order=tb_order.id_order');
		$this->db->where('tb_order.status_order','Selesai Pengiriman');
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilPemesananById($id)
	{
		$this->db->where('id_order', $id);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilPemesananBylog($log)
	{
		$this->db->where('log_time', $log);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function caripelanggan($keyword){
		$this->db->like('nama_pelanggan',$keyword, 'both');
		$this->db->group_by('nama_pelanggan', 'ASC');

		return $this->db->get('tb_pelanggan')->result();
	}

	public function caribarang($keyword){
		$this->db->like('nama_barang',$keyword, 'both');
		$this->db->group_by('nama_barang', 'ASC');
		return $this->db->get('tb_master_barang')->result();
	}

	public function insertOrder($data)
	{
		$this->db->insert($this->tb_order, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function insertDetailOrder($data)
	{
		$this->db->insert_batch($this->tb_detail_order, $data);
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

/* End of file User_model.php */
