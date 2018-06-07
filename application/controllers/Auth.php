<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model(array('auth_model'));
  }

  public function index()
	{
		$this->login_render();
	}

  public function check_login(){

    $this->form_validation->set_rules('inputUsername', 'Username', 'trim|required|xss_clean|max_length[10]');
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|xss_clean|max_length[10]');

		//cek validasi form
		if($this->form_validation->run() == FALSE){
			//validasi gagal
			$this->login_render();
		}
    else{
      $username 		= $this->input->post('inputUsername', TRUE);
			$password 	= $this->encryption_password($this->input->post('inputPassword', TRUE));

      $is_valid = $this->auth_model->check_login($username, $password);

      if($is_valid != FALSE){
        //login berhasil
        $this->session->sess_expiration = '86400';
				$this->session->set_userdata('userid', $is_valid->user_id);
				$this->session->set_userdata('userlevel', $is_valid->user_level);
				$this->session->set_userdata('userip', $_SERVER['REMOTE_ADDR']);

        if($this->agent->is_browser()){
						$agent = $this->agent->browser();
				}
				elseif ($this->agent->is_robot()){
						$agent = $this->agent->robot();
				}
				elseif ($this->agent->is_mobile()){
						$agent = $this->agent->mobile();
				}
				else{
						$agent = 'Unidentified User Agent';
				}

        if($this->input->ip_address() === "::1"){
          $ip = "localhost";
        }
        else{
          $ip = $this->input->ip_address();
        }

        $data = array(
					'user_id'						=> $is_valid->user_id,
					'umeta_lastlogin' 	=> date('Y-m-d H:i:s'),
					'umeta_agent'				=> $agent,
					'umeta_version'			=> $this->agent->version(),
					'umeta_platform'		=> $this->agent->platform(),
					'umeta_ip'					=> $ip
				);

        $this->auth_model->save_log($data);
        redirect('dashboard');
      }
      else{
        //login gagal
				$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_GAGAL);
				redirect('/');
      }

    }

  }

  public function log_out(){
		$this->session->unset_userdata('userid');
		$this->session->unset_userdata('userip');
		$this->session->unset_userdata('userlevel');
		$this->session->sess_destroy();

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_LOGOUT);
		redirect('/');
	}

}
