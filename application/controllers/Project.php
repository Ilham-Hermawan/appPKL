<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->is_logged()){
     $this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
     redirect('/');
   }

   $this->load->model(array('project_model'));
 }

 function index()
 {
  $this->list_data();
}

function list_data(){
  $data = array(
    'header_title' => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Daftar Project'
  );
  $this->backend_render(PATH_BACKEND.'project/list', $data);
}

function add_data(){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Tambah Project'
  );
  $this->backend_render(PATH_BACKEND.'project/form', $data);
}

function edit_data($id = NULL){
  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Edit Project',
    'set'              => $this->project_model->get_project_by_id($id)
  );
  $this->backend_render(PATH_BACKEND.'project/form', $data);
}

function kavling_data($id = NULL){
  $data = array(
    'header_title'      => '<i class="fa fa-users"></i> Kavling',
    'sub_header_title'  => 'Kavling',
    'set'               => $this->project_model->get_project_by_id($id),
    'detil'             => $this->project_model->get_kavling($id)
  );
  $this->backend_render(PATH_BACKEND.'rumah/kavling', $data);
}

function display_data($id = NULL){
  if($id === NULL){
    show_404();
  }
  komik
  $cek = $this->project_model->cek_data($id);
  if ($cek == 0) {
    show_404();
  }else{
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Project',
      'sub_header_title' => 'Edit Project',
      'project'          => $this->project_model->get_project_by_id($id),
      'count_kavling'    => $this->project_model->count_kavling($id),
    );
    $this->backend_render(PATH_BACKEND.'project/display', $data);
  }
}

function count_tersedia($id = NULL){
  $data = $this->project_model->count_tersedia($id);
  echo json_encode($data);
}

function count_terjual($id = NULL){
  $data = $this->project_model->count_terjual($id);
  echo json_encode($data);
}

function delete_project($id = NULL){
  if($id === NULL){
    show_404();
  }

  $data = $this->project_model->delete_data($id);
  echo json_encode($data);
}

function tersedia_data($id = NULL){
  if($id === NULL){
    show_404();
  }

  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Project Tersedia',
    'set'               => $this->project_model->get_project_by_id($id),
    'detil'             => $this->project_model->get_kavling($id)
  );
  $this->backend_render(PATH_BACKEND.'project/tersedia', $data);
}

function get_data_tersedia($id = NULL){
  $this->load->library('Datatables');
  $this->datatables->select('kavling_blok, kavling_lb, kavling_lt, kavling_shm, kavling_shm_no, kavling_imb, kavling_imb_no, kavling_harga, rumah_kavling.kavling_id')
  ->join('tb_booking', 'rumah_kavling.kavling_id = tb_booking.kavling_id', 'left')
  ->where('tb_booking.kavling_id IS NULL')
  ->where('rumah_kavling.rumah_id', $id)
  ->order_by('kavling_blok', 'ASC');
  $this->datatables->from('rumah_kavling');
  echo $this->datatables->generate();
}

function terjual_data($id = NULL){
  if($id === NULL){
    show_404();
  }

  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Project Terjual',
    'set'               => $this->project_model->get_project_by_id($id),
    'detil'             => $this->project_model->get_kavling($id)
  );
  $this->backend_render(PATH_BACKEND.'project/terjual', $data);
}

function get_data_terjual($id = NULL){
  $this->load->library('Datatables');
  $this->datatables->select('booking_id, booking_no, pelanggan_ktp, pelanggan_nama, kavling_blok')
  ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
  ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
  ->order_by('kavling_blok', 'ASC')
  ->where('tb_booking.rumah_id', $id);
  $this->datatables->from('tb_booking');
  echo $this->datatables->generate();
}

function dibatalkan_data($id = NULL){
  if($id === NULL){
    show_404();
  }

  $data = array(
    'header_title'     => '<i class="fa fa-users"></i> Project',
    'sub_header_title' => 'Project Dibatalkan',
    'set'               => $this->project_model->get_project_by_id($id),
    'detil'             => $this->project_model->get_kavling($id)
  );
  $this->backend_render(PATH_BACKEND.'project/dibatalkan', $data);
}

