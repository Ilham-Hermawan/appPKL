<div class="se-pre-con"></div>
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
      <li>Biaya Konstruksi Rumah</li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->pengeluaran_id) ? $id = $data['set']->pengeluaran_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open_multipart("dashboard/finance/pengeluaran/bkr/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <div style="background:rgba(204, 204, 204, 0.2);margin-bottom:10px;);padding:20px;">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <?php
                  $atrNo = array(
                    'id' => 'inputId',
                    'name' => 'inputId',
                    'class' => 'form-control',
                    'placeholder' => 'No Kwitansi'
                  );
                  if(!empty($data['no_kwitansi'])){
                    $atrNo['value'] = $data['no_kwitansi'];
                  }
                  else{
                    $atrNo['value'] = $data['set']->pengeluaran_no;
                  }

                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('No Kwitansi', 'inputId'); ?>
                    <?= form_input($atrNo); ?>
                    <?php if(form_error('inputId')){ echo form_error('inputId', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrKepada = array(
                    'id' => 'inputKepada',
                    'name' => 'inputKepada',
                    'class' => 'form-control',
                    'placeholder' => 'Dibayarkan ke',
                    'autocomplete' => 'off',
                    'maxlength' => '255',
                    'value' => !empty($data['set']->pengeluaran_kepada) ? $data['set']->pengeluaran_kepada : set_value('inputKepada')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Kepada', 'inputKepada'); ?>
                    <?= form_input($atrKepada); ?>
                    <?php if(form_error('inputKepada')){ echo form_error('inputKepada', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
            </div><!--end col-md-6-->
            <div class="col-md-6">
              <div class="form-group">
                <?php
                  $rumah_id = !empty($data['set']->rumah_id) ? $data['set']->rumah_id : set_value('inputRumah');
                  if(!empty($data['rumah'])){
                    foreach($data['rumah'] as $row){
                      $inputRumah[$row->rumah_id] = $row->rumah_nama;
                    }
                  }

                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Perumahan', 'inputRumah'); ?>
                    <?= form_dropdown('inputRumah', $inputRumah, $rumah_id, 'class="form-control select2"'); ?>
                    <?php if(form_error('inputRumah')){ echo form_error('inputRumah', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
            </div><!--end col-md-6-->
          </div><!--end row-->


        </div>

        <table style="width:100%" id="table">
          <thead>
            <tr>
              <th class="dthead dthead-blue text-center">NO</th>
              <th class="dthead dthead-blue text-center">URAIAN</th>
              <th class="dthead dthead-blue text-center" width="10%">VOLUME</th>
              <th class="dthead dthead-blue text-center" width="8%">SATUAN</th>
              <th class="dthead dthead-blue text-center" width="20%">HARGA SATUAN</th>
              <th class="dthead dthead-blue text-center" width="20%">SUB JUMLAH</th>
              <th class="dthead dthead-blue text-center" width="4%"></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php if(!empty($data['detil'])): ?>
              <?php foreach($data['detil'] as $row): ?>
                <tr>
                  <td class="text-center"><?= $i; ?></td>
                  <td>
                    <div class="form-group"><input type="text" value="<?= $row->dp_uraian ?>" class="form-control" name="uraian[]" placeholder="Uraian" autocomplete="off"></div>
                    <input type="hidden" name="dp_id[]" value="<?= $row->dp_id ?>">
                  </td>
                  <td><div class="form-group"><input type="text" value="<?= ($row->dp_volume == 0) ? "" : $row->dp_volume; ?>" class="form-control" name="volume[]" placeholder="Volume" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->dp_satuan ?>" class="form-control" maxlength="50" name="satuan[]" placeholder="Satuan" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->dp_harga_satuan ?>" class="form-control inputHarga" name="harga_satuan[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->dp_sub_jumlah ?>" class="form-control inputHarga sub_jumlah" name="sub_jumlah[]" placeholder="Rp. 0" autocomplete="off" readonly="true"></div></td>
                  <td class="text-center"><a href="<?= site_url('pengeluaran/delete_bkr_detil/'.$row->dp_id.'/'.$id); ?>" id="btn-delete-detil" style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                <?php $i++; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <?php $i=1?>
                <tr>
                  <td class="text-center"><?= $i; ?></td>
                  <td><div class="form-group"><input type="text" class="form-control" name="uraian[]" placeholder="Uraian" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control volume" name="volume[]" placeholder="Volume" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuan[]" placeholder="Satuan" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control inputHarga" name="harga_satuan[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control inputHarga sub_jumlah" name="sub_jumlah[]" placeholder="Rp. 0" autocomplete="off" readonly="true"></div></td>
                  <td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>
                </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2"><a href="javascript:void(0)" class="btn bg-maroon" id="AddRow"><i class="fa fa-plus"></i> Add Row</a></td>
              <td colspan="3" class="text-right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td><div class="form-group"><input type="text" value="<?= !empty($data['set']->bkr_total) ? $data['set']->bkr_total : set_value('total_jumlah'); ?>" class="form-control inputHarga" id="total_jumlah" name="total_jumlah" placeholder="Rp. 0" autocomplete="off" readonly="true"></div></td>
            </tr>
          </tfoot>
        </table>

      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/finance/pengeluaran/bkr/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('table').deleteRow(i);
  }

  $(window).load(function(){
    $(".se-pre-con").fadeOut("slow");
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $(".select2").select2();
    $( ".inputHarga" ).priceFormat(rupiah);

    hitung_volume();
    hitung_harga();
    fnAlltotal();

    $(document).on("click","a[id='AddRow']", function (e) {
       addRow();
    });

    $(document).on("click","a[id='btn-delete-detil']", function (e) {
      $(".se-pre-con").show();
    });


    var x = <?= $i; ?>;
    function addRow(){
      x++;
      $('#table').append(''+
          '<tr>'+
          '<td class="text-center">'+x+'</td>'+
          '<td><div class="form-group"><input type="text" class="form-control" name="uraian[]" placeholder="Uraian" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control volume" name="volume[]" placeholder="Volume" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuan[]" placeholder="Satuan" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control inputHarga" name="harga_satuan[]" placeholder="Rp. 0" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control inputHarga sub_jumlah" name="sub_jumlah[]" placeholder="Rp. 0" autocomplete="off" readonly="true"></div></td>'+
          '<td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>'+
          '</tr>'+
          '');

      hitung_volume();
      hitung_harga();
    }

    function fnAlltotal(){
      var sum = 0;
      $('.sub_jumlah').each(function() {
        sum += Number($(this).unmask());
      });
      $("#total_jumlah").val(sum);
      $( ".inputHarga" ).priceFormat(rupiah);
    }

    function hitung_volume(){
      $(".volume").on('input', function () {
         var self = $(this);
         var harga = self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').unmask();
         self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').val(harga * self.val());
         fnAlltotal();
      });
    }

    function hitung_harga(){
      $(".inputHarga").on('input', function () {
         var self = $(this);
        //  var qtyVal = self.prev().prev().val();
         var volume = self.closest('div').closest('td').prev().find('input').closest('div').closest('td').prev().find('input').val();
         self.closest('div').closest('td').next().find('input').val(self.unmask() * volume);
         fnAlltotal();
      });
    }

  });
</script>
