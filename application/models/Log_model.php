<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function save_log_action($log = NULL){

    $this->db->insert("log_action", $log);
    $insert_id = $this->db->insert_id();
    return  $insert_id;

  }

}
