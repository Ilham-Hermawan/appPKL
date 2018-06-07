<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function save($data = NULL){
    $this->db->insert("tb_booking", $data);
    $lastid = $this->db->insert_id();
    return $lastid;
  }

  function get_booking_data($id = NULL){
    $this->db->where('booking_id', $id);
    $hasil = $this->db->get("tb_booking");
    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_data_by_id($id = NULL){
    $this->db->where('tb_booking.booking_id', $id)
    ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp', 'left')
    ->join('detil_kelengkapan', 'tb_booking.booking_id = detil_kelengkapan.booking_id', 'left')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id', 'left')
    ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id', 'left');
    $query = $this->db->get("tb_booking");

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function get_data($dt1 = "all", $dt2 = "all", $perumahan = "all"){
    $this->db->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
    ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
    ->group_by('tb_booking.booking_no');
    if($dt1 != "all" AND $dt2 != "all"){
      $this->db->where('booking_date BETWEEN "'. date('Y-m-d', strtotime($dt1)). '" AND "'. date('Y-m-d', strtotime($dt2)).'"');
      // $this->db->where('DATE(booking_date) >=', $dt1);
      // $this->db->where('DATE(booking_date) <=', $dt2);
    }
    if($perumahan != "all"){
      $this->db->where('tb_booking.rumah_id', $perumahan);
    }
    $hasil = $this->db->get("tb_booking");

    return ($hasil->num_rows() > 0) ? $hasil->result() : FALSE;
  }

  public function delete_booking($id = NULL){
    $sql = "DELETE FROM tb_booking WHERE booking_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function delete_kelengkapan_by_pelanggan($id = NULL){
    $sql = "DELETE FROM detil_kelengkapan WHERE pelanggan_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function delete_booking_by_pelanggan($id = NULL){
    $sql = "DELETE FROM tb_booking WHERE pelanggan_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function delete_detil($id = NULL, $pelanggan = NULL){
    $sql = "DELETE FROM detil_kelengkapan WHERE booking_id = ? AND pelanggan_id = ?";
    $hasil = $this->db->query($sql, array($id, $pelanggan));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function change_status_booking($data = NULL, $id = NULL){
    $this->db->where('booking_id', $id);
    $this->db->update('tb_booking', $data);
  }

  public function delete_by_kavling($id = NULL){
    $sql = "DELETE FROM tb_booking WHERE kavling_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function delete_kelengkapan_by_booking($id = NULL){
    $sql = "DELETE FROM tb_booking WHERE booking_id = ?";
    $hasil = $this->db->query($sql, array($id));

    if($this->db->affected_rows() == 1){
      return TRUE;
    }
    return FALSE;
  }

  public function get_kelengkapan_by_kavling($id = NULL){
    $this->db->select('booking_id');
    $this->db->where('kavling_id', $id);
    $query = $this->db->get("tb_booking");

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row) {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }

  public function get_max_id_booking($id_rumah = NULL){
    $this->db->select('booking_no')
    ->order_by('booking_id', 'DESC')
    ->limit(1)
    ->where('rumah_id', $id_rumah);
    $hasil = $this->db->get('tb_booking');

    return ($hasil->num_rows() > 0) ? $hasil->row()->booking_no : 0;
  }

  public function get_data_autocomplete($keyword = NULL){
    $this->db->select('booking_id, booking_no, rumah_nama, pelanggan_nama, kavling_blok')
    ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
    ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
    ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
    ->order_by('booking_no', "asc");
    if($keyword != NULL){
     $this->db->like('booking_no',$keyword);
     $this->db->limit(16);
   }
   $query = $this->db->get('tb_booking');

   return $query->result();
 }

 public function count_all($month = NULL){
  $year = date('Y');
  $this->db->select('booking_id')
  ->where('MONTH(booking_date)', $month)
  ->where('YEAR(booking_date)', $year);
  $this->db->from('tb_booking');
  return $this->db->count_all_results();
}

public function get_total_dp($month = NULL){
  $this->db->select_sum('booking_dp', 'booking_dp')
  ->where('MONTH(booking_datetime)', $month);
  $query = $this->db->get('tb_booking');
  return !empty($query->row()->booking_dp) ? $query->row()->booking_dp : 0;
}

public function get_booking_by_pelanggan($id = NULL){
  $this->db->where('pelanggan_id', $id);
  $hasil = $this->db->get("tb_booking");
  return ($hasil->num_rows() > 0) ? $hasil : FALSE;
}

public function get_data_booking($id = NULL){
  $this->db->where('booking_id', $id)
  ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id');
  $hasil = $this->db->get("tb_booking");
  return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
}

}
