<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('booking_model', 'rumah_model', 'transaksi_model'));
  }

  public function index(){
    redirect('/');
  }

  public function bi_checking_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> BI Checking',
      'sub_header_title' => 'BI Checking',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'bichecking/list', $data);
  }

  public function get_bi_checking_list($perumahan = "all", $status = "all", $dt1 = "0", $dt2 = "0"){
    $this->load->library('Datatables');
    $this->datatables->select('bic_id, tb_booking.booking_id, pelanggan_ktp, pelanggan_nama, rumah_nama, kavling_blok, booking_dp, bic_status, bic_datetime, kavling_blok, booking_no')
         ->join('tb_booking', 'tb_bichecking.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_bichecking.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("bic_status", $status);
     }
     if($dt1 != "0" OR $dt2 != "0"){
       $this->db->where("DATE(bic_datetime) BETWEEN '".$dt1."' AND '".$dt2."'");
     }
     $this->datatables->from('tb_bichecking');
     echo $this->datatables->generate();
  }

  public function change_bichecking_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'bic_status'   => $status,
      'bic_datetime' => date('Y-m-d H:i:s')
    );
    $this->transaksi_model->update_bichecking($data, $id);

    if($status === 'y'){
      $ppjb = array(
        'booking_id' => $booking_id,
        'ppjb_status'=> 'p'
      );
      $this->transaksi_model->save_ppjb($ppjb);

      $booking = array(
        'booking_status' => 'p'
      );
    }
    else{
      $booking = array(
        'booking_status' => 'n'
      );

    }

    $this->booking_model->change_status_booking($booking, $booking_id);
    redirect('dashboard/admin/transaksi/bichecking/list');
  }

  public function ppjb_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> PPJB',
      'sub_header_title' => 'PPJB',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'ppjb/list', $data);
  }

  public function get_ppjb_list($perumahan = "all", $status = "all", $dt1 = "0", $dt2 = "0"){
    $this->load->library('Datatables');
    $this->datatables->select('
        ppjb_id, pelanggan_ktp, pelanggan_nama, rumah_nama, kavling_blok,
        booking_dp, ppjb_status, ppjb_datetime, ppjb_no, tb_ppjb.booking_id, booking_no, rumah_kode
    ')
         ->join('tb_booking', 'tb_ppjb.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_ppjb.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_booking.booking_status", $status);
     }
     if($dt1 != "0" OR $dt2 != "0"){
       $this->db->where("DATE(ppjb_datetime) BETWEEN '".$dt1."' AND '".$dt2."'");
     }
     $this->datatables->from('tb_ppjb');
     echo $this->datatables->generate();
  }

  public function get_laporan_ppjb($id_booking = NULL){
    $this->load->model(array('transaksi_model'));
    $this->load->helper(array('fungsidate_helper'));
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'set' => $this->transaksi_model->get_data_ppjb($id_booking),
    );
    $data['date'] = tgl_indo(date('Y-m-d', strtotime($data['set']->ppjb_date)));
    $data['hari'] = $this->hari_terbilang(date('D', strtotime($data['set']->ppjb_date)));
    $data['tanggal'] = $this->angka_terbilang(date('d', strtotime($data['set']->ppjb_date)));
    $data['bulan'] = $this->bulan_terbilang(date('n', strtotime($data['set']->ppjb_date)));
    $data['tahun'] = $this->angka_terbilang(date('Y', strtotime($data['set']->ppjb_date)));
    $data['lb_terbilang'] = $this->angka_terbilang($data['set']->kavling_lb);
    $data['lt_terbilang'] = $this->angka_terbilang($data['set']->kavling_lt);
    $data['harga_terbilang'] = $this->angka_terbilang($data['set']->kavling_harga);
    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/ppjb', $data);
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('PPJB.pdf',array('Attachment'=>0));

  }

  public function change_ppjb_status($id = NULL, $status = 'n', $kavling_blok = NULL, $booking_id = NULL, $rumah_kode = NULL){
    $data = array(
      'ppjb_status' => $status,
      'ppjb_datetime' => date('Y-m-d H:i:s')
    );
    if($status === "y"){
      $exist = $this->transaksi_model->pjjb_exist($booking_id)->ppjb_no;
      if(empty($exist)){
        if($rumah_kode != NULL){
          $data['ppjb_no'] = urldecode($this->get_no_ppjb($kavling_blok));
        }
      }

      $this->load->model('finance_model');
      $exist = $this->finance_model->pi_check($booking_id);
      if(!$exist){
        $pi = array(
          'booking_id' => $booking_id,
          'pi_status'  => 'p'
        );
        $this->finance_model->save_pi($pi);
      }
    }

    $btnExist = $this->transaksi_model->check_btn($booking_id);
    if(!$btnExist){
      $btn = array(
        'booking_id' => $booking_id,
        'db_status'  => 'p'
      );
      $this->transaksi_model->save_dbtn($btn);

      $booking = array(
        'booking_status' => 'p'
      );
    }

    $this->transaksi_model->update_ppjb($data, $id);
    redirect('dashboard/admin/transaksi/ppjb/list');

  }

  public function kelengkapan_berkas_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Kelengkapan Berkas',
      'sub_header_title' => 'Kelengkapan Berkas',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'kelengkapanberkas/list', $data);
  }

  public function get_kelengkapan_berkas_list($perumahan = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('kelengkapan_id, tb_booking.booking_id, pelanggan_ktp, pelanggan_nama, rumah_nama, kavling_blok, kavling_blok, detil_kelengkapan.booking_id, detil_kelengkapan.pelanggan_id, tb_rumah.rumah_alamat, booking_no')
         ->join('tb_booking', 'detil_kelengkapan.booking_id = tb_booking.booking_id')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_booking.kavling_id = rumah_kavling.kavling_id')
         ->join('tb_pelanggan', 'detil_kelengkapan.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->group_by('detil_kelengkapan.booking_id');
    if($perumahan != "all"){
      $this->db->where('tb_booking.rumah_id', $perumahan);
    }
     $this->datatables->from('detil_kelengkapan');
     echo $this->datatables->generate();
  }

  public function kelengkapan_berkas_edit($booking = NULL, $pelanggan = NULL){
    $data = array(
      'header_title'      => '<i class="fa fa-users"></i> Berkas',
      'sub_header_title'  => 'Berkas',
      'detil'             => $this->transaksi_model->get_berkas_by_id($booking, $pelanggan),
      'set'               => $this->transaksi_model->get_pelanggan_by_berkas($booking)
    );
    $this->backend_render(PATH_BACKEND.'kelengkapanberkas/form', $data);
  }

  function get_kkb(){
    $data = $this->transaksi_model->get_kkb();
    echo json_encode($data);
  }

  public function get_kelengkapan_berkas_data(){
    $this->load->library('Datatables');
    $this->datatables->select('kkb_id, kkb_nama')
         ->from('kategori_kelengkapan_berkas')
         ->order_by('kkb_nama', 'ASC');
    echo $this->datatables->generate();
  }

  function delete_kelengkapan_berkas_data(){
    $id = $this->input->post('id');

    $data = $this->transaksi_model->delete_kelengkapan_berkas_data($id);
    echo json_encode($data);
  }

  function save_kelengkapan_berkas_data(){

    $id = $this->input->post('id');
    $data = array(
      'kkb_nama'  => $this->input->post('pkategori_nama')
    );
    if($id === "0"){
      $this->transaksi_model->save_kelengkapan_berkas_data($data);
    }
    else{
      $this->transaksi_model->update_kelengkapan_berkas_data($data, $id);
    }
    $data = 'y';
    echo json_encode($data);

  }

  public function kelengkapanberkas_save(){
    $pelanggan_id = $this->input->post('pelanggan_id', TRUE);
    $booking_id = $this->input->post('booking_id', TRUE);

    $berkas = $this->input->post('berkas');

    $i = 0;
    foreach ($berkas as $row) {
      $detil = array(
        'pelanggan_id'=> $pelanggan_id,
        'booking_id'=> $booking_id,
        'kkb_id' => $this->input->post('berkas')[$i]
      );
      if(!empty($this->input->post('kelengkapan_id')[$i])){
        $detil['kelengkapan_id'] = $this->input->post('kelengkapan_id')[$i];
        $detil['kkb_id'] = $this->input->post('kkb_id')[$i];
      }
      $detil_data[] = $detil;
      $i++;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['kelengkapan_id'])){
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
      $this->db->insert_batch('detil_kelengkapan', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_kelengkapan', $update, 'kelengkapan_id');
    }

    $this->load->model(array('log_model', 'project_model'));
    $log = array(
      'user_id'   => $this->session->userdata('userid'),
      'la_url'    => $_SERVER['HTTP_REFERER'],
      'la_action' => 'add',
      'la_uraian' => 'Menambah/Mengubah BERKAS untuk NO BOOKING : '.$this->project_model->get_booking_no($booking_id),
      'la_created'=> date('Y-m-d H:i:s')
    );
    $this->log_model->save_log_action($log);

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/booking/detil/'.$booking_id);
  }

  public function kelengkapanberkas_delete($id = NULL, $booking = NULL, $pelanggan = NULL){
    $result = $this->transaksi_model->delete_kelengkapan_berkas($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/admin/transaksi/kelengkapanberkas/edit/'.$booking.'/'.$pelanggan);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/admin/transaksi/kelengkapanberkas/edit/'.$booking.'/'.$pelanggan);
    }
  }

  public function wawancara_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Wawancara',
      'sub_header_title' => 'Wawancara',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'wawancara/list', $data);
  }

  public function get_wawancara_list(){
    $this->load->library('Datatables');
    $this->datatables->select('wawancara_id, wawancara_no, wawancara_perihal, wawancara_tanggal, rumah_nama')
         ->join('tb_rumah', 'tb_wawancara.rumah_id = tb_rumah.rumah_id')
         ->group_by('tb_wawancara.wawancara_no');
     $this->datatables->from('tb_wawancara');
     echo $this->datatables->generate();
  }

  public function wawancara_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Wawancara',
      'sub_header_title' => 'Wawancara',
      'wawancara_no'     => $this->get_no_wawancara()
    );
    $this->backend_render(PATH_BACKEND.'wawancara/form', $data);
  }

  public function wawancara_edit($id = NULL){
    $id_perumahan = $this->transaksi_model->get_data_wawancara($id)->rumah_id;
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Wawancara',
      'sub_header_title' => 'Wawancara',
      'detil'     => $this->transaksi_model->get_detil_wawancara($id),
      'set'       => $this->transaksi_model->get_data_wawancara($id)
    );
    $this->backend_render(PATH_BACKEND.'wawancara/form', $data);

  }

  public function wawancara_save(){
    $id = $this->input->post('id', TRUE);

    $detil_wawancara = '';
    $wawancara = array(
      'wawancara_no'      => $this->input->post('inputNo', TRUE),
      'wawancara_perihal' => $this->input->post('inputPerihal', TRUE),
      'wawancara_tanggal' => $this->input->post('inputTgl', TRUE),
      'rumah_id'          => $this->input->post('rumahID', TRUE)
    );

    if($id === "0"){
      $id_wawancara = $this->transaksi_model->save_wawancara($wawancara);
    }
    else{
      $this->transaksi_model->update_wawancara($wawancara, $id);
      $id_wawancara = $id;
    }

    $detil_wawancara = $this->input->post('inputBooking');
    $i = 0;
    foreach ($detil_wawancara as $row) {
      $detil = array(
        'wawancara_id' => $id_wawancara,
        'booking_id'   => $this->input->post('IDBooking', TRUE)[$i]
      );

      if($id != "0"){
        if(!empty($this->input->post('IDBooking')[$i])){
          $detil['dw_id'] = $this->input->post('IDDWawancara')[$i];
        }
      }

      $i++;
      $detil_data[] = $detil;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['dw_id'])){
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
      $this->db->insert_batch('detil_wawancara', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_wawancara', $update, 'dw_id');
    }

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/admin/transaksi/wawancara/list');
  }

  public function detil_wawancara_delete($id_wawancara = NULL, $id = NULL){
    $result = $this->transaksi_model->detil_wawancara_delete($id_wawancara, $id);

    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/admin/transaksi/wawancara/edit/'.$id_wawancara);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/admin/transaksi/wawancara/edit/'.$id_wawancara);
    }
  }

  public function wawancara_delete($id = NULL){
    $result = $this->transaksi_model->wawancara_delete($id);

    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/admin/transaksi/wawancara/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/admin/transaksi/wawancara/list');
    }
  }

  public function get_laporan_wawancara($id = NULL){
    $this->load->helper('fungsidate_helper');
    $this->load->model(array('transaksi_model'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'detil'     => $this->transaksi_model->get_detil_wawancara($id),
      'set'       => $this->transaksi_model->get_data_wawancara($id),
      'perihal'   => 'Permohonan Wawancara Konsumen '.$this->transaksi_model->get_data_wawancara($id)->rumah_nama
    );
    $data['tanggal'] = tgl_indo(date('Y-m-d', strtotime($data['set']->wawancara_tanggal)));
    $html = $this->load->view(PATH_BACKEND.'laporan/wawancara', $data);
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('wawancara.pdf',array('Attachment'=>0));

    // var_dump($data['detil']);
  }

  public function dbtn_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Kirim Data ke BTN',
      'sub_header_title' => 'Kirim Data ke BTN',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'dbtn/list', $data);
  }

  public function get_dbtn_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('db_id, booking_no, db_status, db_datetime, pelanggan_nama, rumah_nama, kavling_blok, tb_data_btn.booking_id')
         ->join('tb_booking', 'tb_data_btn.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_data_btn.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_data_btn.db_status", $status);
     }
     $this->datatables->from('tb_data_btn');
     echo $this->datatables->generate();
  }

  public function change_dbtn_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'db_status' => $status,
      'db_datetime' => date('Y-m-d H:i:s')
    );

    if($status === "y"){
      $exist = $this->transaksi_model->check_ots($booking_id);
      if(!$exist){
        $ots = array(
          'booking_id' => $booking_id,
          'ots_status' => 'p'
        );
        $this->transaksi_model->save_ots($ots);
      }
    }
    $this->transaksi_model->update_dbtn($data, $id);
    redirect('dashboard/admin/transaksi/kirimdatabtn/list');
  }

  public function ots_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> OTS',
      'sub_header_title' => 'OTS',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'ots/list', $data);
  }

  public function get_ots_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('ots_id, booking_no, ots_status, ots_datetime, pelanggan_nama, rumah_nama, kavling_blok, tb_ots.booking_id')
         ->join('tb_booking', 'tb_ots.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_ots.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_ots.db_status", $status);
     }
     $this->datatables->from('tb_ots');
     echo $this->datatables->generate();
  }

  public function change_ots_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'ots_status'   => $status,
      'ots_datetime' => date('Y-m-d H:i:s')
    );

    if($status === "y"){
      $exist = $this->transaksi_model->check_sp3k($booking_id);
      if(!$exist){
        $sp3k = array(
          'booking_id' => $booking_id,
          'sp3k_status' => 'p'
        );
        $this->transaksi_model->save_sp3k($sp3k);
      }
    }
    $this->transaksi_model->update_ots($data, $id);
    redirect('dashboard/admin/transaksi/ots/list');
  }

  public function sp3k_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> SP3K',
      'sub_header_title' => 'SP3K',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'sp3k/list', $data);
  }

  public function get_sp3k_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('sp3k_id, booking_no, sp3k_status, sp3k_datetime, pelanggan_nama, rumah_nama, kavling_blok, tb_sp3k.booking_id')
         ->join('tb_booking', 'tb_sp3k.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_sp3k.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_sp3k.db_status", $status);
     }
     $this->datatables->from('tb_sp3k');
     echo $this->datatables->generate();
  }

  public function change_sp3k_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'sp3k_status'   => $status,
      'sp3k_datetime' => date('Y-m-d H:i:s')
    );

    if($status === "y"){
      $exist = $this->transaksi_model->check_lpa($booking_id);
      if(!$exist){
        // get_no_lpa
        $lpa = array(
          'booking_id'  => $booking_id,
          'lpa_no'      => $this->get_no_lpa(),
          'lpa_date'    => date('Y-m-d')
        );
        $this->transaksi_model->save_lpa($lpa);
      }
      $exist = $this->transaksi_model->check_vpajak($booking_id);
      if(!$exist){
        // get_no_lpa
        $vpajak = array(
          'booking_id'   => $booking_id,
          'vp_status'    => 'p'
        );
        $this->transaksi_model->save_vpajak($vpajak);
      }
    }
    $this->transaksi_model->update_sp3k($data, $id);
    redirect('dashboard/admin/transaksi/sp3k/list');
  }

  public function lpa_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> LPA',
      'sub_header_title' => 'LPA',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'lpa/list', $data);
  }

  public function get_lpa_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('lpa_id, booking_no, lpa_no, lpa_date, pelanggan_nama, rumah_nama, kavling_blok, tb_lpa.booking_id')
         ->join('tb_booking', 'tb_lpa.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_lpa.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_lpa.db_status", $status);
     }
     $this->datatables->from('tb_lpa');
     echo $this->datatables->generate();
  }

  public function get_laporan_lpa($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'set' => $this->transaksi_model->get_data_lpa($id),
      'detil' => $this->transaksi_model->get_data_detil_lpa($id)
    );
    $data['tanggal'] = tgl_indo(date('Y-m-d'));
    $html = $this->load->view(PATH_BACKEND.'laporan/lpa', $data);
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('lpa.pdf',array('Attachment'=>0));
  }

  public function vpajak_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Validasi Pajak',
      'sub_header_title' => 'Validasi Pajak',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'vpajak/list', $data);
  }

  public function get_vpajak_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('vp_id, booking_no, vp_datetime, vp_status, pelanggan_nama, rumah_nama, kavling_blok, tb_validasi_pajak.booking_id')
         ->join('tb_booking', 'tb_validasi_pajak.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_validasi_pajak.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_validasi_pajak.vp_status", $status);
     }
     $this->datatables->from('tb_validasi_pajak');
     echo $this->datatables->generate();
  }

  public function change_vpajak_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'vp_status'   => $status,
      'vp_datetime' => date('Y-m-d H:i:s')
    );

    if($status === 'y'){
      $exist = $this->transaksi_model->check_skr($booking_id);
      if(!$exist){
        // get_no_lpa
        $skr = array(
          'booking_id'  => $booking_id,
          'skr_status'  => 'n'
        );
        $this->transaksi_model->save_skr($skr);
      }
    }

    $this->transaksi_model->update_vpajak($data, $id);
    redirect('dashboard/admin/transaksi/vpajak/list');
  }

  public function get_laporan_akad($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'set'   => $this->transaksi_model->get_akad_data($id),
      'detil' => $this->transaksi_model->get_detil_akad_data($id)
    );
    $data['tanggal'] = tgl_indo(date('Y-m-d'));
    $html = $this->load->view(PATH_BACKEND.'laporan/akad', $data);
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('akad.pdf',array('Attachment'=>0));
    // $this->load->view(PATH_BACKEND.'laporan/ppjb');

  }

  public function akad_add(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Akad',
      'sub_header_title' => 'Akad',
      'akad_no'          => $this->get_no_akad()
    );
    $this->backend_render(PATH_BACKEND.'akad/form', $data);
  }

  public function akad_edit($id = NULL){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> Akad',
      'sub_header_title' => 'Akad',
      'detil'     => $this->transaksi_model->get_detil_akad($id),
      'set'       => $this->transaksi_model->get_data_akad($id)
    );
    $this->backend_render(PATH_BACKEND.'akad/form', $data);
  }

  public function akad_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> AKAD',
      'sub_header_title' => 'AKAD'
    );
    $this->backend_render(PATH_BACKEND.'akad/list', $data);
  }

  public function get_akad_list(){
    $this->load->library('Datatables');
    $this->datatables->select('akad_id, akad_no, akad_date, rumah_nama, tb_akad.rumah_id')
         ->join('tb_rumah', 'tb_akad.rumah_id = tb_rumah.rumah_id');

     $this->datatables->from('tb_akad');
     echo $this->datatables->generate();
  }

  public function akad_save(){
    $id = $this->input->post('id', TRUE);

    $detil_akad = '';
    $akad = array(
      'akad_no'   => $this->input->post('inputNo', TRUE),
      'akad_date' => $this->input->post('inputTgl', TRUE),
      'rumah_id'  => $this->input->post('rumahID', TRUE)
    );

    if($id === "0"){
      $id_akad = $this->transaksi_model->save_akad($akad);
    }
    else{
      $this->transaksi_model->update_akad($akad, $id);
      $id_akad = $id;
    }

    $detil_akad = $this->input->post('inputBooking');
    $i = 0;
    foreach ($detil_akad as $row) {
      $detil = array(
        'akad_id'      => $id_akad,
        'booking_id'   => $this->input->post('IDBooking', TRUE)[$i]
      );

      if($id != "0"){
        if(!empty($this->input->post('IDBooking')[$i])){
          $detil['ad_id'] = $this->input->post('IDDWawancara')[$i];
        }
      }

      $i++;
      $detil_data[] = $detil;
    }

    $i = 0;
    foreach ($detil_data as $row) {
      if(empty($detil_data[$i]['ad_id'])){
        $baru[] = $detil_data[$i];
      }
      else{
        $update[] = $detil_data[$i];
      }
      $i++;
    }

    if(!empty($baru)){
      echo "baru";
      $this->db->insert_batch('detil_akad', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_akad', $update, 'ad_id');
    }

    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/admin/transaksi/akad/list');

  }

  public function akad_delete($id = NULL){
    $result = $this->transaksi_model->akad_delete($id);

    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/admin/transaksi/akad/list');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/admin/transaksi/akad/list');
    }
  }

  public function skr_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> SKR',
      'sub_header_title' => 'SKR',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'skr/list', $data);
  }

  public function get_skr_list($perumahan = "all", $status = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('skr_id, booking_no, skr_datetime, skr_status, pelanggan_nama, rumah_nama, kavling_blok, tb_skr.booking_id')
         ->join('tb_booking', 'tb_skr.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_skr.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     if($status != "all"){
       $this->db->where("tb_skr.skr_status", $status);
     }
     $this->datatables->from('tb_skr');
     echo $this->datatables->generate();
  }

  public function change_skr_status($id = NULL, $status = 'n', $booking_id = NULL){
    $data = array(
      'skr_status'   => $status,
      'skr_datetime' => date('Y-m-d H:i:s')
    );

    if($status === 'y'){
      $exist = $this->transaksi_model->check_jaminan($booking_id);
      if(!$exist){
        // get_no_lpa
        $skr = array(
          'booking_id'  => $booking_id,
          'jaminan_date'=> date('Y-m-d')
        );
        $date = strtotime("+100 day", time());
        $skr['jaminan_expired'] = date('Y-m-d', $date);
        $this->transaksi_model->save_jaminan($skr);
      }
      $booking = array(
        'booking_status' => 'y'
      );
      $this->booking_model->change_status_booking($booking, $booking_id);
    }
    else{
      $booking = array(
        'booking_status' => 'p'
      );
    }

    $this->booking_model->change_status_booking($booking, $booking_id);
    $this->transaksi_model->update_skr($data, $id);
    redirect('dashboard/admin/transaksi/skr/list');
  }

  public function jaminan_list(){
    $data = array(
      'header_title'     => '<i class="fa fa-users"></i> JAMINAN',
      'sub_header_title' => 'JAMINAN',
      'perumahan'        => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'jaminan/list', $data);
  }

  public function get_jaminan_list($perumahan = "all"){
    $this->load->library('Datatables');
    $this->datatables->select('jaminan_id, booking_no, jaminan_date, jaminan_expired, pelanggan_nama, rumah_nama, kavling_blok, tb_jaminan.booking_id')
         ->join('tb_booking', 'tb_jaminan.booking_id = tb_booking.booking_id')
         ->join('tb_pelanggan', 'tb_booking.pelanggan_id = tb_pelanggan.pelanggan_ktp')
         ->join('tb_rumah', 'tb_booking.rumah_id = tb_rumah.rumah_id')
         ->join('rumah_kavling', 'tb_rumah.rumah_id = rumah_kavling.rumah_id')
         ->group_by('tb_jaminan.booking_id');

     if($perumahan != "all"){
       $this->db->where("tb_booking.rumah_id", $perumahan);
     }
     $this->datatables->from('tb_jaminan');
     echo $this->datatables->generate();
  }

  public function laporan(){
    // $this->load->model(array('sales_model', 'transaksi_model', 'jenis_model'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');
    ob_start();
    $html = $this->load->view(PATH_BACKEND.'laporan/ppjb');
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('ssss.pdf',array('Attachment'=>0));
    // $this->load->view(PATH_BACKEND.'laporan/ppjb');
  }

  public function get_no_akad(){
    // 30/RK-PAK/VII/2016
    $last_id = $this->transaksi_model->get_max_id_akad();
    $last_no_id = explode("/",$last_id);
    $tahun = date('Y');
    $lasttahun = (!empty($last_no_id[3])) ? $last_no_id[3] : $tahun;

    if($tahun <= $lasttahun){
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

  public function get_no_lpa(){
    // 29/RK-LPA/VII/2016
    $last_id = $this->transaksi_model->get_max_id_lpa();
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
      $id = "0".$noid."/RK-LPA/VII/".$tahun;
    }
    else{
      $id = $noid."/RK-LPA/VII/".$tahun;
    }
    return $id;
  }

  //ANDRY
  public function get_no_ppjb($id_rumah = NULL, $kavling = NULL){
    $last_id = $this->transaksi_model->get_max_id_pjjb();

    if(!empty($last_id)){

    }
    else{
      //tidak ada
      echo "tes";
    }


    // $last_id = $this->transaksi_model->get_max_id_pjjb();
    // $last_no_id = explode("/",$last_id);
    // $noid = 0;
    // $tanggal = date('d-m-Y');
    // if($tanggal <= $last_no_id[2]){
    //   $noid = 0;
    //   $noid = $last_no_id[0] + 1;
    // }
    // else{
    //   $noid = 1;
    // }
    // // 001/HNR-A.10/24-07-2015
    // if($noid < 10){
    //   $id = "00".$noid."/HNR-".$kavling_blok."/".$tanggal;
    // }
    // else if($noid < 100){
    //   $id = "0".$noid."/HNR-".$kavling_blok."/".$tanggal;
    // }
    // else{
    //   $id = $noid."/HNR-".$kavling_blok."/".$tanggal;
    // }
    // echo $id;
  }

  public function get_no_wawancara(){
    $last_id = $this->transaksi_model->get_max_id_wawancara();
    $last_no_id = explode("/",$last_id);
    $tahun = date('Y');
    if($tahun <= $last_no_id[3]){
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

  public function bulan_terbilang($x){
    $namaBulan = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    return $namaBulan[$x];
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

  public function angka_terbilang($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->angka_terbilang($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->angka_terbilang($x/10)." puluh". $this->angka_terbilang($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->angka_terbilang($x - 100);
    } else if ($x <1000) {
        $temp = $this->angka_terbilang($x/100) . " ratus" . $this->angka_terbilang($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->angka_terbilang($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->angka_terbilang($x/1000) . " ribu" . $this->angka_terbilang($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->angka_terbilang($x/1000000) . " juta" . $this->angka_terbilang($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->angka_terbilang($x/1000000000) . " milyar" . $this->angka_terbilang(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->angka_terbilang($x/1000000000000) . " trilyun" . $this->angka_terbilang(fmod($x,1000000000000));
    }
    return $temp;
  }

  public function laporan_permohonan_listrik(){
    // $this->load->model(array('sales_model', 'transaksi_model', 'jenis_model'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $html = $this->load->view(PATH_BACKEND.'laporan/permohonan_listrik');
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Surat_Permohonan_Listrik.pdf',array('Attachment'=>0));
    // $this->load->view(PATH_BACKEND.'laporan/ppjb');
  }

  public function laporan_pencairan_imb(){
    // $this->load->model(array('sales_model', 'transaksi_model', 'jenis_model'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $html = $this->load->view(PATH_BACKEND.'laporan/pencairan_imb');
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Surat_Pencairan_IMB.pdf',array('Attachment'=>0));
    // $this->load->view(PATH_BACKEND.'laporan/ppjb');
  }


  public function get_laporan_skr($id_booking = NULL){
    $this->load->model(array('transaksi_model'));
    $this->load->helper(array('fungsidate_helper'));
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'set' => $this->transaksi_model->get_data_skr($id_booking),
    );

    $data['hari'] = $this->hari_terbilang(date('D', strtotime($data['set']->skr_date)));
    $data['tanggal'] = date('d', strtotime($data['set']->skr_date));
    $data['bulan'] = date('m', strtotime($data['set']->skr_date));
    $data['tahun'] = date('Y', strtotime($data['set']->skr_date));
    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/skr', $data);
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('Surat SKR '.strtoupper($data['set']->pelanggan_nama).' Perumahan '.strtoupper($data['set']->rumah_nama).'.pdf',array('Attachment'=>0));

  }

}
