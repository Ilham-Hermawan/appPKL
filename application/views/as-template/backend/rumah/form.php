
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
      <li><a href="<?= site_url('dashboard'); ?>">Home</a></li>
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
    <?= form_open_multipart("dashboard/rumah/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="form-group">
          <?php
            $atrNama = array(
              'type'        => 'text',
              'id'          => 'inputNama',
              'name'        => 'inputNama',
              'class'       => 'form-control',
              'placeholder' => 'Nama Perumahan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputNama')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Nama Perumahan', 'inputNama'); ?>
              <?= form_input($atrNama); ?>
              <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $atrKode = array(
              'type'        => 'text',
              'id'          => 'inputKode',
              'name'        => 'inputKode',
              'class'       => 'form-control',
              'placeholder' => 'Kode Perumahan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_kode) ? $data['set']->rumah_kode : set_value('inputKode')
            );
          ?>
          <div class="row">
            <div class="col-sm-2">
              <?= form_label('Kode Perumahan', 'inputKode'); ?>
              <?= form_input($atrKode); ?>
              <?php if(form_error('inputKode')){ echo form_error('inputKode', '<div class="text-danger">', '</div>'); }?>
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
              'placeholder' => 'Alamat Perumahan',
              'autocomplete'=> 'off',
              'rows'        => '4',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputAlamat')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
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
              'placeholder' => 'Desa / Kelurahan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_desa) ? $data['set']->rumah_desa : set_value('inputDesa')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Desa / Kelurahan', 'inputDesa'); ?>
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
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_kecamatan) ? $data['set']->rumah_kecamatan : set_value('inputKecamatan')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
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
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_kota) ? $data['set']->rumah_kota : set_value('inputKota')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
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
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rumah_provinsi) ? $data['set']->rumah_provinsi : set_value('inputProvinsi')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Provinsi', 'inputProvinsi'); ?>
              <?= form_input($atrProvinsi); ?>
              <?php if(form_error('inputProvinsi')){ echo form_error('inputProvinsi', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->


      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/rumah/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
          <?= form_submit($atrBtn); ?>
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

<script>

  $(window).load(function(){
    $("#formRumah").validate({
      rules: {
        inputNama: {
          required: true,
          maxlength:255
        },
        inputAlamat: {
          required: true
        },
        inputDesa: "required",
        inputKecamatan: "required",
        inputKota: "required",
        inputProvinsi: "required"
      },
      messages: {
        inputNama: {
          required: "Nama Perumahan tidak boleh kosong",
          maxlength: "Batas maksimal 255 karakter"
        },
        inputAlamat: {
          required: "Alamat Perumahan tidak boleh kosong"
        },
        inputDesa: {
          required: "Desa tidak boleh kosong"
        },
        inputKecamatan: {
          required: "Kecamatan tidak boleh kosong"
        },
        inputKota: {
          required: "Kota tidak boleh kosong"
        },
        inputProvinsi: {
          required: "Provinsi tidak boleh kosong"
        }
      }
    });

  });
</script>
