<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {
    show_404();
  }

  function log_login(){
    $data = array(
      'header_title' => 'Log Login',
      'sub_header_title' => 'Log Login'
    );
    $this->backend_render(PATH_BACKEND.'log/log_login', $data);
  }

  function get_log_login(){
    $this->load->library('Datatables');
    $this->datatables->select('
        log_umeta.umeta_lastlogin,
        log_umeta.umeta_agent,
        log_umeta.umeta_platform,
        log_umeta.umeta_version,
        log_umeta.umeta_ip,
        tb_user.user_username,
        tb_user.user_fullname,
        tb_user.user_status
    ')
         ->from('log_umeta')
         ->join('tb_user', 'log_umeta.user_id = tb_user.user_id', 'left')
         ->order_by('log_umeta.umeta_lastlogin', 'DESC');
    echo $this->datatables->generate();
  }

  function log_action(){
    $data = array(
      'header_title' => 'Log Action',
      'sub_header_title' => 'Log Action'
    );
    $this->backend_render(PATH_BACKEND.'log/log_action', $data);
  }

  function get_log_action(){
    $this->load->library('Datatables');
    $this->datatables->select('
        log_action.la_id,
        log_action.la_url,
        log_action.la_action,
        log_action.la_uraian,
        log_action.la_created,
        tb_user.user_fullname
    ')
         ->from('log_action')
         ->join('tb_user', 'log_action.user_id = tb_user.user_id', 'left')
         ->order_by('log_action.la_created', 'DESC');
    echo $this->datatables->generate();
  }

}
