
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
      <li class="active">Configuration</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open_multipart("dashboard/configuration/save", $atrform); ?>
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
              'placeholder' => 'Nama Perusahaan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'value'       => !empty($data['company_name']) ? $data['company_name'] : set_value('inputNama')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Nama Perusahaan', 'inputNama'); ?>
              <?= form_input($atrNama); ?>
              <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $atrAlamat = array(
              'id'          => 'inputAlamat',
              'name'        => 'inputAlamat',
              'class'       => 'form-control',
              'placeholder' => 'Alamat Perusahaan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'rows'        => '2',
              'value'       => !empty($data['company_address']) ? $data['company_address'] : set_value('inputAlamat')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Alamat Perusahaan', 'inputAlamat'); ?>
              <?= form_textarea($atrAlamat); ?>
              <?php if(form_error('inputAlamat')){ echo form_error('inputAlamat', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $atrOwner = array(
              'type'        => 'text',
              'id'          => 'inputOwner',
              'name'        => 'inputOwner',
              'class'       => 'form-control',
              'placeholder' => 'Owner Perusahaan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'value'       => !empty($data['company_owner']) ? $data['company_owner'] : set_value('inputOwner')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Owner Perusahaan', 'inputOwner'); ?>
              <?= form_input($atrOwner); ?>
              <?php if(form_error('inputOwner')){ echo form_error('inputOwner', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $atrPhone = array(
              'type'        => 'text',
              'id'          => 'inputPhone',
              'name'        => 'inputPhone',
              'class'       => 'form-control',
              'placeholder' => 'Telp. Perusahaan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'value'       => !empty($data['company_phone']) ? $data['company_phone'] : set_value('inputPhone')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Phone Perusahaan', 'inputPhone'); ?>
              <?= form_input($atrPhone); ?>
              <?php if(form_error('inputPhone')){ echo form_error('inputPhone', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
        </div><!--end form-group-->
        <div class="form-group">
          <?php
            $atrEmail = array(
              'type'        => 'text',
              'id'          => 'inputEmail',
              'name'        => 'inputEmail',
              'class'       => 'form-control',
              'placeholder' => 'Email Perusahaan',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'value'       => !empty($data['company_email']) ? $data['company_email'] : set_value('inputEmail')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Email Perusahaan', 'inputEmail'); ?>
              <?= form_input($atrEmail); ?>
              <?php if(form_error('inputEmail')){ echo form_error('inputEmail', '<div class="text-danger">', '</div>'); }?>
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
          <a href="<?php echo site_url('dashboard'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
</script>
