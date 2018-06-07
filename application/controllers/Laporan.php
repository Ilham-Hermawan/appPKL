<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller{

  public function __construct(){
    parent::__construct();
    if(!$this->is_logged()){
			$this->session->set_flashdata('flashInfo', MESSAGE_LOGIN_DULU);
		  redirect('/');
		}

    $this->load->model(array('rumah_model', 'pelanggan_model', 'booking_model', 'rab_model'));
    $this->load->library('dompdf_gen');
    $this->load->helper(array('fungsidate_helper'));
  }

  public function index(){
    redirect('/');
  }

  public function list_data_master(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Master',
      'sub_header_title' => 'Laporan Master',
      'perumahan'    => $this->rumah_model->get_data()
    );
    $this->backend_render(PATH_BACKEND.'laporan/master', $data);
  }

  function get_report_pdf_perumahan($rumah = NULL){
    ob_start();
    if($rumah === "all"){
      $data = array(
        'perumahan' => $this->rumah_model->get_data(),
        'judul' => "Daftar Perumahan"
      );
    }
    else{
      $data = array(
        'kavling' => $this->rumah_model->get_detil_by_id($rumah),
        'rumah_nama' => $this->rumah_model->get_data_by_id($rumah)->rumah_nama,
        'judul' => "Daftar Perumahan Kavling"
      );
    }

    $data['tanggal'] = date('d-m-Y');

    //Convert to PDF
    if($rumah === "all"){
      $html = $this->load->view(PATH_BACKEND.'laporan/perumahan', $data);
    }
    else{
      $html = $this->load->view(PATH_BACKEND.'laporan/perumahan_kavling', $data);
    }
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

    if($rumah === "all"){
      $this->dompdf->stream('perumahan.pdf',array('Attachment'=>0));
    }
    else{
      $this->dompdf->stream('perumahan_kavling.pdf',array('Attachment'=>0));
    }

  }

  function get_report_pdf_pelanggan(){
    ob_start();
    $data = array(
      'pelanggan' => $this->pelanggan_model->get_data(),
      'judul' => "Daftar Pelanggan"
    );

    $data['tanggal'] = date('d-m-Y');

    //Convert to PDF

    $html = $this->load->view(PATH_BACKEND.'laporan/pelanggan', $data);

		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'potrait');
		$this->dompdf->render();

    $this->dompdf->stream('pelanggan.pdf',array('Attachment'=>0));

  }

  public function list_data_transaksi(){
    $data = array(
      'header_title' => '<i class="fa fa-users"></i> Transaksi',
      'sub_header_title' => 'Laporan Transaksi',
      'perumahan'    => $this->rumah_model->get_data(),
      // 'rab'          => $this->rab_model->get_rab_data()
    );
    $this->backend_render(PATH_BACKEND.'laporan/transaksi', $data);
  }

  function list_data_booking($dt1 = "all", $dt2 = "all", $perumahan = "all"){
    ob_start();
    $data = array(
      'judul' => "Daftar Booking"
    );

    if($dt1 != "all" AND $dt2 != "all"){
      $data['dt1'] = tgl_indo($dt1);
      $data['dt2'] = tgl_indo($dt2);
    }
    if($perumahan != "all"){
      $data['perumahan'] = $this->rumah_model->get_data_by_id($perumahan)->rumah_nama;
    }

    $data['booking'] = $this->booking_model->get_data($dt1, $dt2, $perumahan);


    $data['tanggal'] = date('Y-m-d');

    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/booking', $data);
    //
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'landscape');
		$this->dompdf->render();

    $this->dompdf->stream('booking.pdf',array('Attachment'=>0));
    // var_dump($data);
  }

  function list_data_booking_status($dt1 = "all", $dt2 = "all", $perumahan = "all"){
    ob_start();
    $data = array(
      'judul'     => "Daftar Booking"
    );

    if($dt1 != "all" AND $dt2 != "all"){
      $data['dt1'] = tgl_indo($dt1);
      $data['dt2'] = tgl_indo($dt2);
    }
    if($perumahan != "all"){
      $data['perumahan'] = $this->rumah_model->get_data_by_id($perumahan)->rumah_nama;
    }

    $data['booking'] = $this->booking_model->get_data($dt1, $dt2, $perumahan);


    $data['tanggal'] = date('Y-m-d');

    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/booking_status', $data);
    //
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'landscape');
		$this->dompdf->render();

    $this->dompdf->stream('booking.pdf',array('Attachment'=>0));
    // var_dump($data);
  }

  function get_report_pdf_pencairan($rumah_id = NULL){
    $this->load->model('laporan_model');

    ob_start();

    $data = array(
      'judul'       => "Laporan Pencairan",
      'perumahan'   => $this->rumah_model->get_data_by_id($rumah_id)->rumah_nama,
      'set'         => $this->laporan_model->get_laporan_pencairan($rumah_id),
    );

    $data['tanggal'] = date('d-m-Y');

    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/pencairan', $data);
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'landscape');
		$this->dompdf->render();

    $canvas = $this->dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(45, 18, 'Printed by : '.$this->auth_model->get_user_by_id($this->session->userdata('userid'))->user_fullname.' at '.date('H:i:s A').' '.tgl_indo(date('Y-m-d')), $font, 6, array(0,0,0));
    $canvas->page_text(758, 18, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    $this->dompdf->stream('Laporan Pencairan per '.$data['tanggal'].'.pdf',array('Attachment'=>0));


  }

  function get_report_pdf_progress_booking($rumah_id = NULL){
    $this->load->model(array('project_model', 'laporan_model', 'transaksi_model'));

    ob_start();

    $data = array(
      'judul'       => "Laporan Progress Booking",
      'perumahan'   => !empty($this->rumah_model->get_data_by_id($rumah_id)->rumah_nama) ? $this->rumah_model->get_data_by_id($rumah_id)->rumah_nama : '',
      'set'         => $this->laporan_model->get_laporan_progress_booking($rumah_id),
    );

    $data['tanggal'] = date('d-m-Y');

    //Convert to PDF
    $html = $this->load->view(PATH_BACKEND.'laporan/progress', $data);
		$this->dompdf->load_html(ob_get_clean());
		// set paper size
    $paper_size = $this->data['paper_size'];
		$this->dompdf->set_paper($paper_size, 'portrait');
		$this->dompdf->render();

    $canvas = $this->dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "normal");
    $canvas->page_text(45, 18, 'Printed by : '.$this->auth_model->get_user_by_id($this->session->userdata('userid'))->user_fullname.' at '.date('H:i:s a').' '.tgl_indo(date('Y-m-d')), $font, 6, array(0,0,0));
    $canvas->page_text(520, 18, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    $this->dompdf->stream('Laporan Progress Booking per '.$data['tanggal'].'.pdf',array('Attachment'=>0));

  }


}
