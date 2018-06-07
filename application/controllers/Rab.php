<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rab extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('rab_model'));
  }

  public function index(){
    redirect('/');
  }

  public function rab_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> RAB',
      'sub_header_title' => 'Daftar RAB'
    );
    $this->backend_render(PATH_BACKEND.'rab/list', $data);
  }

  public function rab_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> RAB',
      'sub_header_title' => 'Tambah RAB'
    );
    $this->backend_render(PATH_BACKEND.'rab/form', $data);
  }

  public function rab_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> RAB',
      'sub_header_title' => 'Tambah RAB',
      'set' => $this->rab_model->get_rab_by_id($id)
    );
    $this->backend_render(PATH_BACKEND.'rab/form', $data);
  }

  public function get_list_data(){
    $this->load->library('Datatables');
    $this->datatables->select('rab_id, rab_nama, rab_created');
    $this->datatables->from('tb_rab');
    echo $this->datatables->generate();
  }

  public function rab_save(){
    $id = $this->input->post('id', TRUE);
    $this->form_validation->set_rules('inputNama', 'Nama RAB', 'trim|xss_clean');
    if($this->form_validation->run() == FALSE){
				//gagal validasi
			$this->rab_add();
		}
		else{
      $data = array(
        'rab_nama' => $this->input->post('inputNama', TRUE)
      );
      if($id === "0"){
        $data['rab_created'] = date('Y-m-d H:i:s');
        $this->rab_model->save_rab($data);
      }
      else{
        $this->rab_model->update_rab($data, $id);
      }
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
      redirect('dashboard/owner/rab/list');
    }
  }

  public function rab_delete($id = NULL){
    $result = $this->rab_model->delete_rab($id);

		if($result){
			$this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
			redirect('dashboard/owner/rab/list');
		}
		else{
			$this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
			redirect('dashboard/owner/rab/list');
		}
  }

  public function bpt_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Daftar Biaya Perolehan Tanah'
    );
    $this->backend_render(PATH_BACKEND.'bpt/list', $data);
  }

  public function get_bpt_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bpt_id, rab_nama, bpt_total, bpt_created, bpt_modified')
         ->join('tb_rab', 'rab_bpt.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bpt');
    echo $this->datatables->generate();
  }

  public function bpt_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Tambah Biaya Perolehan Tanah',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bpt/form', $data);
  }

  public function bpt_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Tambah Biaya Perolehan Tanah',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_bpt_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'bpt/form', $data);
  }

  public function bpt_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bpt_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bpt_created'] = date('Y-m-d H:i:s');
      $bpt_id = $this->rab_model->save_bpt($data);
    }
    else{
      $data['bpt_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drb_uraian' => $this->input->post('uraian')[$i],
        'drb_volume' => $this->input->post('volume')[$i],
        'drb_satuan' => $this->input->post('satuan')[$i],
        'drb_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drb_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drb_id')[$i])){
        $detil['bpt_id'] = $id;
        $detil['drb_id'] = $this->input->post('drb_id')[$i];
      }
      else{
        $detil['bpt_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drb_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bpt', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bpt', $update, 'drb_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bpt/list');

  }

  public function bpt_delete($id = NULL){
    $result = $this->rab_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpt/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpt/list');
    }
  }

  public function delete_bpt_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpt/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpt/edit/'.$page);
    }
  }

  public function bppt_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Biaya Persiapan & Pengolahan Tanah'
    );
    $this->backend_render(PATH_BACKEND.'bppt/list', $data);
  }

  public function get_bppt_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bppt_id, rab_nama, bppt_total, bppt_created, bppt_modified')
         ->join('tb_rab', 'rab_bppt.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bppt');
    echo $this->datatables->generate();
  }

  public function bppt_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Tambah Biaya Persiapan & Pengolahan Tanah',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bppt/form', $data);
  }

  public function bppt_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bppt_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bppt_created'] = date('Y-m-d H:i:s');
      $bppt_id = $this->rab_model->save_bppt($data);
    }
    else{
      $data['bppt_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bppt($data, $id);
      $bppt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drbp_uraian' => $this->input->post('uraian')[$i],
        'drbp_volume' => $this->input->post('volume')[$i],
        'drbp_satuan' => $this->input->post('satuan')[$i],
        'drbp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drbp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drbp_id')[$i])){
        $detil['bppt_id'] = $id;
        $detil['drbp_id'] = $this->input->post('drbp_id')[$i];
      }
      else{
        $detil['bppt_id'] = $bppt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drbp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bppt', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bppt', $update, 'drbp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bppt/list');

  }

  public function bppt_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Edit BPPT',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_bppt_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bppt($id)
    );
    $this->backend_render(PATH_BACKEND.'bppt/form', $data);
  }

  public function bppt_delete($id = NULL){
    $result = $this->rab_model->bppt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bppt/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bppt/list');
    }
  }

  public function delete_bppt_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bppt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bppt/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bppt/edit/'.$page);
    }
  }


  public function blp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Legalitas & Perizinan',
      'sub_header_title' => 'Biaya Legalitas & Perizinan'
    );
    $this->backend_render(PATH_BACKEND.'blp/list', $data);
  }

  public function get_blp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('blp_id, rab_nama, blp_total, blp_created, blp_modified')
         ->join('tb_rab', 'rab_blp.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_blp');
    echo $this->datatables->generate();
  }

  public function blp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Legalitas & Perizinan',
      'sub_header_title' => 'Tambah Biaya Legalitas & Perizinan',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'blp/form', $data);
  }

  public function blp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Legalitas & Perizinan',
      'sub_header_title' => 'Edit Biaya Legalitas & Perizinan',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_blp_data_by_id($id),
      'detil' => $this->rab_model->get_detil_blp($id)
    );
    $this->backend_render(PATH_BACKEND.'blp/form', $data);
  }

  public function blp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'blp_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['blp_created'] = date('Y-m-d H:i:s');
      $blp_id = $this->rab_model->save_blp($data);
    }
    else{
      $data['blp_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_blp($data, $id);
      $blp_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drbl_uraian' => $this->input->post('uraian')[$i],
        'drbl_volume' => $this->input->post('volume')[$i],
        'drbl_satuan' => $this->input->post('satuan')[$i],
        'drbl_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drbl_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drbl_id')[$i])){
        $detil['blp_id'] = $id;
        $detil['drbl_id'] = $this->input->post('drbl_id')[$i];
      }
      else{
        $detil['blp_id'] = $blp_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drbl_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_blp', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_blp', $update, 'drbl_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/blp/list');

  }

  public function blp_delete($id = NULL){
    $result = $this->rab_model->blp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/blp/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/blp/list');
    }
  }

  public function delete_blp_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->blp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/blp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/blp/edit/'.$page);
    }
  }


  public function bpsu_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Biaya Prasarana, Sarana & Utilitas'
    );
    $this->backend_render(PATH_BACKEND.'bpsu/list', $data);
  }

  public function get_bpsu_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bpsu_id, rab_nama, bpsu_totalp, bpsu_totals, bpsu_created, bpsu_modified')
         ->join('tb_rab', 'rab_bpsu.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bpsu');
    echo $this->datatables->generate();
  }

  public function bpsu_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Tambah Biaya Prasarana, Sarana & Utilitas',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bpsu/form', $data);
  }

  public function bpsu_save(){
    $id = $this->input->post('id');

    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bpsu_totalp' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlahp')),
      'bpsu_totals' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlahs'))
    );
    if($id === "0"){
      $data['bpsu_created'] = date('Y-m-d H:i:s');
      $bpsuid = $this->rab_model->save_bpsu($data);
    }
    else{
      $data['bpsu_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bpsu($data, $id);
      $bpsuid = $id;
    }

    $prasarana = $this->input->post('uraianp');
    $i = 0;
    foreach ($prasarana as $row) {
      $detilp = array(
        'drbps_uraian' => $this->input->post('uraianp')[$i],
        'drbps_volume' => $this->input->post('volumep')[$i],
        'drbps_satuan' => $this->input->post('satuanp')[$i],
        'drbps_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuanp')[$i]),
        'drbps_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlahp')[$i]),
        'drbps_tipe'   => 'p'
      );

      if(!empty($this->input->post('drbps_id')[$i])){
        $detilp['bpsu_id'] = $id;
        $detilp['drbps_id'] = $this->input->post('drbps_id')[$i];
      }
      else{
        $detilp['bpsu_id'] = $bpsuid;
      }

      $detil_datap[] = $detilp;
      $i++;
    }

    $sarana = $this->input->post('uraians');
    $i = 0;
    foreach ($sarana as $row) {
      $detils = array(
        'drbps_uraian' => $this->input->post('uraians')[$i],
        'drbps_volume' => $this->input->post('volumes')[$i],
        'drbps_satuan' => $this->input->post('satuans')[$i],
        'drbps_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuans')[$i]),
        'drbps_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlahs')[$i]),
        'drbps_tipe'   => 's'
      );

      if(!empty($this->input->post('drbps_ids')[$i])){
        $detils['bpsu_id'] = $id;
        $detils['drbps_id'] = $this->input->post('drbps_ids')[$i];
      }
      else{
        $detils['bpsu_id'] = $bpsuid;
      }

      $detil_datas[] = $detils;
      $i++;
    }

    $i = 0;
    foreach ($detil_datap as $row) {
      if(empty($detil_datap[$i]['drbps_id'])){
        $barup[] = $detil_datap[$i];
      }
      else{
        $updatep[] = $detil_datap[$i];
      }
      $i++;
    }

    $i = 0;
    foreach ($detil_datas as $row) {
      if(empty($detil_datas[$i]['drbps_id'])){
        $barus[] = $detil_datas[$i];
      }
      else{
        $updates[] = $detil_datas[$i];
      }
      $i++;
    }

    if(!empty($barus)){
      $this->db->insert_batch('detil_rab_bpsu', $barus);
    }
    if(!empty($barup)){
      $this->db->insert_batch('detil_rab_bpsu', $barup);
    }
    if(!empty($updates)){
      $this->db->update_batch('detil_rab_bpsu', $updates, 'drbps_id');
    }
    if(!empty($updatep)){
      $this->db->update_batch('detil_rab_bpsu', $updatep, 'drbps_id');
    }

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bpsu/list');
  }

  public function delete_bpsu_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bpsu_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpsu/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpsu/edit/'.$page);
    }
  }

  public function bpsu_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Edit Biaya Prasarana, Sarana & Utilitas',
      'rab'    => $this->rab_model->get_rab_data(),
      'set'    => $this->rab_model->get_bpsu_data_by_id($id),
      'detils' => $this->rab_model->get_detil_bpsu($id, 's'),
      'detilp' => $this->rab_model->get_detil_bpsu($id, 'p'),
    );
    $this->backend_render(PATH_BACKEND.'bpsu/form', $data);
  }

  public function bpsu_delete($id = NULL){
    $result = $this->rab_model->bpsu_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpsu/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpsu/list');
    }
  }

  public function bkr_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Biaya Konstruksi Rumah'
    );
    $this->backend_render(PATH_BACKEND.'bkr/list', $data);
  }

  public function get_bkr_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bkr_id, rab_nama, bkr_total, bkr_created, bkr_modified')
         ->join('tb_rab', 'rab_bkr.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bkr');
    echo $this->datatables->generate();
  }

  public function bkr_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Tambah Biaya Konstruksi Rumah',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bkr/form', $data);
  }

  public function bkr_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bkr_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bkr_created'] = date('Y-m-d H:i:s');
      $bkr_id = $this->rab_model->save_bkr($data);
    }
    else{
      $data['bkr_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bkr($data, $id);
      $bkr_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drbk_uraian' => $this->input->post('uraian')[$i],
        'drbk_volume' => $this->input->post('volume')[$i],
        'drbk_satuan' => $this->input->post('satuan')[$i],
        'drbk_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drbk_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drbk_id')[$i])){
        $detil['bkr_id'] = $id;
        $detil['drbk_id'] = $this->input->post('drbk_id')[$i];
      }
      else{
        $detil['bkr_id'] = $bkr_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drbk_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bkr', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bkr', $update, 'drbk_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bkr/list');

  }

  public function bkr_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Edit Biaya Konstruksi Rumah',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_bkr_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bkr($id)
    );
    $this->backend_render(PATH_BACKEND.'bkr/form', $data);
  }

  public function delete_bkr_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bkr_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bkr/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bkr/edit/'.$page);
    }
  }

  public function bkr_delete($id = NULL){
    $result = $this->rab_model->bkr_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bkr/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bkr/list');
    }
  }

  public function bp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Biaya Pemasaran'
    );
    $this->backend_render(PATH_BACKEND.'bp/list', $data);
  }

  public function get_bp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bp_id, rab_nama, bp_total, bp_created, bp_modified')
         ->join('tb_rab', 'rab_bp.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bp');
    echo $this->datatables->generate();
  }

  public function bp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Tambah Biaya Pemasaran',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bp/form', $data);
  }

  public function bp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bp_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bp_created'] = date('Y-m-d H:i:s');
      $bp_id = $this->rab_model->save_bp($data);
    }
    else{
      $data['bp_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bp($data, $id);
      $bp_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drbp_uraian' => $this->input->post('uraian')[$i],
        'drbp_volume' => $this->input->post('volume')[$i],
        'drbp_satuan' => $this->input->post('satuan')[$i],
        'drbp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drbp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drbp_id')[$i])){
        $detil['bp_id'] = $id;
        $detil['drbp_id'] = $this->input->post('drbp_id')[$i];
      }
      else{
        $detil['bp_id'] = $bp_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drbp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bp', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bp', $update, 'drbp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bp/list');

  }

  public function bp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Edit Biaya Pemasaran',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_bp_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bp($id)
    );
    $this->backend_render(PATH_BACKEND.'bp/form', $data);
  }

  public function delete_bp_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bp/edit/'.$page);
    }
  }

  public function bp_delete($id = NULL){
    $result = $this->rab_model->bp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bp/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bp/list');
    }
  }

  public function bua_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Biaya Umum & Administrasi'
    );
    $this->backend_render(PATH_BACKEND.'bua/list', $data);
  }

  public function get_bua_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bua_id, rab_nama, bua_total, bua_created, bua_modified')
         ->join('tb_rab', 'rab_bua.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bua');
    echo $this->datatables->generate();
  }

  public function bua_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Tambah Biaya Umum & Administrasi',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bua/form', $data);
  }

  public function bua_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bua_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bua_created'] = date('Y-m-d H:i:s');
      $bua_id = $this->rab_model->save_bua($data);
    }
    else{
      $data['bua_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bua($data, $id);
      $bua_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drba_uraian' => $this->input->post('uraian')[$i],
        'drba_volume' => $this->input->post('volume')[$i],
        'drba_satuan' => $this->input->post('satuan')[$i],
        'drba_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drba_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drba_id')[$i])){
        $detil['bua_id'] = $id;
        $detil['drba_id'] = $this->input->post('drba_id')[$i];
      }
      else{
        $detil['bua_id'] = $bua_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drba_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bua', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bua', $update, 'drba_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bua/list');
  }

  public function bua_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Edit Biaya Umum & Administrasi',
      'rab' => $this->rab_model->get_rab_data(),
      'set' => $this->rab_model->get_bua_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bua($id)
    );
    $this->backend_render(PATH_BACKEND.'bua/form', $data);
  }

  public function delete_bua_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bua_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bua/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bua/edit/'.$page);
    }
  }

  public function bua_delete($id = NULL){
    $result = $this->rab_model->bua_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bua/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bua/list');
    }
  }

  public function bpbp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Biaya Pajak & Bunga Pinjaman'
    );
    $this->backend_render(PATH_BACKEND.'bpbp/list', $data);
  }

  public function bpbp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Tambah Biaya Pajak & Bunga Pinjaman',
      'rab' => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'bpbp/form', $data);
  }

  public function get_bpbp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('bpbp_id, rab_nama, bpbp_total, bpbp_created, bpbp_modified')
         ->join('tb_rab', 'rab_bpbp.rab_id = tb_rab.rab_id');
    $this->datatables->from('rab_bpbp');
    echo $this->datatables->generate();
  }

  public function bpbp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rab_id' => $this->input->post('inputRab'),
      'bpbp_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah'))
    );
    if($id === "0"){
      $data['bpbp_created'] = date('Y-m-d H:i:s');
      $bpbp_id = $this->rab_model->save_bpbp($data);
    }
    else{
      $data['bpbp_modified'] = date('Y-m-d H:i:s');
      $this->rab_model->update_bpbp($data, $id);
      $bpbp_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'drbp_uraian' => $this->input->post('uraian')[$i],
        'drbp_volume' => $this->input->post('volume')[$i],
        'drbp_satuan' => $this->input->post('satuan')[$i],
        'drbp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'drbp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('drbp_id')[$i])){
        $detil['bpbp_id'] = $id;
        $detil['drbp_id'] = $this->input->post('drbp_id')[$i];
      }
      else{
        $detil['bpbp_id'] = $bpbp_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['drbp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_rab_bpbp', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_rab_bpbp', $update, 'drbp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/owner/bpbp/list');
  }

  public function bpbp_edit($id = NULL){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Tambah Biaya Pajak & Bunga Pinjaman',
      'rab'   => $this->rab_model->get_rab_data(),
      'set'   => $this->rab_model->get_bpbp_data_by_id($id),
      'detil' => $this->rab_model->get_detil_bpbp($id)
    );
    $this->backend_render(PATH_BACKEND.'bpbp/form', $data);
  }

  public function delete_bpbp_detil($id = NULL, $page = NULL){
    $result = $this->rab_model->bpbp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpbp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpbp/edit/'.$page);
    }
  }

  public function bpbp_delete($id = NULL){
    $result = $this->rab_model->bpbp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/owner/bpbp/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/owner/bpbp/list');
    }
  }


}
