<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Finance extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
     $this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
     redirect('/');
   }

   $this->load->model(array('rumah_model', 'booking_model', 'finance_model'));
 }

 public function index(){
  redirect('/');
}

public function pi_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Induk',
    'sub_header_title' => 'Pencairan Induk',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'pi/list', $data);
}

public function get_pi_list($perumahan = "all", $status = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('pi_id, booking_no, pi_datetime, pi_status, pi_harga, pelanggan_nama, rumah_nama, kavling_blok, tb_pi.booking_id')
  ->join('tb_booking', 'tb_pi.booking_id = tb_booking.booking_id')
  ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
  ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
  ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
  ->group_by('tb_pi.booking_id');

  if($perumahan != "all"){
   $this->db->where("tb_booking.rumah_id", $perumahan);
 }
 if($status != "all"){
   $this->db->where("tb_pi.pi_status", $status);
 }
 $this->datatables->from('tb_pi');
 echo $this->datatables->generate();
}

public function get_pi_by_id($id = NULL){
  $data = $this->finance_model->get_pi_by_id($id);

  echo json_encode($data);
}

public function save_pi(){
  $id = $this->input->post('pi_id');
  $pi = array(
    'pi_harga' => preg_replace('/[^0-9]/', '',$this->input->post('input_nominal'))
  );
  $this->finance_model->update_pi($pi, $id);

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/pencairan_induk/list');
}

public function change_pi_status($id = NULL, $status = 'n', $booking_id = NULL){
  $data = array(
    'pi_status' => $status,
    'pi_datetime' => date('Y-m-d H:i:s')
  );

  if($status === "s"){
    $exist = $this->finance_model->jalan_check($booking_id);
    if(!$exist){
      $jalan = array(
        'booking_id' => $booking_id,
        'j_status' => 'n'
      );
      $this->finance_model->save_jalan($jalan);

    }
  }
  $this->finance_model->update_pi($data, $id);
  redirect('dashboard/finance/pencairan_induk/list');
}

public function pl_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Listrik',
    'sub_header_title' => 'Pencairan Listrik',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'pl/list', $data);
}

public function pl_add(){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Pencairan Listrik',
    'sub_header_title' => 'Pencairan Listrik',
    'perumahan'        => $this->rumah_model->get_data(),
    'pl_no'            => $this->get_no_pl()
  );
  $this->backend_render(PATH_BACKEND.'pl/form', $data);
}

public function pl_edit($id = NULL){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Listrik',
    'sub_header_title' => 'Pencairan Listrik',
    'detil'     => $this->finance_model->get_detil_pl($id),
    'set'       => $this->finance_model->get_pl_data($id)
  );
  $this->backend_render(PATH_BACKEND.'pl/form', $data);
}

public function pl_save(){
  $id = $this->input->post('id', TRUE);

  $detil_pl = '';
  $pl = array(
    'pl_no'      => $this->input->post('inputNo', TRUE),
    'pl_date'    => $this->input->post('inputTgl', TRUE),
    'rumah_id'   => $this->input->post('rumahID', TRUE),
    'pl_harga'   => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga'))
  );

  if($id === "0"){
    $id_pl = $this->finance_model->save_pl($pl);
  }
  else{
    $this->finance_model->update_pl($pl, $id);
    $id_pl = $id;
  }

  $detil_pl = $this->input->post('inputBooking');
  $i = 0;
  foreach ($detil_pl as $row) {
    $detil = array(
      'pl_id'       => $id_pl,
      'booking_id'  => $this->input->post('IDBooking', TRUE)[$i]
    );

    if($id != "0"){
      if(!empty($this->input->post('IDDWawancara')[$i])){
        $detil['dpl_id'] = $this->input->post('IDDWawancara')[$i];
      }
    }

    $i++;
    $detil_data[] = $detil;
  }

  $i = 0;
  foreach ($detil_data as $row) {
    if(empty($detil_data[$i]['dpl_id'])){
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
    $this->db->insert_batch('detil_pl', $baru);
  }
  if(!empty($update)){
    $this->db->update_batch('detil_pl', $update, 'dpl_id');
  }

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/pl/list');
}

public function pl_delete($id = NULL){
  $result = $this->finance_model->pl_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/pl/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/pl/list');
  }
}
public function get_pl_list($perumahan = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('pl_id, pl_no, pl_date, rumah_nama, pl_harga')
  ->join('tb_rumah', 'tb_pl.rumah_id = tb_rumah.rumah_id')
  ->group_by('tb_pl.pl_no');
  if($perumahan != "all"){
   $this->db->where("tb_rumah.rumah_id", $perumahan);
 }
 $this->datatables->from('tb_pl');
 echo $this->datatables->generate();
}

