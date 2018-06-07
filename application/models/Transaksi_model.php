<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function save_kelengkapan_berkas_data($data = NULL){
    $this->db->insert("kategori_kelengkapan_berkas", $data);
  }

  public function update_kelengkapan_berkas_data($data = NULL, $id = NULL){
    $this->db->where('kkb_id', $id);
    $this->db->update('kategori_kelengkapan_berkas', $data);
  }

  function delete_kelengkapan_berkas_data($id = NULL){
    $this->db->where('kkb_id', $id)
         ->delete('kategori_kelengkapan_berkas');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bichecking($data = NULL){
    $this->db->insert("tb_bichecking", $data);
  }

  public function update_bichecking($data = NULL, $id = NULL){
    $this->db->where('bic_id', $id);
    $this->db->update('tb_bichecking', $data);
  }

  public function save_ppjb($data = NULL){
    $this->db->insert("tb_ppjb", $data);
  }

  public function get_data_ppjb($id_booking = NULL){
    $this->db->join('tb_booking', 'tb_ppjb.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->where('tb_ppjb.booking_id', $id_booking);
     $hasil = $this->db->get("tb_ppjb");

     return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  // public function get_max_id_pjjb($id_rumah = NULL){
  //   $this->db->select_max('ppjb_no')
  //        ->where('rumah_id', $id_rumah);
  //   $hasil = $this->db->get('tb_booking');
  //
  //   return ($hasil->num_rows() > 0) ? $hasil->row()->ppjb_no : 0;
  // }


  public function get_max_id_pjjb(){
    return $this->db->query('SELECT MAX(ppjb_no) AS `maxid` FROM `tb_ppjb`')->row()->maxid;
  }

  public function pjjb_exist($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get("tb_ppjb");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function delete_ppjb($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_ppjb');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function update_ppjb($data = NULL, $id = NULL){
    $this->db->where('ppjb_id', $id);
    $this->db->update('tb_ppjb', $data);
  }

  public function get_berkas_by_id($booking = NULL, $pelanggan = NULL){
    $this->db->select('
        detil_kelengkapan.kelengkapan_id,
        detil_kelengkapan.pelanggan_id,
        detil_kelengkapan.booking_id,
        detil_kelengkapan.kkb_id,
        kategori_kelengkapan_berkas.kkb_nama
    ')
             ->where('booking_id', $booking)
             ->where('pelanggan_id', $pelanggan)
             ->join('kategori_kelengkapan_berkas', 'detil_kelengkapan.kkb_id = kategori_kelengkapan_berkas.kkb_id');
    $query = $this->db->get("detil_kelengkapan");
    return ($query->num_rows() > 0) ? $query->result() : FALSE;
  }

  function get_kkb(){
    $this->db->order_by('kkb_nama', 'ASC');
    $query = $this->db->get("kategori_kelengkapan_berkas");
    return ($query->num_rows() > 0) ? $query->result() : FALSE;
  }

  public function get_pelanggan_by_berkas($booking = NULL){
    $this->db->where('booking_id', $booking)
          ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
          ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
          ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id');
    $hasil = $this->db->get("tb_booking");

		return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function count_kelengkapan_berkas($id = NULL){
    $this->db->select('booking_id')
         ->from('detil_kelengkapan')
         ->where('booking_id', $id);
		return $this->db->count_all_results();
  }

  public function delete_kelengkapan_berkas($id = NULL){
    $this->db->where('kelengkapan_id', $id)
         ->delete('detil_kelengkapan');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_wawancara($data = NULL){
    $this->db->insert("tb_wawancara", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_wawancara($data = NULL, $id = NULL){
    $this->db->where('wawancara_id', $id);
    $this->db->update('tb_wawancara', $data);
  }

  public function detil_wawancara_delete($id_Wawancara = NULL, $id = NULL){
    $this->db->where('wawancara_id', $id_Wawancara)
         ->where('dw_id', $id)
         ->delete('detil_wawancara');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function wawancara_delete($id_Wawancara = NULL, $id = NULL){
    $this->db->where('wawancara_id', $id_Wawancara)
         ->delete('tb_wawancara');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function delete_wawancara($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('detil_wawancara');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }


  public function get_data_wawancara($id = NULL){
    $this->db->where('wawancara_id', $id)
         ->join('tb_rumah', 'tb_wawancara.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_wawancara");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_wawancara($id = NULL){
    $this->db->where('detil_wawancara.wawancara_id', $id)
         ->join('tb_wawancara', 'detil_wawancara.wawancara_id = tb_wawancara.wawancara_id')
         ->join('tb_booking', 'detil_wawancara.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

    $query = $this->db->get("detil_wawancara");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
  }

  public function get_max_id_wawancara(){
    return $this->db->query('SELECT MAX(wawancara_no) AS `maxid` FROM `tb_wawancara`')->row()->maxid;
  }

  public function check_btn($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_data_btn");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function update_dbtn($data = NULL, $id = NULL){
    $this->db->where('db_id', $id);
    $this->db->update('tb_data_btn', $data);
  }

  public function save_dbtn($data = NULL){
    $this->db->insert("tb_data_btn", $data);
  }

  public function delete_dbtn($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_data_btn');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function check_ots($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_ots");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_ots($data = NULL){
    $this->db->insert("tb_ots", $data);
  }

  public function update_ots($data = NULL, $id = NULL){
    $this->db->where('ots_id', $id);
    $this->db->update('tb_ots', $data);
  }

  public function delete_ots($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_ots');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function check_sp3k($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_sp3k");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_sp3k($data = NULL){
    $this->db->insert("tb_sp3k", $data);
  }

  public function update_sp3k($data = NULL, $id = NULL){
    $this->db->where('sp3k_id', $id);
    $this->db->update('tb_sp3k', $data);
  }

  public function delete_sp3k($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_sp3k');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_max_id_lpa(){
    return $this->db->query('SELECT MAX(lpa_no) AS `maxid` FROM `tb_lpa`')->row()->maxid;
  }

  public function check_lpa($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_lpa");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_lpa($data = NULL){
    $this->db->insert("tb_lpa", $data);
  }

  public function update_lpa($data = NULL, $id = NULL){
    $this->db->where('lpa_id', $id);
    $this->db->update('tb_lpa', $data);
  }

  public function delete_lpa($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_lpa');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_data_lpa($id = NULL){
    $this->db->where('lpa_id', $id)
         ->join('tb_rumah', 'tb_lpa.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_lpa");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_data_detil_lpa($id = NULL){
    $this->db->where('lpa_id', $id)
         ->join('tb_booking', 'detil_lpa.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');
    $hasil = $this->db->get("detil_lpa");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }


  public function check_vpajak($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_validasi_pajak");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_vpajak($data = NULL){
    $this->db->insert("tb_validasi_pajak", $data);
  }

  public function update_vpajak($data = NULL, $id = NULL){
    $this->db->where('vp_id', $id);
    $this->db->update('tb_validasi_pajak', $data);
  }

  public function delete_vpajak($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_validasi_pajak');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_max_id_akad(){
    return $this->db->query('SELECT MAX(akad_no) AS `maxid` FROM `tb_akad`')->row()->maxid;
  }

  public function save_akad($data = NULL){
    $this->db->insert("tb_akad", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_akad($data = NULL, $id = NULL){
    $this->db->where('akad_id', $id);
    $this->db->update('tb_akad', $data);
  }

  public function get_data_akad($id = NULL){
    $this->db->where('akad_id', $id)
         ->join('tb_rumah', 'tb_akad.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_akad");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function delete_akad($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('detil_akad');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_detil_akad($id = NULL){
    $this->db->where('detil_akad.akad_id', $id)
         ->join('tb_akad', 'detil_akad.akad_id = tb_akad.akad_id')
         ->join('tb_booking', 'detil_akad.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

    $query = $this->db->get("detil_akad");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
  }

  public function akad_delete($id_akad = NULL){
    $this->db->where('akad_id', $id_akad)
         ->delete('tb_akad');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_akad_data($id = NULL){
    $this->db->where('akad_id', $id)
          ->join('tb_rumah', 'tb_akad.rumah_id = tb_rumah.rumah_id')
          ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id');
    $hasil = $this->db->get("tb_akad");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_akad_data($id = NULL){
    $this->db->where('detil_akad.akad_id', $id)
         ->join('tb_akad', 'detil_akad.akad_id = tb_akad.akad_id')
         ->join('tb_booking', 'detil_akad.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

    $query = $this->db->get("detil_akad");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
  }

  public function check_skr($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_skr");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_skr($data = NULL){
    $this->db->insert("tb_skr", $data);
  }

  public function update_skr($data = NULL, $id = NULL){
    $this->db->where('skr_id', $id);
    $this->db->update('tb_skr', $data);
  }

  public function delete_skr($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_skr');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function check_jaminan($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_jaminan");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_jaminan($data = NULL){
    $this->db->insert("tb_jaminan", $data);
  }

  public function delete_jaminan($id = NULL){
    $this->db->where('booking_id', $id)
         ->delete('tb_jaminan');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function get_data_skr($id_booking = NULL){
    $this->db->select('
      tb_skr.skr_date,
      tb_rumah.rumah_alamat,
      tb_rumah.rumah_kota,
      tb_rumah.rumah_kecamatan,
      tb_rumah.rumah_desa,
      tb_pelanggan.pelanggan_nama,
      tb_pelanggan.pelanggan_alamat,
      tb_pelanggan.pelanggan_pekerjaan,
      tb_rumah.rumah_nama,
      rumah_kavling.kavling_blok,
      rumah_kavling.kavling_lb,
      rumah_kavling.kavling_lt
    ')
    ->join('tb_booking', 'tb_skr.booking_id = tb_booking.booking_id')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
    ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
    ->join('rumah_kavling', 'rumah_kavling.rumah_id = tb_rumah.rumah_id AND tb_booking.kavling_id = rumah_kavling.kavling_id')
    ->where('tb_skr.booking_id', $id_booking);

    $hasil = $this->db->get("tb_skr");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }





}
