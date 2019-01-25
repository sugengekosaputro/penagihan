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

	public function simpan_sj()
	{
		$no_sj = $this->input->post('no_sj');
		$id_detail_order = $this->input->post('id_detail_order');
		$dikirm = $this->input->post('dikirim');
		$tanggal = date('Y-m-d');

		$lenght = count($id_detail_order);
		$i = 0;

		while($i < $lenght){
			$array[] = array(
				'no_sj' => $no_sj,
				'id_detail_order' => $id_detail_order[$i],
				'dikirim' => $dikirm[$i],
				'tanggal' => $tanggal,
			);
			$i++;
		}
		
		$body = ['surat_jalan'=>$array];
//		echo json_encode($body);
		$response = json_decode($this->guzzle_post(base_url().'api/','penagihan/suratjalan',$body));
		if($response->status){
			echo json_encode($response);
		}
	}

	public function pdfview()
	{
		$this->load->view('email/pdf_view');
	}

	public function notaAwal()
	{
		$id_order = $this->uri->segment(3);
		$res = json_decode($this->guzzle_get(base_url().'api/','penagihan/notaAwal/'.$id_order));
		$this->data['pelanggan'] = $res->pelanggan;
		$this->data['listbarang'] = $res->listbarang;
		$this->data['jumlah'] = $res->jumlah;
		$this->load->view('email/nota_awal',$this->data);
		// echo json_encode($res);
	}

	public function notaAkhir()
	{
		$id_order = $this->uri->segment(3);
		$res = json_decode($this->guzzle_get(base_url().'api/','penagihan/notaAkhir/'.$id_order));
		$this->data['pelanggan'] = $res->pelanggan;
		$this->data['tanggalkirim'] = $res->tanggalkirim;
		$this->data['listbarang'] = $res->listbarang;
		$this->data['pembayaran'] = $res->pembayaran;
		$this->load->view('email/nota_akhir',$this->data);
		// echo json_encode($res);
	}
	
	public function cetakPdf()
	{ 
		$id_order = $this->uri->segment(3);
		$res = json_decode($this->guzzle_get(base_url().'api/','penagihan/notaAwal/'.$id_order));
		$this->data['pelanggan'] = $res->pelanggan;
		$this->data['listbarang'] = $res->listbarang;
		$this->data['jumlah'] = $res->jumlah;

		$view = $this->load->view('email/nota_awal', $this->data);
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
		$id_order = '190111007';
		$data['data'] = json_decode($this->guzzle_get(base_url().'api/','penagihan/'.$id_order));

		$this->load->view('email/email_view',$data);
	}

    public function notifEmail()
    {
		$id_order = $this->uri->segment(3);
		$res = json_decode($this->guzzle_get(base_url().'api/','penagihan/notaAwal/'.$id_order));
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
                echo 'Sukses! email berhasil dikirim.';
                $this->session->set_flashdata("success", "<div class=\"alert\"> <span id=\"alert\" class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>Notifikasi email berhasil dikirim..</div>");
                redirect('pemesanan');
            } else {
                show_error($this->email->print_debugger());
            }
    }

    public function detail()
    {
        $this->data['data'] = json_decode($this->guzzle_get(base_url().'api/','pemesanan'));
        $this->load->view('layout/main', $this->data);
	}
	
	public function tambah()
	{
		$this->data['content'] = 'penagihan/tambah_view';
		$this->load->view('layout/main', $this->data);
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
		
			$client = new GuzzleHttp\Client(['base_uri' => $url]);
			$response = $client->request('POST',$uri,[
				'form_params' => $body,
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