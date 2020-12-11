<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function getDetailNow()
  {
    $data = $this->db->query('SELECT inputdtm from user ORDER BY inputdtm DESC')->result_array()[0]['inputdtm'];
    return $data;
  }

  public function getUserById($id)
  {
    $dataUser = $this->db->query('SELECT * FROM user where id = "'.$id.'"')->result_array();
    return $dataUser;
  }

  public function checkUser($data)
  {
    $dataUser = $this->db->query('SELECT * FROM user where username = "'.$data['username'].'"')->result_array();
    if($dataUser){
      foreach($dataUser as $userData){
        if($userData['dealer'] == $data['dealer'] && $userData['password'] == $data['password']){
          return $userData;
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