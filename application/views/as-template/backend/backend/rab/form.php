
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
      <li><a href="<?= site_url('dashboard/owner/rab/list'); ?>">RAB</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->rab_id) ? $id = $data['set']->rab_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open_multipart("dashboard/owner/rab/save", $atrform); ?>
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
              'placeholder' => 'Nama RAB',
              'maxlength'   => "255",
              'autocomplete'=> 'off',
              'required'    => 'required',
              'value'       => !empty($data['set']->rab_nama) ? $data['set']->rab_nama : set_value('inputNama')
            );
          ?>
          <div class="row">
            <div class="col-sm-5">
              <?= form_label('Nama RAB', 'inputNama'); ?>
              <?= form_input($atrNama); ?>
              <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
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
          <a href="<?php echo site_url('dashboard/owner/rab/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