public function detil_pl_delete($id_pl = NULL, $id = NULL){
  $result = $this->finance_model->detil_pl_delete($id_pl, $id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/pl/edit/'.$id_pl);
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/pl/edit/'.$id_imb);
  }
}

public function imb_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan IMB',
    'sub_header_title' => 'Pencairan IMB',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'imb/list', $data);
}

public function imb_add(){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Pencairan IMB',
    'sub_header_title' => 'Pencairan IMB',
    'perumahan'        => $this->rumah_model->get_data(),
    'imb_no'            => $this->get_no_imb()
  );
  $this->backend_render(PATH_BACKEND.'imb/form', $data);
}

public function imb_edit($id = NULL){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan IMB',
    'sub_header_title' => 'Pencairan IMB',
    'detil'     => $this->finance_model->get_detil_imb($id),
    'set'       => $this->finance_model->get_imb_data($id)
  );
  $this->backend_render(PATH_BACKEND.'imb/form', $data);
}

public function imb_save(){
  $id = $this->input->post('id', TRUE);

  $detil_pl = '';
  $pl = array(
    'imb_no'      => $this->input->post('inputNo', TRUE),
    'imb_date'    => $this->input->post('inputTgl', TRUE),
    'rumah_id'   => $this->input->post('rumahID', TRUE),
    'imb_harga'  => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga'))
  );

  if($id === "0"){
    $id_pl = $this->finance_model->save_imb($pl);
  }
  else{
    $this->finance_model->update_imb($pl, $id);
    $id_pl = $id;
  }

  $detil_pl = $this->input->post('inputBooking');
  $i = 0;
  foreach ($detil_pl as $row) {
    $detil = array(
      'imb_id'       => $id_pl,
      'booking_id'  => $this->input->post('IDBooking', TRUE)[$i]
    );

    if($id != "0"){
      if(!empty($this->input->post('IDDWawancara')[$i])){
        $detil['dimb_id'] = $this->input->post('IDDWawancara')[$i];
      }
    }

    $i++;
    $detil_data[] = $detil;
  }

  $i = 0;
  foreach ($detil_data as $row) {
    if(empty($detil_data[$i]['dimb_id'])){
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
    $this->db->insert_batch('detil_imb', $baru);
  }
  if(!empty($update)){
    $this->db->update_batch('detil_imb', $update, 'dimb_id');
  }

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/imb/list');
}

public function imb_delete($id = NULL){
  $result = $this->finance_model->imb_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/imb/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/imb/list');
  }
}

public function detil_imb_delete($id_imb = NULL, $id = NULL){
  $result = $this->finance_model->detil_imb_delete($id_imb, $id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/imb/edit/'.$id_imb);
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/imb/edit/'.$id_imb);
  }
}

public function get_imb_list($perumahan = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('imb_id, imb_no, imb_date, rumah_nama, imb_harga')
  ->join('tb_rumah', 'tb_imb.rumah_id = tb_rumah.rumah_id')
  ->group_by('tb_imb.imb_no');
  if($perumahan != "all"){
    $this->datatables->where('tb_rumah.rumah_id', $perumahan);
  }
  $this->datatables->from('tb_imb');
  echo $this->datatables->generate();
}

public function sertifikat_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Sertifikat',
    'sub_header_title' => 'Pencairan Sertifikat',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'sertifikat/list', $data);
}

public function sertifikat_add(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Sertifikat',
    'sub_header_title' => 'Pencairan Sertifikat',
    'perumahan'        => $this->rumah_model->get_data(),
    'sertifikat_no'    => $this->get_no_sertifikat()
  );
  $this->backend_render(PATH_BACKEND.'sertifikat/form', $data);
}

public function get_s_list(){
  $this->load->library('Datatables');
  $this->datatables->select('s_id, s_no, s_date, rumah_nama, s_harga')
  ->join('tb_rumah', 'tb_sertifikat.rumah_id = tb_rumah.rumah_id')
  ->group_by('tb_sertifikat.s_no');
  $this->datatables->from('tb_sertifikat');
  echo $this->datatables->generate();
}

