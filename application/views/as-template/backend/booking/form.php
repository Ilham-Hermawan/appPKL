
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header content-header-default">
    <h1 style="font-size:28px;">
      <?= $data['header_title'] ?>
      <?php if(!empty($data['sub_header_title'])):  ?>
      <small>/ <?= $data['sub_header_title'] ?></small>
      <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li class="active">Booking</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      $id = !empty($data['set']->booking_id) ? $data['set']->booking_id : "0";
      $kavling = !empty($data['set']->kavling_id) ? $data['set']->kavling_id : "0";
      $rumah_id = !empty($data['set']->rumah_id) ? $data['set']->rumah_id : "0";
      $pelanggan_id = !empty($data['set']->pelanggan_id) ? $data['set']->pelanggan_id : "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open("dashboard/booking/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <?= form_hidden('kavling_id', $kavling); ?>
    <?= form_hidden('rumah_id', $rumah_id); ?>
    <?= form_hidden('pelanggan_id', $pelanggan_id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="text-center">
          <h2 class="page-header">BOOKING</h2>
        </div>

        <div class="callout callout-info">
          <h4 style="margin:0"><i class="fa fa-home"></i> DATA PERUMAHAN</h4>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <?php
                $atrPerumahan = array(
                  'type'        => 'text',
                  'id'          => 'inputPerumahan',
                  'name'        => 'inputPerumahan',
                  'class'       => 'form-control',
                  'placeholder' => 'Nama Lengkap',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'readonly'    => 'true',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputPerumahan')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Nama Perumahan', 'inputPerumahan'); ?>
                  <?= form_input($atrPerumahan); ?>
                  <?php if(form_error('inputPerumahan')){ echo form_error('inputPerumahan', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrAlamat = array(
                  'type'        => 'text',
                  'id'          => 'inputAlamat',
                  'name'        => 'inputAlamat',
                  'class'       => 'form-control',
                  'placeholder' => 'Alamat',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'rows'        => '3',
                  'readonly'    => 'true',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputAlamat')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Alamat Perumahan', 'inputAlamat'); ?>
                  <?= form_textarea($atrAlamat); ?>
                  <?php if(form_error('inputAlamat')){ echo form_error('inputAlamat', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrDesa = array(
                  'type'        => 'text',
                  'id'          => 'inputDesa',
                  'name'        => 'inputDesa',
                  'class'       => 'form-control',
                  'placeholder' => 'Desa',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'readonly'    => 'true',
                  'value'       => !empty($data['set']->rumah_desa) ? $data['set']->rumah_desa : set_value('inputDesa')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Desa', 'inputDesa'); ?>
                  <?= form_input($atrDesa); ?>
                  <?php if(form_error('inputDesa')){ echo form_error('inputDesa', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrKecamatan = array(
                  'type'        => 'text',
                  'id'          => 'inputKecamatan',
                  'name'        => 'inputKecamatan',
                  'class'       => 'form-control',
                  'placeholder' => 'Kecamatan',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'readonly'    => 'true',
                  'value'       => !empty($data['set']->rumah_kecamatan) ? $data['set']->rumah_kecamatan : set_value('inputKecamatan')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Kecamatan', 'inputKecamatan'); ?>
                  <?= form_input($atrKecamatan); ?>
                  <?php if(form_error('inputKecamatan')){ echo form_error('inputKecamatan', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrKota = array(
                  'type'        => 'text',
                  'id'          => 'inputKota',
                  'name'        => 'inputKota',
                  'class'       => 'form-control',
                  'placeholder' => 'Kota',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'readonly'    => 'true',
                  'value'       => !empty($data['set']->rumah_kota) ? $data['set']->rumah_kota : set_value('inputKota')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Kota', 'inputKota'); ?>
                  <?= form_input($atrKota); ?>
                  <?php if(form_error('inputKota')){ echo form_error('inputKota', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrProvinsi = array(
                  'type'        => 'text',
                  'id'          => 'inputProvinsi',
                  'name'        => 'inputProvinsi',
                  'class'       => 'form-control',
                  'placeholder' => 'Provinsi',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'readonly'    => 'true',
                  'value'       => !empty($data['set']->rumah_provinsi) ? $data['set']->rumah_provinsi : set_value('inputProvinsi')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Provinsi', 'inputProvinsi'); ?>
                  <?= form_input($atrProvinsi); ?>
                  <?php if(form_error('inputProvinsi')){ echo form_error('inputProvinsi', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->



          </div><!--end col-md-6-->

          <div class="col-md-6" style="border-left:1px solid rgba(207, 207, 207, 0.5);padding-left:30px;">

            <div class="form-group">
              <?php
                $atrNoKavling = array(
                  'type'        => 'text',
                  'id'          => 'inputNoKavling',
                  'name'        => 'inputNoKavling',
                  'class'       => 'form-control input-lg',
                  'placeholder' => 'No Kavling',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'readonly'    => 'true',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->kavling_blok) ? $data['set']->kavling_blok : set_value('inputNoKavling')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('No Kavling', 'inputNoKavling'); ?>
                  <?= form_input($atrNoKavling); ?>
                  <?php if(form_error('inputNoKavling')){ echo form_error('inputNoKavling', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                  <?php
                    $atrLb = array(
                      'type'        => 'text',
                      'id'          => 'inputLb',
                      'name'        => 'inputLb',
                      'class'       => 'form-control',
                      'placeholder' => 'LB',
                      'autocomplete'=> 'off',
                      'required'    => 'required',
                      'readonly'    => 'true',
                      'value'       => !empty($data['set']->kavling_lb) ? $data['set']->kavling_lb : set_value('inputLb')
                    );
                  ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <?= form_label('LB', 'inputLb'); ?>
                      <?= form_input($atrLb); ?>
                      <?php if(form_error('inputLb')){ echo form_error('inputLb', '<div class="text-danger">', '</div>'); }?>
                    </div>
                  </div>
                </div><!--end form-group-->
                <div class="form-group">
                  <?php
                    $atrTipe = array(
                      'type'        => 'text',
                      'id'          => 'inputTipe',
                      'name'        => 'inputTipe',
                      'class'       => 'form-control',
                      'placeholder' => 'Tipe',
                      'autocomplete'=> 'off',
                      'required'    => 'required',
                      'readonly'    => 'true',
                      'value'       => !empty($data['set']->kavling_tipe) ? $data['set']->kavling_tipe : set_value('inputTipe')
                    );
                  ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <?= form_label('Tipe', 'inputTipe'); ?>
                      <?= form_input($atrTipe); ?>
                      <?php if(form_error('inputTipe')){ echo form_error('inputTipe', '<div class="text-danger">', '</div>'); }?>
                    </div>
                  </div>
                </div><!--end form-group-->

              </div>

              <div class="col-md-6">

                <div class="form-group">
                  <?php
                    $atrLt = array(
                      'type'        => 'text',
                      'id'          => 'inputLt',
                      'name'        => 'inputLt',
                      'class'       => 'form-control',
                      'placeholder' => 'LT',
                      'autocomplete'=> 'off',
                      'required'    => 'required',
                      'readonly'    => 'true',
                      'value'       => !empty($data['set']->kavling_lt) ? $data['set']->kavling_lt : set_value('inputLt')
                    );
                  ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <?= form_label('LT', 'inputLt'); ?>
                      <?= form_input($atrLt); ?>
                      <?php if(form_error('inputLt')){ echo form_error('inputLt', '<div class="text-danger">', '</div>'); }?>
                    </div>
                  </div>
                </div><!--end form-group-->
                <div class="form-group">
                  <?php
                    $atrHarga = array(
                      'type'        => 'text',
                      'id'          => 'inputHarga',
                      'name'        => 'inputHarga',
                      'class'       => 'form-control harga',
                      'placeholder' => 'Rp. 0',
                      'autocomplete'=> 'off',
                      'required'    => 'required',
                      'readonly'    => 'true',
                      'value'       => !empty($data['set']->kavling_harga) ? $data['set']->kavling_harga : set_value('inputHarga')
                    );
                  ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <?= form_label('Harga', 'inputHarga'); ?>
                      <?= form_input($atrHarga); ?>
                      <?php if(form_error('inputHarga')){ echo form_error('inputHarga', '<div class="text-danger">', '</div>'); }?>
                    </div>
                  </div>
                </div><!--end form-group-->

              </div>

            </div>

            <div class="form-group">
              <?php
                $atrTandaJadi = array(
                  'type'        => 'text',
                  'id'          => 'inputTandaJadi',
                  'name'        => 'inputTandaJadi',
                  'class'       => 'form-control input-lg harga',
                  'placeholder' => 'Rp. 0',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'readonly'    => 'true',
                  'value'       => '500000'
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Tanda Jadi', 'inputTandaJadi'); ?>
                  <?= form_input($atrTandaJadi); ?>
                  <?php if(form_error('inputTandaJadi')){ echo form_error('inputTandaJadi', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

          </div><!--end col-md-6-->

        </div><!--end row-->
        <hr/>
        <div style="margin-top:30px;" class="callout callout-info">
          <h4 style="margin:0"><i class="fa fa-user"></i> DATA PELANGGAN</h4>
        </div>

        <div class="row">

          <div class="col-md-6">

            <div class="form-group">
              <?php
                $atrNama = array(
                  'type'        => 'text',
                  'id'          => 'inputNama',
                  'name'        => 'inputNama',
                  'class'       => 'form-control',
                  'placeholder' => 'Nama Lengkap',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_nama) ? $data['set']->pelanggan_nama : set_value('inputNama')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Nama Lengkap', 'inputNama'); ?>
                  <?= form_input($atrNama); ?>
                  <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrKtp = array(
                  'type'        => 'text',
                  'id'          => 'inputKtp',
                  'name'        => 'inputKtp',
                  'class'       => 'form-control',
                  'placeholder' => 'No. KTP',
                  'maxlength'   => "16",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_ktp) ? $data['set']->pelanggan_ktp : set_value('inputKtp')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('No. KTP', 'inputKtp'); ?>
                  <?= form_input($atrKtp); ?>
                  <?php if(form_error('inputKtp')){ echo form_error('inputKtp', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrAlamat1 = array(
                  'type'        => 'text',
                  'id'          => 'inputAlamat1',
                  'name'        => 'inputAlamat1',
                  'class'       => 'form-control',
                  'placeholder' => 'Alamat Rumah',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'rows'        => '4',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_alamat) ? $data['set']->pelanggan_alamat : set_value('inputAlamat1')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Alamat Rumah', 'inputAlamat1'); ?>
                  <?= form_textarea($atrAlamat1); ?>
                  <?php if(form_error('inputAlamat1')){ echo form_error('inputAlamat1', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrAlamat2 = array(
                  'type'        => 'text',
                  'id'          => 'inputAlamat2',
                  'name'        => 'inputAlamat2',
                  'class'       => 'form-control',
                  'placeholder' => 'Alamat Surat',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'rows'        => '4',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_alamat_surat) ? $data['set']->pelanggan_alamat_surat : set_value('inputAlamat2')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Alamat Surat', 'inputAlamat2'); ?>
                  <?= form_textarea($atrAlamat2); ?>
                  <?php if(form_error('inputAlamat2')){ echo form_error('inputAlamat2', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

          </div><!--end col-md-6-->

          <div class="col-md-6" style="border-left:1px solid rgba(207, 207, 207, 0.5);padding-left:15px;">

            <div class="form-group">
              <?php
                $pelanggan_agama = isset($data['set']->pelanggan_agama) ? $data['set']->pelanggan_agama : set_value('inputAgama');
                if(!empty($data['agama'])){
                  foreach($data['agama'] as $row){
                    $inputAgama[$row->agama_id] = $row->agama_nama;
                  }
                }
              ?>
              <div class="row">
                <div class="col-sm-8">
                  <?= form_label('Agama', 'inputAgama'); ?>
                  <?= form_dropdown('inputAgama', $inputAgama, $pelanggan_agama, 'class="form-control"'); ?>
                  <?php if(form_error('inputAgama')){ echo form_error('inputAgama', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrTtl = array(
                  'type'        => 'text',
                  'id'          => 'inputTtl',
                  'name'        => 'inputTtl',
                  'class'       => 'form-control',
                  'placeholder' => 'Jakarta, 17 Agustus 1945',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_ttl) ? $data['set']->pelanggan_ttl : set_value('inputTtl')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Tempat, Tanggal Lahir Pelanggan', 'inputTtl'); ?>
                  <?= form_input($atrTtl); ?>
                  <?php if(form_error('inputTtl')){ echo form_error('inputTtl', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $pelanggan_jk = isset($data['set']->pelanggan_jk) ? $data['set']->pelanggan_jk : set_value('inputJk');
                $inputJk = array(
                  'l' => 'LAKI-LAKI',
                  'p' => 'PEREMPUAN'
                );
              ?>
              <div class="row">
                <div class="col-sm-8">
                  <?= form_label('Jenis Kelamin', 'inputJk'); ?>
                  <?= form_dropdown('inputJk', $inputJk, $pelanggan_jk, 'class="form-control"'); ?>
                  <?php if(form_error('inputJk')){ echo form_error('inputJk', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrKontak = array(
                  'type'        => 'text',
                  'id'          => 'inputKontak',
                  'name'        => 'inputKontak',
                  'class'       => 'form-control',
                  'placeholder' => 'No. Kontak',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_kontak) ? $data['set']->pelanggan_kontak : set_value('inputKontak')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('No. Kontak', 'inputKontak'); ?>
                  <?= form_input($atrKontak); ?>
                  <?php if(form_error('inputKontak')){ echo form_error('inputKontak', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <?php
                $atrPekerjaan = array(
                  'type'        => 'text',
                  'id'          => 'inputPekerjaan',
                  'name'        => 'inputPekerjaan',
                  'class'       => 'form-control',
                  'placeholder' => 'Pekerjaan',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->pelanggan_pekerjaan) ? $data['set']->pelanggan_pekerjaan : set_value('inputPekerjaan')
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Pekerjaan', 'inputPekerjaan'); ?>
                  <?= form_input($atrPekerjaan); ?>
                  <?php if(form_error('inputPekerjaan')){ echo form_error('inputPekerjaan', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

          </div><!--end col-md-6-->

        </div><!--end row-->

        <hr/>
        <div style="margin-top:30px;" class="callout callout-info">
          <h4 style="margin:0"><i class="fa fa-book"></i> DATA BOOKING</h4>
        </div>

        <div class="row">
          <div class="col-md-6">

            <div class="form-group">
              <?php
                $atrBooking = array(
                  'type'        => 'text',
                  'id'          => 'inputBooking',
                  'name'        => 'inputBooking',
                  'class'       => 'form-control',
                  'placeholder' => 'No. Booking',
                  'maxlength'   => "255",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->booking_no) ? $data['set']->booking_no : 'auto'
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('No. Booking', 'inputBooking'); ?>
                  <?= form_input($atrBooking); ?>
                  <span class="help-block">Isi dengan <strong>auto</strong> jika ingin menggunakan nomor otomatis</span>
                  <?php if(form_error('inputBooking')){ echo form_error('inputBooking', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

          </div><!--end col-md-6-->

          <div class="col-md-6">

            <div class="form-group">
              <?php
                $atrTanggal = array(
                  'type'        => 'text',
                  'id'          => 'inputTanggal',
                  'name'        => 'inputTanggal',
                  'class'       => 'form-control',
                  'placeholder' => 'No. Tanggal',
                  'maxlength'   => "10",
                  'data-date-format'=> 'yyyy-mm-dd',
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->booking_date) ? $data['set']->booking_date : date("Y-m-d")
                );
              ?>
              <div class="row">
                <div class="col-sm-12">
                  <?= form_label('Tanggal', 'inputTanggal'); ?>
                  <?= form_input($atrTanggal); ?>
                  <?php if(form_error('inputTanggal')){ echo form_error('inputTanggal', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

          </div><!--end col-md-6-->

        </div><!--end row-->

        <!-- START CUSTOM TABS -->

      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">

          <a href="<?php echo site_url('dashboard/project/tersedia/'.$this->uri->segment(4)); ?>" title="Back" class="btn btn-default">Kembali</a>
          <button type="submit" class="btn btn-primary" id="btnID">
            <img src="<?= site_url(IMAGES_WEB.'loading_2.svg'); ?>" id="img-loading" style="margin-right:0.5em;height:10px;">
            <span id="sign-in">Simpan Data</span>
          </button>

        </div>
      </div>
    </div><!-- /.box -->
    <?= form_close(); ?>


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>

  $(window).load(function(){
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $("#img-loading").hide();
    $("#sign-in").show();
    $(".select2").select2();
    $( "#inputDp" ).priceFormat(rupiah);
    $( ".harga" ).priceFormat(rupiah);

    $('#inputTanggal').datepicker({
      autoclose: true
    });



    $('form#form').submit(function(){
      document.getElementById("btnID").disabled = true;
      $('#img-loading').show();
      $('#sign-in').hide();
    });


    load_ktp();
    hitung_pengajuan_kpr();

    $( "#inputRumah" ).change(function() {
      $.ajax({
        url: "<?= site_url('rumah/get_data_json'); ?>",
        data: { id: $( "#inputRumah" ).val()},
        dataType: "json",
        type: "POST",
        success: function(data){
          $( "#rumah_id" ).val(data.rumah_id);
          $( "#inputAlamatRumah" ).val(data.rumah_alamat);
          $( "#inputDesa" ).val(data.rumah_desa);
          $( "#inputKecamatan" ).val(data.rumah_kecamatan);
          $( "#inputKota" ).val(data.rumah_kota);
          $( "#inputProvinsi" ).val(data.rumah_provinsi);
        }
      });

      var url = "<?= site_url('rumah/add_ajax_kavling');?>/"+$(this).val();
      $('#inputNo').load(url);
      return false;

    });

    $('#inputNo').change(function() {
      $.ajax({
        url: "<?= site_url('rumah/get_data_kavling_json'); ?>",
        data: { id: $("#inputNo").val()},
        dataType: "json",
        type: "POST",
        success: function(data){
          $( "#kavling_id" ).val(data.kavling_id);
          $( "#inputLb" ).val(data.kavling_lb);
          $( "#inputLt" ).val(data.kavling_lt);
          $( "#inputTipe" ).val(data.kavling_tipe);
          $( "#inputHarga" ).val(data.kavling_harga);
          $( "#inputHarga" ).priceFormat(rupiah);

          $( "#inputDp" ).val('');
          $( "#inputKpr" ).val('');
          $("[id$=inputDp]").focus();
        }
      });
    });

    $('#inputKtpLama').change(function() {
      $( "#inputKtpBaru" ).val('');
      $( "#inputNamaBaru" ).val('');
      $( "#inputAlamatBaru" ).val('');
      $( "#inputJkBaru" ).val('');
      $( "#inputPekerjaanBaru" ).val('');
      $( "#inputKontakBaru" ).val('');

      $.ajax({
        url: "<?= site_url('pelanggan/get_data_pelanggan_json'); ?>",
        data: { id: $("#inputKtpLama").val()},
        dataType: "json",
        type: "POST",
        success: function(data){
          $( "#id" ).val(data.pelanggan_ktp);
          $( "#inputNamaLama" ).val(data.pelanggan_nama);
          $( "#inputAlamatLama" ).val(data.pelanggan_alamat);
          var jk = '';
          if(data.pelanggan_jk === "p"){
            jk = "PEREMPUAN";
          }
          else{
            jk = "LAKI-LAKI";
          }
          $( "#inputJkLama" ).val(jk);
          $( "#inputPekerjaanLama" ).val(data.pelanggan_pekerjaan);
          $( "#inputKontakLama" ).val(data.pelanggan_kontak);
        }
      });
    });

    $('#inputDp').keyup(function() {
      var kpr = 0;
      kpr = parseInt($( "#inputHarga" ).unmask()) - parseInt($( "#inputDp" ).unmask());
      $( "#inputKpr" ).val(kpr);
      $( "#inputKpr" ).priceFormat(rupiah);
    });

    $("#formRumah").validate({
      rules: {
        inputNama: {
          required: true,
          maxlength:255
        },
        inputAlamat: {
          required: true
        }
      },
      messages: {
        inputNama: {
          required: "Nama Perumahan tidak boleh kosong",
          maxlength: "Batas maksimal 255 karakter"
        },
        inputAlamat: {
          required: "Alamat Perumahan tidak boleh kosong"
        }
      }
    });

    function load_ktp(){
      var url = "<?= site_url('pelanggan/add_ajax_pelanggan');?>";
      $('#inputKtpLama').load(url);
      return false;
    }

    function hitung_pengajuan_kpr(){
      var harga = $('#inputHarga').val().replace(/[^0-9]/gi, '');
      var tandajadi = 500000;
      var total = 0;
      total = parseInt(harga) - parseInt(tandajadi);
      $('#inputPengajuan').val(total);
      $( ".harga" ).priceFormat(rupiah);
    }

  });
</script>
