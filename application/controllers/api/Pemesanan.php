<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pemesanan extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pemesanan_model');
		$this->load->model('barang_model');
		$this->load->model('pelanggan_model');
		$this->load->model('pembayaran_model');
		$this->load->model('penagihan_model');
  }
    
	public function index_get()
	{
		$id = $this->uri->segment(3);
		$res = $this->pemesanan_model->tampilPemesanan();
		$resId = $this->pemesanan_model->tampilPemesananById($id);
		if(empty($id)){
			if ($res) {
				$this->response($res,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
		}else{
			if ($resId) {
				$this->response($resId,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
		}
	}

	public function getId_get()
	{
		$tgl = date('ymd');
		$res = $this->pemesanan_model->tampilPemesanan($tgl);
		if ($res) {
			$jumlah = count($res);
			$digit = strlen((string)$jumlah);
			$urutan = $jumlah + 1;
			if($digit == 1){
				if($jumlah == 9){
					$digitAkhir = '0'.$urutan;
				}else{
					$digitAkhir = '00'.$urutan;
				}
			}elseif($digit == 2){
				if($jumlah == 99){
					$digitAkhir = $urutan;					
				}else{
					$digitAkhir = '0'.$urutan;
				}
			}
			$kode = $tgl.$digitAkhir;
			$this->response($kode,REST_Controller::HTTP_OK);
		} else {
			$digitAkhir = '001';
			$kode = $tgl.$digitAkhir;
			$this->response($kode,REST_Controller::HTTP_OK);
		}
	}

	public function index_post()
	{	
		$tanggal = date('Y-m-d');
		$waktu = date('H:i:s');
		
		$body = array(
			'id_order' => $this->post('id_order'),
			'id_pelanggan' => $this->post('id_pelanggan'),
			'tanggal_order' => $tanggal,
			'status_order' => 'Proses Pengiriman',
			'log_time' => $waktu,
		);
		
		$insertPemesanan = $this->pemesanan_model->insertOrder($body);
		if($insertPemesanan){
			$order_list = $this->post('order_list');
			$insertDetailOrder = $this->pemesanan_model->insertDetailOrder($order_list);
			if($insertDetailOrder){
				$this->response([
					'status' => TRUE,
					'message' => 'Tagihan Berhasil Dikirim',
				],REST_Controller::HTTP_OK);
			}else{
			 	$this->response([
			 		'status' => FALSE,
					'message' => 'Data DETAIL Gagal Ditambahkan',
				],REST_Controller::HTTP_BAD_REQUEST);				
			}
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Gagal Ditambahkan',
			],REST_Controller::HTTP_BAD_REQUEST);
		}
	}

	// public function index_post()
	// {	
	// 	$tanggal = date('Y-m-d');
	// 	$waktu = date('H:i:s');
	// 	$jumlah_order = $this->post('jumlah_order');
	// 	$dibayarAwal = $this->post('dibayarAwal');
		
	// 	$body = array(
	// 		'id_pelanggan' => $this->post('id_pelanggan'),
	// 		'id_barang' => $this->post('id_barang'),
	// 		'jumlah_order' => $jumlah_order,
	// 		'tanggal_order' => $tanggal,
	// 		'total_kirim' => '0',
	// 		'status_order' => 'Proses Pengiriman',
	// 		'log_time' => $waktu,
	// 	);
		
	// 	$insertPemesanan = $this->pemesanan_model->insertPemesanan($body);
	// 	if($insertPemesanan){
	// 		$dataPemesanan = $this->pemesanan_model->tampilPemesananBylog($waktu);
	// 		$id_order = $dataPemesanan[0]->id_order;
	// 		$id_pelanggan = $dataPemesanan[0]->id_pelanggan;
	// 		$id_barang = $dataPemesanan[0]->id_barang;
	// 		$jumlah_order = $dataPemesanan[0]->jumlah_order;

	// 		$dataBarang = $this->barang_model->tampilBarangById($id_barang);
	// 		$dataPelanggan = $this->pelanggan_model->tampilPelangganById($id_pelanggan);
			
	// 		$hargaBarang = $dataBarang[0]->harga_jual;			
	// 		$hargaPelanggan = $dataPelanggan[0]->harga_pelanggan;
	// 		$emailPelanggan = $dataPelanggan[0]->email;

	// 		$total_bayar = ($hargaBarang + $hargaPelanggan) * $jumlah_order;

	// 		if($total_bayar > $dibayarAwal){
	// 			$bodyPembayaran = array(
	// 				'id_order' => $id_order,
	// 				'total_bayar' => $total_bayar,
	// 				'status_pembayaran' => 'Belum Lunas',
	// 			);
	// 		}else{
	// 			$bodyPembayaran = array(
	// 				'id_order' => $id_order,
	// 				'total_bayar' => $total_bayar,
	// 				'status_pembayaran' => 'Lunas',
	// 			);
	// 		}
	// 		$insertPembayaran = $this->pembayaran_model->insertPembayaran($bodyPembayaran);
	// 		if($insertPembayaran){
	// 			$dataPembayaran = $this->pembayaran_model->tampilPembayaranByIdOrder($id_order);
	// 			$id_pembayaran = $dataPembayaran[0]->id_pembayaran;

	// 			$bodyDetail = array(
	// 				'id_pembayaran' => $id_pembayaran,
	// 				'dibayar' => $dibayarAwal,
	// 				'tanggal' => $tanggal,
	// 			);
	// 			$insertDetailPembayaran = $this->pembayaran_model->insertDetailPembayaran($bodyDetail);
	// 			if($insertDetailPembayaran){
	// 				$sendEmail = $this->notifEmail($id_order,$emailPelanggan);
	// 				if($sendEmail){
	// 					$this->response([
	// 						'status' => TRUE,
	// 						'message' => 'Tagihan Berhasil Dikirim',
	// 					],REST_Controller::HTTP_OK);
	// 				}else{
	// 					$this->response([
	// 						'status' => FALSE,
	// 						'message' => 'Data Gagal Dikirim',
	// 					],REST_Controller::HTTP_BAD_REQUEST);
	// 				}
	// 			} else {
	// 				$this->response([
	// 					'status' => FALSE,
	// 					'message' => 'Data Gagal Ditambahkan',
	// 				],REST_Controller::HTTP_BAD_REQUEST);
	// 			}
	// 		}
	// 	} else {
	// 		$this->response([
	// 			'status' => FALSE,
	// 			'message' => 'Data Gagal Ditambahkan',
	// 		],REST_Controller::HTTP_BAD_REQUEST);
	// 	}
	// }

	public function pelanggan_post(){
		$keyword = $this->post('keyword');
		 
		 	$result = $this->pemesanan_model->caripelanggan($keyword);
		 	if (count($result) > 0) {
		    foreach ($result as $row){
					$arr['query'] = $keyword;
					$arr['suggestions'][] = array(
						'value'	=>$row->nama_pelanggan,
						'id'	=>$row->id_pelanggan,
					);
				 }
			}
		echo json_encode($arr);
	}

	public function barang_post(){
		$keyword = $this->post('keyword');
	
			$result = $this->pemesanan_model->caribarang($keyword);
			if (count($result) > 0) {
				foreach ($result as $row){
					$arr['query'] = $keyword;
					$arr['suggestions'][] = array(
						'value'	=>$row->nama_barang,
						'id'	=>$row->id_barang,
						'harga_beli' =>$row->harga_beli,
					);
				}
		  }
			echo json_encode($arr);
	}

	
	public function riwayat_get()
	{
		$res = $this->pemesanan_model->tampilRiwayatPemesanan();
			if ($res) {
				$this->response($res,REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data Tidak Ada'
				],REST_Controller::HTTP_NOT_FOUND);
			}
	}

	public function send_post()
	{
		$id_order = $this->post('id_order');
		$emailTujuan = $this->post('email');
		
		$send = $this->notifEmail($id_order,$emailTujuan);
		if($send){
			echo 'OK';
		}else{
			echo 'not';
		}
	}

	public function notifEmail($id_order,$emailTujuan)
    {
		$data['data'] = $this->penagihan_model->tampilPenagihanByIdOrder($id_order);
        // Konfigurasi email
        $config = Array(
            'protocol'  => 'smtp',
            'mailpath'  => '/usr/sbin/sendmail',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sugengekosaputro96@gmail.com',
			'smtp_pass' => '100%AREMA', 
			'mailtype'	=> 'html',
			'charset'   => 'utf-8',
			'newline'	=> "\r\n",
	        'wordwrap' => TRUE
        );

		// Load library email dan konfigurasinya
		$this->load->library('email');
		$this->email->initialize($config);
		// $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
		// $this->email->set_header('Content-type', 'text/html');


		// $path = $this->config->item('server_root');
		// $file = $path.'/importExcel/assets/1.jpg';
		// $this->email->attach($file);

		// Email dan nama pengirim
		$this->email->from('sugengekosaputro96@gmail.com','SUGENG EKO SAPUTRO');

		// Email penerima
		$this->email->to($emailTujuan);

		// Subject email
		$this->email->subject('UD. BILLY BOX BANGIL');

		// Isi email
		$body = $this->load->view('penagihan/email_view',$data,true) ;
		$this->email->message($body);

		// Tampilkan pesan sukses atau error
		// if ($this->email->send()) {
		// 	echo 'Sukses! Nota berhasil dikirim.';
		// 	$this->session->set_flashdata("success", "<div class=\"alert\"> <span id=\"alert\" class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Notifikasi email berhasil dikirim..</div>");
		// 	redirect('pemesanan');
		// } else {
		// 	show_error($this->email->print_debugger());
		// }

		if($this->email->send()){
			return TRUE;
		}else{
			return FALSE;
		}
    }
}