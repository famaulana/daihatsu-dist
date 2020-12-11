<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Mailer_model');
  }

  public function index()
  {
    $dealers = $this->User_model->getDealer();
    // var_dump($dealers);
    // exit;
    $views = array(
      'tittle' => 'Login - Daihatsu DIST',
      'view' => 'login',
      'dealers' => $dealers,
    );
    $this->load->view('template/template', $views);
  }

  public function auth()
  {
    $authData = $this->input->post();
    $authData = array(
      'username' => "famaulana",
      'password' => "itsmee",
      'dealer'   => "Astra Daihatsu Jayakarta"
    );
    $auth = $this->User_model->checkUser($authData);
    if(!empty($auth) || $auth != false){
      $this->Mailer_model->index($auth);
    } else{
      print_r('failed');
    }
  }

}


/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */