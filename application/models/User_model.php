<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function checkUser($data)
  {
    $dataUser = $this->db->query('SELECT username, dealer, password FROM user where username = "'.$data['username'].'"')->result_array();
    if($dataUser){
      foreach($dataUser as $userData){
        if($userData['dealer'] == $data['dealer'] && $userData['password'] == $data['password']){
          return true;
          break;
        }
      }
    }else{
      return false;
    }
  }

  public function getUser()
  {
    $data = $this->db->get("user")->result_array();
    return $data;
  }
  
  public function getDealer()
  {
    $data = $this->db->query('SELECT DISTINCT(dealer) FROM user')->result_array();
    return $data;
  }

}

/* End of file UserModel_model.php */
/* Location: ./application/models/UserModel_model.php */