public function sertifikat_save(){
  $id = $this->input->post('id', TRUE);

  $detil_pl = '';
  $pl = array(
    's_no'      => $this->input->post('inputNo', TRUE),
    's_date'    => $this->input->post('inputTgl', TRUE),
    'rumah_id'   => $this->input->post('rumahID', TRUE),
    's_harga'  => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga'))
  );

  if($id === "0"){
    $id_pl = $this->finance_model->save_s($pl);
  }
  else{
    $this->finance_model->update_s($pl, $id);
    $id_pl = $id;
  }

  $detil_pl = $this->input->post('inputBooking');
  $i = 0;
  foreach ($detil_pl as $row) {
    $detil = array(
      's_id'       => $id_pl,
      'booking_id'  => $this->input->post('IDBooking', TRUE)[$i]
    );

    if($id != "0"){
      if(!empty($this->input->post('IDDWawancara')[$i])){
        $detil['ds_id'] = $this->input->post('IDDWawancara')[$i];
      }
    }

    $i++;
    $detil_data[] = $detil;
  }

  $i = 0;
  foreach ($detil_data as $row) {
    if(empty($detil_data[$i]['ds_id'])){
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
    $this->db->insert_batch('detil_sertifikat', $baru);
  }
  if(!empty($update)){
    $this->db->update_batch('detil_sertifikat', $update, 'ds_id');
  }

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/sertifikat/list');
}

public function s_edit($id = NULL){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan sertifikat',
    'sub_header_title' => 'Pencairan sertifikat',
    'detil'     => $this->finance_model->get_detil_s($id),
    'set'       => $this->finance_model->get_s_data($id)
  );
  $this->backend_render(PATH_BACKEND.'sertifikat/form', $data);
}

public function s_delete($id = NULL){
  $result = $this->finance_model->s_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/sertifikat/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/sertifikat/list');
  }
}

public function detil_s_delete($id_s = NULL, $id = NULL){
  $result = $this->finance_model->detil_s_delete($id_s, $id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/s/edit/'.$id_s);
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/s/edit/'.$id_s);
  }
}

public function j100_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Jaminan 100 Hari',
    'sub_header_title' => 'Pencairan Jaminan 100 Hari',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'100/list', $data);
}

public function j100_add(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Jaminan 100 Hari',
    'sub_header_title' => 'Pencairan Jaminan 100 Hari',
    'perumahan'        => $this->rumah_model->get_data(),
    'j100_no'            => $this->get_no_100()
  );
  $this->backend_render(PATH_BACKEND.'100/form', $data);
}

public function get_100_list($perumahan = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('j100_id, j100_no, j100_date, rumah_nama, j100_harga')
  ->join('tb_rumah', 'tb_100.rumah_id = tb_rumah.rumah_id')
  ->group_by('tb_100.j100_no');
  if($perumahan != "all"){
    $this->datatables->where('tb_rumah.rumah_id', $perumahan);
  }
  $this->datatables->from('tb_100');
  echo $this->datatables->generate();
}

public function j100_edit($id = NULL){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Pencairan Jaminan 100 Hari',
    'sub_header_title' => 'Pencairan Jaminan 100 Hari',
    'detil'     => $this->finance_model->get_detil_100($id),
    'set'       => $this->finance_model->get_100_data($id)
  );
  $this->backend_render(PATH_BACKEND.'100/form', $data);
}

public function j100_save(){
  $id = $this->input->post('id', TRUE);

  $detil_pl = '';
  $pl = array(
    'j100_no'      => $this->input->post('inputNo', TRUE),
    'j100_date'    => $this->input->post('inputTgl', TRUE),
    'rumah_id'    => $this->input->post('rumahID', TRUE),
    'j100_harga'  => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga'))
  );

  if($id === "0"){
    $id_pl = $this->finance_model->save_100($pl);
  }
  else{
    $this->finance_model->update_100($pl, $id);
    $id_pl = $id;
  }

  $detil_pl = $this->input->post('inputBooking');
  $i = 0;
  foreach ($detil_pl as $row) {
    $detil = array(
      'j100_id'       => $id_pl,
      'booking_id'  => $this->input->post('IDBooking', TRUE)[$i]
    );

    if($id != "0"){
      if(!empty($this->input->post('IDDWawancara')[$i])){
        $detil['d100_id'] = $this->input->post('IDDWawancara')[$i];
      }
    }

    $i++;
    $detil_data[] = $detil;
  }

  $i = 0;
  foreach ($detil_data as $row) {
    if(empty($detil_data[$i]['d100_id'])){
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
    $this->db->insert_batch('detil_100', $baru);
  }
  if(!empty($update)){
    $this->db->update_batch('detil_100', $update, 'd100_id');
  }

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/100/list');
}

public function detil_j100_delete($id_s = NULL, $id = NULL){
  $result = $this->finance_model->detil_100_delete($id_s, $id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/100/edit/'.$id_s);
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/100/edit/'.$id_s);
  }
}

public function j100_delete($id = NULL){
  $result = $this->finance_model->j100_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/100/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/100/list');
  }
}

