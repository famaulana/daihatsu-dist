<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Mailer_model');
    $this->load->library('session');
    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
  {
    $dateYesterday = $this->User_model->getDetailNow();
    $dateYesterday = new DateTime($dateYesterday);
    $dateYesterday = $dateYesterday->format('Y-m-d');
    if(date('Y-m-d') != $dateYesterday){
      $this->session->sess_destroy();
    } else if ($authConfirm = $this->session->userdata('authKeyStatus') != null) {
      return redirect('/authentication');
    }

    $dealers = $this->User_model->getDealer();
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
      // return redirect('/authentication');
      $this->succes();
    } else{
      print_r('failed');
    }
  }

  public function succes()
  {
    $this->session->set_flashdata('succes', 'User listed bellow');
    return redirect('/authentication');
  }

  public function logout()
  {
    $this->session->sess_destroy();
  }

}


/* End of file LoginController.php */
/* Location: ./application/controllers/LoginController.php */