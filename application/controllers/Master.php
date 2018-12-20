<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public $data = array(
            'content' => 'master/form_multiple_view'
    );

    public function __construct()
    {
      parent::__construct();    
    }

    public function selectSuggest()
    {
      $this->data['content'] = 'master/form_select_suggest_view';
      $this->load->view('layout/main', $this->data);
    }

    public function save()
    {
      $barang = $this->input->post('barang');
      $jumlah = $this->input->post('jumlah');

      foreach(array_combine($barang,$jumlah) as $brg => $jml){
          $array[] = array(
              'barang' => $brg,
              'jumlah' => $jml,
          );

          $data = array('value' => $array);
      }

      //print_r(json_encode($data));
      $response = $this->guzzle_post('master',$data);
      echo $response;
    }

    public function FormMultiple()
    {
      $this->data['content'] = 'master/form_multiple_view';
      $this->load->view('layout/main', $this->data);        
    }

    public function guzzle_post($uri,$body)
    {
      $client = new GuzzleHttp\Client(['base_uri' => base_url().'api/']);
      $response = $client->request('POST',$uri,[
        'form_params' => $body,
      ]);
      return $response->getBody()->getContents();
    }
}
