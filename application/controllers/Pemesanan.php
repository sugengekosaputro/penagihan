<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {

	public $data = array(
		'content' => 'pemesanan/pemesanan_view',
		'lipemesanan' => 'active',
		'ulpemesanan' => 'display:block',
		'lidaftarpesanan' => 'active'
	);

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('username'))){
			redirect(base_url('login'));
		}
	}

  public function index()
	{
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan'));
		$this->load->view('layout/main', $this->data);
	}

	public function detail()
	{
		$id_order = $this->uri->segment(3);
		$data = json_decode($this->guzzle_get(base_url().'api/','pemesanan/detail/'.$id_order));
		
		$this->data['pelanggan'] = $data->pelanggan;
		$this->data['order'] = $data->order;
		$this->data['order_list'] = $this->data['order']->detail_order;
		$this->data['pembayaran'] = $data->pembayaran;
		$this->data['surat_jalan'] = $data->surat_jalan;
		$this->data['list'] = $this->data['surat_jalan']->history;

		$this->data['content'] = 'pemesanan/detail_view';
		$this->load->view('layout/main', $this->data);
	}

	public function surat_jalan()
	{
		$id_order = $this->uri->segment(3);
		$data = json_decode($this->guzzle_get(base_url().'api/','pemesanan/detail/'.$id_order));
		$this->data['order'] = $data->order;
		$this->data['order_list'] = $this->data['order']->detail_order;
		$this->data['content'] = 'pemesanan/surat_jalan_view';
		$this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'pemesanan/tambah_pemesanan_update';
		$this->load->view('layout/main', $this->data);
	}

	public function simpan()
	{
		$id_order = $this->input->post('id_order');
		$harga = $this->input->post('harga_barang');
		$barang = $this->input->post('id_barang');
		$jumlah = $this->input->post('jumlah_order');

		$lenght = count($barang);
		$i = 0;

		while($i < $lenght){
			$array[] = array(
				'id_order' => $id_order,
				'id_barang' => $barang[$i],
				'jumlah' => $jumlah[$i],
				'harga' => $harga[$i]
			);
			$i++;
		}

		$body = [
			'id_order' => $id_order,
			'id_pelanggan' => $this->input->post('id_pelanggan'),
			'order_list' => $array,
			'status' => 'Baru',
		];
		//echo json_encode($body);
		$response = json_decode($this->guzzle_post(base_url().'api/','pemesanan',$body));	
		// $this->notifEmailPemesanan($id_order);	
		if($response->status){
			echo json_encode($response);
		}else{			
			redirect('pemesanan','refresh');
		}
	}
	public function coba()
	{
		# code...
		$id_order = '190111007';
		$this->notifEmailPemesanan($id_order);
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

	public function pembayaran()
	{
		// $totaldp = $this->input->post('dp') + $this->input->post('dibayar');
		
		$body = [
			'id_order' => $this->input->post('id_order'),
			'id_pembayaran' => $this->input->post('id_pembayaran'),
			// 'total_bayar' => $this->input->post('total_bayar'),
			// 'dp' => $totaldp,
			'dibayar' => $this->input->post('dibayar'),
			'tanggal' => date('y-m-d'),
			'status_order' => $this->input->post('status_order'),
		];
        $response = json_decode($this->guzzle_post(base_url().'api/','pemesanan/pembayaran',$body));
        if($response->status){
        redirect('pemesanan','refresh');
    	}
	}

	public function edit($id)
	{
		$this->data['content'] = 'barang/edit_barang_view';
		$this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','barang/'.$id));
		$this->load->view('layout/main', $this->data);
	}

	public function editform()
	{
		if(empty($_FILES['foto_barang']['name'])){
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => $this->input->post('foto_lama'),
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];

			$response = json_decode($this->guzzle_put(base_url().'api/','barang/update',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('id_barang'),
				],
				[
					'name' => 'nama_barang',
					'contents' => $this->input->post('nama_barang'),
				],
				[
					'name' => 'ukuran',
					'contents' => $this->input->post('ukuran'),
				],
				[
					'name' => 'gramatur',
					'contents' => $this->input->post('gramatur'),
				],
				[
					'name' => 'foto_barang',
					'contents' => fopen($_FILES['foto_barang']['tmp_name'], 'r'),
					'filename' => $_FILES['foto_barang']['name'],
					'headers' => [
						'content-type' => 'image/jpeg'
					]
				],
				[
					'name' => 'harga_beli',
					'contents' => $this->input->post('harga_beli'),
				],
				[
					'name' => 'harga_jual',
					'contents' => $this->input->post('harga_jual'),
				],
			];
			
			$response = json_decode($this->guzzle_put(base_url().'api/','barang/update',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}
	}

	public function cari_pelanggan(){
		$keyword = urldecode($this->uri->segment(3));
			$body = [
				'keyword' => $keyword,
			];
		echo $this->guzzle_post(base_url().'api/','pemesanan/pelanggan',$body);
	}

	public function cari_barang(){
		$keyword = urldecode($this->uri->segment(3));
			$body = [
				'keyword' => $keyword,
			];
		echo $this->guzzle_post(base_url().'api/','pemesanan/barang',$body);
	}

	public function getId()
	{
		$response = json_decode($this->guzzle_get(base_url().'api/','pemesanan/getid'));
		echo json_encode($response);
	}

	public function hapus($id_barang)
	{
		$body = [
			'id_barang' => $id_barang,
		];
		$response = json_decode($this->guzzle_delete(base_url().'api/','barang',$body));
		 if($response->status){
			redirect('barang','refresh');
		}
	}

	public function guzzle_get($url,$uri)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('GET',$uri);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody();
			return null;
		}
	}

	public function guzzle_post($url,$uri,$body)
	{
		try{
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('POST',$uri,[
				'form_params' => $body,
			]);
			return $response->getBody();
		}catch(GuzzleHttp\Exception\ClientException $e){
			$response = $e->getResponse();
			$responseBodyAsString = $response->getBody()->getContents();
			redirect('pemesanan','refresh');
		}
	}

	public function guzzle_put($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
	}

	public function guzzle_delete($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('DELETE',$uri,[
			'form_params' => $body,
		]);
		return $response->getBody()->getContents();
	}
}