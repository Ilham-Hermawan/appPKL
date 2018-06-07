<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller{

  var  $data = array();

  public function __construct(){
    parent::__construct();

    $this->load->model(array('configuration_model', 'auth_model'));

    $this->data = array(
      'app_name'              => $this->configuration_model->get_config('app_name') ? $this->configuration_model->get_config('app_name') : "",
      'separator'             => "-",
      'site_favicon'          => $this->configuration_model->get_config('site_favicon') ? $this->configuration_model->get_config('site_favicon') : FALSE,
      'app_version'           => $this->configuration_model->get_config('app_version') ? $this->configuration_model->get_config('app_version') : "0",
      'site_timezone'         => $this->configuration_model->get_config('site_timezone') ? $this->configuration_model->get_config('site_timezone') : "Asia/Jakarta",
      'paper_size'            => $this->configuration_model->get_config('paper_size') ? $this->configuration_model->get_config('paper_size') : "A4",
    );

    (!empty($this->data['site_timezone'])) ? date_default_timezone_set($this->data['site_timezone']) : "Asia/Jakarta";
  }

  public function backend_render($content = NULL, $data_from_controller = NULL){
    $this->load->model(array('rumah_model'));
    $id = $this->session->userdata('userid');
    $data = array(
      'global_var'    => $this->data,
      'user_info'     => $this->get_user_info($id),
      'data'          => $data_from_controller,
      'project'       => $this->rumah_model->get_data()
    );

    $data['header'] = $this->load->view(PATH_BACKEND.'header', $data, TRUE);
    $data['left_menu'] = $this->load->view(PATH_BACKEND.'left_menu', $data, TRUE);
    $data['content'] = $this->load->view($content, $data, TRUE);

    $this->load->view(PATH_BACKEND.'index', $data);

  }

  public function login_render(){
    $this->load->view(PATH_BACKEND.'login', $this->data);
  }

  public function get_user_info($id = NULL){
    $data_user = $this->auth_model->get_user_by_id($id);
    $user_lastlogin = $this->auth_model->get_umeta_by_id($id);

    switch ($data_user->user_level) {
      case '0':
          $user_level = LEVEL_0;
          break;
      case '1':
          $user_level = LEVEL_1;
          break;
      case '2':
          $user_level = LEVEL_2;
          break;
      case '3':
          $user_level = LEVEL_3;
          break;
      default:
        $user_level = LEVEL_UNDIFINED;
        break;
    }

    $user_info = array(
        'user_id'           => $data_user->user_id,
        'user_nama'         => !empty($data_user->user_fullname) ? $data_user->user_fullname : "",
        'user_avatar'       => !empty($data_user->user_avatar) ? $data_user->user_avatar : "",
        'user_lastlogin'    => !empty($user_lastlogin->umeta_lastlogin) ? date('d-m-Y H:i:s a', strtotime($user_lastlogin->umeta_lastlogin)) : "",
        'user_level'        => $user_level
    );

    return $user_info;
  }

  public function is_logged(){
    $user = $this->session->userdata('userid');
    return isset($user);
  }

  function encryption_password($password = NULL){
		return "$"."AS"."$".md5(sha1(md5(md5(sha1("8d3270788f4fd8615cbdbe0054945f1c".$password."!@#$%^&*()_+{}><?;:]")))))."==";
	}

  function get_no_penerimaan($id_booking = NULL){
    $this->load->model(array('project_model', 'rumah_model'));
    $booking_kode = $this->project_model->get_booking_data($id_booking)->booking_no;
    $booking_kode_urut = explode('/',$booking_kode);
    $last_id = $this->penerimaan_model->get_max_id_penerimaan($id_booking);
    $kode_rumah = $this->penerimaan_model->get_rumah_kode($id_booking);
    $kavling = $this->penerimaan_model->get_kavling_kode($id_booking);
    if($kavling != NULL){
      $kavling = preg_replace('/\s+/', '', $kavling);
      $kavling = preg_replace("/[^A-Za-z0-9?!]/",'',$kavling);
    }
    $tanggal = date('dmy');
    $nourut = 0;
    $nourutid = 0;
    if(!empty($last_id)){
      $ex_last_id = explode('/',$last_id);
      $ex_no_urut = explode('-',$ex_last_id[1]);
      $nourut = intval($ex_no_urut[1]) + intval(1);
    }
    else{
      $nourut = 1;
    }

    if($nourut < 10){
      $nourutid = "00".$nourut;
    }
    else if($nourut < 100){
      $nourutid = "0".$nourut;
    }
    else{
      $nourutid = $nourut;
    }
    return $booking_kode_urut[0].'/'.$booking_kode_urut[1].'-'.$nourutid.'/'.$tanggal;
  }

  function get_no_pengeluaran($id_rumah = NULL, $kategori_id = NULL){
    $this->load->model(array('project_model', 'rumah_model'));

    $last_id = $this->pengeluaran_model->get_max_id_pengeluaran($kategori_id);
    $kode_rumah = $this->project_model->get_project_by_id($id_rumah)->rumah_kode;

    $tanggal = date('dmy');
    $nourut = 0;
    $nourutid = 0;

    if(!empty($last_id)){
      $ex_last_id = explode('/',$last_id);
      $nourut = intval($ex_last_id[2]) + intval(1);
    }
    else{
      $nourut = 1;
    }

    if($nourut < 10){
      $nourutid = "00".$nourut;
    }
    else if($nourut < 100){
      $nourutid = "0".$nourut;
    }
    else{
      $nourutid = $nourut;
    }
    return $kode_rumah.'/P/'.$nourutid.'/'.$tanggal;
  }

}
