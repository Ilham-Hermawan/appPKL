<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_project(){
    $hasil = $this->db->get("tb_rumah");
    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function cek_data($id = NULL)
  {
    $this->db->where('rumah_id', $id);
    $hasil = $this->db->get("tb_rumah");
    return $hasil->num_rows();
  }

  function get_project_by_id($id = NULL){
    $this->db->where('rumah_id', $id);
    $hasil = $this->db->get("tb_rumah");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_kavling_id($id = NULL){
    $this->db->where('kavling_id', $id)
         ->join('tb_rumah', 'rumah_kavling.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("rumah_kavling");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_kavling($id = NULL){
    $this->db->where('rumah_id', $id)
         ->order_by('kavling_blok', 'ASC');
    $hasil = $this->db->get("rumah_kavling");
    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function count_kavling($id = NULL){
    $this->db->where('rumah_id', $id);
    return $this->db->count_all_results('rumah_kavling');
  }

  function delete_data($id = NULL){

    $rumah = $this->get_project_by_id($id);
    $action = 'delete';
    $uraian = 'Menghapus PROJECT dengan NAMA : '.$rumah->rumah_nama;
    $this->save_log_action($action, $uraian);

    $this->db->where('rumah_id', $id)
         ->delete('tb_rumah');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function get_data_batal_by_id($id = NULL){
    $this->db->where('batal_id', $id)
         ->join('tb_jenis_pembatalan', 'tb_batal.batal_status = tb_jenis_pembatalan.pembatalan_id');
    $hasil = $this->db->get("tb_batal");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function delete_batal($id = NULL){

    $data = $this->get_data_batal_by_id($id);
    $action = 'delete';
    $uraian = 'Menghapus BOOKING PROJECT yang dibatalkan dengan NO BOOKING : '.$data->booking_no.' dengan alasan : '.$data->pembatalan_nama;
    $this->save_log_action($action, $uraian);

    $this->db->where('batal_id', $id)
         ->delete('tb_batal');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function count_tersedia($id = NULL){
    $this->db->where('rumah_kavling.rumah_id', $id)
         ->where('tb_booking.kavling_id IS NULL')
         ->join('tb_booking', 'rumah_kavling.kavling_id = tb_booking.kavling_id', 'left');
    return $this->db->count_all_results('rumah_kavling');
  }

  function count_terjual($id = NULL){
    $this->db->where('rumah_kavling.rumah_id', $id)
         ->join('tb_booking', 'rumah_kavling.kavling_id = tb_booking.kavling_id', 'inner');
    return $this->db->count_all_results('rumah_kavling');
  }

  function get_max_id_booking($id_rumah = NULL){
    $this->db->select_max('booking_no')
         ->where('rumah_id', $id_rumah);
    $hasil = $this->db->get('tb_booking');

    return ($hasil->num_rows() > 0) ? $hasil->row()->booking_no : 0;
  }

  function save_pelanggan($data = NULL){
    $this->db->insert("tb_pelanggan", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  function update_pelanggan($data = NULL, $id = NULL){
    $this->db->where('pelanggan_id', $id);
    $this->db->update('tb_pelanggan', $data);
  }

  function booking_save($data = NULL, $pelanggan_nama, $pelanggan_ktp){

    $action = 'add';
    $uraian = 'Menambah BOOKING RUMAH dengan NOMOR BOOKING : '.$data['booking_no'].' dengan NAMA PELANGGAN : '.$pelanggan_nama.' dengan NOMOR KTP : '.$pelanggan_ktp;
    $this->save_log_action($action, $uraian);

    $this->db->insert("tb_booking", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  function booking_update($data = NULL, $id = NULL, $pelanggan_nama, $pelanggan_ktp){
    $this->db->where('booking_id', $id);
    $this->db->update('tb_booking', $data);

    $action = 'edit';
    $uraian = 'Mengubah BOOKING RUMAH dengan NOMOR BOOKING : '.$data['booking_no'].' dengan NAMA PELANGGAN : '.$pelanggan_nama.' dengan NOMOR KTP : '.$pelanggan_ktp;
    $this->save_log_action($action, $uraian);
  }

  function get_booking_data($id = NULL){
    $this->db->where('booking_id', $id)
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('tb_agama', 'tb_pelanggan.pelanggan_agama = tb_agama.agama_id');
    $hasil = $this->db->get('tb_booking');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_booking_no($id = NULL){
    $this->db->select('booking_no')
         ->where('booking_id', $id);
    $hasil = $this->db->get('tb_booking');

    return ($hasil->num_rows() > 0) ? $hasil->row()->booking_no : FALSE;
  }

  function get_ppjb($id = NULL){
    $this->db->where('tb_ppjb.booking_id', $id);
    $hasil = $this->db->get('tb_ppjb');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_ppjb($data = NULL){
    $this->db->insert("tb_ppjb", $data);
  }

  function update_ppjb($data = NULL, $id = NULL){
    $this->db->where('ppjb_id', $id);
    $this->db->update('tb_ppjb', $data);
  }

  function get_max_id_ppjb($id_rumah = NULL){
    $this->db->select_max('ppjb_no')
         ->join('tb_booking', 'tb_ppjb.booking_id = tb_booking.booking_id')
         ->where('tb_booking.rumah_id', $id_rumah);
    $hasil = $this->db->get('tb_ppjb');

    return ($hasil->num_rows() > 0) ? $hasil->row()->ppjb_no : 0;
  }

  function cek_exist_tanggal_wawancara($tgl = NULL){
    $this->db->where('wawancara_tanggal', $tgl);
    $hasil = $this->db->get('tb_wawancara');

    return ($hasil->num_rows() > 0) ? $hasil->row()->wawancara_id : FALSE;
  }

  public function get_max_id_wawancara(){
    return $this->db->query('SELECT MAX(wawancara_no) AS `maxid` FROM `tb_wawancara`')->row()->maxid;
  }

  function wawancara_save($data = NULL){
    $this->db->insert("tb_wawancara", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  function wawancara_update($data = NULL, $id = NULL){
    $this->db->where('wawancara_id', $id);
    $this->db->update('tb_wawancara', $data);
  }

  function save_detil_wawancara($data = NULL){
    $this->db->insert("detil_wawancara", $data);
  }

  function get_detil_wawancara($id = NULL){
    $this->db->where('detil_wawancara.booking_id', $id)
         ->join('tb_wawancara', 'detil_wawancara.wawancara_id = tb_wawancara.wawancara_id');
    $hasil = $this->db->get('detil_wawancara');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function update_detil_wawancara($data = NULL, $id = NULL){
    $this->db->where('dw_id', $id);
    $this->db->update('detil_wawancara', $data);
  }

  function get_pb($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_data_btn');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_pb($data = NULL){
    $this->db->insert("tb_data_btn", $data);
  }

  function update_pb($data = NULL, $id = NULL){
    $this->db->where('db_id', $id);
    $this->db->update('tb_data_btn', $data);
  }

  function get_ots($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_ots');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_ots($data = NULL){
    $this->db->insert("tb_ots", $data);
  }

  function update_ots($data = NULL, $id = NULL){
    $this->db->where('ots_id', $id);
    $this->db->update('tb_ots', $data);
  }

  function get_sp3k($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_sp3k');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_sp3k($data = NULL){
    $this->db->insert("tb_sp3k", $data);
  }

  function update_sp3k($data = NULL, $id = NULL){
    $this->db->where('sp3k_id', $id);
    $this->db->update('tb_sp3k', $data);
  }

  function get_detil_lpa($id = NULL){
    $this->db->where('detil_lpa.booking_id', $id)
         ->join('tb_lpa', 'detil_lpa.lpa_id = tb_lpa.lpa_id');
    $hasil = $this->db->get('detil_lpa');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function cek_exist_tanggal_lpa($tgl = NULL){
    $this->db->where('lpa_tanggal', $tgl);
    $hasil = $this->db->get('tb_lpa');

    return ($hasil->num_rows() > 0) ? $hasil->row()->lpa_id : FALSE;
  }

  function lpa_save($data = NULL){
    $this->db->insert("tb_lpa", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  function lpa_update($data = NULL, $id = NULL){
    $this->db->where('lpa_id', $id);
    $this->db->update('tb_lpa', $data);
  }

  function save_detil_lpa($data = NULL){
    $this->db->insert("detil_lpa", $data);
  }

  function update_detil_lpa($data = NULL, $id = NULL){
    $this->db->where('dlpa_id', $id);
    $this->db->update('detil_lpa', $data);
  }

  function get_vpajak($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_validasi_pajak');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_vpajak($data = NULL){
    $this->db->insert("tb_validasi_pajak", $data);
  }

  function update_vpajak($data = NULL, $id = NULL){
    $this->db->where('vp_id', $id);
    $this->db->update('tb_validasi_pajak', $data);
  }

  function get_detil_akad($id = NULL){
    $this->db->where('detil_akad.booking_id', $id)
         ->join('tb_akad', 'detil_akad.akad_id = tb_akad.akad_id');
    $hasil = $this->db->get('detil_akad');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_max_id_akad(){
    return $this->db->query('SELECT MAX(akad_no) AS `maxid` FROM `tb_akad`')->row()->maxid;
  }

  function cek_exist_tanggal_akad($tgl = NULL){
    $this->db->where('akad_date', $tgl);
    $hasil = $this->db->get('tb_akad');

    return ($hasil->num_rows() > 0) ? $hasil->row()->akad_id : FALSE;
  }

  function akad_save($data = NULL){
    $this->db->insert("tb_akad", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  function akad_update($data = NULL, $id = NULL){
    $this->db->where('akad_id', $id);
    $this->db->update('tb_akad', $data);
  }

  function save_detil_akad($data = NULL){
    $this->db->insert("detil_akad", $data);
  }

  function update_detil_akad($data = NULL, $id = NULL){
    $this->db->where('ad_id', $id);
    $this->db->update('detil_akad', $data);
  }

  function get_skr2($id = NULL){
    $this->db->where('booking_id', $id)
         ->where('skr_status !=', 'n');
    $hasil = $this->db->get('tb_skr');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_skr($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_skr');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_skr($data = NULL){
    $this->db->insert("tb_skr", $data);
  }

  function update_skr($data = NULL, $id = NULL){
    $this->db->where('skr_id', $id);
    $this->db->update('tb_skr', $data);
  }

  function delete_jaminan($id_booking = NULL){
    $this->db->where('booking_id', $id_booking)
         ->delete('tb_jaminan');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function save_jaminan($data = NULL){
    $this->db->insert("tb_jaminan", $data);
  }

  function get_jaminan($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get('tb_jaminan');

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_max_id_lpa(){
    return $this->db->query('SELECT MAX(lpa_no) AS `maxid` FROM `tb_lpa`')->row()->maxid;
  }

  function get_agama(){
    $this->db->order_by('agama_nama', 'ASC');
    $hasil = $this->db->get("tb_agama");
    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_pembayaran($id_booking = NULL){
    $this->db->select_sum('penerimaan_total', 'penerimaan_total')
         ->where('booking_id', $id_booking)
         ->where('pkategori_id != 1');
    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;
  }

  function save_batal($data = NULL, $status){

    $action = 'delete';
    $uraian = 'Membatalkan BOOKING dengan NO BOOKING : '.$data['booking_no'].' dengan alasan : '.$status;
    $this->save_log_action($action, $uraian);

    $this->db->insert("tb_batal", $data);
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function get_date_wawancara($id = NULL){
    $this->db->select('wawancara_tanggal')
         ->where('rumah_id', $id);
    $hasil = $this->db->get("tb_wawancara");

		return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_date_lpa($id = NULL){
    $this->db->select('lpa_tanggal')
         ->where('rumah_id', $id);
    $hasil = $this->db->get("tb_lpa");

		return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_date_akad($id = NULL){
    $this->db->select('akad_date')
         ->where('rumah_id', $id);
    $hasil = $this->db->get("tb_akad");

		return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
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
