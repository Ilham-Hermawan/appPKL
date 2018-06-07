<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct(){
    parent::__construct();
		if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}
		$this->load->model(array('rumah_model', 'booking_model', 'pelanggan_model', 'auth_model'));
  }

	public function index()
	{
		$data = array(
			'header_title'     => '<i class="fa fa-home"></i> Dashboard',
			'sub_header_title' => 'Control Panel',
			'last_login'       => $this->auth_model->get_last_login()->result(),
			'list_user'        => $this->auth_model->get_user(5)->result()
		);
		$this->backend_render(PATH_BACKEND.'dashboard', $data);
	}

	public function get_data_box(){
		$data = array(
			'jumlah_perumahan'=> $this->get_total_perumahan(),
			'jumlah_kavling' 	=> $this->get_total_kavling(),
			'bulan'						=> date('M'),
			'jumlah_booking'=> $this->get_total_booking(),
			// 'jumlah_dp'       => $this->get_total_dp()
		);
		echo json_encode($data);
	}

	public function get_total_perumahan(){
		return $this->rumah_model->count_all();
	}

	public function get_total_kavling(){
		return $this->rumah_model->count_all_kavling();
	}

	public function get_total_booking(){
		$month = date('m');
		return $this->booking_model->count_all($month);
	}

	public function get_total_dp(){
		$month = date('m');
		return $this->booking_model->get_total_dp($month);
	}
}
