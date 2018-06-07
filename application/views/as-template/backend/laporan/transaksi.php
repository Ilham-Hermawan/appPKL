
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
      <li>Laporan</li>
      <li class="active">Transaksi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="row">
      <?php if($this->session->userdata('userlevel') == "0" OR $this->session->userdata('userlevel') == "1"): ?>
      <div class="col-md-3">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Booking</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <p>Silahkan pilih kategori dibawah :</p>
              <div class="form-group">
                <label>Dari Tanggal :</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker" id="d-booking1">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>Sampai Tanggal :</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker" id="d-booking2">
                </div>
                <!-- /.input group -->
              </div>

              <div class="form-group">
                <label>Perumahan</label>
                <select class="form-control select2" id="filterPerumahan">
                <?php if(!empty($data['perumahan'])): ?>
                  <?php foreach($data['perumahan'] as $row): ?>
                    <option value="<?= $row->rumah_id ?>"><?= $row->rumah_nama ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
                </select>
              </div>



            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-block" id="btn_booking_pdf"><i class="fa fa-eye"></i> View</button>
            </div>
          </div>
          <!-- /.box -->
      </div>
      <?php endif; ?>

      <?php if($this->session->userdata('userlevel') != "2"): ?>
      <div class="col-md-3">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Pencairan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="text-center" style="margin:20px 0px;">
                <img src="<?= base_url(IMAGES_ICONS.'Sales-report-icon.png') ?>">
              </div>

              <p>Silahkan pilih kategori dibawah :</p>

              <div class="form-group">
                <label>Perumahan</label>
                <select class="form-control select2" id="filterPerumahan2">
                <?php if(!empty($data['perumahan'])): ?>
                  <?php foreach($data['perumahan'] as $row): ?>
                    <option value="<?= $row->rumah_id ?>"><?= strtoupper($row->rumah_nama) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
                </select>
              </div>



            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-block" id="btn_pencairan_pdf"><i class="fa fa-eye"></i> View</button>
            </div>
          </div>
          <!-- /.box -->
      </div>
      <?php endif; ?>

      <?php if($this->session->userdata('userlevel') != "3"): ?>
      <div class="col-md-3">
        <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Laporan Progress Booking</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <div class="text-center" style="margin:20px 0px;">
                <img src="<?= base_url(IMAGES_ICONS.'Sales-report-icon.png') ?>">
              </div>

              <p>Silahkan pilih kategori dibawah :</p>

              <div class="form-group">
                <label>Perumahan</label>
                <select class="form-control select2" id="filterPerumahan3">
                <?php if(!empty($data['perumahan'])): ?>
                  <?php foreach($data['perumahan'] as $row): ?>
                    <option value="<?= $row->rumah_id ?>"><?= strtoupper($row->rumah_nama) ?></option>
                  <?php endforeach; ?>
                <?php endif; ?>
                </select>
              </div>



            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button class="btn btn-primary btn-block" id="btn_progress_booking_pdf"><i class="fa fa-eye"></i> View</button>
            </div>
          </div>
          <!-- /.box -->
      </div>
      <?php endif; ?>

    </div>


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
    $(window).load(function(){
      $(".select2").select2();
      $('.datepicker').datepicker({
        autoclose: true
      });

      $( "#btn_booking_pdf" ).click(function() {
        var dt1 = $('#d-booking1').val() || "all";
        var dt2 = $('#d-booking2').val() || "all";
        var perumahan = $('#filterPerumahan').val() || "all";

        var url = '<?= site_url('dashboard/laporan/transaksi/booking/'."'+dt1+'/'+dt2+'/'+perumahan+'"); ?>';
        window.open(url, '_blank');
      });

      $( "#btn_pencairan_pdf" ).click(function() {
        var rumah_id = $('#filterPerumahan2').val();;
        var url = '<?= site_url('dashboard/laporan/pencairan/'."'+rumah_id+'"); ?>';
        window.open(url, '_blank');
      });

      $( "#btn_progress_booking_pdf" ).click(function() {
        var rumah_id = $('#filterPerumahan3').val();;
        var url = '<?= site_url('dashboard/laporan/progress_booking/'."'+rumah_id+'"); ?>';
        window.open(url, '_blank');
      });

    });
</script>
