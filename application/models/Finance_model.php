<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function pi_check($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_pi");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function save_pi($data = NULL){
    $this->db->insert("tb_pi", $data);
  }

  public function get_pi_by_id($id_booking = NULL){
    $this->db->where('tb_pi.booking_id', $id_booking)
          ->join('tb_booking', 'tb_pi.booking_id = tb_booking.booking_id')
          ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
          ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp');
    $hasil = $this->db->get("tb_pi");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function update_pi($data = NULL, $id = NULL){
    $this->db->where('pi_id', $id);
    $this->db->update('tb_pi', $data);
  }

  public function get_max_id_pl(){
    return $this->db->query('SELECT MAX(pl_no) AS `maxid` FROM `tb_pl`')->row()->maxid;
  }

  public function save_pl($data = NULL){
    $this->db->insert("tb_pl", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_pl($data = NULL, $id = NULL){
    $this->db->where('pl_id', $id);
    $this->db->update('tb_pl', $data);
  }

  public function pl_delete($id_pl = NULL){
    $this->db->where('pl_id', $id_pl)
         ->delete('tb_pl');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_pl_data($id = NULL){
    $this->db->select('*, COUNT(detil_pl.pl_id) AS total')
         ->where('tb_pl.pl_id', $id)
           ->join('tb_rumah', 'tb_pl.rumah_id = tb_rumah.rumah_id')
           ->join('detil_pl', 'tb_pl.pl_id = detil_pl.pl_id')
           ->group_by('detil_pl.pl_id');
    $hasil = $this->db->get("tb_pl");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_pl($id = NULL){
    $this->db->where('detil_pl.pl_id', $id)
         ->join('tb_pl', 'detil_pl.pl_id = tb_pl.pl_id')
         ->join('tb_booking', 'detil_pl.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

     $query = $this->db->get("detil_pl");

     if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
             $data[] = $row;
         }
         return $data;
     }
     return false;
  }

  public function detil_pl_delete($id_pl = NULL, $id = NULL){
    $this->db->where('pl_id', $id_pl)
         ->where('dpl_id', $id)
         ->delete('detil_pl');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_max_id_imb(){
    return $this->db->query('SELECT MAX(imb_no) AS `maxid` FROM `tb_imb`')->row()->maxid;
  }

  public function save_imb($data = NULL){
    $this->db->insert("tb_imb", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_imb($data = NULL, $id = NULL){
    $this->db->where('imb_id', $id);
    $this->db->update('tb_imb', $data);
  }

  public function imb_delete($id_imb = NULL){
    $this->db->where('imb_id', $id_imb)
         ->delete('tb_imb');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function detil_imb_delete($id_imb = NULL, $id = NULL){
    $this->db->where('imb_id', $id_imb)
         ->where('dimb_id', $id)
         ->delete('detil_imb');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }


  public function get_imb_data($id = NULL){
    $this->db->select('*, COUNT(detil_imb.imb_id) AS total')
         ->where('tb_imb.imb_id', $id)
           ->join('tb_rumah', 'tb_imb.rumah_id = tb_rumah.rumah_id')
           ->join('detil_imb', 'tb_imb.imb_id = detil_imb.imb_id')
           ->group_by('detil_imb.imb_id');
    $hasil = $this->db->get("tb_imb");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_imb($id = NULL){
    $this->db->where('detil_imb.imb_id', $id)
         ->join('tb_imb', 'detil_imb.imb_id = tb_imb.imb_id')
         ->join('tb_booking', 'detil_imb.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

     $query = $this->db->get("detil_imb");

     if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
             $data[] = $row;
         }
         return $data;
     }
     return false;
  }

  public function get_max_id_sertifikat(){
    return $this->db->query('SELECT MAX(s_no) AS `maxid` FROM `tb_sertifikat`')->row()->maxid;
  }

  public function save_s($data = NULL){
    $this->db->insert("tb_sertifikat", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_s($data = NULL, $id = NULL){
    $this->db->where('s_id', $id);
    $this->db->update('tb_sertifikat', $data);
  }

  public function s_delete($id_s = NULL){
    $this->db->where('s_id', $id_s)
         ->delete('tb_sertifikat');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function detil_s_delete($id_s = NULL, $id = NULL){
    $this->db->where('s_id', $id_s)
         ->where('ds_id', $id)
         ->delete('detil_sertifikat');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_s_data($id = NULL){
    $this->db->select('*, COUNT(detil_sertifikat.s_id) AS total')
         ->where('tb_sertifikat.s_id', $id)
           ->join('tb_rumah', 'tb_sertifikat.rumah_id = tb_rumah.rumah_id')
           ->join('detil_sertifikat', 'tb_sertifikat.s_id = detil_sertifikat.s_id')
           ->group_by('detil_sertifikat.s_id');
    $hasil = $this->db->get("tb_sertifikat");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_s($id = NULL){
    $this->db->where('detil_sertifikat.s_id', $id)
         ->join('tb_sertifikat', 'detil_sertifikat.s_id = tb_sertifikat.s_id')
         ->join('tb_booking', 'detil_sertifikat.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

     $query = $this->db->get("detil_sertifikat");

     if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
             $data[] = $row;
         }
         return $data;
     }
     return false;
  }

  public function get_max_id_100(){
    return $this->db->query('SELECT MAX(j100_no) AS `maxid` FROM `tb_100`')->row()->maxid;
  }

  public function save_100($data = NULL){
    $this->db->insert("tb_100", $data);
    $last_id = $this->db->insert_id();
    return $last_id;
  }

  public function update_100($data = NULL, $id = NULL){
    $this->db->where('j100_id', $id);
    $this->db->update('tb_100', $data);
  }

  public function j100_delete($id_s = NULL){
    $this->db->where('j100_id', $id_s)
         ->delete('tb_100');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function detil_100_delete($id_s = NULL, $id = NULL){
    $this->db->where('j100_id', $id_s)
         ->where('d100_id', $id)
         ->delete('detil_100');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_100_data($id = NULL){
    $this->db->select('*, COUNT(detil_100.j100_id) AS total')
         ->where('tb_100.j100_id', $id)
           ->join('tb_rumah', 'tb_100.rumah_id = tb_rumah.rumah_id')
           ->join('detil_100', 'tb_100.j100_id = detil_100.j100_id')
           ->group_by('tb_100.j100_id');
    $hasil = $this->db->get("tb_100");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_100($id = NULL){
    $this->db->where('detil_100.j100_id', $id)
         ->join('tb_100', 'detil_100.j100_id = tb_100.j100_id')
         ->join('tb_booking', 'detil_100.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');

     $query = $this->db->get("detil_100");

     if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
             $data[] = $row;
         }
         return $data;
     }
     return false;
  }

  public function jalan_check($id_booking = NULL){
    $this->db->where('booking_id', $id_booking);
    $hasil = $this->db->get("tb_jalan");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function get_jalan_by_id($id_booking = NULL){
    $this->db->where('tb_jalan.booking_id', $id_booking)
          ->join('tb_booking', 'tb_jalan.booking_id = tb_booking.booking_id')
          ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
          ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp');
    $hasil = $this->db->get("tb_jalan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function save_jalan($data = NULL){
    $this->db->insert("tb_jalan", $data);
  }

  public function update_j($data = NULL, $id = NULL){
    $this->db->where('j_id', $id);
    $this->db->update('tb_jalan', $data);

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_penerimaan($data = NULL){
    $this->db->insert("tb_pp", $data);
  }

  public function pp_delete($id_pp = NULL){
    $this->db->where('pp_id', $id_pp)
         ->delete('tb_pp');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function update_penerimaan($data = NULL, $id = NULL){
    $this->db->where('pp_id', $id);
    $this->db->update('tb_pp', $data);

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_penerimaan_by_id($id = NULL){
    $this->db->where('pp_id', $id)
        ->join('tb_rumah', 'tb_pp.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_pp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function save_dp($data = NULL){
    $this->db->insert("tb_dp", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_dp($data = NULL, $id = NULL){
    $this->db->where('dp_id', $id);
    $this->db->update('tb_dp', $data);
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_dp_data_by_id($id = NULL){
    $this->db->where('dp_id', $id)
         ->join('tb_booking', 'tb_dp.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_dp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_dp($id = NULL){
    $this->db->where('dp_id', $id)
         ->order_by('ddp_id', 'ASC');
    $hasil = $this->db->get("detil_dp");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function dp_delete($id = NULL){
    $this->db->where('dp_id', $id)
         ->delete('tb_dp');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

}
