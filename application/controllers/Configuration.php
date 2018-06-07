<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('configuration_model'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data(){
    $data = array(
      'header_title'     => '<i class="fa fa-book"></i> Configuration',
      'sub_header_title' => 'Configuration',
      'company_name'     => $this->configuration_model->get_config('company_name'),
      'company_address'  => $this->configuration_model->get_config('company_address'),
      'company_owner'    => $this->configuration_model->get_config('company_owner'),
      'company_phone'    => $this->configuration_model->get_config('company_phone'),
      'company_email'    => $this->configuration_model->get_config('company_email')
    );
    $this->backend_render(PATH_BACKEND.'configuration/list', $data);
  }

  public function save_data(){
    $data = array(
      'company_name' => $this->input->post('inputNama'),
      'company_address' => $this->input->post('inputAlamat'),
      'company_owner' => $this->input->post('inputOwner'),
      'company_phone' => $this->input->post('inputPhone'),
      'company_email' => $this->input->post('inputEmail')
    );
    $this->configuration_model->save_config($data);
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/configuration/list');
  }

}
