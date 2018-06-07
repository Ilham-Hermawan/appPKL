<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rab_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save_rab($data = NULL){
    $this->db->insert("tb_rab", $data);
  }

  public function update_rab($data = NULL, $id = NULL){
    $this->db->where('rab_id', $id);
    $this->db->update('tb_rab', $data);
  }

  public function get_rab_data(){
    $this->db->order_by('rab_nama', "ASC");
    $hasil = $this->db->get("tb_rab");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function get_rab_by_id($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("tb_rab");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function delete_rab($id = NULL){
    $sql = "DELETE FROM tb_rab WHERE rab_id = ?";
		$hasil = $this->db->query($sql, array($id));

		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;

  }

  public function save_bpt($data = NULL){
    $this->db->insert("rab_bpt", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bpt($data = NULL, $id = NULL){
    $this->db->where('bpt_id', $id);
    $this->db->update('rab_bpt', $data);
  }

  public function get_bpt_data_by_id($id = NULL){
    $this->db->where('bpt_id', $id);
    $hasil = $this->db->get("rab_bpt");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bpt_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bpt");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bpt($id = NULL){
    $this->db->where('bpt_id', $id);
    $hasil = $this->db->get("detil_rab_bpt");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bpt_delete($id = NULL){
    $this->db->where('bpt_id', $id)
         ->delete('rab_bpt');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bpt_delete_detil($id = NULL){
    $this->db->where('drb_id', $id)
         ->delete('detil_rab_bpt');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bppt($data = NULL){
    $this->db->insert("rab_bppt", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bppt($data = NULL, $id = NULL){
    $this->db->where('bppt_id', $id);
    $this->db->update('rab_bppt', $data);
  }

  public function get_bppt_data_by_id($id = NULL){
    $this->db->where('bppt_id', $id);
    $hasil = $this->db->get("rab_bppt");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bppt_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bppt");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bppt($id = NULL){
    $this->db->where('bppt_id', $id);
    $hasil = $this->db->get("detil_rab_bppt");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bppt_delete($id = NULL){
    $this->db->where('bppt_id', $id)
         ->delete('rab_bppt');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bppt_delete_detil($id = NULL){
    $this->db->where('drbp_id', $id)
         ->delete('detil_rab_bppt');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_blp($data = NULL){
    $this->db->insert("rab_blp", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_blp($data = NULL, $id = NULL){
    $this->db->where('blp_id', $id);
    $this->db->update('rab_blp', $data);
  }

  public function get_blp_data_by_id($id = NULL){
    $this->db->where('blp_id', $id);
    $hasil = $this->db->get("rab_blp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_blp_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_blp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_blp($id = NULL){
    $this->db->where('blp_id', $id);
    $hasil = $this->db->get("detil_rab_blp");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function blp_delete($id = NULL){
    $this->db->where('blp_id', $id)
         ->delete('rab_blp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function blp_delete_detil($id = NULL){
    $this->db->where('drbl_id', $id)
         ->delete('detil_rab_blp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bpsu($data = NULL){
    $this->db->insert("rab_bpsu", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bpsu($data = NULL, $id = NULL){
    $this->db->where('bpsu_id', $id);
    $this->db->update('rab_bpsu', $data);
  }

  public function get_bpsu_data_by_id($id = NULL){
    $this->db->where('bpsu_id', $id);
    $hasil = $this->db->get("rab_bpsu");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bpsu_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bpsu");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bpsu($id = NULL, $tipe = "p"){
    $this->db->where('bpsu_id', $id)
             ->where('drbps_tipe', $tipe);
    $hasil = $this->db->get("detil_rab_bpsu");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bpsu_delete($id = NULL){
    $this->db->where('bpsu_id', $id)
         ->delete('rab_bpsu');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bpsu_delete_detil($id = NULL){
    $this->db->where('drbps_id', $id)
         ->delete('detil_rab_bpsu');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bkr($data = NULL){
    $this->db->insert("rab_bkr", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bkr($data = NULL, $id = NULL){
    $this->db->where('bkr_id', $id);
    $this->db->update('rab_bkr', $data);
  }

  public function get_bkr_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bkr");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bkr_data_by_id($id = NULL){
    $this->db->where('bkr_id', $id);
    $hasil = $this->db->get("rab_bkr");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bkr($id = NULL){
    $this->db->where('bkr_id', $id);
    $hasil = $this->db->get("detil_rab_bkr");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bkr_delete($id = NULL){
    $this->db->where('bkr_id', $id)
         ->delete('rab_bkr');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bkr_delete_detil($id = NULL){
    $this->db->where('drbk_id', $id)
         ->delete('detil_rab_bkr');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bp($data = NULL){
    $this->db->insert("rab_bp", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bp($data = NULL, $id = NULL){
    $this->db->where('bp_id', $id);
    $this->db->update('rab_bp', $data);
  }

  public function get_bp_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bp_data_by_id($id = NULL){
    $this->db->where('bp_id', $id);
    $hasil = $this->db->get("rab_bp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bp($id = NULL){
    $this->db->where('bp_id', $id);
    $hasil = $this->db->get("detil_rab_bp");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bp_delete($id = NULL){
    $this->db->where('bp_id', $id)
         ->delete('rab_bp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bp_delete_detil($id = NULL){
    $this->db->where('drbp_id', $id)
         ->delete('detil_rab_bp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bua($data = NULL){
    $this->db->insert("rab_bua", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bua($data = NULL, $id = NULL){
    $this->db->where('bua_id', $id);
    $this->db->update('rab_bua', $data);
  }

  public function get_bua_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bua");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bua_data_by_id($id = NULL){
    $this->db->where('bua_id', $id);
    $hasil = $this->db->get("rab_bua");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bua($id = NULL){
    $this->db->where('bua_id', $id);
    $hasil = $this->db->get("detil_rab_bua");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bua_delete($id = NULL){
    $this->db->where('bua_id', $id)
         ->delete('rab_bua');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bua_delete_detil($id = NULL){
    $this->db->where('drba_id', $id)
         ->delete('detil_rab_bua');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function save_bpbp($data = NULL){
    $this->db->insert("rab_bpbp", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bpbp($data = NULL, $id = NULL){
    $this->db->where('bpbp_id', $id);
    $this->db->update('rab_bpbp', $data);
  }

  public function get_bpbp_data_by_rab($id = NULL){
    $this->db->where('rab_id', $id);
    $hasil = $this->db->get("rab_bpbp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_bpbp_data_by_id($id = NULL){
    $this->db->where('bpbp_id', $id);
    $hasil = $this->db->get("rab_bpbp");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bpbp($id = NULL){
    $this->db->where('bpbp_id', $id);
    $hasil = $this->db->get("detil_rab_bpbp");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bpbp_delete($id = NULL){
    $this->db->where('bpbp_id', $id)
         ->delete('rab_bpbp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bpbp_delete_detil($id = NULL){
    $this->db->where('drbp_id', $id)
         ->delete('detil_rab_bpbp');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

}
