<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save_bpt($data = NULL){
    $this->db->insert("tb_pengeluaran", $data);
    $insert_id = $this->db->insert_id();
    return  $insert_id;
  }

  public function update_bpt($data = NULL, $id = NULL){
    $this->db->where('pengeluaran_id', $id);
    $this->db->update('tb_pengeluaran', $data);
  }

  public function get_bpt_data_by_id($id = NULL){
    $this->db->where('pengeluaran_id', $id)
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id');
    $hasil = $this->db->get("tb_pengeluaran");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_bpt($id = NULL){
    $this->db->where('pengeluaran_id', $id);
    $hasil = $this->db->get("detil_pengeluaran");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function get_detil_bpsu($id = NULL, $tipe = NULL){
    $this->db->where('pengeluaran_id', $id)
         ->where('dp_tipe', $tipe);
    $hasil = $this->db->get("detil_pengeluaran");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function bpt_delete($id = NULL){
    $this->db->where('pengeluaran_id', $id)
         ->delete('tb_pengeluaran');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function bpt_delete_detil($id = NULL){
    $this->db->where('dp_id', $id)
         ->delete('detil_pengeluaran');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function count_modal($id = NULL){
    $this->db->where('rumah_id', $id);
    $hasil = $this->db->get("tb_rumah");
    return ($hasil->num_rows() > 0) ? $hasil->row()->modal_awal : 0;
  }

  function count_pemasukkan($id = NULL){
    $this->db->select_sum('penerimaan_total', 'penerimaan_total')
         ->join('tb_booking', 'tb_penerimaan.booking_id = tb_booking.booking_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->where('tb_rumah.rumah_id', $id);
    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;

  }

  function count_total_hpp($id_rumah = NULL){
    $this->db->select_sum('pengeluaran_total', 'pengeluaran_total')
         ->where('rumah_id', $id_rumah)
         ->where('tb_pengeluaran.pj_id IN ("1", "2", "3", "4", "5")');
    $hasil = $this->db->get("tb_pengeluaran");
    return ($hasil->num_rows() > 0) ? $hasil->row()->pengeluaran_total : 0;
  }

  function count_total_biaya_umum($id_rumah = NULL){
    $this->db->select_sum('pengeluaran_total', 'pengeluaran_total')
         ->where('rumah_id', $id_rumah)
         ->where('tb_pengeluaran.pj_id IN ("6", "7", "8")')
         ->where('pj_id != ""');
    $hasil = $this->db->get("tb_pengeluaran");
    return ($hasil->num_rows() > 0) ? $hasil->row()->pengeluaran_total : 0;
  }

  function save_pengeluaran_kategori($data){
    $this->db->insert("pengeluaran_kategori", $data);
  }

  function update_pengeluaran_kategori($data, $id){
    $this->db->where('pp_id', $id);
    $this->db->update('pengeluaran_kategori', $data);
  }

  function get_kategori_pengeluaran_by_id($id = NULL){
    $this->db->where('pp_id', $id);
    $hasil = $this->db->get("pengeluaran_kategori");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_kategori_pengeluaran($id = NULL, $id_rumah = NULL){
    $this->db->select('pengeluaran_kategori.pp_id, pengeluaran_nama, (SELECT SUM(pengeluaran_total) FROM	tb_pengeluaran WHERE pengeluaran_kategori.pp_id = tb_pengeluaran.pp_id AND rumah_id = '.$id_rumah.') AS sub_total')
         ->order_by('pengeluaran_nama', 'ASC')
         ->where('pp_kategori', $id);
    $hasil = $this->db->get("pengeluaran_kategori");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function delete_pengeluaran_kategori($id = NULL){
    $this->db->where('pp_id', $id)
         ->delete('pengeluaran_kategori');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function delete_pengeluaran_history($id = NULL){

    $penerimaan_no = $this->get_bayar_pengeluaran($id)->pengeluaran_no;
    $kategori = $this->get_kategori_pengeluaran_by_id($this->get_bayar_pengeluaran($id)->pp_id)->pengeluaran_nama;
    $total = $this->get_bayar_pengeluaran($id)->pengeluaran_total;
    $tanggal = $this->get_bayar_pengeluaran($id)->pengeluaran_tanggal;
    $action = 'delete';
    $uraian = 'Menghapus PENGELUARAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan TOTAL PEMBAYARAN : Rp. '.number_format($total). ' pada TANGGAL : '.date('d/m/Y', strtotime($tanggal));
    $this->save_log_action($action, $uraian);

    $this->db->where('pengeluaran_id', $id)
         ->delete('tb_pengeluaran');
    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  function save_pengeluaran($data){
    $this->db->insert("tb_pengeluaran", $data);
    $insert_id = $this->db->insert_id();

    $penerimaan_no = (!empty($data['pengeluaran_no'])) ? $data['pengeluaran_no'] : '-';
    $kategori = $this->get_kategori_pengeluaran_by_id($data['pp_id'])->pengeluaran_nama;
    $total = $data['pengeluaran_total'];
    $tanggal = $data['pengeluaran_tanggal'];
    $action = 'add';
    $uraian = 'Menambah PENGELUARAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan TOTAL PEMBAYARAN : Rp. '.number_format($total). ' pada TANGGAL : '.date('d/m/Y', strtotime($tanggal));
    $this->save_log_action($action, $uraian);

    return  $insert_id;
  }

  function update_pengeluaran($data = NULL, $id = NULL){
    $this->db->where('pengeluaran_id', $id);
    $this->db->update('tb_pengeluaran', $data);

    $penerimaan_no = (!empty($data['pengeluaran_no'])) ? $data['pengeluaran_no'] : '-';
    $kategori = $this->get_kategori_pengeluaran_by_id($data['pp_id'])->pengeluaran_nama;
    $total = $data['pengeluaran_total'];
    $tanggal = $data['pengeluaran_tanggal'];
    $action = 'edit';
    $uraian = 'Mengubah PENGELUARAN dengan NOMOR KWITANSI : '.$penerimaan_no.' untuk KATEGORI : '.$kategori.' dengan TOTAL PEMBAYARAN : Rp. '.number_format($total). ' pada TANGGAL : '.date('d/m/Y', strtotime($tanggal));
    $this->save_log_action($action, $uraian);

  }

  function get_bayar_pengeluaran($id = NULL){
    $this->db->where('pengeluaran_id', $id)
         ->join('pengeluaran_kategori', 'tb_pengeluaran.pp_id = pengeluaran_kategori.pp_id')
         ->join('pengeluaran_jenis', 'tb_pengeluaran.pj_id = pengeluaran_jenis.pj_id');
    $hasil = $this->db->get("tb_pengeluaran");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_jenis_pengeluaran(){
    $this->db->order_by('pj_id', 'ASC');
    $hasil = $this->db->get("pengeluaran_jenis");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_jenis_pengeluaran_by_id($id = NULL){
    $this->db->where('pj_id', $id);
    $hasil = $this->db->get("pengeluaran_jenis");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function get_max_id_pengeluaran($id_kategori = NULL){
    $this->db->select_max('pengeluaran_no')
         ->where('pj_id', $id_kategori);
    $hasil = $this->db->get('tb_pengeluaran');

    return ($hasil->num_rows() > 0) ? $hasil->row()->pengeluaran_no : 0;
  }

  function total_batal($id_rumah = NULL){
    $this->db->select_sum('batal_potongan', 'batal_potongan')
         ->where('rumah_id', $id_rumah);
    $hasil = $this->db->get("tb_batal");
    return ($hasil->num_rows() > 0) ? $hasil->row()->batal_potongan : 0;

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
