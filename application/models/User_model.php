<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save($data = NULL){
    $this->db->insert("tb_user", $data);

    $action = 'add';
    if($data['user_level'] == 0){
      $level = LEVEL_0;
    }
    elseif($data['user_level'] == 1){
      $level = LEVEL_1;
    }
    elseif($data['user_level'] == 2){
      $level = LEVEL_2;
    }
    elseif($data['user_level'] == 3){
      $level = LEVEL_3;
    }
    else{
      $level = LEVEL_UNDIFINED;
    }
    $uraian = 'Menambahkan USER dengan NAMA LENGKAP : '.$data['user_fullname'].' menggunakan USERNAME : '.$data['user_username'].' dengan LEVEL : '.$level;
    $this->save_log_action($action, $uraian);
  }

  public function update($data = NULL, $id = NULL){
    $this->db->where('user_id', $id);
    $this->db->update('tb_user', $data);

    $action = 'edit';
    if($data['user_level'] == 0){
      $level = LEVEL_0;
    }
    elseif($data['user_level'] == 1){
      $level = LEVEL_1;
    }
    elseif($data['user_level'] == 2){
      $level = LEVEL_2;
    }
    elseif($data['user_level'] == 3){
      $level = LEVEL_3;
    }
    else{
      $level = LEVEL_UNDIFINED;
    }
    $uraian = 'Mengubah USER dengan NAMA LENGKAP : '.$data['user_fullname'].' menggunakan USERNAME : '.$data['user_username'].' dengan LEVEL : '.$level;
    $this->save_log_action($action, $uraian);
  }

  public function get_data_by_id($id = NULL){
    $this->db->where('user_id', $id);
		$hasil = $this->db->get("tb_user");

		return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function delete($id = NULL){

    $user = $this->get_data_by_id($id);
    $action = 'delete';
    if($user->user_level == 0){
      $level = LEVEL_0;
    }
    elseif($user->user_level == 1){
      $level = LEVEL_1;
    }
    elseif($user->user_level == 2){
      $level = LEVEL_2;
    }
    elseif($user->user_level == 3){
      $level = LEVEL_3;
    }
    else{
      $level = LEVEL_UNDIFINED;
    }
    $uraian = 'Mengubah USER dengan NAMA LENGKAP : '.$user->user_fullname.' menggunakan USERNAME : '.$user->user_username.' dengan LEVEL : '.$level;
    $this->save_log_action($action, $uraian);

    $sql = "DELETE FROM tb_user WHERE user_id = ?";
		$hasil = $this->db->query($sql, array($id));

		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;

  }

  function save_log_action($action = NULL, $uraian = NULL){
    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => $action,
      'la_uraian' => $uraian,
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);
  }

}
