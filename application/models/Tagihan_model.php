<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan_model extends CI_Model {

	private $tb_tagihan = 'tb_tagihan';
	private $tb_detail_order = 'tb_detail_order_rev';
	private $tb_barang = 'tb_master_barang';

	public function tampilSuratJalanByIdOrder($arrayId)
	{
		$this->db->select('
		tb_tagihan.id_tagihan,tb_tagihan.no_sj,SUM(tb_tagihan.dikirim) as total,tb_tagihan.tanggal,
		');
		$this->db->where_in('tb_tagihan.id_detail_order', $arrayId);
		$this->db->group_by('tb_tagihan.no_sj');
		$query = $this->db->get($this->tb_tagihan);
		if ($query->num_rows() > 0) {
			$result = array();
			foreach($query->result() as $key => $val){
				$query2 = $this->db->where('tb_tagihan.no_sj',$val->no_sj)->get($this->tb_tagihan);
				
				$array[] = array(
					'no_sj'=>$val->no_sj,
					'tanggal'=>$val->tanggal,
					'total'=> $val->total,
					'list'=>$query2->result());
			}
			return $array;
		} else {
			return FALSE;
		}
	}

	public function tampilSjByIdSj($id_sj)
	{
		$this->db->select(
			'tb_tagihan.*,tb_detail_order_rev.id_barang,
			'.$this->tb_barang.'.nama_barang'
		);
		$this->db->join('tb_detail_order_rev','tb_detail_order_rev.id_detail_order = tb_tagihan.id_detail_order');
		$this->db->join(
			$this->tb_barang,$this->tb_barang.'.id_barang = '.$this->tb_detail_order.'.id_barang');
		$this->db->where_in('tb_tagihan.no_sj', $id_sj);

		$query = $this->db->get($this->tb_tagihan);
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function insertSuratJalan($data)
	{
		$this->db->insert_batch($this->tb_tagihan, $data);
		if ($this->db->affected_rows()>0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}