<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function get_laporan_pencairan($id_rumah = NULL){
    $this->db->select('
            tb_booking.booking_id,
            tb_booking.booking_no,
            rumah_kavling.kavling_blok,
            rumah_kavling.kavling_harga,
            tb_pelanggan.pelanggan_nama,
            tb_pelanggan.pelanggan_id
    ')
         ->where('tb_booking.rumah_id', $id_rumah)
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->order_by('rumah_kavling.kavling_blok', 'ASC');
    $hasil = $this->db->get("tb_booking");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  function get_detil_penerimaan($id_booking = NULL, $id_pelanggan = NULL, $uraian = 'Tanda Jadi', $return = '->row()'){
    $this->db->select('
            tb_penerimaan.penerimaan_no,
            tb_penerimaan.booking_id,
            tb_penerimaan.penerimaan_dari,
            tb_penerimaan.penerimaan_total,
            tb_penerimaan.penerimaan_tanggal,
            tb_penerimaan.penerimaan_uraian,
            penerimaan_kategori.pkategori_nama,
            penerimaan_kategori.pkategori_id
    ')
         ->where('tb_penerimaan.booking_id', $id_booking)
         ->where('tb_booking.pelanggan_id', $id_pelanggan)
         ->where('tb_penerimaan.penerimaan_uraian', $uraian)
         ->join('penerimaan_kategori', 'tb_penerimaan.pkategori_id = penerimaan_kategori.pkategori_id')
         ->join('tb_booking', 'tb_penerimaan.booking_id = tb_booking.booking_id');

    $hasil = $this->db->get("tb_penerimaan");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  function count_total_penerimaan($id_booking = NULL){
    $this->db->select_sum('tb_penerimaan.penerimaan_total', 'penerimaan_total')
         ->where('tb_penerimaan.booking_id', $id_booking)
         ->join('penerimaan_kategori', 'tb_penerimaan.pkategori_id = penerimaan_kategori.pkategori_id')
         ->join('tb_booking', 'tb_penerimaan.booking_id = tb_booking.booking_id');

    $hasil = $this->db->get("tb_penerimaan");
    return ($hasil->num_rows() > 0) ? $hasil->row()->penerimaan_total : 0;
  }

  function get_laporan_progress_booking($rumah_id = NULL){
    $this->db->select('
          tb_booking.booking_no,
          tb_booking.booking_id,
          tb_booking.pelanggan_id,
          tb_pelanggan.pelanggan_nama,
          rumah_kavling.kavling_blok
    ')
         ->where('tb_booking.rumah_id', $rumah_id)
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
         ->order_by('rumah_kavling.kavling_blok', 'ASC');
    $hasil = $this->db->get("tb_booking");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

}