public function penerimaan_add(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Penerimaan',
    'sub_header_title' => 'Penerimaan'
  );
  $this->backend_render(PATH_BACKEND.'penerimaan/form', $data);
}

public function jalan_list(){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Pencairan Jalan',
    'sub_header_title' => 'Pencairan Jalan',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'jalan/list', $data);
}

public function get_jalan_list($perumahan = "all", $status = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('j_id, booking_no, j_datetime, j_status, j_harga, pelanggan_nama, rumah_nama, kavling_blok, tb_jalan.booking_id')
  ->join('tb_booking', 'tb_jalan.booking_id = tb_booking.booking_id')
  ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
  ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
  ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
  ->group_by('tb_jalan.booking_id');

  if($perumahan != "all"){
   $this->db->where("tb_booking.rumah_id", $perumahan);
 }
 if($status != "all"){
   $this->db->where("tb_jalan.j_status", $status);
 }
 $this->datatables->from('tb_jalan');
 echo $this->datatables->generate();
}

public function change_j_status($id = NULL, $status = 'n', $booking_id = NULL){
  $data = array(
    'j_status'   => $status,
    'j_datetime' => date('Y-m-d H:i:s')
  );

  $this->finance_model->update_j($data, $id);
  redirect('dashboard/finance/transaksi/jalan/list');
}

public function get_jalan_by_id($id = NULL){
  $data = $this->finance_model->get_jalan_by_id($id);

  echo json_encode($data);
}

public function save_j(){
  $id = $this->input->post('pi_id');
  $pi = array(
    'j_harga' => preg_replace('/[^0-9]/', '',$this->input->post('input_nominal'))
  );
  $this->finance_model->update_j($pi, $id);

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/jalan/list');
}

public function get_laporan_pl($id = NULL){
  $this->load->helper(array('fungsidate_helper'));
  set_time_limit(0);
  $this->load->library('dompdf_gen');
  ob_start();
  $data = array(
    'set'  => $this->finance_model->get_pl_data($id),
    'detil'=> $this->finance_model->get_detil_pl($id)
  );
  $data['tanggal'] = tgl_indo(date('Y-m-d'));
  $data['hari'] = $this->hari_terbilang(date('D'));
  $html = $this->load->view(PATH_BACKEND.'laporan/permohonan_listrik', $data);
    //Convert to PDF
  $this->dompdf->load_html(ob_get_clean());
    // set paper size
  $paper_size = $this->data['paper_size'];
  $this->dompdf->set_paper($paper_size, 'potrait');
  $this->dompdf->render();

  $this->dompdf->stream('Surat_Permohonan_Listrik.pdf',array('Attachment'=>0));
}

public function get_laporan_imb($id = NULL){
  $this->load->helper(array('fungsidate_helper'));
  set_time_limit(0);
  $this->load->library('dompdf_gen');
  ob_start();
  $data = array(
    'set'  => $this->finance_model->get_imb_data($id),
    'detil'=> $this->finance_model->get_detil_imb($id)
  );
  $data['tanggal'] = tgl_indo(date('Y-m-d'));
  $data['hari'] = $this->hari_terbilang(date('D'));
  $html = $this->load->view(PATH_BACKEND.'laporan/pencairan_imb', $data);
    //Convert to PDF
  $this->dompdf->load_html(ob_get_clean());
    // set paper size
  $paper_size = $this->data['paper_size'];
  $this->dompdf->set_paper($paper_size, 'potrait');
  $this->dompdf->render();

  $this->dompdf->stream('Surat_Pencairan_IMB.pdf',array('Attachment'=>0));
}

public function get_laporan_s($id = NULL){
  $this->load->helper(array('fungsidate_helper'));
  set_time_limit(0);
  $this->load->library('dompdf_gen');
  ob_start();
  $data = array(
    'set'  => $this->finance_model->get_s_data($id),
    'detil'=> $this->finance_model->get_detil_s($id)
  );
  $data['tanggal'] = tgl_indo(date('Y-m-d'));
  $data['hari'] = $this->hari_terbilang(date('D'));
  $html = $this->load->view(PATH_BACKEND.'laporan/pencairan_sertifikat', $data);
    //Convert to PDF
  $this->dompdf->load_html(ob_get_clean());
    // set paper size
  $paper_size = $this->data['paper_size'];
  $this->dompdf->set_paper($paper_size, 'potrait');
  $this->dompdf->render();

  $this->dompdf->stream('Surat_Pencairan_Sertifikat.pdf',array('Attachment'=>0));
}

public function get_laporan_100($id = NULL){
  $this->load->helper(array('fungsidate_helper'));
  set_time_limit(0);
  $this->load->library('dompdf_gen');
  ob_start();
  $data = array(
    'set'  => $this->finance_model->get_100_data($id),
    'detil'=> $this->finance_model->get_detil_100($id)
  );
  $data['tanggal'] = tgl_indo(date('Y-m-d'));
  $data['hari'] = $this->hari_terbilang(date('D'));
  $html = $this->load->view(PATH_BACKEND.'laporan/100', $data);
    //Convert to PDF
  $this->dompdf->load_html(ob_get_clean());
    // set paper size
  $paper_size = $this->data['paper_size'];
  $this->dompdf->set_paper($paper_size, 'potrait');
  $this->dompdf->render();

  $this->dompdf->stream('Surat_Pencairan_100_hari.pdf',array('Attachment'=>0));
}

public function get_no_imb(){
  $last_id = $this->finance_model->get_max_id_imb();
  $last_no_id = explode("/",$last_id);
  $tahun = date('Y');
  if(!empty($last_no_id[3])){
    $last_tahun = $last_no_id[3];
  }
  else{
    $last_tahun = date('Y');
  }
  if($tahun <= $last_tahun){
    $noid = 0;
    $noid = $last_no_id[0] + 1;
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "0".$noid."/RK-PDJ/VII/".$tahun;
  }
  else{
    $id = $noid."/RK-PDJ/VII/".$tahun;
  }
  return $id;
}

public function get_no_sertifikat(){
  $last_id = $this->finance_model->get_max_id_sertifikat();
  $last_no_id = explode("/",$last_id);
  $tahun = date('Y');
  if(!empty($last_no_id[3])){
    $last_tahun = $last_no_id[3];
  }
  else{
    $last_tahun = date('Y');
  }
  if($tahun <= $last_tahun){
    $noid = 0;
    $noid = $last_no_id[0] + 1;
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "0".$noid."/RK-PDJ/VII/".$tahun;
  }
  else{
    $id = $noid."/RK-PDJ/VII/".$tahun;
  }
  return $id;
}

public function get_no_100(){
  $last_id = $this->finance_model->get_max_id_100();
  $last_no_id = explode("/",$last_id);
  $tahun = date('Y');
  if(!empty($last_no_id[3])){
    $last_tahun = $last_no_id[3];
  }
  else{
    $last_tahun = date('Y');
  }
  if($tahun <= $last_tahun){
    $noid = 0;
    $noid = $last_no_id[0] + 1;
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "0".$noid."/RK-PDJ/VII/".$tahun;
  }
  else{
    $id = $noid."/RK-PDJ/VII/".$tahun;
  }
  return $id;
}

public function get_no_pl(){
  $last_id = $this->finance_model->get_max_id_pl();
  $last_no_id = explode("/",$last_id);
  $tahun = date('Y');
  if(!empty($last_no_id[3])){
    $last_tahun = $last_no_id[3];
  }
  else{
    $last_tahun = date('Y');
  }
  if($tahun <= $last_tahun){
    $noid = 0;
    $noid = $last_no_id[0] + 1;
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "0".$noid."/RK-PDJ/VII/".$tahun;
  }
  else{
    $id = $noid."/RK-PDJ/VII/".$tahun;
  }
  return $id;
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

public function save_penerimaan(){
  $id = $this->input->post('id');

  $data = array(
    'rumah_id' => $this->input->post('rumahID'),
    'pp_tipe'  => $this->input->post('inputTipe'),
    'pp_unit'  => $this->input->post('inputUnit'),
    'pp_harga'  => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga')),
    'pp_percent'=> $this->input->post('inputPercent'),
    'pp_total'  => preg_replace('/[^0-9]/', '',$this->input->post('inputTotal')),
    'pp_datetime' => date('Y-m-d H:i:s')
  );

  if($id === "0"){
    $this->finance_model->save_penerimaan($data);
  }
  else{
    $this->finance_model->update_penerimaan($data, $id);
  }
  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/penerimaan/list');
}

public function penerimaan_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Penerimaan',
    'sub_header_title' => 'Penerimaan',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'penerimaan/list', $data);
}

public function get_pp_list($perumahan = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('pp_id, rumah_nama, pp_tipe, pp_unit, pp_harga, pp_percent, pp_datetime, pp_total')
  ->join('tb_rumah', 'tb_pp.rumah_id = tb_rumah.rumah_id');

  if($perumahan != "all"){
   $this->db->where("tb_pp.rumah_id", $perumahan);
 }
 $this->datatables->from('tb_pp');
 echo $this->datatables->generate();
}

public function penerimaan_edit($id = NULL){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Penerimaan',
    'sub_header_title' => 'Penerimaan',
    'perumahan'        => $this->rumah_model->get_data(),
    'set'              => $this->finance_model->get_penerimaan_by_id($id)
  );
  $this->backend_render(PATH_BACKEND.'penerimaan/form', $data);
}

public function penerimaan_delete($id = NULL){
  $result = $this->finance_model->pp_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/penerimaan/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/penerimaan/list');
  }
}

public function dp_list(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Rencana DP',
    'sub_header_title' => 'Rencana DP',
    'perumahan'        => $this->rumah_model->get_data()
  );
  $this->backend_render(PATH_BACKEND.'dp/list', $data);
}

public function dp_add(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Rencana DP',
    'sub_header_title' => 'Tambah Rencana DP'
  );
  $this->backend_render(PATH_BACKEND.'dp/form', $data);
}

public function get_dp_list($perumahan = "all", $status = "all"){
  $this->load->library('Datatables');
  $this->datatables->select('dp_id, pelanggan_nama, rumah_nama, booking_no, dp_status, dp_datetime, dp_modified, dp_keterangan, dp_total')
  ->join('tb_booking', 'tb_dp.booking_id = tb_booking.booking_id')
  ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
  ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id');

  if($perumahan != "all"){
   $this->db->where("tb_rumah.rumah_id", $perumahan);
 }
 if($status != "all"){
   $this->db->where("tb_dp.dp_status", $status);
 }
 $this->datatables->from('tb_dp');
 echo $this->datatables->generate();
}

public function dp_save(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'dp_status'  => $this->input->post('inputStatus'),
    'dp_keterangan' => $this->input->post('inputKeterangan'),
    'dp_total'   => preg_replace('/[^0-9]/', '',$this->input->post('inputTotal'))
  );
  if($id === "0"){
    $data['dp_datetime'] = date('Y-m-d H:i:s');
    $lid = $this->finance_model->save_dp($data);
  }
  else{
    $data['dp_modified'] = date('Y-m-d H:i:s');
    $this->finance_model->update_dp($data, $id);
    $lid = $id;
  }

  $sub = $this->input->post('jumlah_dp');
  $i = 0;
  foreach ($sub as $row) {
    $detil = array(
      'dp_id' => $lid,
      'ddp_jumlah' => preg_replace('/[^0-9]/', '',$this->input->post('jumlah_dp')[$i])
    );

    if(!empty($this->input->post('ddp_id')[$i])){
      $detil['dp_id'] = $lid;
      $detil['ddp_id'] = $this->input->post('ddp_id')[$i];
    }
    else{
      $detil['dp_id'] = $lid;
    }

    $detil_data[] = $detil;
    $i++;
  }

  $i = 0;
  foreach ($detil_data as $row) {
    if(empty($detil_data[$i]['ddp_id'])){
      $baru[] = $detil_data[$i];
    }
    else{
      $update[] = $detil_data[$i];
    }
    $i++;
  }

  if(!empty($baru)){
    $this->db->insert_batch('detil_dp', $baru);
  }
  if(!empty($update)){
    $this->db->update_batch('detil_dp', $update, 'ddp_id');
  }
  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/finance/transaksi/dp/list');
}

public function dp_edit($id = NULL){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Rencana DP',
    'sub_header_title' => 'Edit Rencana DP',
    'set'  => $this->finance_model->get_dp_data_by_id($id),
    'detil'=> $this->finance_model->get_detil_dp($id)
  );
  $this->backend_render(PATH_BACKEND.'dp/form', $data);
}

public function dp_delete($id = NULL){
  $result = $this->finance_model->dp_delete($id);

  if($result){
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
    redirect('dashboard/finance/transaksi/dp/list');
  }
  else{
    $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
    redirect('dashboard/finance/transaksi/dp/list');
  }
}


}
