a<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save_bpt($data = NULL){
    $this->db->insert("tb_penerimaan", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bpt($data = NULL, $id = NULL){
    $this->db->where('penerimaan_id', $id);
    $this->db->update('tb_penerimaan', $data);
  }

  public function get_data_by_id($id = NULL){
    $this->db->where('penerimaan_id', $id)
    ->join('tb_rumah', 'tb_penerimaan.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_data($id = NULL){
    $this->db->where('penerimaan_id', $id);
    $hasil = $this->db->get("detil_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function pp_delete($id = NULL){
    $this->db->where('penerimaan_id', $id)
    ->delete('tb_penerimaan');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function pp_delete_detil($id = NULL){
    $this->db->where('dp_id', $id)
    ->delete('detil_penerimaan');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function save_penerimaan_kategori($data = NULL){
    $this->db->insert("penerimaan_kategori", $data);
  }

  function update_penerimaan_kategori($data = NULL, $id = NULL){
    $this->db->where('pkategori_id', $id);
    $this->db->update('penerimaan_kategori', $data);
  }

  function get_kategori_penerimaan($booking_id = NULL){
    $this->db->order_by('pkategori_nama', 'ASC')
    ->where('pkategori_id !=', '1');
    $hasil = $this->db->get("penerimaan_kategori");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function delete_penerimaan_kategori($id = NULL){
    $this->db->where('pkategori_id', $id)
    ->delete('penerimaan_kategori');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function g_kategori_penerimaan($id = NULL){
    $this->db->where('pkategori_id', $id);
    $hasil = $this->db->get("penerimaan_kategori");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function save_penerimaan($data = NULL){
    $this->db->insert("tb_penerimaan", $data);

    $penerimaan_no = (!empty($data['penerimaan_no'])) ? $data['penerimaan_no'] : '-';
    $kategori = $this->g_kategori_penerimaan($data['pkategori_id'])->pkategori_nama;
    $action = 'add';
    $uraian = 'Menambah PENERIMAAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan URAIAN : '.$data['penerimaan_uraian'].' dengan TOTAL PEMBAYARAN : Rp. '.number_format($data['penerimaan_total']). ' pada TANGGAL : '.date('d/m/Y', strtotime($data['penerimaan_tanggal']));
    $this->save_log_action($action, $uraian);

  }

  function update_penerimaan($data = NULL, $id = NULL){
    $this->db->where('penerimaan_id', $id);
    $this->db->update('tb_penerimaan', $data);

    $penerimaan_no = (!empty($data['penerimaan_no'])) ? $data['penerimaan_no'] : '-';
    $kategori = $this->g_kategori_penerimaan($data['pkategori_id'])->pkategori_nama;
    $action = 'edit';
    $uraian = 'Mengubah PENERIMAAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan URAIAN : '.$data['penerimaan_uraian'].' dengan TOTAL PEMBAYARAN : Rp. '.number_format($data['penerimaan_total']). ' pada TANGGAL : '.date('d/m/Y', strtotime($data['penerimaan_tanggal']));
    $this->save_log_action($action, $uraian);
  }

  // function get_uraian($id = NULL){
  //   $this->db->order_by('order', 'ASC')
  //       ->join('tb_penerimaan', 'uraian_penerimaan.up_id = tb_penerimaan.penerimaan_uraian', 'left')
  //        ->where('uraian_penerimaan.pkategori_id', $id)
  //        ->where('tb_penerimaan.penerimaan_uraian IS NULL');
  //   $hasil = $this->db->get("uraian_penerimaan");
  //
  //   return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  // }

  function get_uraian($kategori = NULL, $booking_id = NULL){
    $this->db->order_by('order', 'ASC')
    ->where('uraian_penerimaan.pkategori_id', $kategori)
    ->where('NOT EXISTS (SELECT 1 FROM tb_penerimaan WHERE penerimaan_uraian = uraian_penerimaan.up_id AND booking_id = "'.$booking_id.'")');
    $hasil = $this->db->get("uraian_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_uraian2($kategori = NULL, $booking_id = NULL){
    $this->db->order_by('order', 'ASC')
    ->where('uraian_penerimaan.pkategori_id', $kategori);;
    $hasil = $this->db->get("uraian_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_bayar_penerimaan($id = NULL){
    $this->db->where('penerimaan_id', $id)
    ->join('penerimaan_kategori', 'tb_penerimaan.pkategori_id = penerimaan_kategori.pkategori_id')
    ->join('tb_booking', 'tb_penerimaan.booking_id = tb_booking.booking_id')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
    ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');
    $hasil = $this->db->get("tb_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_penerimaan_by_id($id = NULL){
    $this->db->where('penerimaan_id', $id);
    $hasil = $this->db->get('tb_penerimaan');
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function delete_penerimaan($id = NULL){

    $penerimaan_no = $this->get_penerimaan_by_id($id)->penerimaan_no;
    $kategori = $this->g_kategori_penerimaan($this->get_penerimaan_by_id($id)->pkategori_id)->pkategori_nama;
    $uraian = $this->get_penerimaan_by_id($id)->penerimaan_uraian;
    $tanggal = $this->get_penerimaan_by_id($id)->penerimaan_tanggal;
    $total = $this->get_penerimaan_by_id($id)->penerimaan_total;
    $action = 'delete';
    $uraian = 'Menghapus PENERIMAAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan URAIAN : '.$uraian.' dengan TOTAL PEMBAYARAN : Rp. '.number_format($total). ' pada TANGGAL : '.date('d/m/Y', strtotime($tanggal));
    $this->save_log_action($action, $uraian);


    $this->db->where('penerimaan_id', $id)
    ->delete('tb_penerimaan');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function get_max_id_penerimaan($id_booking = NULL){
    $this->db->select_max('penerimaan_no')
    ->where('booking_id', $id_booking);
    $hasil = $this->db->get('tb_penerimaan');

    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_no : 0;
  }

  function get_rumah_kode($id_booking = NULL){
    $this->db->select('rumah_kode')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
    ->where('booking_id', $id_booking);
    $hasil = $this->db->get('tb_booking');
    return ($hasil->num_rows() > 0) ? $hasil->row()->rumah_kode : FALSE;
  }

  function get_kavling_kode($id_booking = NULL){
    $this->db->select('kavling_blok')
    ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
    ->where('booking_id', $id_booking);
    $hasil = $this->db->get('tb_booking');
    return ($hasil->num_rows() > 0) ? $hasil->row()->kavling_blok : FALSE;
  }

  function count_total_uangmuka($id_booking = NULL, $kategori_id = NULL){
    $this->db->select_sum('penerimaan_total', 'penerimaan_total')
    ->where('booking_id', $id_booking)
    ->where('pkategori_id !=', '2');
    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;
  }

  function count_total_penerimaanbank($id_booking = NULL, $kategori_id = NULL){
    $this->db->select_sum('penerimaan_total', 'penerimaan_total')
    ->where('booking_id', $id_booking)
    ->where('pkategori_id', $kategori_id);
    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;
  }

  function total_penerimaan($id_booking = NULL){
    $this->db->select_sum('penerimaan_total', 'penerimaan_total')
    ->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;
  }

  function detil_booking($id_booking = NULL){
    $this->db->where('booking_id', $id_booking)
    ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id');
    $hasil = $this->db->get("tb_booking");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
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
