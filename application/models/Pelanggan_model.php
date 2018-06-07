<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save($data = NULL){
    $this->db->insert("tb_pelanggan", $data);
  }

  public function update($data = NULL, $id = NULL){
    $this->db->where('pelanggan_id', $id);
    $this->db->update('tb_pelanggan', $data);
  }

  public function get_data(){
    $hasil = $this->db->get("tb_pelanggan");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function get_data_by_id($id = NULL){
    $this->db->where('pelanggan_id', $id);
    $hasil = $this->db->get("tb_pelanggan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_data_by_ktp($id = NULL){
    $this->db->where('pelanggan_ktp', $id);
    $hasil = $this->db->get("tb_pelanggan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function cek_ktp($id = NULL){
    $this->db->where('pelanggan_ktp', $id);
    $hasil = $this->db->get("tb_pelanggan");

    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function delete_data($id = NULL){
    $sql = "DELETE FROM tb_pelanggan WHERE pelanggan_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function count_all(){
    $this->db->select('pelanggan_id');
    $this->db->from('tb_pelanggan');
    return $this->db->count_all_results();
  }

  public function check_transaksi($table = NULL, $column = NULL, $id = NULL){
    $this->db->select($column)
    ->where('booking_id', $id);
    $hasil = $this->db->get($table);
    return ($hasil->num_rows() > 0) ? $hasil->row()->$column : FALSE;
  }

  public function check_wawancara($id = NULL){
    $this->db->select('booking_id')
    ->where('booking_id', $id);
    $hasil = $this->db->get('detil_wawancara');
    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function check_lpa($id = NULL){
    $this->db->select('booking_id')
    ->where('booking_id', $id);
    $hasil = $this->db->get('tb_lpa');
    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }


  public function check_akad($id = NULL){
    $this->db->select('booking_id')
    ->where('booking_id', $id);
    $hasil = $this->db->get('detil_akad');
    return ($hasil->num_rows() > 0) ? TRUE : FALSE;
  }

  public function count_kelengkapan_berkas($id = NULL){
    $this->db->select('booking_id')
    ->from('detil_kelengkapan')
    ->where('booking_id', $id);
    return $this->db->count_all_results();
  }

  public function get_expired_jaminan($id = NULL){
    $this->db->select('jaminan_expired')
    ->where('booking_id', $id);
    $hasil = $this->db->get('tb_jaminan');
    return ($hasil->num_rows() > 0) ? $hasil->row()->jaminan_expired : FALSE;
  }

}
