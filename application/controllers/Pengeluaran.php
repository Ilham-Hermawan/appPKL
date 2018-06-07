<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('configuration_model', 'pengeluaran_model', 'rumah_model', 'rab_model'));
  }

  public function index(){
    redirect('/');
  }

  public function bpt_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Daftar Biaya Perolehan Tanah'
    );
    $this->backend_render(PATH_BACKEND.'pbpt/list', $data);
  }

  public function get_pbpt_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bpt');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bpt_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Tambah Biaya Perolehan Tanah',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbpt/form', $data);
  }

  public function bpt_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bpt',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bpt/list');
  }

  public function bpt_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Perolehan Tanah',
      'sub_header_title' => 'Edit Biaya Perolehan Tanah',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbpt/form', $data);
  }

  public function bpt_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpt/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpt/list/');
    }
  }

  public function delete_bpt_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpt/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpt/edit/'.$page);
    }
  }

  public function bpt_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Perolehan Tanah',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bppt_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Daftar Biaya Persiapan & Pengolahan Tanah'
    );
    $this->backend_render(PATH_BACKEND.'pbppt/list', $data);
  }

  public function get_pbppt_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bppt');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bppt_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Tambah Biaya Persiapan & Pengolahan Tanah',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbppt/form', $data);
  }

  public function bppt_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bppt',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bppt/list');
  }

  public function bppt_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Persiapan & Pengolahan Tanah',
      'sub_header_title' => 'Edit Biaya Persiapan & Pengolahan Tanah',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbppt/form', $data);
  }

  public function bppt_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bppt/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bppt/list/');
    }
  }

  public function delete_bppt_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bppt/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bppt/edit/'.$page);
    }
  }

  public function bppt_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Persiapan & Pengolahan Tanah',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function blp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Legalitas & Perizinan',
      'sub_header_title' => 'Daftar Legalitas & Perizinan'
    );
    $this->backend_render(PATH_BACKEND.'pblp/list', $data);
  }

  public function get_pblp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'blp');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function blp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Legalitas & Perizinan',
      'sub_header_title' => 'Tambah Legalitas & Perizinan',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pblp/form', $data);
  }

  public function blp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Legalitas & Perizinan',
      'sub_header_title' => 'Edit Legalitas & Perizinan',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pblp/form', $data);
  }

  public function blp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'blp',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/blp/list');
  }

  public function blp_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Persiapan & Pengolahan Tanah',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function blp_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/blp/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/blp/list/');
    }
  }

  public function delete_blp_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/blp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/blp/edit/'.$page);
    }
  }

  public function bpsu_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Daftar Prasarana, Sarana & Utilitas'
    );
    $this->backend_render(PATH_BACKEND.'pbpsu/list', $data);
  }

  public function get_pbpsu_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_total2, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bpsu');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bpsu_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Tambah Prasarana, Sarana & Utilitas',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbpsu/form', $data);
  }

  public function bpsu_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Prasarana, Sarana & Utilitas',
      'sub_header_title' => 'Edit Prasarana, Sarana & Utilitas',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data(),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detilp' => $this->pengeluaran_model->get_detil_bpsu($id, 'p'),
      'detils' => $this->pengeluaran_model->get_detil_bpsu($id, 's')
    );
    $this->backend_render(PATH_BACKEND.'pbpsu/form', $data);
  }

  public function bpsu_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlahp')),
      'pengeluaran_total2' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlahs')),
      'pengeluaran_tipe'  => 'bpsu',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraianp');
    $i = 0;
    foreach ($uraian as $row) {
      $detilp = array(
        'dp_uraian' => $this->input->post('uraianp')[$i],
        'dp_volume' => $this->input->post('volumep')[$i],
        'dp_satuan' => $this->input->post('satuanp')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuanp')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlahp')[$i]),
        'dp_tipe' => 'p'
      );

      if(!empty($this->input->post('dp_idp')[$i])){
        $detilp['pengeluaran_id'] = $id;
        $detilp['dp_id'] = $this->input->post('dp_idp')[$i];
      }
      else{
        $detilp['pengeluaran_id'] = $bpt_id;
      }

      $detil_datap[] = $detilp;
      $i++;
    }

    $uraian = $this->input->post('uraians');
    $i = 0;
    foreach ($uraian as $row) {
      $detils = array(
        'dp_uraian' => $this->input->post('uraians')[$i],
        'dp_volume' => $this->input->post('volumes')[$i],
        'dp_satuan' => $this->input->post('satuans')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuans')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlahs')[$i]),
        'dp_tipe' => 's'
      );

      if(!empty($this->input->post('dp_ids')[$i])){
        $detils['pengeluaran_id'] = $id;
        $detils['dp_id'] = $this->input->post('dp_ids')[$i];
      }
      else{
        $detils['pengeluaran_id'] = $bpt_id;
      }

      $detil_datas[] = $detils;
      $i++;
    }

    $i = 0;
    foreach ($detil_datap as $row) {
      if(empty($detil_datap[$i]['dp_id'])){
        $barup[] = $detil_datap[$i];
      }
      else{
        $updatep[] = $detil_datap[$i];
      }
      $i++;
    }

    $i = 0;
    foreach ($detil_datas as $row) {
      if(empty($detil_datas[$i]['dp_id'])){
        $barus[] = $detil_datas[$i];
      }
      else{
        $updates[] = $detil_datas[$i];
      }
      $i++;
    }

    if(!empty($barup)){
      $this->db->insert_batch('detil_pengeluaran', $barup);
    }
    if(!empty($updatep)){
      $this->db->update_batch('detil_pengeluaran', $updatep, 'dp_id');
    }
    if(!empty($barus)){
      $this->db->insert_batch('detil_pengeluaran', $barus);
    }
    if(!empty($updates)){
      $this->db->update_batch('detil_pengeluaran', $updates, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bpsu/list');
  }

  public function bpsu_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpsu/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpsu/list/');
    }
  }

  public function delete_bpsu_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpsu/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpsu/edit/'.$page);
    }
  }

  public function bpsu_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Prasarana, Sarana & Utilitas',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detilp' => $this->pengeluaran_model->get_detil_bpsu($id, 'p'),
      'detils' => $this->pengeluaran_model->get_detil_bpsu($id, 's')
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpsu', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bkr_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Daftar Biaya Konstruksi Rumah'
    );
    $this->backend_render(PATH_BACKEND.'pbkr/list', $data);
  }

  public function get_pbkr_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bkr');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bkr_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Tambah Biaya Konstruksi Rumah',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbkr/form', $data);
  }

  public function bkr_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bkr',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bkr/list');
  }

  public function bkr_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Konstruksi Rumah',
      'sub_header_title' => 'Edit Biaya Konstruksi Rumah',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbkr/form', $data);
  }

  public function bkr_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Konstruksi Rumah',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bkr_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bkr/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bkr/list/');
    }
  }

  public function delete_bkr_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bkr/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bkr/edit/'.$page);
    }
  }

  public function bp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Daftar Biaya Pemasaran'
    );
    $this->backend_render(PATH_BACKEND.'pbp/list', $data);
  }

  public function get_pbp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bp');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Tambah Biaya Pemasaran',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbp/form', $data);
  }

  public function bp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pemasaran',
      'sub_header_title' => 'Edit Biaya Pemasaran',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbp/form', $data);
  }

  public function bp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bp',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bp/list');
  }

  public function bp_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Pemasaran',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bp_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bp/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bp/list/');
    }
  }

  public function delete_bp_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bp/edit/'.$page);
    }
  }

  public function bua_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Daftar Biaya Umum & Administrasi'
    );
    $this->backend_render(PATH_BACKEND.'pbua/list', $data);
  }

  public function get_pbua_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bua');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bua_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Tambah Biaya Umum & Administrasi',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbua/form', $data);
  }

  public function bua_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum & Administrasi',
      'sub_header_title' => 'Edit Biaya Umum & Administrasi',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbua/form', $data);
  }

  public function bua_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bua',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bua/list');
  }

  public function bua_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Umum & Administrasi',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bua_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bua/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bua/list/');
    }
  }

  public function delete_bua_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bua/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bua/edit/'.$page);
    }
  }

  public function bpbp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Daftar Biaya Pajak & Bunga Pinjaman'
    );
    $this->backend_render(PATH_BACKEND.'pbpbp/list', $data);
  }

  public function get_pbpbp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, rumah_nama, pengeluaran_total, pengeluaran_created, pengeluaran_modified')
         ->join('tb_rumah', 'tb_pengeluaran.rumah_id = tb_rumah.rumah_id')
         ->where('pengeluaran_tipe', 'bpbp');
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  public function bpbp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Tambah Biaya Pajak & Bunga Pinjaman',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pbpbp/form', $data);
  }

  public function bpbp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Pajak & Bunga Pinjaman',
      'sub_header_title' => 'Edit Biaya Pajak & Bunga Pinjaman',
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'rumah' => $this->rumah_model->get_data(),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id)
    );
    $this->backend_render(PATH_BACKEND.'pbpbp/form', $data);
  }

  public function bpbp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'pengeluaran_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'pengeluaran_tipe'  => 'bpbp',
      'pengeluaran_kepada'=> $this->input->post('inputKepada')
    );
    if($id === "0"){
      $data['pengeluaran_created'] = date('Y-m-d H:i:s');
      $data['pengeluaran_no'] = $this->input->post('inputId');
      $bpt_id = $this->pengeluaran_model->save_bpt($data);

    }
    else{
      $data['pengeluaran_modified'] = date('Y-m-d H:i:s');
      $this->pengeluaran_model->update_bpt($data, $id);
      $bpt_id = $id;
    }

    $uraian = $this->input->post('uraian');
    $i = 0;
    foreach ($uraian as $row) {
      $detil = array(
        'dp_uraian' => $this->input->post('uraian')[$i],
        'dp_volume' => $this->input->post('volume')[$i],
        'dp_satuan' => $this->input->post('satuan')[$i],
        'dp_harga_satuan' => preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')[$i]),
        'dp_sub_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('sub_jumlah')[$i])
      );

      if(!empty($this->input->post('dp_id')[$i])){
        $detil['pengeluaran_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['pengeluaran_id'] = $bpt_id;
      }

      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dp_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      $this->db->insert_batch('detil_pengeluaran', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_pengeluaran', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/pengeluaran/bpbp/list');
  }

  public function bpbp_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => 'Biaya Pajak & Bunga Pinjaman',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->pengeluaran_model->get_bpt_data_by_id($id),
      'detil' => $this->pengeluaran_model->get_detil_bpt($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran_bpt', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
  }

  public function bpbp_delete($id = NULL){
    $result = $this->pengeluaran_model->bpt_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpbp/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpbp/list/');
    }
  }

  public function delete_bpbp_detil($id = NULL, $page = NULL){
    $result = $this->pengeluaran_model->bpt_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpbp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/pengeluaran/bpbp/edit/'.$page);
    }
  }



