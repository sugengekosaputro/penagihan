<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penagihan_model extends CI_Model {

    private $tb_master_barang = 'tb_master_barang', 
            $tb_order='tb_order_rev',
            $tb_pelanggan='tb_pelanggan',
            $tb_pembayaran='tb_pembayaran',
            $tb_detail_pembayaran='tb_detail_pembayaran';
	
	public function tampilPenagihan()
	{   
		$this->db->select("tb_pembayaran.*, tb_order.*, tb_pelanggan.*, tb_master_barang.*");
		$this->db->join('tb_order','tb_order.id_order=tb_pembayaran.id_order');
        $this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan=tb_order.id_pelanggan');
        $this->db->join('tb_master_barang','tb_master_barang.id_barang=tb_order.id_barang');
        $this->db->where('tb_pembayaran.status_pembayaran !=','Lunas');
		$query = $this->db->get($this->tb_pembayaran);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
    }
    
    public function tampilRiwayatPenagihan()
	{   
        $this->db->select("tb_pembayaran.*, tb_order.*, tb_pelanggan.*, tb_master_barang.*");
		$this->db->join('tb_order','tb_order.id_order=tb_pembayaran.id_order');
        $this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan=tb_order.id_pelanggan');
        $this->db->join('tb_master_barang','tb_master_barang.id_barang=tb_order.id_barang');
        $this->db->where('tb_pembayaran.status_pembayaran','Lunas');
		$query = $this->db->get($this->tb_pembayaran);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function tampilPelanggan($id_order)
	{   
        $this->db->select("tb_order_rev.id_order, tb_pelanggan.*");
		$this->db->join('tb_pelanggan','tb_pelanggan.id_pelanggan=tb_order_rev.id_pelanggan');
        $this->db->where('tb_order_rev.id_order',$id_order);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res = $val;
			}
			return $val;
		} else {
			return FALSE;
		}
	}

	public function tampilListBarangSJ($id_order)
	{	
		$this->db->select("tb_order_rev.*, tb_detail_order_rev.*, tb_tagihan.id_detail_order, tb_tagihan.tanggal as tanggalkirim, sum(tb_tagihan.dikirim) as dikirim, tb_master_barang.*, tb_kategori_barang.*");
		$this->db->distinct('tb_tagihan.id_detail_order');
		$this->db->join('tb_detail_order_rev','tb_detail_order_rev.id_order = tb_order_rev.id_order');
		$this->db->join('tb_tagihan','tb_tagihan.id_detail_order = tb_detail_order_rev.id_detail_order');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang = tb_detail_order_rev.id_barang');
		$this->db->join('tb_kategori_barang','tb_kategori_barang.id_kategori = tb_master_barang.id_kategori');
		$this->db->where('tb_order_rev.id_order',$id_order);
		$this->db->group_by('tb_tagihan.id_detail_order');
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res[] = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
	}

	public function tampilListBarang($id_order)
	{
		$this->db->select("tb_order_rev.*, tb_detail_order_rev.*, tb_master_barang.*, tb_kategori_barang.*");
		$this->db->join('tb_detail_order_rev','tb_detail_order_rev.id_order = tb_order_rev.id_order');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang = tb_detail_order_rev.id_barang');
		$this->db->join('tb_kategori_barang','tb_kategori_barang.id_kategori = tb_master_barang.id_kategori');
        $this->db->where('tb_order_rev.id_order',$id_order);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res[] = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
	}

	public function tampilJumlah($id_order)
	{
		$this->db->select("tb_order_rev.*, tb_pembayaran.total_bayar, tb_pembayaran.dp");
		$this->db->join('tb_pembayaran','tb_pembayaran.id_order = tb_order_rev.id_order');
        $this->db->where('tb_order_rev.id_order',$id_order);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
	}

	public function tampilPembayaran($id_order)
	{
		$this->db->select("tb_order_rev.id_order, tb_pembayaran.id_pembayaran, sum(tb_detail_pembayaran.dibayar) as dibayar");
		$this->db->distinct('tb_detail_pembayaran.id_pembayaran');
		$this->db->join('tb_pembayaran','tb_pembayaran.id_order = tb_order_rev.id_order');
		$this->db->join('tb_detail_pembayaran','tb_detail_pembayaran.id_pembayaran = tb_pembayaran.id_pembayaran');
		$this->db->where('tb_order_rev.id_order',$id_order);
		$this->db->group_by('tb_detail_pembayaran.id_pembayaran');
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			foreach($query->result() as $val){
				$res = $val;
			}
			return $res;
		} else {
			return FALSE;
		}
	}

	public function tampilNotaAwal($id_order)
	{
		$this->db->select("tb_order_rev.*, tb_detail_order_rev.*, tb_pembayaran.*,
							tb_detail_pembayaran.*, tb_pelanggan.*, tb_master_barang.*, 
							tb_kategori_barang.*");
		$this->db->join('tb_order_rev','tb_order_rev.id_order=tb_detail_order_rev.id_order');
        $this->db->join('tb_','tb_pelanggan.id_pelanggan=tb_order_rev.id_pelanggan');
		$this->db->join('tb_master_barang','tb_master_barang.id_barang=tb_order.id_barang');
		$this->db->join('tb_detail_pembayaran','tb_detail_pembayaran.id_pembayaran = tb_pembayaran.id_pembayaran');
        $this->db->where('tb_order_rev.id_order',$id_order);
		$query = $this->db->get($this->tb_order);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
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

/* End of file User_model.php */
