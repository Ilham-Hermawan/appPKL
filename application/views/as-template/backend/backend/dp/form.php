
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
      <li><a href="<?= site_url('dashboard/finance/transaksi/dp/list'); ?>">Rencana DP</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->dp_id) ? $id = $data['set']->dp_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open("dashboard/finance/transaksi/dp/save", $atrform); ?>
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
          <div class="col-md-5">
            <div style="padding:10px;border:1px solid rgba(207, 207, 207, 0.5);border-radius:3px;">
              <div class="form-group">
                <?php
                  $atrBooking = array(
                    'type'        => 'text',
                    'id'          => 'inputBooking',
                    'name'        => 'inputBooking',
                    'class'       => 'form-control',
                    'placeholder' => 'No Booking',
                    'maxlength'   => "255",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->booking_no) ? $data['set']->booking_no : set_value('inputBooking')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('No Booking', 'inputBooking'); ?>
                    <?= form_input($atrBooking); ?>
                    <?php
                    $atrBookingID = array(
                      'type'        => 'hidden',
                      'id'          => 'booking_id',
                      'name'        => 'booking_id',
                      'value'       => !empty($data['set']->booking_id) ? $data['set']->booking_id : set_value('booking_id')
                    );
                    ?>
                    <?= form_input($atrBookingID); ?>
                    <?php if(form_error('inputBooking')){ echo form_error('inputBooking', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Pelanggan', 'inputPelanggan'); ?>
                    <input type="text" readonly="true" id="pelanggan_nama" value="<?= !empty($data['set']->pelanggan_nama) ? $data['set']->pelanggan_nama : set_value('inputPelanggan') ?>" class="form-control">
                    <?php if(form_error('inputPelanggan')){ echo form_error('inputPelanggan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Perumahan', 'inputPerumahan'); ?>
                    <input type="text" readonly="true" value="<?= !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputPerumahan') ?>" id="rumah_nama" class="form-control">
                    <?php if(form_error('inputPerumahan')){ echo form_error('inputPerumahan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Keterangan', 'inputKeterangan'); ?>
                    <textarea id="inputKeterangan" name="inputKeterangan" placeholder="Keterangan" maxlength="225" rows="3" class="form-control"><?= !empty($data['set']->dp_keterangan) ? $data['set']->dp_keterangan : '' ?></textarea>
                    <?php if(form_error('inputKeterangan')){ echo form_error('inputKeterangan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $dp_status = !empty($data['set']->dp_status) ? $data['set']->dp_status : set_value('inputStatus');
                  $inputStatus = array(
                    'n' => 'BELUM LUNAS',
                    'y' => 'LUNAS'
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Status', 'inputStatus'); ?>
                    <?= form_dropdown('inputStatus', $inputStatus, $dp_status, 'class="form-control"'); ?>
                    <?php if(form_error('inputStatus')){ echo form_error('inputStatus', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->

            </div>
          </div>
          <div class="col-md-7">
            <table id="table" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="dthead dthead-blue">Jumlah DP</th>
                  <th class="dthead dthead-blue" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['detil'])): ?>
                  <?php foreach($data['detil'] as $row): ?>
                    <tr>
                      <td>
                        <input type="text" class="form-control harga jumlah_dp" value="<?= $row->ddp_jumlah ?>" name="jumlah_dp[]" maxlength="255" autocomplete="off" placeholder="Rp. 0">
                        <input type="hidden" name="ddp_id[]" value="<?= $row->ddp_id ?>">
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td>
                      <input type="text" class="form-control harga jumlah_dp" name="jumlah_dp[]" maxlength="255" autocomplete="off" placeholder="Rp. 0">
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
              <tfoot>
              </tfoot>
            </table>
            <table width="100%">
              <tr>
                <td width="50%"><strong>TOTAL</strong></td>
                <td width="50%">
                  <input type="text" class="form-control harga" value="<?= !empty($data['set']->dp_total) ? $data['set']->dp_total : set_value('inputTotal') ?>" name="inputTotal" id="inputTotal" readonly="true" placeholder="Rp. 0">
                </td>
              </tr>
            </table>
            <br/><br/>
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
          <a href="<?php echo site_url('dashboard/finance/transaksi/dp/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('table').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};

    fnAlltotal();
    <?php if($this->uri->segment(5) === "edit"): ?>
    <?php else: ?>
      $( "#booking_id" ).val('');
      $( "#pelanggan_nama" ).val('');
      $( "#rumah_nama" ).val('');
    <?php endif; ?>

    $('.harga').priceFormat(rupiah);

    $('.harga').keyup(function(event) {
      if(event.keyCode  == 113) { //f2
        addRow();
      }
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
        $( "#booking_id" ).val(ui.item.id);
        $( "#pelanggan_nama" ).val(ui.item.pelanggan_nama);
        $( "#rumah_nama" ).val(ui.item.rumah_nama);
      }
    });

    $(document).keypress(function(e) {
      if(e.keyCode == 113) { //f2
        addRow();
      }
    });

    function addRow(){
      x++;
      $('#table').append(''+
        '<tr>'+
        '<td>'+
        '<input type="text" class="form-control harga jumlah_dp" name="jumlah_dp[]" maxlength="255" autocomplete="off" placeholder="Rp. 0">'+
        '</td>'+
        '<td><button id="' + x + '" type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>'+
        '</tr>'+
        '');

      fnAlltotal();
    }

    function fnAlltotal(){

      $(".jumlah_dp").keyup(function(){
        var sum = 0;
        $('.jumlah_dp').each(function() {
          sum += Number($(this).unmask());
        });
        $("#inputTotal").val(sum);
        $( ".harga" ).priceFormat(rupiah);
      });

    }

  });
</script>
