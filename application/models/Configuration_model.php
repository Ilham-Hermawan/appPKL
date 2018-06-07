<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration_model extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function get_config($config_key = NULL){
		$hasil = $this->db->where('config_key', $config_key)
		->limit(1)
		->get("app_config");

		return ($hasil->num_rows() > 0) ? $hasil->row()->config_value : FALSE;

	}

	public function save_config($data = NULL){
		foreach ($data as $key => $item)
		{
			$this->db->set('config_value', $item);
			$this->db->where('config_key', $key);
			$this->db->update('app_config');
		}
		return ($this->db->affected_rows() > 0);
	}


}
