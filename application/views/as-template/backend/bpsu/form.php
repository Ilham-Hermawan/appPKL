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
      <li>Biaya Prasarana, Sarana & Utilitas</li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->bpsu_id) ? $id = $data['set']->bpsu_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'form'
      );
    ?>
    <?= form_open_multipart("dashboard/owner/bpsu/save", $atrform); ?>
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
          <div class="form-group">
            <?php
              $rab_id = !empty($data['set']->rab_id) ? $data['set']->rab_id : set_value('inputRab');
              if(!empty($data['rab'])){
                foreach($data['rab'] as $row){
                  $inputRab[$row->rab_id] = $row->rab_nama;
                }
              }

            ?>
            <div class="row">
              <div class="col-sm-12">
                <?= form_label('Nama RAB', 'inputRab'); ?>
                <?= form_dropdown('inputRab', $inputRab, $rab_id, 'class="form-control select2"'); ?>
                <?php if(form_error('inputRab')){ echo form_error('inputRab', '<div class="text-danger">', '</div>'); }?>
              </div>
            </div>
          </div>
        </div>

        <?php
        $prasarana = array(
          'Biaya PLN (Daya 1300 w)', 'Biaya PDAM/Sumur Bor/Gorong-gorong', 'Biaya Telkom', 'Biaya Pembangunan Jembatan',
          'Biaya Pembangunan Jalan Beton', 'Biaya Pagar Keliling', 'Biaya Saluran Drainase Depan', 'Biaya Saluran Drainase Belakang',
          'Biaya Penerangan Jalan Umum (PJU)', 'Biaya Lain-lain'
        );
        $sarana = array(
          'Biaya Pembangunan Gerbang', 'Biaya Pembangunan Pos Satpam', 'Biaya Pembangunan Tempat Ibadah', 'Biaya Pembangunan Balai Pertemuan',
          'Biaya Pembangunan Taman Lingkungan', 'Biaya Lain-lain'
        );
        ?>
        <h3><i class="fa fa-arrow-circle-o-right"></i> Prasarana</h3>
        <table style="width:100%" id="tablep">
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
            <?php $ip = 1; ?>
            <?php if(!empty($data['detilp'])): ?>
              <?php foreach($data['detilp'] as $row): ?>
                <tr>
                  <td class="text-center"><?= $ip; ?></td>
                  <td>
                    <div class="form-group"><input type="text" value="<?= $row->drbps_uraian ?>"  class="form-control" name="uraianp[]" placeholder="Uraian" autocomplete="off"></div>
                    <input type="hidden" name="drbps_id[]" value="<?= $row->drbps_id ?>">
                  </td>
                  <td><div class="form-group"><input type="text" value="<?= ($row->drbps_volume == 0) ? "" : $row->drbps_volume; ?>" class="form-control volumep" name="volumep[]" placeholder="Volume" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->drbps_satuan ?>" class="form-control" maxlength="50" name="satuanp[]" placeholder="Satuan" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->drbps_harga_satuan ?>" class="form-control inputHarga inputHargap" name="harga_satuanp[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" value="<?= $row->drbps_sub_jumlah ?>" readonly="true" class="form-control inputHarga sub_jumlahp" name="sub_jumlahp[]" placeholder="Rp. 0" autocomplete="off" ></div></td>
                  <td class="text-center"><a style="margin-bottom:16px;" href="<?= site_url('rab/delete_bpsu_detil/'.$row->drbps_id.'/'.$id); ?>" id="btn-delete-detil" class="btn btn-sm btn-danger btn-delete-detil"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php $ip++; ?>
              <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"><a href="javascript:void(0)" class="btn bg-maroon" id="AddRowP"><i class="fa fa-plus"></i> Add Row</a></td>
                  <td colspan="3" class="text-right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td><div class="form-group"><input type="text" readonly="true" value="<?= !empty($data['set']->bpsu_totalp) ? $data['set']->bpsu_totalp : set_value('total_jumlahp'); ?>" class="form-control inputHarga" id="total_jumlahp" name="total_jumlahp" placeholder="Rp. 0" autocomplete="off" ></div></td>
                </tr>
              </tfoot>
            <?php else: ?>
              <?php $ip=0; $no=1; ?>
              <?php foreach($prasarana as $row): ?>
                <tr>
                  <td class="text-center"><?= $no ?></td>
                  <td><div class="form-group"><input type="text" value="<?= $prasarana[$ip] ?>" class="form-control" name="uraianp[]" placeholder="Uraian" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control volumep" name="volumep[]" placeholder="Volume" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuanp[]" placeholder="Satuan" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" class="form-control inputHarga inputHargap" name="harga_satuanp[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                  <td><div class="form-group"><input type="text" readonly="true" class="form-control inputHarga sub_jumlahp" name="sub_jumlahp[]" placeholder="Rp. 0" autocomplete="off" ></div></td>
                  <td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRowP(this)"><i class="fa fa-trash-o"></i></button></td>
                </tr>
                <?php $ip++; $no++; ?>
              <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="2"><a href="javascript:void(0)" class="btn bg-maroon" id="AddRowP"><i class="fa fa-plus"></i> Add Row</a></td>
                  <td colspan="3" class="text-right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td><div class="form-group"><input type="text" value="<?= !empty($data['set']->bpsu_total) ? $data['set']->bpsu_total : set_value('total_jumlah'); ?>" class="form-control inputHarga" id="total_jumlahp" name="total_jumlahp" placeholder="Rp. 0" autocomplete="off" ></div></td>
                </tr>
              </tfoot>
            <?php endif; ?>
        </table>
        <hr/>
        <h3><i class="fa fa-arrow-circle-o-right"></i> Sarana</h3>
        <table style="width:100%" id="tables">
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
              <?php $is = 1; ?>
              <?php if(!empty($data['detils'])): ?>
                <?php foreach($data['detils'] as $row): ?>
                  <tr>
                    <td class="text-center"><?= $is; ?></td>
                    <td>
                      <div class="form-group"><input type="text" value="<?= $row->drbps_uraian ?>"  class="form-control" name="uraians[]" placeholder="Uraian" autocomplete="off"></div>
                      <input type="hidden" name="drbps_ids[]" value="<?= $row->drbps_id ?>">
                    </td>
                    <td><div class="form-group"><input type="text" value="<?= ($row->drbps_volume == 0) ? "" : $row->drbps_volume; ?>" class="form-control" name="volumes[]" placeholder="Volume" autocomplete="off"></div></td>
                    <td><div class="form-group"><input type="text" value="<?= $row->drbps_satuan ?>" class="form-control" maxlength="50" name="satuans[]" placeholder="Satuan" autocomplete="off"></div></td>
                    <td><div class="form-group"><input type="text" value="<?= $row->drbps_harga_satuan ?>" class="form-control inputHarga inputHargas" name="harga_satuans[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                    <td><div class="form-group"><input type="text" value="<?= $row->drbps_sub_jumlah ?>" readonly="true" class="form-control inputHarga sub_jumlahs" name="sub_jumlahs[]" placeholder="Rp. 0" autocomplete="off" ></div></td>
                    <td class="text-center"><a style="margin-bottom:16px;" href="<?= site_url('rab/delete_bpsu_detil/'.$row->drbps_id.'/'.$id); ?>" class="btn btn-sm btn-danger" id="btn-delete-detil"><i class="fa fa-trash-o"></i></a></td>
                  </tr>
                  <?php $is++; ?>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="2"><a href="javascript:void(0)" class="btn bg-maroon" id="AddRowS"><i class="fa fa-plus"></i> Add Row</a></td>
                    <td colspan="3" class="text-right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td><div class="form-group"><input type="text" readonly="true" value="<?= !empty($data['set']->bpsu_totals) ? $data['set']->bpsu_totals : set_value('total_jumlahs'); ?>" class="form-control inputHarga" id="total_jumlahs" name="total_jumlahs" placeholder="Rp. 0" autocomplete="off" ></div></td>
                  </tr>
                </tfoot>

              <?php else: ?>
                  <?php $is=0; $no=1; ?>
                  <?php foreach($sarana as $row): ?>
                    <tr>
                      <td class="text-center"><?= $no ?></td>
                      <td><div class="form-group"><input type="text" value="<?= $sarana[$is] ?>" class="form-control" name="uraians[]" placeholder="Uraian" autocomplete="off"></div></td>
                      <td><div class="form-group"><input type="text" class="form-control" name="volumes[]" placeholder="Volume" autocomplete="off"></div></td>
                      <td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuans[]" placeholder="Satuan" autocomplete="off"></div></td>
                      <td><div class="form-group"><input type="text" class="form-control inputHarga inputHargas" name="harga_satuans[]" placeholder="Rp. 0" autocomplete="off"></div></td>
                      <td><div class="form-group"><input type="text" readonly="true" class="form-control inputHarga sub_jumlahs" name="sub_jumlahs[]" placeholder="Rp. 0" autocomplete="off" ></div></td>
                      <td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRowS(this)"><i class="fa fa-trash-o"></i></button></td>
                    </tr>
                    <?php $is++; $no++; ?>
                  <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                      <td colspan="2"><a href="javascript:void(0)" class="btn bg-maroon" id="AddRowS"><i class="fa fa-plus"></i> Add Row</a></td>
                      <td colspan="3" class="text-right"><strong>TOTAL</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><div class="form-group"><input type="text" value="<?= !empty($data['set']->bpsu_total) ? $data['set']->bpsu_total : set_value('total_jumlah'); ?>" class="form-control inputHarga" id="total_jumlahs" name="total_jumlahs" placeholder="Rp. 0" autocomplete="off" ></div></td>
                    </tr>
                  </tfoot>
            <?php endif; ?>
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
          <a href="<?php echo site_url('dashboard/owner/bpsu/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
  function deleteRowP(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('tablep').deleteRow(i);
  }
  function deleteRowS(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('tables').deleteRow(i);
  }

  $(window).load(function(){
    $(".se-pre-con").fadeOut("slow");
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $(".select2").select2();
    $( ".inputHarga" ).priceFormat(rupiah);

    hitung_volumep();
    hitung_hargap();
    hitung_volumes();
    hitung_hargas();
    fnAlltotalP();
    fnAlltotalS();

    $(document).on("click","a[id='AddRowP']", function (e) {
       addRowP();
    });

    $(document).on("click","a[id='AddRowS']", function (e) {
       addRowS();
    });

    $(document).on("click","a[id='btn-delete-detil']", function (e) {
      $(".se-pre-con").show();
    });

    var xp = <?= $ip; ?>;
    var xs = <?= $is; ?>;
    function addRowP(){
      $('#tablep').append(''+
          '<tr>'+
          '<td class="text-center">'+xp+'</td>'+
          '<td><div class="form-group"><input type="text" class="form-control" name="uraianp[]" placeholder="Uraian" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control volumep" name="volumep[]" placeholder="Volume" id="volumep" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuanp[]" placeholder="Satuan" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control inputHarga inputHargap" name="harga_satuanp[]" placeholder="Rp. 0" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" readonly="true" class="form-control inputHarga sub_jumlahp" name="sub_jumlahp[]" placeholder="Rp. 0" autocomplete="off" ></div></td>'+
          '<td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRowP(this)"><i class="fa fa-trash-o"></i></button></td>'+
          '</tr>'+
          '');

      hitung_volumep();
      hitung_hargap();
      xp++;
    }

    function addRowS(){
      $('#tables').append(''+
          '<tr>'+
          '<td class="text-center">'+xs+'</td>'+
          '<td><div class="form-group"><input type="text" class="form-control" name="uraians[]" placeholder="Uraian" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control volumes" name="volumes[]" placeholder="Volume" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control" maxlength="50" name="satuans[]" placeholder="Satuan" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" class="form-control inputHarga inputHargas" name="harga_satuans[]" placeholder="Rp. 0" autocomplete="off"></div></td>'+
          '<td><div class="form-group"><input type="text" readonly="true" class="form-control inputHarga sub_jumlahs" name="sub_jumlahs[]" placeholder="Rp. 0" autocomplete="off" ></div></td>'+
          '<td class="text-center"><button style="margin-bottom:16px;" type="button" class="btn btn-sm btn-danger" onclick="deleteRowS(this)"><i class="fa fa-trash-o"></i></button></td>'+
          '</tr>'+
          '');

      hitung_volumes();
      hitung_hargas();
      xs++;
    }

    function fnAlltotalP(){
      var sum = 0;
      $('.sub_jumlahp').each(function() {
        sum += Number($(this).unmask());
      });
      $("#total_jumlahp").val(sum);
      $( ".inputHarga" ).priceFormat(rupiah);
    }

    function hitung_volumep(){
      $(".volumep").on('input', function () {
         var self = $(this);
         var harga = self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').unmask();
         self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').val(harga * self.val());
         fnAlltotalP();
      });
    }

    function hitung_hargap(){
      $(".inputHargap").on('input', function () {
         var self = $(this);
        //  var qtyVal = self.prev().prev().val();
         var volume = self.closest('div').closest('td').prev().find('input').closest('div').closest('td').prev().find('input').val();
         self.closest('div').closest('td').next().find('input').val(self.unmask() * volume);
         fnAlltotalP();
      });
    }

    function fnAlltotalS(){
      var sum = 0;
      $('.sub_jumlahs').each(function() {
        sum += Number($(this).unmask());
      });
      $("#total_jumlahs").val(sum);
      $( ".inputHarga" ).priceFormat(rupiah);
    }

    function hitung_volumes(){
      $(".volumes").on('input', function () {
         var self = $(this);
         var harga = self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').unmask();
         self.closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').closest('div').closest('td').next().find('input').val(harga * self.val());
         fnAlltotalS();
      });
    }

    function hitung_hargas(){
      $(".inputHargas").on('input', function () {
         var self = $(this);
        //  var qtyVal = self.prev().prev().val();
         var volume = self.closest('div').closest('td').prev().find('input').closest('div').closest('td').prev().find('input').val();
         self.closest('div').closest('td').next().find('input').val(self.unmask() * volume);
         fnAlltotalS();
      });
    }



  });
</script>
