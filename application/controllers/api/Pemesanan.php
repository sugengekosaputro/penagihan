<?php 
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Pemesanan extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('pemesanan_model');//++--
		$this->load->model('barang_model');
		$this->load->model('pelanggan_model');
		$this->load->model('pembayaran_model');
		$this->load->model('penagihan_model');
		$this->load->model('kategori_model');
		$this->load->model('jual_model');
		$this->load->model('tagihan_model');
  }
    
	public function index_get()
	{
		$res = $this->pemesanan_model->tampilkanOrder();
		if($res){
			$this->response($res,REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada',
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function detail_get()
	{
		$id_order = $this->uri->segment(4);
		$order = $this->pemesanan_model->tampilkanOrderByIdOrder($id_order);
		$pelanggan = $this->pelanggan_model->tampilPelangganById($order['id_pelanggan']);
		$order_list = $this->pemesanan_model->tampilDetailOrder($id_order);
		$pembayaran = $this->pembayaran_model->tampilPembayaranByIdOrder($id_order);

		foreach($order_list as $val){
			$id_detail_order[] = $val->id_detail_order; 
		}
		$surat_jalan = $this->tagihan_model->tampilSuratJalanByIdOrder($id_detail_order);

		$data = array(
			'pelanggan' => $pelanggan,
			'order' => $order,
			'pembayaran' => $pembayaran,
			'surat_jalan' => array('history' => $surat_jalan),
		);
		$this->response($data);
	}

	public function getId_get()
	{
		$tgl = date('ymd');
		$res = $this->pemesanan_model->tampilPemesananByTgl($tgl);
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

	public function getLaba_get()
	{
		$id_barang = $this->get('id_barang');
		$id_pelanggan = $this->get('id_pelanggan');
		$res = $this->jual_model->tampilHargaJualByPelangganBarang($id_pelanggan,$id_barang);
		
		if ($res) {
			$this->response($res,REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada'
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function getDetailOrder_get()
	{
		$id_order = $this->uri->segment(4);
		$res = $this->pemesanan_model->tampilDetailOrder($id_order);
		if ($res) {
			$this->response($res,REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada'
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function getDetailOrderSJ_get()
	{
		$id_order = $this->uri->segment(4);
		$sj = $this->uri->segment(5);
		$res = $this->pemesanan_model->tampilDetailOrderSJ($id_order);
		if ($res) {
			$this->response($res,REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada'
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}

	public function index_post()
	{	
		$tanggal = date('Y-m-d');
		$waktu = date('H:i:s');
		$id_order = $this->post('id_order');
		$body_order = array(
			'id_order' => $id_order,
			'id_pelanggan' => $this->post('id_pelanggan'),
			'tanggal_order' => $tanggal,
			'status_order' => $this->post('status'),
			'log_time' => $waktu,
		);
		
		$insertPemesanan = $this->pemesanan_model->insertOrder($body_order);
		if($insertPemesanan){
			$order_list = $this->post('order_list');
			$insertDetailOrder = $this->pemesanan_model->insertDetailOrder($order_list);
			if($insertDetailOrder){
				foreach($order_list as $ol){
					$arrJumlah[] = $ol['jumlah'] * $ol['harga'];
				}
				$total = array_sum($arrJumlah);
				$body_pembayaran = array(
				 	'id_order' => $id_order,
					'total_bayar' => $total,
					'dp' => 0,
					'status_pembayaran' => 'Belum Bayar',
				);
				$insertPembayaran = $this->pembayaran_model->insertPembayaran($body_pembayaran);
				if($insertPembayaran){
					// $this->notifEmailPemesanan($id_order);
					$this->response([
						'status' => TRUE,
						'message' => 'Tagihan Berhasil Dikirim',
					],REST_Controller::HTTP_OK);
				}else{
					$this->response([
						'status' => FALSE,
					 'message' => 'Data PEMBAYARAN Gagal Ditambahkan',
				 ],REST_Controller::HTTP_BAD_REQUEST);
				}
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

	public function Pembayaran_post()
	{
		$id_order = $this->post('id_order');
		// $dp = $this->post('dp');
		// $total_bayar = $this->post('total_bayar') / 2;
		$id_pembayaran = $this->post('id_pembayaran');

		$datadetailpembayaran = array(
			'id_pembayaran' => $this->post('id_pembayaran'),
			'dibayar' => $this->post('dibayar'),
			'tanggal' => $this->post('tanggal'),
			);	
		$insertDetailPembayaran = $this->pemesanan_model->insertDetailPembayaran($datadetailpembayaran);
		if($insertDetailPembayaran){
				$dataorder = array(
					'status_order' => $this->post('status_order'),
					);
			$updateOrder = $this->pemesanan_model->updateOrder($id_order,$dataorder);
			if($updateOrder){
				$datapembayaran = array(
					'status_pembayaran' => 'DP',
					);
				$updatePembayaran = $this->pemesanan_model->updatePembayaran($id_pembayaran,$datapembayaran);
				if($updatePembayaran){
						$this->response([
							'status' => TRUE,
							'message' => 'Data Pembayaran Berhasil Diupdate',
						],REST_Controller::HTTP_CREATED);
					} else {
						$this->response([
							'status' => FALSE,
							'message' => 'Data pembayaran Gagal Diupdate',
						],REST_Controller::HTTP_BAD_REQUEST);
					}
			} else {
				$this->response([
					'status' => FALSE,
					'message' => 'Data order Gagal Diupdate',	
				],REST_Controller::HTTP_BAD_REQUEST);
			}				
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data detail pembayaran Gagal Ditambahkan',
			],REST_Controller::HTTP_BAD_REQUEST);
		}
	
	}
		
	public function getPembayaran_get($id_order)
	{
		
		$id_pembayaran = $this->pemesanan_model->tampilPembayaran($id_order);
		if ($id_pembayaran) {
			$this->response($id_pembayaran,REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => FALSE,
				'message' => 'Data Tidak Ada'
			],REST_Controller::HTTP_NOT_FOUND);
		}
		# code...
	}

	public function tesinput_post()
	{
		$body_pembayaran = array(
			'id_order' => $this->post('id_order'),
			'total_bayar' => '9978',
			'status_pembayaran' => 'Belum Bayar',
		);
		$insertPembayaran = $this->pembayaran_model->insertPembayaran($body_pembayaran);
		if($insertPembayaran){
			$this->response([
				'status' => TRUE,
				'message' => 'Tagihan Berhasil Dikirim',
			],REST_Controller::HTTP_OK);
		}else{
			$this->response([
				'status' => FALSE,
			 'message' => 'Data HargaPembayaran Gagal Ditambahkan',
		 ],REST_Controller::HTTP_BAD_REQUEST);					
		}
	}

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
						'id_kategori' =>$row->id_kategori,
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

	public function harga_get()
	{
		$id_order = $this->get('id_order');
		$res = $this->pemesanan_model->tampilHarga($id_order);
			if ($res) {
				$this->response(array_sum(array_column($res,'harga')),REST_Controller::HTTP_OK);
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

	public function notifEmailPemesanan($id_order)
    {
		// $id_order = $this->uri->segment(3);
		$res = json_decode($this->guzzle_get(base_url().'api/','penagihan/notaPemesanan/'.$id_order));
		$this->data['pelanggan'] = $res->pelanggan;
		$this->data['listbarang'] = $res->listbarang;
		$this->data['jumlah'] = $res->jumlah;
		$pelanggan = $res->pelanggan;

	    $email = $pelanggan->email;
		$nota = 'Nota '.$pelanggan->nama_pelanggan.'.pdf';
		$view = $this->load->view('email/nota_awal',$this->data);
		$html = $this->output->get_output($view);
		$this->load->library('pdf');
		# code...
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4','portrait');
		// Render the HTML as PDF
		$this->dompdf->render();
		$output= $this->dompdf->output();

         // Konfigurasi email
         $config = Array(
            'protocol'  => 'smtp',
            'mailpath'  => '/usr/sbin/sendmail',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'fabinurcahyo@gmail.com',
			'smtp_pass' => 'fabiituindah8888', 
			'mailtype'	=> 'html',
			'charset'   => 'utf-8',
			'newline'	=> "\r\n",
	        'wordwrap' => TRUE
		 );
			$filename = base_url('assets/upload/telunjuk.png');
				// Load library email dan konfigurasinya
			$this->load->library('email');
			$this->email->initialize($config);
            $this->email->attach($output,'application/pdf',$nota,false);
            // Email dan nama pengirim
            $this->email->from('fabinurcahyo@gmail.com','fabi nur cahyo');
            // Email penerima
            $this->email->to($email);
            // Subject email
            $this->email->subject('UD. BILLY BOX BANGIL');
			// Isi email
			$body = $this->load->view('email/email_view',$this->data,true) ;
            $this->email->message($body,"inline");

            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                return true;
            } else {
                return false;
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