function get_data_dibatalkan($id = NULL){
  $this->load->library('Datatables');
  $this->datatables->select('batal_id, booking_no, pelanggan_ktp, pelanggan_nama, kavling_blok, booking_batal, batal_status, batal_potongan')
  ->join('tb_pelanggan', 'tb_batal.pelanggan_id = tb_pelanggan.pelanggan_id')
  ->join('rumah_kavling', 'tb_batal.kavling_id = rumah_kavling.kavling_id')
  ->order_by('kavling_blok', 'ASC')
  ->where('tb_batal.rumah_id', $id);
  $this->datatables->from('tb_batal');
  echo $this->datatables->generate();
}

function delete_batal($id = NULL){
  $result = $this->project_model->delete_batal($id);
  echo json_encode($result);
}

function save_batal($booking_id = NULL, $batal_status = NULL){
  $this->load->model('booking_model');
  $data_booking = $this->booking_model->get_booking_data($booking_id);
  $data = array(
    'booking_id' => $booking_id,
    'booking_no' => $data_booking->booking_no,
    'booking_harga' => $data_booking->harga,
    'pelanggan_id' => $data_booking->pelanggan_id,
    'rumah_id'  => $data_booking->rumah_id,
    'kavling_id'  => $data_booking->kavling_id,
    'booking_date' => $data_booking->booking_date,
    'booking_batal' => date('Y-m-d')
  );
  if($batal_status == '1'){
    $data['batal_status'] = "1";
    $data['batal_potongan'] = '300000';
    $status = 'Tidak Lolos BI Checking';
  }
  elseif($batal_status == '2'){
    $data['batal_status'] = "2";
    $data['batal_potongan'] = '0';
    $status = 'Pembatalan Sepihak';
  }
  else{
    $data['batal_status'] = "3";
    $data['batal_potongan'] = $this->project_model->get_pembayaran($booking_id);
    $status = 'Ditolak Bank';
  }

  $result = $this->project_model->save_batal($data, $status);
  $this->load->model('booking_model');
  $this->booking_model->delete_booking($booking_id);

  echo json_encode($result);
}

public function booking($halaman = NULL, $id = NULL){
  $data = array(
    'header_title'      => '<i class="fa fa-book"></i> Booking',
    'sub_header_title'  => 'Booking',
    'set'               => $this->project_model->get_kavling_id($id),
    'agama'             => $this->project_model->get_agama()

  );
  $this->backend_render(PATH_BACKEND.'booking/form', $data);
}

function edit_booking($id = NULL){
  $data = array(
    'header_title'      => '<i class="fa fa-book"></i> Edit Booking',
    'sub_header_title'  => 'Edit Booking',
    'set'               => $this->project_model->get_kavling_id($id),
    'agama'             => $this->project_model->get_agama(),
    'set'               => $this->project_model->get_booking_data($id)

  );
  $this->backend_render(PATH_BACKEND.'booking/form', $data);
}