//------------------------------

  public function cetak_kwitansi(){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d'))
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_pengeluaran.pdf',array('Attachment'=>0));
    // $this->load->view(PATH_BACKEND.'laporan/ppjb');
  }

  public function hari_terbilang($x){
    $dayList = array(
      'Sun' => 'Minggu',
      'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu'
    );
    return $dayList[$x];
  }

  function get_no_kwitansi(){
    return "TK".time();
  }

  function list_pengeluaran($id = NULL){
    $this->load->model('project_model');
    $nama_perumahan = $this->project_model->get_project_by_id($id)->rumah_nama;
    $data = array(
      'header_title'      => '<i class="fa fa-money"></i> Pengeluaran',
      'sub_header_title'  => 'PENGELUARAN',
      'pengeluaran_jenis' => $this->pengeluaran_model->get_jenis_pengeluaran(),
      'nama'              => $nama_perumahan
    );
    $this->backend_render(PATH_BACKEND.'pengeluaran/list', $data);
  }

  function list2_pengeluaran($id = NULL, $id_kategori = NULL){
    $this->load->model('project_model');
    $data = array(
      'header_title'      => '<i class="fa fa-money"></i> Pengeluaran',
      'sub_header_title'  => 'Pengeluaran',
      'nama'              => $this->pengeluaran_model->get_jenis_pengeluaran_by_id($id_kategori)->pj_nama,
      'detil'             => $this->pengeluaran_model->get_kategori_pengeluaran($id_kategori, $id)
    );
    $this->backend_render(PATH_BACKEND.'pengeluaran/list2', $data);
  }

  function get_mpp($id = NULL){
    $total_batal = !empty($this->pengeluaran_model->total_batal($id)) ? $this->pengeluaran_model->total_batal($id) : '0';
    $data = array(
      'modal' => $this->pengeluaran_model->count_modal($id),
      'penerimaan_penjualan' => intval($this->pengeluaran_model->count_pemasukkan($id)) - intval($total_batal),
      'hpp' => $this->pengeluaran_model->count_total_hpp($id),
      'biaya_umum' => !empty($this->pengeluaran_model->count_total_biaya_umum($id)) ? $this->pengeluaran_model->count_total_biaya_umum($id) : 0
    );

    echo json_encode($data);
  }

  function bayar_pengeluaran($id = NULL, $id_penerimaan = NULL, $id_pengeluaran = NULL){
    $this->load->model('project_model');
    if($id_pengeluaran != NULL){
      $data = array(
        'header_title'      => '<i class="fa fa-money"></i> Pengeluaran',
        'sub_header_title'  => 'Edit Pengeluaran',
        'set'               => $this->pengeluaran_model->get_bayar_pengeluaran($id_pengeluaran)
      );
    }
    else{
      $data = array(
        'header_title'      => '<i class="fa fa-money"></i> Pengeluaran',
        'sub_header_title'  => 'Pengeluaran'
      );
    }

    $this->backend_render(PATH_BACKEND.'pengeluaran/bayar', $data);
  }

  function save_pengeluaran_kategori(){
    $id = $this->input->post('id');
    $data = array(
      'pengeluaran_nama'  => $this->input->post('pengeluaran_nama'),
      'pp_kategori'       => $this->input->post('pp_kategori')
    );
    if($id === '0'){
      $this->pengeluaran_model->save_pengeluaran_kategori($data);
    }
    else{
      $this->pengeluaran_model->update_pengeluaran_kategori($data, $id);
    }

    $data = 'y';
    echo json_encode($data);
  }

  function get_pengeluaran_kategori_list($id = NULL){
    $this->load->library('Datatables');
    $this->datatables->select('pp_id, pengeluaran_nama')
         ->where('pp_kategori', $id);
    $this->datatables->from('pengeluaran_kategori');
    echo $this->datatables->generate();
  }

  function get_kategori_pengeluaran($id = NULL, $id_rumah = NULL){
    $data = $this->pengeluaran_model->get_kategori_pengeluaran($id, $id_rumah);
    echo json_encode($data);
  }

  function delete_pengeluaran_kategori($id = NULL){
    $data = $this->pengeluaran_model->delete_pengeluaran_kategori($id);
    echo json_encode($data);
  }

  function save_pembayaran_pengeluaran(){
    $id = $this->input->post('id');

    $data = array(
      'pengeluaran_no' => $this->get_no_pengeluaran($this->input->post('project_id'), $this->input->post('pj_id')),
      'pengeluaran_kepada'=> $this->input->post('kepada'),
      'pp_id'  => $this->input->post('kategori'),
      'pengeluaran_volume'=> $this->input->post('volume'),
      'pengeluaran_satuan'=> $this->input->post('satuan'),
      'pengeluaran_harga_satuan'=> preg_replace('/[^0-9]/', '',$this->input->post('harga_satuan')),
      'pengeluaran_total'=> preg_replace('/[^0-9]/', '',$this->input->post('total')),
      'pengeluaran_tanggal'=> $this->input->post('tanggal'),
      'pj_id' => $this->input->post('pj_id'),
      'rumah_id' => $this->input->post('project_id')
    );

    if($id === '0'){
      $id = $this->pengeluaran_model->save_pengeluaran($data);
    }
    else{
      $this->pengeluaran_model->update_pengeluaran($data, $id);
    }

    redirect('dashboard/pengeluaran/kwitansi/'.$id);
    // redirect('dashboard/pengeluaran/list/'.$this->input->post('project_id').'/'.$data['pj_id'].'/');
  }

  function delete_pengeluaran_history($id = NULL){
    $data = $this->pengeluaran_model->delete_pengeluaran_history($id);
    echo json_encode($data);
  }

  function get_pembayaran_pengeluaran($id = NULL){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, pengeluaran_total, pengeluaran_tanggal, pengeluaran_uraian, pengeluaran_nama')
         ->join('pengeluaran_kategori', 'tb_pengeluaran.pp_id = pengeluaran_kategori.pp_id')
         ->where('tb_pengeluaran.pp_kategori', $id);
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  function history_pengeluaran($id_rumah = NULL, $id = NULL ){
    $data = array(
      'header_title'      => '<i class="fa fa-history"></i> History ',
      'sub_header_title'  => 'History',
      'nama'              => $this->pengeluaran_model->get_kategori_pengeluaran_by_id($id)->pengeluaran_nama
    );
    $this->backend_render(PATH_BACKEND.'pengeluaran/history', $data);
  }

  function get_history_pengeluaran($rumah_id = NULL, $pp = NULL){
    $this->load->library('Datatables');
    $this->datatables->select('pengeluaran_id, pengeluaran_no, pengeluaran_kepada, pengeluaran_volume, pengeluaran_satuan, pengeluaran_harga_satuan, pengeluaran_tanggal')
         ->where('pp_id', $pp)
         ->where('rumah_id', $rumah_id);
    $this->datatables->from('tb_pengeluaran');
    echo $this->datatables->generate();
  }

  function kwitansi_pengeluaran($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');

    $kategori = $this->pengeluaran_model->get_bayar_pengeluaran($id)->pj_nama;

    ob_start();
    $data = array(
      'kwitansi' => 'BUKTI PENGELUARAN',
      'detil_kwitansi' => $kategori,
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'company_website' => $this->configuration_model->get_config('company_website') ? $this->configuration_model->get_config('company_website') : "-",
      'hari'  => $this->hari_terbilang(date('D', strtotime($this->pengeluaran_model->get_bayar_pengeluaran($id)->pengeluaran_tanggal))),
      'tanggal' => tgl_indo(date('Y-m-d', strtotime($this->pengeluaran_model->get_bayar_pengeluaran($id)->pengeluaran_tanggal))),
      'set' => $this->pengeluaran_model->get_bayar_pengeluaran($id)
    );
    $data['tanggal'] = tgl_indo(date('Y-m-d'));
    $html = $this->load->view(PATH_BACKEND.'kwitansi/pengeluaran', $data);
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('pengeluaran.pdf',array('Attachment'=>0));

  }

}
