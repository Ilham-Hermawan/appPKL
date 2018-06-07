
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
      <li class="active">Transaksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>No. KTP</label>
                  <input type="text" id="pelanggan_ktp" class="form-control" placeholder="KTP Pelanggan" readonly="true" value="<?= $data['set']->pelanggan_ktp ?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>Nama</label>
                  <input type="text" id="pelanggan_nama" class="form-control" placeholder="Nama Pelanggan" readonly="true" value="<?= $data['set']->pelanggan_nama ?>">
                </div>
              </div>
            </div>

          </div><!--end col-md-6-->
          <div class="col-md-6">
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>No Booking</label>
                  <select id="booking_no" class="form-control select2">
                    <option value="">Silahkan pilih no booking</option>
                    <?php if(!empty($data['booking'])): ?>
                      <?php foreach($data['booking'] as $row): ?>
                        <option value="<?= $row->booking_id ?>"><?= $row->booking_no ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>Perumahan</label>
                  <input type="text" id="rumah_nama" class="form-control" placeholder="Nama Perumahan" readonly="true">
                </div>
              </div>
            </div>

          </div><!--end col-md-6-->
        </div><!--end row-->
        <hr/>
        <table width="100%" class="table table-bordered">
          <thead>
            <th class="dthead dthead-blue text-center">BI CHECKING</th>
            <th class="dthead dthead-blue text-center">PPJB</th>
            <th class="dthead dthead-blue text-center">BERKAS</th>
            <th class="dthead dthead-blue text-center">WAWANCARA</th>
            <th class="dthead dthead-blue text-center">DATA KE BTN</th>
            <th class="dthead dthead-blue text-center">OTS</th>
            <th class="dthead dthead-blue text-center">SP3K</th>
            <th class="dthead dthead-blue text-center">LPA</th>
            <th class="dthead dthead-blue text-center">VALIDASI PAJAK</th>
            <th class="dthead dthead-blue text-center">AKAD</th>
            <th class="dthead dthead-blue text-center">SKR</th>
            <th class="dthead dthead-blue text-center">JAMINAN 100 HARI</th>
          </thead>
          <tbody>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="bichecking"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="ppjb"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="berkas"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="wawancara"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="btn"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="ots"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="sp3k"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="lpa"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="vpajak"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="akad"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="skr"></span></td>
            <td class="text-center"><img class="processing" src="<?= site_url(IMAGES_WEB."loading.gif") ?>" width="28px"><span id="jaminan"></span></td>
          </tbody>
        </table>
      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <a href="<?php echo site_url('dashboard/pelanggan/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
        </div>
      </div>
    </div><!-- /.box -->


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>

<script>

  $(window).load(function(){
    $(".select2").select2();
    $(".processing").hide();

    $( "#booking_no" ).change(function() {
      $(".processing").show();
      $.ajax({
        url: "<?= site_url('booking/get_data_by_no'); ?>",
        data: { id: $( "#booking_no" ).val()},
        dataType: "json",
        type: "POST",
        success: function(data){
          $( "#rumah_nama" ).val(data.rumah_nama);
        }
      });

      $( "#bichecking" ).html('');
      $( "#ppjb" ).html('');
      $( "#berkas" ).html('');
      $( "#btn" ).html('');
      $( "#ots" ).html('');
      $( "#sp3k" ).html('');
      $( "#lpa" ).html('');
      $( "#vpajak" ).html('');
      $( "#akad" ).html('');
      $( "#skr" ).html('');
      $( "#jaminan" ).html('');

      $.ajax({
        url: "<?= site_url('pelanggan/get_status_transaksi'); ?>",
        data: { booking: $( "#booking_no" ).val()},
        dataType: "json",
        type: "POST",
        success: function(data){
          $(".processing").hide();
          if(data.bichecking === 'y'){
            $( "#bichecking" ).html('<span class="label-text bg-green">DITERIMA</span>');
          }
          else if(data.bichecking === 'p'){
            $( "#bichecking" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else{
            $( "#bichecking" ).html('<span class="label-text bg-red">DITOLAK</span>');
          }
          //PPJB
          if(data.ppjb === 'y'){
            $( "#ppjb" ).html('<span class="label-text bg-green">DITERIMA</span>');
          }
          else if(data.ppjb === 'p'){
            $( "#ppjb" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else if(data.ppjb === 'n'){
            $( "#ppjb" ).html('<span class="label-text bg-red">DITOLAK</span>');
          }
          else{
            $( "#ppjb" ).html('-');
          }
          //BERKAS
          $( "#berkas" ).html('<span>'+data.kelengkapanberkas+'</span>');

          if(data.wawancara){
            $( "#wawancara" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else{
            $( "#wawancara" ).html('<span class="label-text bg-red">BELUM</span>');
          }

          if(data.dbtn === 'y'){
            $( "#btn" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else if(data.dbtn === 'p'){
            $( "#btn" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else if(data.dbtn === 'n'){
            $( "#btn" ).html('<span class="label-text bg-red">DITOLAK</span>');
          }
          else{
            $( "#btn" ).html('-');
          }

          if(data.ots === 'y'){
            $( "#ots" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else if(data.ots === 'p'){
            $( "#ots" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else if(data.ots === 'n'){
            $( "#ots" ).html('<span class="label-text bg-red">DITOLAK</span>');
          }
          else{
            $( "#ots" ).html('-');
          }

          if(data.sp3k === 'y'){
            $( "#sp3k" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else if(data.sp3k === 'p'){
            $( "#sp3k" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else if(data.sp3k === 'n'){
            $( "#sp3k" ).html('<span class="label-text bg-red">DITOLAK</span>');
          }
          else{
            $( "#sp3k" ).html('-');
          }

          if(data.lpa){
            $( "#lpa" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else{
            $( "#lpa" ).html('-');
          }

          if(data.vpajak === 'y'){
            $( "#vpajak" ).html('<span class="label-text bg-green">VALID</span>');
          }
          else if(data.vpajak === 'p'){
            $( "#vpajak" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else if(data.vpajak === 'n'){
            $( "#vpajak" ).html('<span class="label-text bg-red">TIDAK VALID</span>');
          }
          else{
            $( "#vpajak" ).html('-');
          }

          if(data.akad){
            $( "#akad" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          else{
            $( "#akad" ).html('-');
          }

          if(data.skr === 'y'){
            $( "#skr" ).html('<span class="label-text bg-green">SUDAH</span>');
          }
          if(data.skr === 'n'){
            $( "#skr" ).html('<span class="label-text bg-light-blue">PROSES</span>');
          }
          else{
            $( "#skr" ).html('-');
          }

          if(!data.jaminan){
            $( "#jaminan" ).html('-');
          }
          else{
            $( "#jaminan" ).html('<span>'+moment(data.jaminan).format("DD MMM YYYY")+'</span>');
          }

        }
      });



    });

  });
</script>
