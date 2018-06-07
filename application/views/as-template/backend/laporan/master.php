
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
      <li class="active">Master</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="row">
      <div class="col-md-3">

        <div class="box">

          <div class="box-body">
            <div class="text-center">
              <h4>LAPORAN DAFTAR PERUMAHAN</h4>
              <img src="<?= site_url(IMAGES_ICONS.'house.svg'); ?>" width="50%">
              <br/><br/>
              <span style="font-weight:normal;">Silahkan pilih kategori dibawah</span>
            </div>
            <hr/>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-12">
                  <label>Perumahan</label>
                  <select class="form-control select2" id="filterPerumahan">
                    <option value="all">All</option>
                  <?php if(!empty($data['perumahan'])): ?>
                    <?php foreach($data['perumahan'] as $row): ?>
                      <option value="<?= $row->rumah_id ?>"><?= $row->rumah_nama ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                  </select>
                </div>
              </div>
            </div><!--end form-group-->

            <div class="form-group">
              <button class="btn btn-primary btn-block" id="btn_perumahan_pdf"><i class="fa fa-eye"></i> View Data</button>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>

      <div class="col-md-3">

        <div class="box">
          <div class="box-body">

            <div class="text-center">
              <h4>LAPORAN DAFTAR PELANGGAN</h4>
              <img src="<?= site_url(IMAGES_ICONS.'team.svg'); ?>" width="50%">
              <br/><br/>
              <span style="font-weight:normal;">Silahkan pilih kategori dibawah</span>
            </div>
            <hr/>
            <div class="form-group">
              <button class="btn btn-primary btn-block" id="btn_pelanggan_pdf"><i class="fa fa-eye"></i> View Data</button>
            </div>

          </div><!-- /.box-body -->
        </div><!-- /.box -->

      </div>


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

<script>
    $(window).load(function(){
      $(".select2").select2();

      $( "#btn_perumahan_pdf" ).click(function() {
        var perumahan = $('#filterPerumahan').val() || "all";

        var url = '<?= site_url('dashboard/laporan/master/perumahan/'."'+perumahan+'"); ?>';
        window.open(url, '_blank');
      });

      $( "#btn_pelanggan_pdf" ).click(function() {


        var url = '<?= site_url('dashboard/laporan/master/pelanggan/'); ?>';
        window.open(url, '_blank');
      });

    });
</script>
