<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerimaan extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('configuration_model', 'penerimaan_model', 'rumah_model', 'rab_model'));
  }

  public function index(){
    redirect('/');
  }

  public function pp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Penerimaan Penjualan',
      'sub_header_title' => 'Daftar Penerimaan Penjualan'
    );
    $this->backend_render(PATH_BACKEND.'pp/list', $data);
  }

  public function get_pp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('penerimaan_id, penerimaan_no, rumah_nama, penerimaan_dari, penerimaan_total, penerimaan_created, penerimaan_modified, penerimaan_tipe')
         ->join('tb_rumah', 'tb_penerimaan.rumah_id = tb_rumah.rumah_id')
         ->where('penerimaan_tipe', 'pp');
    $this->datatables->from('tb_penerimaan');
    echo $this->datatables->generate();
  }

  public function pp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Penerimaan Penjualan',
      'sub_header_title' => 'Tambah Penerimaan Penjualan',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'pp/form', $data);
  }

  public function pp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Penerimaan Penjualan',
      'sub_header_title' => 'Edit Penerimaan Penjualan',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data(),
      'set' => $this->penerimaan_model->get_data_by_id($id),
      'detil' => $this->penerimaan_model->get_detil_data($id)
    );
    $this->backend_render(PATH_BACKEND.'pp/form', $data);
  }

  public function pp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'penerimaan_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'penerimaan_tipe'  => 'pp',
      'penerimaan_dari'=> $this->input->post('inputDari')
    );
    if($id === "0"){
      $data['penerimaan_created'] = date('Y-m-d H:i:s');
      $data['penerimaan_no'] = $this->input->post('inputId');
      $bpt_id = $this->penerimaan_model->save_bpt($data);

    }
    else{
      $data['penerimaan_modified'] = date('Y-m-d H:i:s');
      $this->penerimaan_model->update_bpt($data, $id);
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
        $detil['penerimaan_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['penerimaan_id'] = $bpt_id;
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
      $this->db->insert_batch('detil_penerimaan', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_penerimaan', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/penerimaan/pp/list');
  }

  public function pp_delete($id = NULL){
    $result = $this->penerimaan_model->pp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/pp/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/pp/list/');
    }
  }

  public function delete_pp_detil($id = NULL, $page = NULL){
    $result = $this->penerimaan_model->pp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/pp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/pp/edit/'.$page);
    }
  }

  public function pp_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'KWITANSI PENERIMAAN',
      'detil_kwitansi' => 'Biaya Penerimaan Penjualan',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      // 'set' => $this->penerimaan_model->get_data_by_id($id),
      // 'detil' => $this->penerimaan_model->get_detil_data($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/penerimaan', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_penerimaan.pdf',array('Attachment'=>0));
  }

  public function hpp_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Harga Pokok Penjualan',
      'sub_header_title' => 'Daftar Harga Pokok Penjualan'
    );
    $this->backend_render(PATH_BACKEND.'hpp/list', $data);
  }

  public function get_hpp_data(){
    $this->load->library('Datatables');
    $this->datatables->select('penerimaan_id, penerimaan_no, rumah_nama, penerimaan_dari, penerimaan_total, penerimaan_created, penerimaan_modified, penerimaan_tipe')
         ->join('tb_rumah', 'tb_penerimaan.rumah_id = tb_rumah.rumah_id')
         ->where('penerimaan_tipe', 'hpp');
    $this->datatables->from('tb_penerimaan');
    echo $this->datatables->generate();
  }

  public function hpp_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Harga Pokok Penjualan',
      'sub_header_title' => 'Tambah Harga Pokok Penjualan',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'hpp/form', $data);
  }

  public function hpp_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Harga Pokok Penjualan',
      'sub_header_title' => 'Edit Harga Pokok Penjualan',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data(),
      'set' => $this->penerimaan_model->get_data_by_id($id),
      'detil' => $this->penerimaan_model->get_detil_data($id)
    );
    $this->backend_render(PATH_BACKEND.'hpp/form', $data);
  }

  public function hpp_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'penerimaan_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'penerimaan_tipe'  => 'hpp',
      'penerimaan_dari'=> $this->input->post('inputDari')
    );
    if($id === "0"){
      $data['penerimaan_created'] = date('Y-m-d H:i:s');
      $data['penerimaan_no'] = $this->input->post('inputId');
      $bpt_id = $this->penerimaan_model->save_bpt($data);

    }
    else{
      $data['penerimaan_modified'] = date('Y-m-d H:i:s');
      $this->penerimaan_model->update_bpt($data, $id);
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
        $detil['penerimaan_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['penerimaan_id'] = $bpt_id;
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
      $this->db->insert_batch('detil_penerimaan', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_penerimaan', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/penerimaan/hpp/list');
  }

  public function hpp_delete($id = NULL){
    $result = $this->penerimaan_model->pp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/hpp/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/hpp/list/');
    }
  }

  public function delete_hpp_detil($id = NULL, $page = NULL){
    $result = $this->penerimaan_model->pp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/hpp/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/hpp/edit/'.$page);
    }
  }

  public function hpp_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'KWITANSI PENERIMAAN',
      'detil_kwitansi' => 'Biaya Harga Pokok Penjualan',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->penerimaan_model->get_data_by_id($id),
      'detil' => $this->penerimaan_model->get_detil_data($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/penerimaan', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_penerimaan.pdf',array('Attachment'=>0));
  }

  public function buda_list(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum dan Administrasi',
      'sub_header_title' => 'Daftar Biaya Umum dan Administrasi'
    );
    $this->backend_render(PATH_BACKEND.'buda/list', $data);
  }

  public function get_buda_data(){
    $this->load->library('Datatables');
    $this->datatables->select('penerimaan_id, penerimaan_no, rumah_nama, penerimaan_dari, penerimaan_total, penerimaan_created, penerimaan_modified, penerimaan_tipe')
         ->join('tb_rumah', 'tb_penerimaan.rumah_id = tb_rumah.rumah_id')
         ->where('penerimaan_tipe', 'buda');
    $this->datatables->from('tb_penerimaan');
    echo $this->datatables->generate();
  }

  public function buda_add(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum dan Administrasi',
      'sub_header_title' => 'Tambah Biaya Umum dan Administrasi',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'buda/form', $data);
  }

  public function buda_edit($id = NULL){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Biaya Umum dan Administrasi',
      'sub_header_title' => 'Edit Biaya Umum dan Administrasi',
      'no_kwitansi' => $this->get_no_kwitansi(),
      'rumah' => $this->rumah_model->get_data(),
      'set' => $this->penerimaan_model->get_data_by_id($id),
      'detil' => $this->penerimaan_model->get_detil_data($id)
    );
    $this->backend_render(PATH_BACKEND.'buda/form', $data);
  }

  public function buda_save(){
    $id = $this->input->post('id');
    $data = array(
      'rumah_id' => $this->input->post('inputRumah'),
      'penerimaan_total' => preg_replace('/[^0-9]/', '',$this->input->post('total_jumlah')),
      'penerimaan_tipe'  => 'buda',
      'penerimaan_dari'=> $this->input->post('inputDari')
    );
    if($id === "0"){
      $data['penerimaan_created'] = date('Y-m-d H:i:s');
      $data['penerimaan_no'] = $this->input->post('inputId');
      $bpt_id = $this->penerimaan_model->save_bpt($data);

    }
    else{
      $data['penerimaan_modified'] = date('Y-m-d H:i:s');
      $this->penerimaan_model->update_bpt($data, $id);
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
        $detil['penerimaan_id'] = $id;
        $detil['dp_id'] = $this->input->post('dp_id')[$i];
      }
      else{
        $detil['penerimaan_id'] = $bpt_id;
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
      $this->db->insert_batch('detil_penerimaan', $baru);
    }
    if(!empty($update)){
      $this->db->update_batch('detil_penerimaan', $update, 'dp_id');
    }
    $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_SIMPAN);
    redirect('dashboard/finance/penerimaan/buda/list');
  }

  public function buda_delete($id = NULL){
    $result = $this->penerimaan_model->pp_delete($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/buda/list/');
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/buda/list/');
    }
  }

  public function delete_buda_detil($id = NULL, $page = NULL){
    $result = $this->penerimaan_model->pp_delete_detil($id);
    if($result){
      $this->session->set_flashdata('flashInfo', MESSAGE_BERHASIL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/buda/edit/'.$page);
    }
    else{
      $this->session->set_flashdata('flashInfo', MESSAGE_GAGAL_DIHAPUS);
      redirect('dashboard/finance/penerimaan/buda/edit/'.$page);
    }
  }

  public function buda_print($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
    $this->load->library('dompdf_gen');
    ob_start();
    $data = array(
      'kwitansi' => 'KWITANSI PENERIMAAN',
      'detil_kwitansi' => 'Biaya Umum dan Administrasi',
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->penerimaan_model->get_data_by_id($id),
      'detil' => $this->penerimaan_model->get_detil_data($id),
    );
    $html = $this->load->view(PATH_BACKEND.'kwitansi/penerimaan', $data);
    //Convert to PDF
    $this->dompdf->load_html(ob_get_clean());
    // set paper size
    $paper_size = $this->data['paper_size'];
    $this->dompdf->set_paper($paper_size, 'potrait');
    $this->dompdf->render();

    $this->dompdf->stream('Kwitansi_penerimaan.pdf',array('Attachment'=>0));
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

  function list_penerimaan($id = NULL){
    $this->load->model('project_model');
    $nama_perumahan = $this->project_model->get_project_by_id($id)->rumah_nama;
    $data = array(
      'header_title'      => '<i class="fa fa-money"></i> Penerimaan untuk Perumahan',
      'sub_header_title'  => 'Penerimaan',
      'nama'               => $nama_perumahan
    );
    $this->backend_render(PATH_BACKEND.'penerimaan/list', $data);
  }

  function get_penerimaan_list($id = 'all', $dt1 = "0", $dt2 = "0"){
    $this->load->library('Datatables');
    $this->datatables->select('booking_id, booking_no, pelanggan_nama, kavling_blok, booking_date, harga')
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

  function get_total($id_booking = NULL){
    $data = array(
      'no_booking' => $this->penerimaan_model->detil_booking($id_booking)->booking_no,
      'nama_pelanggan' => $this->penerimaan_model->detil_booking($id_booking)->pelanggan_nama,
      'harga'  => $this->penerimaan_model->detil_booking($id_booking)->harga,
      'total_penerimaan' => $this->penerimaan_model->total_penerimaan($id_booking)
    );
    echo json_encode($data);

  }

  function penerimaan_detil($id = NULL, $id_booking = NULL){
    $this->load->model('project_model');
    $data = array(
      'header_title'      => '<i class="fa fa-money"></i> Detil Penerimaan',
      'sub_header_title'  => 'Penerimaan',
      'set'               => $this->project_model->get_booking_data($id_booking),
      'pelanggan_id'      => $this->project_model->get_booking_data($id_booking)->pelanggan_id,
      'rumah_id'          => $this->project_model->get_booking_data($id_booking)->rumah_id,
      'total_uangmuka'    => $this->penerimaan_model->count_total_uangmuka($id_booking, '3'),
      'total_penerimaanbank' => $this->penerimaan_model->count_total_penerimaanbank($id_booking, '2')
    );
    $this->backend_render(PATH_BACKEND.'penerimaan/detil', $data);
  }

  function bayar_penerimaan($id = NULL, $id_booking = NULL, $id_penerimaan = NULL){
    $this->load->model('project_model');
    $nama_perumahan = $this->project_model->get_booking_data($id_booking)->rumah_nama;
    if($id_penerimaan != NULL){
      $data = array(
        'header_title'      => '<i class="fa fa-money"></i> Penerimaan untuk Perumahan '.$nama_perumahan,
        'sub_header_title'  => 'Edit Penerimaan',
        'set'               => $this->penerimaan_model->get_bayar_penerimaan($id_penerimaan),
        'nama'              => $this->project_model->get_booking_data($id_booking)->pelanggan_nama
      );
    }
    else{
      $data = array(
        'header_title'      => '<i class="fa fa-money"></i> Penerimaan untuk Perumahan '.$nama_perumahan,
        'sub_header_title'  => 'Penerimaan',
        'nama'              => $this->project_model->get_booking_data($id_booking)->pelanggan_nama
      );
    }

    $this->backend_render(PATH_BACKEND.'penerimaan/bayar', $data);
  }

  function save_penerimaan_kategori(){
    $id = $this->input->post('id');
    $data = array(
      'pkategori_nama'  => $this->input->post('pkategori_nama')
    );
    if($id === "0"){
      $this->penerimaan_model->save_penerimaan_kategori($data);
    }
    else{
      $this->penerimaan_model->update_penerimaan_kategori($data, $id);
    }
    $data = 'y';
    echo json_encode($data);
  }

  function get_penerimaan_kategori_list(){
    $this->load->library('Datatables');
    $this->datatables->select('pkategori_id, pkategori_nama')
        ->from('penerimaan_kategori')
        ->where('pkategori_id !=', '1');
    echo $this->datatables->generate();
  }

  function get_penerimaan_kategori($booking_id = NULL){
    $data = $this->penerimaan_model->get_kategori_penerimaan($booking_id);
    echo json_encode($data);
  }

  function get_uraian2($kategori = NULL, $booking_id = NULL){
    if($kategori === '2'){
      $data = $this->penerimaan_model->get_uraian2($kategori, $booking_id);

      echo json_encode($data);
    }
    else if($kategori === '3'){
      $data = $this->penerimaan_model->get_uraian2($kategori, $booking_id);

      echo json_encode($data);
    }
  }

  function get_uraian($kategori = NULL, $booking_id = NULL){
    if($kategori === '2'){
      $data = $this->penerimaan_model->get_uraian($kategori, $booking_id);

      echo json_encode($data);
    }
    else if($kategori === '3'){
      $data = $this->penerimaan_model->get_uraian($kategori, $booking_id);

      echo json_encode($data);
    }
  }

  function delete_penerimaan_kategori($id = NULL){
    $data = $this->penerimaan_model->delete_penerimaan_kategori($id);
    echo json_encode($data);
  }

  function save_pembayaran_penerimaan(){
    $id = $this->input->post('id');
    $booking_id = $this->input->post('booking_id');

    $data = array(
      'penerimaan_no' => $this->get_no_penerimaan($booking_id),
      'booking_id'    => $booking_id,
      'penerimaan_dari'=> $this->input->post('dari'),
      'penerimaan_total'=> preg_replace('/[^0-9]/', '',$this->input->post('total')),
      'penerimaan_uraian'=> $this->input->post('uraian'),
      'penerimaan_tanggal'=> $this->input->post('tanggal'),
      'pkategori_id'  => $this->input->post('kategori')
    );

    if($id === '0'){
      $this->penerimaan_model->save_penerimaan($data);
    }
    else{
      $this->penerimaan_model->update_penerimaan($data, $id);
    }

    redirect('dashboard/penerimaan/detil/'.$this->input->post('project_id').'/'.$data['booking_id'].'/');

  }

  function get_pembayaran_penerimaan($id_booking = NULL, $tipe = NULL){
    $this->load->library('Datatables');
    $this->datatables->select('penerimaan_id, tb_penerimaan.booking_id, penerimaan_no, penerimaan_dari, penerimaan_total, penerimaan_tanggal, penerimaan_uraian, pkategori_nama')
        ->join('penerimaan_kategori', 'tb_penerimaan.pkategori_id = penerimaan_kategori.pkategori_id')
        ->join('tb_booking', 'tb_penerimaan.booking_id = tb_booking.booking_id')
        ->where('tb_penerimaan.booking_id', $id_booking);
    if($tipe === '3'){
      $this->datatables->where('tb_penerimaan.pkategori_id !=', '2');
    }
    else{
      $this->datatables->where('tb_penerimaan.pkategori_id', '2');
    }
    $this->datatables->from('tb_penerimaan');
    echo $this->datatables->generate();
  }

  function kwitansi_penerimaan($id = NULL){
    $this->load->helper(array('fungsidate_helper'));
    set_time_limit(0);
		$this->load->library('dompdf_gen');

    $kategori = $this->penerimaan_model->get_bayar_penerimaan($id)->pkategori_nama;

    ob_start();
    $data = array(
      'kwitansi' => 'KWITANSI PEMBAYARAN',
      'detil_kwitansi' => $kategori,
      'company_name' => $this->configuration_model->get_config('company_name') ? $this->configuration_model->get_config('company_name') : "-",
      'company_address' => $this->configuration_model->get_config('company_address') ? $this->configuration_model->get_config('company_address') : "-",
      'company_email' => $this->configuration_model->get_config('company_email') ? $this->configuration_model->get_config('company_email') : "-",
      'company_phone' => $this->configuration_model->get_config('company_phone') ? $this->configuration_model->get_config('company_phone') : "-",
      'company_website' => $this->configuration_model->get_config('company_website') ? $this->configuration_model->get_config('company_website') : "-",
      'hari'  => $this->hari_terbilang(date('D')),
      'tanggal' => tgl_indo(date('Y-m-d')),
      'set' => $this->penerimaan_model->get_bayar_penerimaan($id)
    );

    $data['tanggal'] = tgl_indo(date('Y-m-d'));
    $html = $this->load->view(PATH_BACKEND.'kwitansi/penerimaan', $data);
    //Convert to PDF
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

		$this->dompdf->stream('penerimaan.pdf',array('Attachment'=>0));
  }

  function delete_penerimaan($id = NULL){

    $data = $this->penerimaan_model->delete_penerimaan($id);
    echo json_encode($data);
  }



}
