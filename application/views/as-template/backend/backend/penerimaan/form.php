
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
      <li><a href="<?= site_url('dashboard/rumah/list'); ?>">Penerimaan</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->pp_id) ? $id = $data['set']->pp_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formRumah'
      );
    ?>
    <?= form_open("finance/save_penerimaan", $atrform); ?>
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
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrRumah = array(
                        'id'          => 'inputRumah',
                        'name'        => 'inputRumah',
                        'class'       => 'form-control',
                        'placeholder' => 'Perumahan',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'value'       => !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputRumah')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Perumahan', 'inputRumah'); ?>
                        <?= form_input($atrRumah); ?>
                        <input type="hidden" name="rumahID" id="rumahID" value="<?= (!empty($data['set']->rumah_id)) ? $data['set']->rumah_id : set_value('rumahID') ?>">
                        <?php if(form_error('inputRumah')){ echo form_error('inputRumah', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrTipe = array(
                        'id'          => 'inputTipe',
                        'name'        => 'inputTipe',
                        'class'       => 'form-control',
                        'placeholder' => 'Tipe perumahan',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'value'       => !empty($data['set']->pp_tipe) ? $data['set']->pp_tipe : set_value('inputTipe')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Tipe Perumahan', 'inputTipe'); ?>
                        <?= form_input($atrTipe); ?>
                        <?php if(form_error('inputTipe')){ echo form_error('inputTipe', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrUnit = array(
                        'id'          => 'inputUnit',
                        'name'        => 'inputUnit',
                        'class'       => 'form-control',
                        'placeholder' => 'Masukkan Berapa Unit',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'value'       => !empty($data['set']->pp_tipe) ? $data['set']->pp_tipe : set_value('inputUnit')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Unit Perumahan', 'inputUnit'); ?>
                        <?= form_input($atrUnit); ?>
                        <?php if(form_error('inputUnit')){ echo form_error('inputUnit', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrHarga = array(
                        'id'          => 'inputHarga',
                        'name'        => 'inputHarga',
                        'class'       => 'form-control input-harga',
                        'placeholder' => 'Rp. 0',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'value'       => !empty($data['set']->pp_harga) ? $data['set']->pp_harga : set_value('inputHarga')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Harga Perumahan', 'inputHarga'); ?>
                        <?= form_input($atrHarga); ?>
                        <?php if(form_error('inputHarga')){ echo form_error('inputHarga', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrPercent = array(
                        'id'          => 'inputPercent',
                        'name'        => 'inputPercent',
                        'class'       => 'form-control',
                        'placeholder' => 'Percent',
                        'autocomplete'=> 'off',
                        'value'       => !empty($data['set']->pp_percent) ? $data['set']->pp_percent : set_value('inputPercent')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Percent %', 'inputPercent'); ?>
                        <?= form_input($atrPercent); ?>
                        <?php if(form_error('inputPercent')){ echo form_error('inputPercent', '<div class="text-danger">', '</div>'); }?>
                        <span id="error" class="text-red"></span>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->

            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?php
                      $atrTotal = array(
                        'id'          => 'inputTotal',
                        'name'        => 'inputTotal',
                        'class'       => 'form-control input-lg input-harga',
                        'placeholder' => 'Rp. 0',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'readonly'    => 'true',
                        'value'       => !empty($data['set']->pp_total) ? $data['set']->pp_total : set_value('inputTotal')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Total Rp.', 'inputTotal'); ?>
                        <?= form_input($atrTotal); ?>
                        <?php if(form_error('inputTotal')){ echo form_error('inputTotal', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->
            </div>
          </div><!-- /.row -->


      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/transaksi/penerimaan/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>

<script>

  $(window).load(function(){
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $(".select2").select2();
    $( ".input-harga" ).priceFormat(rupiah);

    $( "#inputRumah" ).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?= site_url('rumah/get_rumah_json'); ?>",
          data: { rumah_nama: $("#inputRumah").val()},
          dataType: "json",
          type: "POST",
          success: function(data){
            response(data);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("ERROR AJAX => DATA NULL");
          }
        });
      },
      minLength:1,
      select:function(event, ui){
        $( "#rumahID" ).val(ui.item.id);
      }
    });

    $('#inputUnit').change(function() {
      var total = 0;
      total = parseInt($( "#inputHarga" ).unmask()) * parseInt($( "#inputUnit" ).val());
      $( "#inputTotal" ).val(total);
      $( "#inputTotal" ).priceFormat(rupiah);
    });

    $('#inputHarga').keyup(function() {
      var total = 0;
      total = parseInt($( "#inputHarga" ).unmask()) * parseInt($( "#inputUnit" ).val());
      $( "#inputTotal" ).val(total);
      $( "#inputTotal" ).priceFormat(rupiah);

    });

    $('#inputPercent').keyup(function() {
      var total = 0;
      total = parseInt($( "#inputHarga" ).unmask()) * parseInt($( "#inputUnit" ).val());
      total = (parseFloat($('#inputPercent').val()) / 100) * parseFloat(total);
      $( "#inputTotal" ).val(total);
      $( "#inputTotal" ).priceFormat(rupiah);

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


  });
</script>