function booking_save(){
  $id = $this->input->post('id');

  $data = array(
    'pelanggan_ktp'   => $this->input->post('inputKtp'),
    'pelanggan_nama'  => $this->input->post('inputNama'),
    'pelanggan_jk'    => $this->input->post('inputJk'),
    'pelanggan_ttl'   => $this->input->post('inputTtl'),
    'pelanggan_alamat'=> $this->input->post('inputAlamat1'),
    'pelanggan_agama' => $this->input->post('inputAgama'),
    'pelanggan_alamat_surat'=> $this->input->post('inputAlamat2'),
    'pelanggan_kontak'=> $this->input->post('inputKontak'),
    'pelanggan_pekerjaan'=> $this->input->post('inputPekerjaan'),
  );

  if($id === "0"){
    $data['pelanggan_datetime'] = date('Y-m-d H:i:s');
    $idp = $this->project_model->save_pelanggan($data);
  }
  else{
    $id_pelanggan = $this->input->post('pelanggan_id');
    $this->project_model->update_pelanggan($data, $id_pelanggan);
    $idp = $id_pelanggan;
  }

    // unset($data);
  $kavling_id = $this->input->post('kavling_id');
  $rumah_id = $this->input->post('rumah_id');
  $dataz = array(
    'pelanggan_id'  => $idp,
    'rumah_id'      => $rumah_id,
    'kavling_id'    => $kavling_id,
    'booking_date'  => $this->input->post('inputTanggal'),
    'harga'         => preg_replace('/[^0-9]/', '',$this->input->post('inputHarga'))
  );
  if(strtolower($this->input->post('inputBooking')) === 'auto'){
    $dataz['booking_no'] = $this->_get_booking_no($rumah_id, $kavling_id);
  }
  else{
    $dataz['booking_no'] = $this->input->post('inputBooking');
  }

  if($id === '0'){
      //insert
    $idbooking = $this->project_model->booking_save($dataz, $data['pelanggan_nama'], $data['pelanggan_ktp']);

  }
  else{
      //update
    $this->project_model->booking_update($dataz, $id, $data['pelanggan_nama'], $data['pelanggan_ktp']);
    $idbooking = $id;
  }

  if($id === '0'){
    $bayar = array(
      'penerimaan_no'   => '',
      'booking_id'      => $idbooking,
      'penerimaan_dari' => $data['pelanggan_nama'],
      'penerimaan_total'=> '500000',
      'penerimaan_tanggal'=> date('Y-m-d'),
      'penerimaan_uraian' => 'Tanda Jadi',
      'pkategori_id'    => '1'
    );
    $this->load->model('penerimaan_model');
    $this->penerimaan_model->save_penerimaan($bayar);
  }

  $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
  redirect('dashboard/project/terjual/'.$rumah_id);
}

function booking_list($id = NULL){
  $cek = $this->project_model->cek_data($id);
  if ($cek == 0) {
    show_404();
  }else{
    $nama_perumahan = $this->project_model->get_project_by_id($id)->rumah_nama;
    $data = array(
      'header_title'      => '<i class="fa fa-book"></i> Daftar Booking '.$nama_perumahan,
      'sub_header_title'  => 'Booking',
      // 'set'               => $this->project_model->get_kavling_id($id),
      'wawancara'         => $this->project_model->get_date_wawancara($id),
      'lpa'               => $this->project_model->get_date_lpa($id),
      'akad'              => $this->project_model->get_date_akad($id)
    );
    $this->backend_render(PATH_BACKEND.'booking/list', $data);
  }
}

function get_date_wawancara(){
  $data = $this->project_model->get_date_wawancara();
  echo json_encode($data);
}

function get_booking_list($id = 'all', $dt1 = "0", $dt2 = "0"){
  $this->load->library('Datatables');
  $this->datatables->select('booking_id, booking_no, pelanggan_nama, pelanggan_ktp, kavling_blok, booking_date, harga')
  ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_id')
  ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
  ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id');
  if($id != 'all'){
    $this->db->where('tb_booking.rumah_id', $id);
  }
  if($dt1 != "0" OR $dt2 != "0"){
    $this->db->where("booking_date BETWEEN '".$dt1."' AND '".$dt2."'");
  }
  $this->datatables->from('tb_booking');
  echo $this->datatables->generate();
}

function print_kwitansi($id = NULL){
  $this->load->helper(array('fungsidate_helper'));
  set_time_limit(0);
  $this->load->library('dompdf_gen');
  ob_start();
  $data = array(
    'set'  => $this->project_model->get_booking_data($id),
    'kwitansi' => 'KWITANSI BOOKING',
    'detil_kwitansi' => 'PERUMAHAN '.$this->project_model->get_booking_data($id)->rumah_nama,
    'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
    'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
    'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
    'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
    'company_website' => $this->configuration_model->get_config('company_website') ? $this->configuration_model->get_config('company_website') : "-"
      // 'detil'=> $this->project_model->get_detil_pl($id)
  );
  $data['tanggal'] = tgl_indo($data['set']->booking_date);
  $data['hari'] = $this->hari_terbilang(date('D', strtotime($data['set']->booking_date)));
  $html = $this->load->view(PATH_BACKEND.'kwitansi/booking', $data);
    //Convert to PDF
  $this->dompdf->load_html(ob_get_clean());
    // set paper size
  $paper_size = $this->data['paper_size'];
  $this->dompdf->set_paper($paper_size, 'potrait');
  $this->dompdf->render();

  $this->dompdf->stream('Kwitansi_booking.pdf',array('Attachment'=>0));

}

