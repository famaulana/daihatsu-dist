<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
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
      'username' => "rayno23",
      'password' => "apahayo123",
      'dealer'   => "Astra Daihatsu Jayakarta"
    );
    $auth = $this->User_model->checkUser($authData);
    if($auth){
      print_r('success');
    } else{
      print_r('failed');
    }
  }

}


/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */