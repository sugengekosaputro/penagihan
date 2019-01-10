<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	private $tb_tagihan = 'tb_tagihan';
	private $tb_detail_order = 'tb_detail_order_rev';
	private $tb_barang = 'tb_master_barang';

  public function tampilTagihanByIdOrder($arrayId)
	{
		$this->db->select(
			'tb_tagihan.*,tb_detail_order_rev.id_barang,
			'.$this->tb_barang.'.nama_barang'
		);
		
		$this->db->join('tb_detail_order_rev','tb_detail_order_rev.id_detail_order = tb_tagihan.id_detail_order');
		$this->db->join(
			$this->tb_barang,$this->tb_barang.'.id_barang = '.$this->tb_detail_order.'.id_barang');
		$this->db->where_in('tb_tagihan.id_detail_order', $arrayId);

		$query = $this->db->get($this->tb_tagihan);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
}