function booking_detil($id = NULL){
  $data = array(
    'header_title'      => '<i class="fa fa-book"></i> Detil Booking',
    'sub_header_title'  => 'Booking',
    'set'               => $this->project_model->get_booking_data($id),
    'pelanggan_id'      => $this->project_model->get_booking_data($id)->pelanggan_id,
    'rumah_id'          => $this->project_model->get_booking_data($id)->rumah_id
  );
  $this->backend_render(PATH_BACKEND.'booking/detil', $data);
}

function _get_booking_no($id_rumah = NULL, $kavling = NULL){
  $this->load->model('rumah_model');
  $last_id = $this->project_model->get_max_id_booking($id_rumah);
  $kode_rumah = $this->rumah_model->get_data_by_id($id_rumah)->rumah_kode;
  $kavling = $this->rumah_model->get_detil_kavling_by_id($kavling)->kavling_blok;
  if($kavling != NULL){
    $kavling = preg_replace('/\s+/', '', $kavling);
    $kavling = preg_replace("/[^A-Za-z0-9?!]/",'',$kavling);
  }
  $tanggal = date('dmy');
  $noid = 0;
  $id = 0;
  if(!empty($last_id)){
    $ex_last_id = explode('/',$last_id);
    $noid = intval($ex_last_id[1]) + intval(1);
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "00".$noid;
  }
  else if($noid < 100){
    $id = "0".$noid;
  }
  else{
    $id = $noid;
  }
  return $kode_rumah.'-'.$kavling.'/'.$id.'/'.$tanggal;
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

function get_ppjb($id = NULL){
  $data = $this->project_model->get_ppjb($id);
  echo json_encode($data);
}

function save_ppjb(){
  if(!$this->input->post()){
      //tidak ada post
    show_404();
  }
  $id = $this->input->post('id');
  $booking_id = $this->input->post('booking_id');
  $id_rumah = $this->project_model->get_booking_data($booking_id)->rumah_id;
  $kavling = $this->project_model->get_booking_data($booking_id)->kavling_id;
  $data = array(
    'booking_id' => $booking_id,
    'ppjb_status'=> $this->input->post('ppjb_status'),
    'ppjb_date'  => $this->input->post('ppjb_date')
  );
  if($id === "0"){
    $data['ppjb_no'] = $this->_get_ppjb_no($id_rumah, $kavling);
    $this->project_model->save_ppjb($data);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status PPJB menjadi SUDAH pada TANGGAL : '.date('d/m/Y', strtotime($data['ppjb_date'])).' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  else{

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status PPJB menjadi SUDAH pada TANGGAL : '.date('d/m/Y', strtotime($data['ppjb_date'])).' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->update_ppjb($data, $id);
  }

  $data = "ok";
  echo json_encode($data);

}

function check_ppjb($id = NULL){
  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_ppjb($id)->ppjb_status)){
    $data = $this->project_model->get_ppjb($id)->ppjb_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);
}

function kelengkapan_berkas($id = NULL){
  $this->load->model('transaksi_model');
  if($id == NULL){
    show_404();
  }

  $data = $this->transaksi_model->count_kelengkapan_berkas($id);
  echo json_encode($data);
}

function wawancara($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_detil_wawancara($id)->dw_status)){
    $data = $this->project_model->get_detil_wawancara($id)->dw_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);

}

function penyerahan_berkas($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_pb($id)->db_status)){
    $data = $this->project_model->get_pb($id)->db_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);
}

function ots($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_ots($id)->ots_status)){
    $data = $this->project_model->get_ots($id)->ots_status;
  }
  else{
    $data = 'n';
  }

  echo json_encode($data);

}

function sp3k($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_sp3k($id)->sp3k_status)){
    $data = $this->project_model->get_sp3k($id)->sp3k_status;
  }
  else{
    $data = 'n';
  }

  echo json_encode($data);

}

function lpa($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_detil_lpa($id)->dlpa_status)){
    $data = $this->project_model->get_detil_lpa($id)->dlpa_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);

}


