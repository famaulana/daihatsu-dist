<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VerifyController extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->load->library('session');
    $this->load->model('User_model');
  }

  public function index()
  {
    $authConfirm = $this->session->userdata('authKeyStatus');
    $views = array(
      'tittle' => 'Verify Authentication - Daihatsu DIST',
      'view' => 'verification',
      'key' => $authConfirm
    );
    $this->load->view('template/template', $views);
  }

  public function verifyAuth()
  {
    $authVerify = $this->input->post();
    
    if(empty($authVerify)){
      $authVerify = $this->uri->segment(2);
      $authVerify = str_replace("DisT", " ", $authVerify);
      $authVerify = explode(" ", $authVerify);
      $id = $authVerify[0];
      $authKey = $authVerify[1];
    } else{
      $id = $authVerify['key'];
      $authKey = $authVerify['keyAuth'];
    }

    $authVerify = array(
      'id' => $id,
      'verifycode' => $authKey
    );

    $dataUser = $this->User_model->getUserById($authVerify['id']);

    if($dataUser[0]['verifycode'] == $authVerify['verifycode']){
      $this->session->unset_userdata('errAuth');
      print_r($dataUser);
    }else {
      $this->session->set_userdata('errAuth', 1);
      return redirect('/');
    }
  }

}


/* End of file VerifyController.php */
/* Location: ./application/controllers/VerifyController.php */