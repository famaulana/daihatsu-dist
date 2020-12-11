<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mailer_model extends CI_Model
{
    
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
    $this->load->database();
  }

  public function index($data)
  {
    $dateNow = date('y-m-d');
    if(preg_match('/'.$dateNow.'/', $data['inputdtm'])){
      print_r($data);
    }else{
      $data['verifycode'] = $this->authKey();
      $data['inputdtm'] = date('y-m-d H:i:s');
      if($this->updateKey($data)){
        $this->posttomail($data);
        print_r("success");
      }else{
        print_r($data);
      }
    }
  }

  public function authKey()
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  public function updateKey($data)
  {
    if($update = $this->db->replace('user', $data)){
      return true;
    }else{
      return false;
    }

  }

  public function posttomail($data){

    $config = Array(
        'protocol' => 'smtp',
        '_smtp_auth' => TRUE,
        'smtp_host' => 'smtp.gmail.com', # Change this
        'smtp_crypto' => 'tls',
        'smtp_port' => 587,
        'smtp_user'   => 'daihatsu.mail.sender@gmail.com',
        'smtp_pass'  => 'wqdznsbhmqkpwmhq',
        'mailtype'  => 'html',
        // 'smtp_timeout' => 20,
    );
    
    $this->load->library('email', $config);
    // $this->email->initialize($config);

    $this->email->set_newline("\r\n");

    $this->email->from('Daihatsu Indonesia', 'Daihatsu Indonesia');
    $this->email->to($data['email']);
    
    $this->email->subject('Authentication Code - Daihatsu DIST');
    $this->email->message('<html><body><img style="width:50%" src="'.base_url().'assets/template/image/unnamed.png" alt=""><h3>Konfirmasi Kode Autentikasi DIST</h3><p>Hi '.$data['name'].'</p><p>Kode autentikasi anda adalah : <b>'.$data['verifycode'].'</b></p></body></html>');
    // $this->email->message('<html><body><img style="width:50%" src="'.base_url().'assets/template/image/unnamed.png" alt=""><h3>Konfirmasi Kode Autentikasi DIST</h3><p>Hi '.$data['name'].'</p><p>Kode autentikasi anda adalah : <b>'.$data['verifycode'].'</b></p><p>Jika anda ingin langsung melanjutkan ke website masuk dengan url berikut : </p><p><a href="http://localhost/dist/login">http://localhost/dist/login</a></p></body></html>');
    // $this->email->message('Done');

    // return $this->email->send();
    if($this->email->send()){
        return true;
    }else{
        print_r("You have encountered an error");
    }
    // var_dump($this->email->send());
    // print_r($this->email->print_debugger());
  }

}


/* End of file MailerController.php */
/* Location: ./application/controllers/MailerController.php */