function vpajak($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_vpajak($id)->vp_status)){
    $data = $this->project_model->get_vpajak($id)->vp_status;
  }
  else{
    $data = 'n';
  }

  echo json_encode($data);

}

function akad($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_detil_akad($id)->ad_status)){
    $data = $this->project_model->get_detil_akad($id)->ad_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);

}

function skr($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_skr($id)->skr_status)){
    $data = $this->project_model->get_skr($id)->skr_status;
  }
  else{
    $data = 'n';
  }
  echo json_encode($data);

}

function jaminan($id = NULL){

  if($id == NULL){
    show_404();
  }

  if(!empty($this->project_model->get_jaminan($id))){
    $data = $this->project_model->get_jaminan($id)->jaminan_expired;
  }
  else{
    $data = '???';
  }
  echo json_encode($data);

}



function _get_ppjb_no($id_rumah = NULL, $kavling = NULL){
  $this->load->model('rumah_model');
  $last_id = $this->project_model->get_max_id_ppjb($id_rumah);
  $kode_rumah = $this->rumah_model->get_data_by_id($id_rumah)->rumah_kode;
  $kavling = $this->rumah_model->get_detil_kavling_by_id($kavling)->kavling_blok;
  if($kavling != NULL){
    $kavling = preg_replace('/\s+/', '', $kavling);
    $kavling = preg_replace("/[^A-Za-z0-9?!]/",'',$kavling);
  }
  $tanggal = date('dmy');
  $noid = 0;
  $id = 0;
  if(!empty($last_id)){
    $ex_last_id = explode('/',$last_id);
    $noid = intval($ex_last_id[1]) + intval(1);
  }
  else{
    $noid = 1;
  }

  if($noid < 10){
    $id = "00".$noid;
  }
  else if($noid < 100){
    $id = "0".$noid;
  }
  else{
    $id = $noid;
  }
  return $id.'/'.$kode_rumah.'-'.$kavling.'/'.$tanggal;
}

function save_wawancara(){
  $id = $this->input->post('id');
  $rumah_id = $this->input->post('rumah_id');
  $tgl = $this->input->post('wawancara_tanggal');

  $ada = $this->project_model->cek_exist_tanggal_wawancara($tgl);
  if(!$ada){
      //tambah baru
    $data = array(
      'wawancara_tanggal'=> $tgl,
      'rumah_id'         => $rumah_id,
      'booking_id'       => $this->input->post('booking_id')
    );

    if($id === "0"){
      $data['wawancara_no'] = $this->_get_no_wawancara();
      $id_wawancara = $this->project_model->wawancara_save($data);
    }
    else{
      $this->project_model->wawancara_update($data, $id);
      $id_wawancara = $id;
    }
  }
  else{
    $id_wawancara = $ada;
  }

  $detil_data = array(
    'booking_id' => $this->input->post('booking_id'),
    'wawancara_id'=> $id_wawancara,
    'dw_status'   => $this->input->post('dw_status')
  );

  $dw = $this->input->post('dw');
  $status = ($detil_data['dw_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($dw === '0'){
    $this->project_model->save_detil_wawancara($detil_data);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Mengubah status WAWANCARA menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  else{
    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status WAWANCARA menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($this->input->post('booking_id')),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->update_detil_wawancara($detil_data, $dw);
  }

  $data = "ok";
  echo json_encode($data);

}

function get_wawancara($id = NULL){
  $data = $this->project_model->get_detil_wawancara($id);
  echo json_encode($data);
}

function _get_no_wawancara(){
  $last_id = $this->project_model->get_max_id_wawancara();
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
    $id = "0".$noid."/RK-PW/VI/".$tahun;
  }
  else{
    $id = $noid."/RK-PW/VI/".$tahun;
  }
  return $id;
}

function get_pb($id = NULL){
  $data = $this->project_model->get_pb($id);
  echo json_encode($data);
}

function get_wawancara_dokument(){
  $tgl = $this->input->get('tanggal');
  if(!empty($this->project_model->cek_exist_tanggal_wawancara($tgl))){
    $data = array(
      'status' => 'y',
      'id' => $this->project_model->cek_exist_tanggal_wawancara($tgl)
    );
    echo json_encode($data);
  }
  else{
    $data = array(
      'status' => 'n'
    );
    echo json_encode($data);
  }

}

function save_pb(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'db_status'  => $this->input->post('pb_status'),
    'db_date'    => $this->input->post('pb_date')
  );
  $status = ($data['db_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($id === '0'){

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status PENYERAHAN BERKAS menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->save_pb($data);
  }
  else {

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status PENYERAHAN BERKAS menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);


    $this->project_model->update_pb($data, $id);
  }
  $data = "ok";
  echo json_encode($data);
}

