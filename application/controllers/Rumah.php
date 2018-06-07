<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('rumah_model', 'booking_model'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Perumahan',
      'sub_header_title' => 'Daftar Perumahan'
    );
    $this->backend_render(PATH_BACKEND.'rumah/list', $data);
  }

  public function add_data(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Perumahan',
      'sub_header_title' => 'Tambah Perumahan'
    );
    $this->backend_render(PATH_BACKEND.'rumah/form', $data);
  }

  public function edit_data($id = NULL){
    $data = array(
      'header_title'      => '<i class="fa fa-users"></i> Perumahan',
      'sub_header_title'  => 'Edit Perumahan',
      'set'               => $this->rumah_model->get_data_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'rumah/form', $data);
  }

  public function kavling_data($id = NULL){
    $data = array(
      'header_title'      => '<i class="fa fa-users"></i> Kavling',
      'sub_header_title'  => 'Kavling',
      'set'               => $this->rumah_model->get_data_by_id($id),
      'detil'             => $this->rumah_model->get_detil_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'rumah/kavling', $data);
  }

  public function kavling_save(){
    $id_rumah = $this->input->post('id_rumah', TRUE);
    $id = $this->input->post('id', TRUE);

    $kavling = $this->input->post('blok', TRUE);
    $i = 0;
    foreach ($kavling as $row) {
      $detil = array(
        'rumah_id'     => $id_rumah,
        'kavling_blok' => $this->input->post('blok')[$i],
        'kavling_lb'   => $this->input->post('lb')[$i],
        'kavling_lt'   => $this->input->post('lt')[$i],
        'kavling_tipe' => $this->input->post('lb')[$i],
        'kavling_shm'  => $this->input->post('inputShm')[$i],
        'kavling_shm_no'=> $this->input->post('shmno')[$i],
        'kavling_imb'  => $this->input->post('inputImb')[$i],
        'kavling_imb_no'=> $this->input->post('imbno')[$i],
        'kavling_harga'=> preg_replace('/[^0-9]/', '',$this->input->post('harga')[$i])
      );

      if($id != "0"){
        if(!empty($this->input->post('kavling_id')[$i])){
          $detil['kavling_id'] = $this->input->post('kavling_id')[$i];
        }
      }

      $i++;
      $detil_data[] = $detil;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['kavling_id'])){
        // $this->db->update_batch('rumah_kavling', $detil_data, 'kavling_id');
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
        // $this->db->update_batch('rumah_kavling', $detil_data[$i], 'kavling_id');
      }
      $i++;
    }

    if(!empty($baru)){

      $action = 'add';
      $uraian = 'Menambahkan KAVLING';
      $this->rumah_model->save_log_action($action, $uraian);

      $this->db->insert_batch('rumah_kavling', $baru);
    }
    if(!empty($update)){

      $action = 'edit';
      $uraian = 'Mengubah KAVLING';
      $this->rumah_model->save_log_action($action, $uraian);

      $this->db->update_batch('rumah_kavling', $update, 'kavling_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/rumah/kavling/'.$id_rumah);

  }

  public function kavling_delete($id = NULL, $id_rumah = NULL){
    $result = $this->rumah_model->delete_kavling($id);

    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/rumah/kavling/'.$id_rumah);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/rumah/kavling/'.$id_rumah);
    }
  }

  public function get_list_data(){
    $this->load->library('Datatables');
    $this->datatables->select('rumah_id, rumah_nama, rumah_alamat, rumah_created, rumah_kode');
    $this->datatables->from('tb_rumah');
    echo $this->datatables->generate();
  }

  public function save_data(){
    $id = $this->input->post('id', TRUE);

    $this->form_validation->set_rules('inputNama', 'Nama Perumahan', 'trim|required|xss_clean|max_length[255]');
    $this->form_validation->set_rules('inputAlamat', 'Alamat Perumahan', 'trim|required|xss_clean');
    $this->form_validation->set_rules('inputDesa', 'Desa', 'trim|required|xss_clean');
    $this->form_validation->set_rules('inputKecamatan', 'Kecamatan', 'trim|required|xss_clean');
    $this->form_validation->set_rules('inputKota', 'Kota', 'trim|required|xss_clean');
    $this->form_validation->set_rules('inputProvinsi', 'Provinsi', 'trim|required|xss_clean');
    if($this->form_validation->run() == FALSE){
				//gagal validasi
			$this->add_data();
		}
		else{
      $data = array(
        'rumah_nama'  => $this->input->post('inputNama', TRUE),
        'rumah_alamat'=> $this->input->post('inputAlamat', TRUE),
        'rumah_desa'  => $this->input->post('inputDesa', TRUE),
        'rumah_kecamatan'  => $this->input->post('inputKecamatan', TRUE),
        'rumah_kota'  => $this->input->post('inputKota', TRUE),
        'rumah_provinsi'  => $this->input->post('inputProvinsi', TRUE),
        'rumah_kode'  => $this->input->post('inputKode', TRUE),
        'modal_awal'  => preg_replace('/[^0-9]/', '',$this->input->post('inputModal'))
      );

      if($id === "0"){
        $data['rumah_created'] = date('Y-m-d H:i:s');
      }

    }

    if($id === "0"){
      $this->rumah_model->save($data);
    }
    else{
      $this->rumah_model->update($data, $id);
    }

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/project');

  }

  public function delete_data($id = NULL){

		$result = $this->rumah_model->delete($id);

		if($result){
			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
			redirect('dashboard/rumah/list');
		}
		else{
			$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
			redirect('dashboard/rumah/list');
		}

	}

  public function get_data_json(){
    $id = $this->input->post('id');
    $data = $this->rumah_model->get_alamat($id);
    if(!empty($data)){
      echo json_encode($data);
    }
    else{
      echo json_encode("Data tidak ditemukan");
    }
  }

  public function get_data_kavling_json(){
    $id = $this->input->post('id');
    $data = $this->rumah_model->get_detil_kavling_by_id($id);
    if(!empty($data)){
      echo json_encode($data);
    }
    else{
      echo json_encode("Data tidak ditemukan");
    }
  }

  public function add_ajax_kavling($id = NULL){
    $this->db->order_by("kavling_blok", "ASC");
    $query = $this->db->get_where('rumah_kavling',array('rumah_id'=>$id));
    $data = "<option value=''>Silahkan pilih Kavling</option>";
    foreach ($query->result() as $value):
      $data .= "<option value='".$value->kavling_id."'>".$value->kavling_blok."</option>";
    endforeach;

    echo $data;

  }

  public function get_rumah_json(){
    $keyword = $this->input->post('rumah_nama',TRUE);
		$rumah = $this->rumah_model->get_data_autocomplete($keyword);

		if($rumah){
			foreach ($rumah as $row) {
				$data[] = array(
					'label' => $row->rumah_nama,
					'value'	=> $row->rumah_nama,
          'id'    => $row->rumah_id
				);
			}
		}
		else{
			$data[] = array(
				'label' => 'Data tidak ada',
				'value' => ''
			);
		}

		echo json_encode($data);
  }


}
