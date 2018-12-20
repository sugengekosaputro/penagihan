<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penagihan extends CI_Controller {

	public $data = array(
		'content' => 'penagihan/penagihan_view'
	);

    public function __construct()
	{
        parent::__construct();
	}

    public function index()
    {
        $this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','penagihan'));
        $this->load->view('layout/main', $this->data);
    }
    
    public function riwayat()
    {
        $this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','penagihan/riwayat'));
        $this->load->view('layout/main', $this->data);
	}

	public function pdfview()
	{
		$this->load->view('pdf_view');
	}
	public function cetakPdf()
	{ 
		$view = $this->load->view('pdf_view');
		$html = $this->output->get_output($view);
		$this->load->library('pdf');
		# code...
		$this->dompdf->load_html($html);
		$this->dompdf->set_paper('A4','portrait');
		// Render the HTML as PDF
		$this->dompdf->render();
        
        // Output the generated PDF (1 = download and 0 = preview);
        $this->dompdf->stream("welcome.pdf", array("Attachment"=>0));

	}
	
	public function templateEmail()
	{
		$id_order = '37';
		$data['data'] = json_decode($this->guzzle_get(base_url().'api/','penagihan/'.$id_order));

		$this->load->view('penagihan/email_view',$data);
	}

    public function notifEmail($id_order)
    {
		$data['data'] = json_decode($this->guzzle_get(base_url().'api/','penagihan/'.$id_order));
		$pelanggan = json_decode($this->guzzle_get(base_url().'api/','penagihan/'.$id_order));
        foreach($pelanggan as $pelanggan){ 
			$email = $pelanggan->email;
			$nota = 'Nota '.$pelanggan->nama_pelanggan.'.pdf';
		}
		$view = $this->load->view('pdf_view');
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
			$body = $this->load->view('penagihan/email_view',$data,true) ;
            $this->email->message($body,"inline");

            // Tampilkan pesan sukses atau error
            if ($this->email->send()) {
                echo 'Sukses! email berhasil dikirim.';
                $this->session->set_flashdata("success", "<div class=\"alert\"> <span id=\"alert\" class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Notifikasi email berhasil dikirim..</div>");
                redirect('penagihan');
            } else {
                show_error($this->email->print_debugger());
            }
    }

    public function detail()
    {
        $this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan'));
        $this->load->view('layout/main', $this->data);
	}
	


	public function simpan()
	{
		if(empty($_FILES['foto_barang']['name'])){
			echo 'harus upload bro';
		}else{
			$body = [
				[
					'name' => 'id_barang',
					'contents' => $this->input->post('nama_barang'),
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
			$response = json_decode($this->guzzle_post(base_url().'api/','barang',$body));
			if($response->status){
				redirect('barang','refresh');
			}
		}
	}

	public function tambah()
	{
		$this->data['content'] = 'penagihan/tambah_view';
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
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('GET',$uri);
		return $response->getBody();
	}

	public function guzzle_post($url,$uri,$body)
	{
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$response = $client->request('POST',$uri,[
			'multipart' => $body,
		]);
		return $response->getBody();
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