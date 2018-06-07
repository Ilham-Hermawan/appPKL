
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
      <li class="active">Pencairan Listrik</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->s_id) ? $id = $data['set']->s_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formWawancara'
      );
    ?>
    <?= form_open("dashboard/finance/transaksi/s/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div style="padding:10px;border:1px solid rgba(207, 207, 207, 0.5);border-radius:3px;">
              <div class="form-group">
                <?php
                  $atrNo = array(
                    'type'        => 'text',
                    'id'          => 'inputNo',
                    'name'        => 'inputNo',
                    'class'       => 'form-control',
                    'placeholder' => 'No Wawancara',
                    'maxlength'   => "20",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['sertifikat_no']) ? $data['sertifikat_no'] : $data['set']->s_no
                  );
                  if(!empty($data['set']->s_no)){
                    $atrNo['readonly'] = 'true';
                  }
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('No Wawancara', 'inputNo'); ?>
                    <?= form_input($atrNo); ?>
                    <?php if(form_error('inputNo')){ echo form_error('inputNo', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrTgl = array(
                    'id'          => 'inputTgl',
                    'name'        => 'inputTgl',
                    'class'       => 'form-control',
                    'placeholder' => 'Tanggal Wawancara',
                    'data-date-format' => 'yyyy-mm-dd',
                    'maxlength'   => "20",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->imb_date) ? $data['set']->imb_date : date('Y-m-d')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Tanggal Wawancara', 'inputTgl'); ?>
                    <?= form_input($atrTgl); ?>
                    <?php if(form_error('inputTgl')){ echo form_error('inputTgl', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
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
                      $atrHarga = array(
                        'id'          => 'inputHarga',
                        'name'        => 'inputHarga',
                        'class'       => 'form-control',
                        'placeholder' => 'Rp. 0',
                        'autocomplete'=> 'off',
                        'required'    => 'required',
                        'value'       => !empty($data['set']->s_harga) ? $data['set']->s_harga : set_value('inputHarga')
                      );
                    ?>
                    <div class="row">
                      <div class="col-sm-12">
                        <?= form_label('Nominal', 'inputHarga'); ?>
                        <?= form_input($atrHarga); ?>
                        <?php if(form_error('inputHarga')){ echo form_error('inputHarga', '<div class="text-danger">', '</div>'); }?>
                      </div>
                    </div>

                  </div>
                </div>
              </div><!--end form-group-->

            </div>
          </div>
          <div class="col-md-8">
            <table id="kavling" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="dthead dthead-blue" width="26%">Booking No</th>
                  <th class="dthead dthead-blue">Pelanggan</th>
                  <th class="dthead dthead-blue">Perumahan</th>
                  <th class="dthead dthead-blue" width="6%">Kavling</th>
                  <th class="dthead dthead-blue" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['detil'])): ?>
                  <?php foreach($data['detil'] as $row): ?>
                    <tr>
                      <td>
                        <input type="text" class="form-control" name="inputBooking[]" value="<?= $row->booking_no ?>" id="inputBooking" maxlength="255" autocomplete="off" placeholder="No Booking">
                        <input type="hidden" id="IDBooking" name="IDBooking[]" value="<?= $row->booking_id ?>">
                        <input type="hidden" id="IDDWawancara" name="IDDWawancara[]" value="<?= $row->ds_id ?>">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="pelanggan[]" id="pelanggan" value="<?= $row->pelanggan_nama ?>" readonly="true" maxlength="255" autocomplete="off" placeholder="Pelanggan">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="perumahan[]" id="perumahan" value="<?= $row->rumah_nama ?>" maxlength="255" readonly="true" autocomplete="off" placeholder="Perumahan">
                      </td>
                      <td>
                        <input type="text" class="form-control" name="kavling[]" id="no" value="<?= $row->kavling_blok ?>" readonly="true" maxlength="255" autocomplete="off" placeholder="No">
                      </td>

                      <td>
                        <a class="btn btn-danger" href="<?= site_url('finance/detil_s_delete/'.$id.'/'.$row->ds_id); ?>" /><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td>
                      <input type="text" class="form-control" name="inputBooking[]" id="inputBooking" maxlength="255" autocomplete="off" placeholder="No Booking">
                      <input type="hidden" id="IDBooking" name="IDBooking[]">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="pelanggan[]" id="pelanggan" readonly="true" maxlength="255" autocomplete="off" placeholder="Pelanggan">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="perumahan[]" id="perumahan" maxlength="255" readonly="true" autocomplete="off" placeholder="Perumahan">
                    </td>
                    <td>
                      <input type="text" class="form-control" name="kavling[]" id="no" readonly="true" maxlength="255" autocomplete="off" placeholder="No">
                    </td>

                    <td>
                      <button type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>[Booking No]</th>
                  <th>[Pelanggan]</th>
                  <th>[Perumahan]</th>
                  <th>[Kavling]</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <button type="button" id="AddRow" class="btn btn-default btn-sm pull-right">[F2] Tambah</button>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/finance/transaksi/sertifikat/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('#inputHarga').priceFormat(rupiah);
    $(".select2").select2();

    $('#inputTgl').datepicker({
      autoclose: true
    });

    $("#AddRow").click(function(){
       addRow();
    });

    $( "#inputBooking" ).autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?= site_url('booking/get_booking_json'); ?>",
          data: { booking: $("#inputBooking").val()},
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
        $( "#IDBooking" ).val(ui.item.id);
        $( "#pelanggan" ).val(ui.item.pelanggan_nama);
        $( "#perumahan" ).val(ui.item.rumah_nama);
        $( "#no" ).val(ui.item.kavling_blok);
      }
    });

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

    $(document).keypress(function(e) {
      if(e.keyCode == 113) { //f2
        addRow();
      }
    });

    function addRow(){
      x++;
      $('#kavling').append(''+
                            '<tr>'+
                            '<td>'+
                            '<input id="booking' + x + '" type="text" class="form-control" name="inputBooking[]" id="inputBooking" maxlength="255" autocomplete="off" placeholder="No Booking">'+
                            '<input type="hidden" id="IDBooking' + x + '" name="IDBooking[]">'+
                            '</td>'+
                            '<td>'+
                            '<input id="pelanggan' + x + '" type="text" class="form-control" name="pelanggan[]" readonly="true" maxlength="255" autocomplete="off" placeholder="Pelanggan">'+
                            '</td>'+
                            '<td>'+
                            '<input id="perumahan' + x + '" type="text" class="form-control" name="perumahan[]" maxlength="255" readonly="true" autocomplete="off" placeholder="Perumahan">'+
                            '</td>'+
                            '<td>'+
                            '<input id="no' + x + '" type="text" class="form-control" name="kavling[]" readonly="true" maxlength="255" autocomplete="off" placeholder="No">'+
                            '</td>'+
                            '<td><button id="' + x + '" type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>'+
                            '</tr>'+
                            '');
      $(".select2").select2();

      $( "input[id=booking"+ x +"]" ).focus();

      $( "#booking"+x ).autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "<?= site_url('booking/get_booking_json'); ?>",
            data: { booking: $("#booking"+x).val()},
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
          $( "#IDBooking"+x ).val(ui.item.id);
          $( "#pelanggan"+x ).val(ui.item.pelanggan_nama);
          $( "#perumahan"+x ).val(ui.item.rumah_nama);
          $( "#no"+x ).val(ui.item.kavling_blok);
        }
      });


    }

  });
</script>
