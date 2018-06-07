<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    $this->db->order_by('rumah_nama', "asc");
    $query = $this->db->get("tb_rumah");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
  }

  public function save($data = NULL){
    $this->db->insert("tb_rumah", $data);

    $action = 'add';
    $uraian = 'Menambahkan PROJECT dengan NAMA : '.$data['rumah_nama'].' dengan MODAL AWAL : Rp. '.number_format($data['modal_awal']);
    $this->save_log_action($action, $uraian);
  }

  public function update($data = NULL, $id = NULL){
    $this->db->where('rumah_id', $id);
    $this->db->update('tb_rumah', $data);

    $action = 'edit';
    $uraian = 'Mengubah PROJECT dengan NAMA : '.$data['rumah_nama'].' dengan MODAL AWAL : Rp. '.number_format($data['modal_awal']);
    $this->save_log_action($action, $uraian);
  }

  public function get_data_by_id($id = NULL){
    $this->db->where('rumah_id', $id);
    $hasil = $this->db->get("tb_rumah");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_kavling_by_id($id = NULL){
    $this->db->where('kavling_id', $id);
    $hasil = $this->db->get("rumah_kavling");

    return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_detil_by_id($id = NULL){
		$this->db->where('rumah_id', $id)
            ->order_by('kavling_blok', "ASC");
    $query = $this->db->get("rumah_kavling");

    if ($query->num_rows() > 0) {
        foreach ($query->result() as $row) {
            $data[] = $row;
        }
        return $data;
    }
    return false;
	}

  public function delete($id = NULL){
    $sql = "DELETE FROM tb_rumah WHERE rumah_id = ?";
		$hasil = $this->db->query($sql, array($id));

		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;

  }

  public function delete_detil($id = NULL){
    $sql = "DELETE FROM rumah_kavling WHERE rumah_id = ?";
		$hasil = $this->db->query($sql, array($id));

		return ($this->db->affected_rows() == 1) ? TRUE : FALSE;

  }

  public function delete_kavling($id = NULL){
    $kavling = $this->get_detil_kavling_by_id($id);
    $rumah = $this->get_data_by_id($kavling->rumah_id);
    $action = 'delete';
    $uraian = 'Menghapus KAVLING dengan NOMOR KAVLING : '.$kavling->kavling_blok.' di PROJECT : '.$rumah->rumah_nama;
    $this->save_log_action($action, $uraian);

    $this->db->where('rumah_kavling.kavling_id', $id)
         ->delete('rumah_kavling');

    return ($this->db->affected_rows() == 1) ? TRUE : FALSE;
  }

  public function get_alamat($id = NULL){
    $this->db->where('rumah_id', $id);
    $hasil = $this->db->get("tb_rumah");

		return ($hasil->num_rows() > 0) ? $hasil->row() : FALSE;
  }

  public function get_data_autocomplete($keyword = NULL){
		$this->db->order_by('rumah_nama', "asc");
		$this->db->select('rumah_id, rumah_nama');
		if($keyword != NULL){
			$this->db->like('rumah_nama',$keyword);
			$this->db->limit(16);
		}
		$query = $this->db->get('tb_rumah');

		return $query->result();
	}

  public function count_all(){
		$this->db->select('rumah_id');
		$this->db->from('tb_rumah');
		return $this->db->count_all_results();
	}

  public function count_all_kavling(){
		$this->db->select('kavling_id');
		$this->db->from('rumah_kavling');
		return $this->db->count_all_results();
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
