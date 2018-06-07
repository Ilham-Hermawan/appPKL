<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function check_login($username = NULL, $password = NULL){

		$sql = "SELECT * FROM tb_user WHERE user_username = ? AND user_password = ? AND user_status = ? LIMIT 1";
		$hasil = $this->db->query($sql, array($username, $password, 'y'));

		if($hasil->num_rows() > 0){
			//data ditemukan
			return $hasil->row();
		}
		else{
			//data tidak ditemukan
			return FALSE;
		}
	}

	public function get_user_by_id($id = NULL){
		$sql = "SELECT * FROM tb_user WHERE user_id = ? LIMIT 1";
		$hasil = $this->db->query($sql, array($id));

		if($hasil->num_rows() > 0){
			//data ditemukan
			return $hasil->row();
		}
		else{
			//data tidak ditemukan
			return FALSE;
		}
	}

	public function get_umeta_by_id($id = NULL){
		$sql = "SELECT * FROM log_umeta WHERE user_id = ? ORDER BY umeta_id DESC LIMIT 1,1";
		$hasil = $this->db->query($sql, array($id));

		if($hasil->num_rows() > 0){
			//data ditemukan
			return $hasil->row();
		}
		else{
			//data tidak ditemukan
			return FALSE;
		}
	}

	public function save_log($data = NULL){
		$this->db->insert("log_umeta", $data);
	}

	public function get_last_login(){
		$this->db->join('tb_user', 'log_umeta.user_id = tb_user.user_id')
		->order_by('umeta_id', 'DESC')
		->limit(5);
		$hasil = $this->db->get("log_umeta");

		return ($hasil->num_rows() > 0) ? $hasil : FALSE;
	}

	public function get_user($limit = NULL){
		$this->db->order_by('user_id', 'DESC');
		if($limit != NULL){
			$this->db->limit($limit);
		}
		$hasil = $this->db->get("tb_user");
		return ($hasil->num_rows() > 0) ? $hasil : FALSE;
	}

}
