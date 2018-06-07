
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
      <li><a href="<?= site_url('dashboard/pelanggan/list'); ?>">Pelanggan</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->pelanggan_id) ? $id = $data['set']->pelanggan_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formPelanggan'
      );
    ?>
    <?= form_open("dashboard/pelanggan/save", $atrform); ?>
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
            $atrKtp = array(
              'type'        => 'text',
              'id'          => 'inputKtp',
              'name'        => 'inputKtp',
              'class'       => 'form-control',
              'placeholder' => 'No. KTP',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->pelanggan_ktp) ? $data['set']->pelanggan_ktp : set_value('inputKtp')
            );
            if($id != "0"){
              $atrKtp['readonly'] = "true";
            }
          ?>
          <div class="row">
            <div class="col-sm-4">
              <?= form_label('No. KTP', 'inputKtp'); ?>
              <?= form_input($atrKtp); ?>
              <?php if(form_error('inputKtp')){ echo form_error('inputKtp', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
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
            <div class="col-sm-5">
              <?= form_label('Nama Lengkap', 'inputNama'); ?>
              <?= form_input($atrNama); ?>
              <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $pelanggan_jk = !empty($data['set']->pelanggan_jk) ? $data['set']->pelanggan_jk : set_value('inputJk');
            $inputJk = array(
              'l' => 'LAKI-LAKI',
              'p' => 'PEREMPUAN'
            );

          ?>
          <div class="row">
            <div class="col-sm-2">
              <?= form_label('Jenis Kelamin', 'inputJk'); ?>
              <?= form_dropdown('inputJk', $inputJk, $pelanggan_jk, 'class="form-control"'); ?>
              <?php if(form_error('inputJk')){ echo form_error('inputJk', '<div class="text-danger">', '</div>'); }?>
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
            <div class="col-sm-5">
              <?= form_label('Tempat, Tanggal Lahir', 'inputTtl'); ?>
              <?= form_input($atrTtl); ?>
              <?php if(form_error('inputTtl')){ echo form_error('inputTtl', '<div class="text-danger">', '</div>'); }?>
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
              'maxlength'   => '255',
              'rows'        => '4',
              'required'    => 'required',
              'value'       => !empty($data['set']->pelanggan_alamat) ? $data['set']->pelanggan_alamat : set_value('inputAlamat')
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
            $atrKontak = array(
              'type'        => 'text',
              'id'          => 'inputKontak',
              'name'        => 'inputKontak',
              'class'       => 'form-control',
              'placeholder' => 'Kontak',
              'maxlength'   => "50",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->pelanggan_kontak) ? $data['set']->pelanggan_kontak : set_value('inputKontak')
            );
          ?>
          <div class="row">
            <div class="col-sm-4">
              <?= form_label('Kontak', 'inputKontak'); ?>
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
            <div class="col-sm-5">
              <?= form_label('Pekerjaan', 'inputPekerjaan'); ?>
              <?= form_input($atrPekerjaan); ?>
              <?php if(form_error('inputPekerjaan')){ echo form_error('inputPekerjaan', '<div class="text-danger">', '</div>'); }?>
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
          <a href="<?php echo site_url('dashboard/pelanggan/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
    $("#formPelanggan").validate({
      rules: {
        inputKtp: {
          required: true,
          maxlength:255
        },
        inputNama: {
          required: true,
          maxlength:255
        },
        inputAlamat: "required",
        inputKontak: "required",
        inputPekerjaan: "required",
        inputTtl: "required"
      },
      messages: {
        inputKtp: {
          required: "KTP tidak boleh kosong",
          maxlength: "Batas maksimal 255 karakter"
        },
        inputNama: {
          required: "Nama Pelanggan tidak boleh kosong",
          maxlength: "Batas maksimal 255 karakter"
        },
        inputAlamat: {
          required: "Alamat Pelanggan tidak boleh kosong"
        },
        inputKontak: {
          required: "No. kontak pelanggan tidak boleh kosong"
        },
        inputPekerjaan: {
          required: "Pekerjaan pelanggan tidak boleh kosong"
        },
        inputTtl: {
          required: "Tempat Tanggal Lahir pelanggan tidak boleh kosong"
        }
      }
    });

  });
</script>
