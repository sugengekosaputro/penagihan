<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Token_model");

	}

    public function index()
    {
		$result = $this->Token_model->getAll();

        $tokens = array();
        
		foreach ($result as $row) {
			$tokens[] = $row['token'];
			$messages['judul'] = " Notif Penagihan";
			$messages['isi'] = "ini isi";


			$url = 'https://fcm.googleapis.com/fcm/send';
		
			$fields = array(
				'registration_ids' => $tokens,
				'data' => $messages
			);
			
			$headers = array(
				'Authorization:key = AAAAFGRJO44:APA91bH4JMElvhwGsLerh6OZPGzgxvK0mrFjftqnpi4aaH1UIbMD4gRbCS7JaY38cJNHoTPCcLSAsssI6HjsvyLrd8IIPH0DxAZ0jda7EDVYVj_2PMqL-u3drOfViU9Sn81SVR9y-WWo',
				'Content-Type: application/json'
			);


			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);

			if ($result === FALSE) {
		       die('Curl failed: ' . curl_error($ch));
		   }
		   curl_close($ch);
		
			$tokens = array();

		}
		
		$response['success'] = true;
		$response['message'] = "Info terkirim ke aplikasi";
		$response['token'] = $tokens;

		echo json_encode($response);

	}

}