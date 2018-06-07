
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
      <li><a href="<?= site_url('dashboard/rumah/list'); ?>">Rumah</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->rumah_id) ? $id = $data['set']->rumah_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formRumah'
      );
    ?>
    <?= form_open("dashboard/booking/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <!-- START CUSTOM TABS -->
          <h2 class="page-header"><?= $data['sub_header_title'] ?></h2>
          <div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">DATA PELANGGAN</a></li>
                  <li><a href="#tab_2" data-toggle="tab">KELENGKAPAN</a></li>
                  <li><a href="#tab_3" data-toggle="tab">BOOKING</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">

                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-11">
                              <?= form_label('No. KTP', 'inputKtpLama'); ?>
                              <select id="inputKtpLama" name="inputKtpLama" class="form-control select2" style="width:100% !important;" required="required">
                              </select>
                              <input type="hidden" name="id" id="id">
                              <?php if(form_error('inputKtpLama')){ echo form_error('inputKtpLama', '<div class="text-danger">', '</div>'); }?>
                            </div>
                          </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                          <?php
                            $atrNamaLama = array(
                              'type'        => 'text',
                              'id'          => 'inputNamaLama',
                              'name'        => 'inputNamaLama',
                              'class'       => 'form-control',
                              'placeholder' => 'Nama Lengkap',
                              'maxlength'   => "255",
                              'autocomplete'=> 'off',
                              'readonly'    => 'true',
                              'required'    => 'required',
                              'value'       => set_value('inputNamaLama')
                            );
                          ?>
                          <div class="row">
                            <div class="col-sm-11">
                              <?= form_label('Nama Lengkap', 'inputNamaLama'); ?>
                              <?= form_input($atrNamaLama); ?>
                              <?php if(form_error('inputNamaLama')){ echo form_error('inputNamaLama', '<div class="text-danger">', '</div>'); }?>
                            </div>
                          </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                          <?php
                            $atrAlamatLama = array(
                              'type'        => 'text',
                              'id'          => 'inputAlamatLama',
                              'name'        => 'inputAlamatLama',
                              'class'       => 'form-control',
                              'placeholder' => 'Alama Pelanggan',
                              'autocomplete'=> 'off',
                              'maxlength'   => '255',
                              'readonly'    => 'true',
                              'rows'        => '4',
                              'required'    => 'required',
                              'value'       => set_value('inputAlamatLama')
                            );
                          ?>
                          <div class="row">
                            <div class="col-sm-11">
                              <?= form_label('Alamat Pelanggan', 'inputAlamatLama'); ?>
                              <?= form_textarea($atrAlamatLama); ?>
                              <?php if(form_error('inputAlamatLama')){ echo form_error('inputAlamatLama', '<div class="text-danger">', '</div>'); }?>
                            </div>
                          </div>
                        </div><!--end form-group-->

                      </div><!--end col-md-6-->
                      <div class="col-md-7">
                        <div style="border-left:1px solid rgba(207, 207, 207, 0.5);padding-left:30px;">
                          <div class="form-group">
                            <?php
                              $inputJkLama = array(
                                'type'        => 'text',
                                'id'          => 'inputJkLama',
                                'name'        => 'inputJkLama',
                                'class'       => 'form-control',
                                'placeholder' => 'Jenis Kelamin',
                                'readonly'    => 'true',
                                'readonly'    => 'true',
                                'autocomplete'=> 'off',
                                'required'    => 'required',
                                'value'       => set_value('inputJkLama')
                              );
                            ?>
                            <div class="row">
                              <div class="col-sm-6">
                                <?= form_label('Jenis Kelamin', 'inputJkLama'); ?>
                                <?= form_input($inputJkLama); ?>
                                <?php if(form_error('inputJkLama')){ echo form_error('inputJkLama', '<div class="text-danger">', '</div>'); }?>
                              </div>
                            </div>
                          </div><!--end form-group-->
                          <div class="form-group">
                            <?php
                            $atrKontakLama = array(
                              'type'        => 'text',
                              'id'          => 'inputKontakLama',
                              'name'        => 'inputKontakLama',
                              'class'       => 'form-control',
                              'placeholder' => 'Kontak',
                              'maxlength'   => "50",
                              'readonly'    => 'true',
                              'autocomplete'=> 'off',
                              'required'    => 'required',
                              'value'       => set_value('inputKontakLama')
                            );
                            ?>
                            <div class="row">
                              <div class="col-sm-9">
                                <?= form_label('Kontak', 'inputKontakLama'); ?>
                                <?= form_input($atrKontakLama); ?>
                                <?php if(form_error('inputKontakLama')){ echo form_error('inputKontakLama', '<div class="text-danger">', '</div>'); }?>
                              </div>
                            </div>
                          </div><!--end form-group-->
                          <div class="form-group">
                            <?php
                            $atrPekerjaanLama = array(
                              'type'        => 'text',
                              'id'          => 'inputPekerjaanLama',
                              'name'        => 'inputPekerjaanLama',
                              'class'       => 'form-control',
                              'placeholder' => 'Pekerjaan',
                              'maxlength'   => "255",
                              'autocomplete'=> 'off',
                              'readonly'    => 'true',
                              'required'    => 'required',
                              'value'       => set_value('inputPekerjaanLama')
                            );
                            ?>
                            <div class="row">
                              <div class="col-sm-9">
                                <?= form_label('Pekerjaan', 'inputPekerjaanLama'); ?>
                                <?= form_input($atrPekerjaanLama); ?>
                                <?php if(form_error('inputPekerjaanLama')){ echo form_error('inputPekerjaanLama', '<div class="text-danger">', '</div>'); }?>
                              </div>
                            </div>
                          </div><!--end form-group-->

                        </div>
                      </div><!--end col-md-6-->
                    </div><!--end row-->
                  </div>
                  <div class="tab-pane" id="tab_2">

                    <div class="row">
                      <div class="col-md-6">

                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy KTP Suami/Istri"> Fotocopy KTP Suami/Istri<br>
                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy Surat Nikah"> Fotocopy Surat Nikah<br>
                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy Surat Keluarga"> Fotocopy Surat Keluarga<br>
                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy NPWP"> Fotocopy NPWP<br>
                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy Rekening Bank 3 Bulan Terakhir"> Fotocopy Rekening Bank 3 Bulan Terakhir<br>
                        <input type="checkbox" name="kelengkapan[]" value="Fotocopy Tabungan Bank BTN"> Fotocopy Tabungan Bank BTN<br>
                      </div><!--end col-md-6-->
                      <div class="col-md-6">
                      </div><!--end col-md-6-->
                    </div>


                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="tab_3">

                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                          <?php
                            $atrNoBooking = array(
                              'type'        => 'text',
                              'id'          => 'inputNoBooking',
                              'name'        => 'inputNoBooking',
                              'class'       => 'form-control',
                              'placeholder' => 'No Booking',
                              'autocomplete'=> 'off',
                              'required'    => 'required',
                              'value'       => 'auto'
                            );
                          ?>
                          <div class="row">
                            <div class="col-sm-12">
                              <?= form_label('No Booking', 'inputNoBooking'); ?>
                              <?= form_input($atrNoBooking); ?>
                              <?php if(form_error('inputNoBooking')){ echo form_error('inputNoBooking', '<div class="text-danger">', '</div>'); }?>
                              <span class="help-block">Tulis <strong>auto</strong> untuk penomoran otomatis</span>
                            </div>
                          </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                          <?php
                            $rumah_id = !empty($data['set']->pelanggan_jk) ? $data['set']->pelanggan_jk : set_value('inputJk');
                            $inputPerumahan[''] = '-Pilih Perumahan-';
                            if(!empty($data['perumahan'])){
                              foreach($data['perumahan'] as $row){
                                $inputPerumahan[$row->rumah_id] = $row->rumah_nama;
                              }
                            }

                          ?>
                          <div class="row">
                            <div class="col-sm-12">
                              <?= form_label('Perumahan', 'inputRumah'); ?>
                              <?= form_dropdown('inputRumah', $inputPerumahan, $rumah_id, 'id="inputRumah" class="form-control select2" style="width:100% !important;"'); ?>
                              <input type="hidden" name="rumah_id" id="rumah_id">
                              <?php if(form_error('inputRumah')){ echo form_error('inputRumah', '<div class="text-danger">', '</div>'); }?>
                            </div>
                          </div>
                        </div><!--end form-group-->
                        <div class="form-group">
                          <?php
                            $atrAlamat = array(
                              'type'        => 'text',
                              'id'          => 'inputAlamatRumah',
                              'name'        => 'inputAlamatRumah',
                              'class'       => 'form-control',
                              'placeholder' => 'Alamat Perumahan',
                              'autocomplete'=> 'off',
                              'rows'        => '2',
                              'required'    => 'required',
                              'readonly'    => 'true',
                              'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputAlamatRumah')
                            );
                          ?>
                          <div class="row">
                            <div class="col-sm-12">
                              <?= form_label('Alamat Perumahan', 'inputAlamatRumah'); ?>
                              <?= form_textarea($atrAlamat); ?>
                              <?php if(form_error('inputAlamatRumah')){ echo form_error('inputAlamatRumah', '<div class="text-danger">', '</div>'); }?>
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



                      </div><!--col-md-6-->
                      <div class="col-md-6">
                        <div style="border-left:1px solid rgba(207, 207, 207, 0.5);padding-left:30px;">
                          <div class="form-group">

                            <div class="row">
                              <div class="col-sm-12">
                                <?= form_label('No Kavling', 'inputNo'); ?>
                                <select id="inputNo" name="inputNo" class="form-control select2" style="width:100% !important;" required="required">
                                </select>
                                <input type="hidden" name="kavling_id" id="kavling_id">
                                <?php if(form_error('inputNo')){ echo form_error('inputNo', '<div class="text-danger">', '</div>'); }?>
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
                                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputLb')
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
                                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputTipe')
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
                            </div><!--end col-md-6-->
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
                                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputLt')
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
                                    'class'       => 'form-control',
                                    'placeholder' => 'Rp. 0',
                                    'autocomplete'=> 'off',
                                    'required'    => 'required',
                                    'readonly'    => 'true',
                                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputHarga')
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

                            </div><!--end col-md-6-->
                          </div><!--end row-->

                          <div class="form-group">
                            <?php
                              $atrDp = array(
                                'type'        => 'text',
                                'id'          => 'inputDp',
                                'name'        => 'inputDp',
                                'class'       => 'form-control input-lg',
                                'placeholder' => 'Rp. 0',
                                'autocomplete'=> 'off',
                                'required'    => 'required',
                                'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputDp')
                              );
                            ?>
                            <div class="row">
                              <div class="col-sm-12">
                                <?= form_label('Rencana Dp', 'inputDp'); ?>
                                <?= form_input($atrDp); ?>
                                <?php if(form_error('inputDp')){ echo form_error('inputDp', '<div class="text-danger">', '</div>'); }?>
                              </div>
                            </div>
                          </div><!--end form-group-->
                          <div class="form-group">
                            <?php
                              $atrKpr = array(
                                'type'        => 'text',
                                'id'          => 'inputKpr',
                                'name'        => 'inputKpr',
                                'class'       => 'form-control input-lg',
                                'placeholder' => 'Rp. 0',
                                'autocomplete'=> 'off',
                                'readonly'    => 'true',
                                'required'    => 'required',
                                'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputKpr')
                              );
                            ?>
                            <div class="row">
                              <div class="col-sm-12">
                                <?= form_label('Sisa Hutang', 'inputKpr'); ?>
                                <?= form_input($atrKpr); ?>
                                <?php if(form_error('inputKpr')){ echo form_error('inputKpr', '<div class="text-danger">', '</div>'); }?>
                              </div>
                            </div>
                          </div><!--end form-group-->

                        </div>
                      </div><!--col-md-6-->
                    </div><!--row-->

                    <?php
                      $atrBtn = array(
                        'class' => 'btn btn-primary',
                        'value' => 'Simpan Data'
                      );
                    ?>
                    <div class="text-right">
                      <?= form_submit($atrBtn); ?>
                    </div>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->


      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">

          <a href="<?php echo site_url('dashboard'); ?>" title="Back" class="btn btn-default">Kembali</a>

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

<script>

  $(window).load(function(){
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $(".select2").select2();
    $( "#inputDp" ).priceFormat(rupiah);

    load_ktp();

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

  });
</script>