function get_ots($id = NULL){
  $data = $this->project_model->get_ots($id);
  echo json_encode($data);
}

function save_ots(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'ots_status'  => $this->input->post('ots_status'),
    'ots_date'    => $this->input->post('ots_date')
  );
  $status = ($data['ots_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($id === '0'){

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status OTS/Survey menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->save_ots($data);
  }
  else {

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status OTS/Survey menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->update_ots($data, $id);
  }
  $data = "ok";
  echo json_encode($data);
}

function get_sp3k($id = NULL){
  $data = $this->project_model->get_sp3k($id);
  echo json_encode($data);
}

function save_sp3k(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'sp3k_status'  => $this->input->post('sp3k_status'),
    'sp3k_date'    => $this->input->post('sp3k_date'),
    'sp3k_no'    => $this->input->post('sp3k_no')
  );
  $status = ($data['sp3k_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($id === '0'){

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status SP3K menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->save_sp3k($data);
  }
  else {

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status SP3K menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->update_sp3k($data, $id);
  }
  $data = "ok";
  echo json_encode($data);
}

function get_lpa($id = NULL){
  $data = $this->project_model->get_detil_lpa($id);
  echo json_encode($data);
}

function save_lpa(){
  $id = $this->input->post('id');
  $rumah_id = $this->input->post('rumah_id');
  $tgl = $this->input->post('lpa_tanggal');

  $ada = $this->project_model->cek_exist_tanggal_lpa($tgl);
  if(!$ada){
      //tambah baru
    $data = array(
      'lpa_tanggal'=> $tgl,
      'rumah_id'   => $rumah_id,
      'booking_id' => $this->input->post('booking_id')
    );

    if($id === "0"){
      $data['lpa_no'] = $this->_get_no_lpa();
      $id_lpa = $this->project_model->lpa_save($data);
    }
    else{
      $this->project_model->lpa_update($data, $id);
      $id_lpa = $id;
    }
  }
  else{
    $id_lpa = $ada;
  }

  $detil_data = array(
    'booking_id' => $this->input->post('booking_id'),
    'lpa_id'=> $id_lpa,
    'dlpa_status'   => $this->input->post('dlpa_status')
  );

  $dw = $this->input->post('dlpa');
  $status = ($detil_data['dlpa_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($dw === '0'){
    $this->project_model->save_detil_lpa($detil_data);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status LPA menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($detil_data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  else{
    $this->project_model->update_detil_lpa($detil_data, $dw);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status LPA menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($detil_data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  $data = "ok";
  echo json_encode($data);

}

function get_lpa_dokument(){
  $tgl = $this->input->get('tanggal');
  if(!empty($this->project_model->cek_exist_tanggal_lpa($tgl))){
    $data = array(
      'status' => 'y',
      'id' => $this->project_model->cek_exist_tanggal_lpa($tgl)
    );
    echo json_encode($data);
  }
  else{
    $data = array(
      'status' => 'n'
    );
    echo json_encode($data);
  }

}

function get_vpajak($id = NULL){
  $data = $this->project_model->get_vpajak($id);
  echo json_encode($data);
}

function save_vpajak(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'vp_status'  => $this->input->post('vp_status'),
    'vp_date'    => $this->input->post('vp_date')
  );
  $status = ($data['vp_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($id === '0'){

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status VALIDASI PAJAK menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->save_vpajak($data);
  }
  else {

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status VALIDASI PAJAK menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->update_vpajak($data, $id);
  }
  $data = "ok";
  echo json_encode($data);
}

function get_detil_akad($id = NULL){
  $data = $this->project_model->get_detil_akad($id);
  echo json_encode($data);
}

function _get_no_akad(){
  $last_id = $this->project_model->get_max_id_akad();
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
    $id = "0".$noid."/RK-PAK/VII/".$tahun;
  }
  else{
    $id = $noid."/RK-PAK/VII/".$tahun;
  }
  return $id;
}

function save_akad(){
  $id = $this->input->post('id');
  $rumah_id = $this->input->post('rumah_id');
  $tgl = $this->input->post('akad_date');

  $ada = $this->project_model->cek_exist_tanggal_akad($tgl);
  if(!$ada){
      //tambah baru
    $data = array(
      'akad_date'=> $tgl,
      'rumah_id' => $rumah_id,
      'booking_id' => $this->input->post('booking_id')
    );

    if($id === "0"){
      $data['akad_no'] = $this->_get_no_akad();
      $id_akad = $this->project_model->akad_save($data);
    }
    else{
      $this->project_model->akad_update($data, $id);
      $id_akad = $id;
    }
  }
  else{
    $id_akad = $ada;
  }

  $detil_data = array(
    'booking_id' => $this->input->post('booking_id'),
    'akad_id'=> $id_akad,
    'ad_status'   => $this->input->post('ad_status')
  );

  $ad = $this->input->post('ad');
  $status = ($detil_data['ad_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($ad === '0'){

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status AKAD menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($detil_data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

    $this->project_model->save_detil_akad($detil_data);
  }
  else{
    $this->project_model->update_detil_akad($detil_data, $ad);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status AKAD menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($detil_data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  $data = "ok";
  echo json_encode($data);

}

function get_akad_dokument(){
  $tgl = $this->input->get('tanggal');
  if(!empty($this->project_model->cek_exist_tanggal_akad($tgl))){
    $data = array(
      'status' => 'y',
      'id' => $this->project_model->cek_exist_tanggal_akad($tgl)
    );
    echo json_encode($data);
  }
  else{
    $data = array(
      'status' => 'n'
    );
    echo json_encode($data);
  }

}

function get_skr($id = NULL){
  $data = $this->project_model->get_skr($id);
  echo json_encode($data);
}

function save_skr(){
  $id = $this->input->post('id');
  $data = array(
    'booking_id' => $this->input->post('booking_id'),
    'skr_status'  => $this->input->post('skr_status'),
    'skr_date'    => $this->input->post('skr_date')
  );
  $status = ($data['skr_status'] == 'y') ? 'SUDAH' : 'BELUM';
  if($id === '0'){
    $this->project_model->save_skr($data);
    $exp = strtotime($data['skr_date']);
    $exprired = strtotime("+100 day", $exp);
    $jaminan = array(
      'booking_id' => $data['booking_id'],
      'jaminan_date'=> $data['skr_date'],
      'jaminan_expired'=> date('Y-m-d', $exprired)
    );

    $this->project_model->save_jaminan($jaminan);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah status SKR menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);


  }
  else {
      //check tanggal jaminan
    if($data['skr_status'] == 'n'){
      $this->project_model->delete_jaminan($data['booking_id']);
    }
    else{
      $exp = strtotime($data['skr_date']);
      $exprired = strtotime("+100 day", $exp);
      $jaminan = array(
        'booking_id' => $data['booking_id'],
        'jaminan_date'=> $data['skr_date'],
        'jaminan_expired'=> date('Y-m-d', $exprired)
      );

      $this->project_model->save_jaminan($jaminan);
    }

    $this->project_model->update_skr($data, $id);

    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'edit',
      'la_uraian' => 'Mengubah status SKR menjadi : '.$status.' untuk NO BOOKING : '.$this->project_model->get_booking_no($data['booking_id']),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->load->model('log_model');
    $this->log_model->save_log_action($log);

  }
  $data = "ok";
  echo json_encode($data);
}

function _get_no_lpa(){
  $last_id = $this->project_model->get_max_id_lpa();
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
    $id = "0".$noid."/RK-LPA/XII/".$tahun;
  }
  else{
    $id = $noid."/RK-LPA/XII/".$tahun;
  }
  return $id;
}


}
