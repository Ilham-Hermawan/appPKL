<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('pelanggan_model', 'booking_model'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Pelanggan',
      'sub_header_title' => 'Daftar Pelanggan'
    );
    $this->backend_render(PATH_BACKEND.'pelanggan/list', $data);
  }

  public function list_transaksi($id = NULL){
    $data = array(
      'header_title'     => '<i class="fa fa-eye"></i> Transaksi Pelanggan',
      'sub_header_title' => 'Status Transaksi Pelanggan',
      'booking'          => $this->booking_model->get_booking_by_pelanggan($id)->result(),
      'set'              => $this->pelanggan_model->get_data_by_ktp($id)
    );
    $this->backend_render(PATH_BACKEND.'pelanggan/transaksi', $data);
  }

  public function get_list_data($jk = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('pelanggan_id, pelanggan_ktp, pelanggan_nama, pelanggan_jk, pelanggan_alamat, pelanggan_kontak, pelanggan_pekerjaan, pelanggan_datetime, pelanggan_ttl');
    if($jk != "all"){
      $this->datatables->where('pelanggan_jk', $jk);
    }
    $this->datatables->from('tb_pelanggan');
    echo $this->datatables->generate();
  }

  public function add_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Pelanggan',
      'sub_header_title' => 'Tambah Pelanggan'
    );
    $this->backend_render(PATH_BACKEND.'pelanggan/form', $data);
  }

  public function edit_data($id = NULL){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Pelanggan',
      'sub_header_title' => 'Edit Pelanggan',
      'set'              => $this->pelanggan_model->get_data_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'pelanggan/form', $data);
  }

  public function save_data(){
    $id = $this->input->post('id', TRUE);

    if($id === "0"){
      $this->form_validation->set_rules('inputKtp', 'KTP', 'trim|xss_clean|required|is_unique[tb_pelanggan.pelanggan_ktp]');
    }
    else{
      $this->form_validation->set_rules('inputKtp', 'KTP', 'trim|xss_clean');
    }
		$this->form_validation->set_rules('inputNama', 'Nama Pelanggan', 'trim|xss_clean');
    $this->form_validation->set_rules('inputAlamat', 'Alamat Pelanggan', 'trim|xss_clean');
    $this->form_validation->set_rules('inputKontak', 'Kontak Pelanggan', 'trim|xss_clean');
    $this->form_validation->set_rules('inputPekerjaan', 'Pekerjaan Pelanggan', 'trim|xss_clean');
    $this->form_validation->set_rules('inputTtl', 'Tempat Tanggal Lahir', 'trim|xss_clean');

		if($this->form_validation->run() == FALSE){
				//gagal validasi
			$this->add_data();
		}
		else{
      $data = array(
        'pelanggan_ktp'       => $this->input->post('inputKtp', TRUE),
        'pelanggan_nama'      => $this->input->post('inputNama', TRUE),
        'pelanggan_jk'        => $this->input->post('inputJk', TRUE),
        'pelanggan_alamat'    => $this->input->post('inputAlamat', TRUE),
        'pelanggan_kontak'    => $this->input->post('inputKontak', TRUE),
        'pelanggan_pekerjaan' => $this->input->post('inputPekerjaan', TRUE),
        'pelanggan_ttl'       => $this->input->post('inputTtl', TRUE)
      );
      if($id === "0"){
        $data['pelanggan_datetime'] = date('Y-m-d H:i:s');
      }

      if($id === "0"){
        $this->pelanggan_model->save($data);
      }
      else{
        $this->pelanggan_model->update($data, $id);
      }
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
      redirect('dashboard/pelanggan/list');
    }//end validation

  }

  public function check_ktp(){
    $id = $this->input->post('id');
    $barang = $this->pelanggan_model->cek_ktp($id);
    if($barang === TRUE){
      echo json_encode('No Ktp Sudah ada');
    }

  }

  public function add_ajax_pelanggan(){
    $this->db->order_by("pelanggan_ktp", "ASC");
    $query = $this->db->get('tb_pelanggan');
    $data = "<option value=''>-Silahkan pilih Pelanggan-</option>";
    foreach ($query->result() as $value):
      $data .= "<option value='".$value->pelanggan_ktp."'>".$value->pelanggan_ktp."</option>";
    endforeach;

    echo $data;

  }

  public function get_data_pelanggan_json(){
    $id = $this->input->post('id');
    $data = $this->pelanggan_model->get_data_by_ktp($id);
    if(!empty($data)){
      echo json_encode($data);
    }
    else{
      echo json_encode("Data tidak ditemukan");
    }
  }

  public function delete_data($id = NULL, $ktp = NULL){
    $this->booking_model->delete_kelengkapan_by_pelanggan($ktp);
    $this->booking_model->delete_booking_by_pelanggan($ktp);
    $result = $this->pelanggan_model->delete_data($id);

		if($result){
			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
			redirect('dashboard/pelanggan/list');
		}
		else{
			$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
			redirect('dashboard/pelanggan/list');
		}
  }

  public function get_status_transaksi(){
    $id = $this->input->post('booking');
    $data = array(
      'bichecking' => $this->pelanggan_model->check_transaksi('tb_bichecking', 'bic_status', $id),
      'ppjb'       => $this->pelanggan_model->check_transaksi('tb_ppjb', 'ppjb_status', $id),
      'kelengkapanberkas' => $this->pelanggan_model->count_kelengkapan_berkas($id),
      'wawancara'  => $this->pelanggan_model->check_wawancara($id),
      'dbtn'       => $this->pelanggan_model->check_transaksi('tb_data_btn', 'db_status', $id),
      'ots'        => $this->pelanggan_model->check_transaksi('tb_ots', 'ots_status', $id),
      'sp3k'       => $this->pelanggan_model->check_transaksi('tb_sp3k', 'sp3k_status', $id),
      'lpa'        => $this->pelanggan_model->check_lpa($id),
      'vpajak'     => $this->pelanggan_model->check_transaksi('tb_validasi_pajak', 'vp_status', $id),
      'akad'       => $this->pelanggan_model->check_akad($id),
      'skr'        => $this->pelanggan_model->check_transaksi('tb_skr', 'skr_status', $id),
      'jaminan'    => $this->pelanggan_model->get_expired_jaminan($id)

    );
    echo json_encode($data);

  }

}
