<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('booking_model', 'rumah_model', 'transaksi_model'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data(){
    $data = array(
      'header_title'     => '<i class="fa fa-book"></i> Booking',
      'sub_header_title' => 'Daftar Booking',
      'perumahan'        => $this->rumah_model->get_data()
    );
  }

  public function get_list_data($perumahan = "all", $status = "all", $dt1 = "0", $dt2 = "0"){
    $this->load->library('Datatables');
    $this->datatables->select('booking_id, pelanggan_nama, pelanggan_ktp, booking_datetime, booking_status, rumah_nama, kavling_blok, booking_no')
        ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
        ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
        ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');
    if($perumahan != "all"){
      $this->db->where("tb_booking.rumah_id", $perumahan);
    }
    if($status != "all"){
      $this->db->where("booking_status", $status);
    }
    if($dt1 != "0" OR $dt2 != "0"){
      $this->db->where("DATE(booking_datetime) BETWEEN '".$dt1."' AND '".$dt2."'");
    }
    $this->datatables->from('tb_booking');
    echo $this->datatables->generate();
  }

  public function get_data_by_id($id = NULL){
    if($id != NULL){
      $data = $this->booking_model->get_data_by_id($id);
      foreach ($data as $key => $value) {
          $result = $value;
      }
      echo json_encode($result);
    }
    else{
      $result = '';
    }

  }

  public function get_data_by_id_json(){
    $id = $this->input->post('id');
    if($id != NULL){
      $data = $this->booking_model->get_data_by_id($id);
      foreach ($data as $key => $value) {
          $result = $value;
      }
      echo json_encode($result);
    }
    else{
      $result = '';
    }

  }

  public function booking(){
    $data = array(
      'header_title'     => '<i class="fa fa-book"></i> Booking',
      'sub_header_title' => 'Booking',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'booking/form', $data);
  }

  public function save_data(){
    $booking = array(
      'pelanggan_id' => $this->input->post('id', TRUE),
      'rumah_id'     => $this->input->post('rumah_id', TRUE),
      'kavling_id'   => $this->input->post('kavling_id', TRUE),
      'booking_dp'   => preg_replace('/[^0-9]/', '',$this->input->post('inputDp', TRUE)),
      'booking_status' => 'p',
      'booking_datetime' => date('Y-m-d H:i:s')
    );

    if(strtolower($this->input->post('inputNoBooking', TRUE)) === "auto"){
      $rumah_id = $booking['rumah_id'];
      $kavling_id = $booking['kavling_id'];
      $booking['booking_no'] = $this->get_no_booking($rumah_id, $kavling_id);
    }
    else{
      $booking['booking_no'] = $this->input->post('inputNoBooking', TRUE);
    }

    $lastid = $this->booking_model->save($booking);

    $i = 0;
    if(!empty($this->input->post('kelengkapan'))){
      foreach ($this->input->post('kelengkapan') as $row) {
        $kelengkapan = array(
          'booking_id'   => $lastid,
          'pelanggan_id' => $booking['pelanggan_id'],
          'kelengkapan'  => $this->input->post('kelengkapan', TRUE)[$i]
        );
        $kelengkapan_data[] = $kelengkapan;
        $i++;
      }
    }
    else{
      $kelengkapan = array(
        'booking_id'   => $lastid,
        'pelanggan_id' => $booking['pelanggan_id'],
        'kelengkapan'  => ''
      );
      $kelengkapan_data[] = $kelengkapan;
    }

    $this->db->insert_batch('detil_kelengkapan', $kelengkapan_data);

    $bichecking = array(
      'booking_id' => $lastid,
      'bic_status' => 'p'
    );

    $this->transaksi_model->save_bichecking($bichecking);

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/booking/list/');

  }

  public function delete($id = NULL, $pelanggan = NULL){
    $this->booking_model->delete_detil($id, $pelanggan);
    $result = $this->booking_model->delete_booking($id);

		if($result){
			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
			redirect('dashboard/booking/list');
		}
		else{
			$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
			redirect('dashboard/booking/list');
		}
  }

  public function get_no_booking($id_rumah = NULL, $kavling = NULL){
    $last_id = $this->booking_model->get_max_id_booking($id_rumah);
    $kode_rumah = $this->rumah_model->get_data_by_id($id_rumah)->rumah_kode;
    $kavling = $this->rumah_model->get_detil_kavling_by_id($kavling)->kavling_blok;
    if($kavling != NULL){
      $kavling = preg_replace('/\s+/', '', $kavling);
      $kavling = preg_replace("/[^A-Za-z0-9?!]/",'',$kavling);
    }
    $tanggal = date('dmy');
    $noid = 0;
    $id = 0;
    if(!empty($last_id)){
      $ex_last_id = explode('/',$last_id);
      $noid = intval($ex_last_id[1]) + intval(1);
    }
    else{
      $noid = 1;
    }

    if($noid < 10){
      $id = "00".$noid;
    }
    else if($noid < 100){
      $id = "0".$noid;
    }
    else{
      $id = $noid;
    }
    return $kode_rumah.'-'.$kavling.'/'.$id.'/'.$tanggal;
  }

  public function get_no_booking_ajax(){
    $this->db->order_by("booking_no", "ASC");
    $query = $this->db->get_where('tb_booking');
    $data = "<option value=''>Silahkan pilih No Booking</option>";
    foreach ($query->result() as $value):
      $data .= "<option value='".$value->booking_id."'>".$value->booking_no."</option>";
    endforeach;

    echo $data;

  }

  public function get_booking_json(){
    $keyword = $this->input->post('booking',TRUE);
		$booking = $this->booking_model->get_data_autocomplete($keyword);

		if($booking){
			foreach ($booking as $row) {
				$data[] = array(
					'label' => $row->booking_no,
					'value'	=> $row->booking_no,
          'id'    => $row->booking_id,
          'pelanggan_nama' => $row->pelanggan_nama,
          'rumah_nama'     => $row->rumah_nama,
          'kavling_blok'   => $row->kavling_blok
				);
			}
		}
		else{
			$data[] = array(
				'label' => 'Data tidak ada',
				'value' => ''
			);
		}

		echo json_encode($data);
  }

  public function get_data_by_no(){
    $id = $this->input->post('id');
    $data = $this->booking_model->get_data_booking($id);
    if(!empty($data)){
      echo json_encode($data);
    }
    else{
      $data = "";
      echo json_encode($data);
    }
  }


}
