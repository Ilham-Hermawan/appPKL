
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
      <li class="active">Pengeluaran</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'].' '.$data['nama'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <div class="row">

          <?php if(!empty($data['pengeluaran_jenis'])): ?>
            <?php foreach($data['pengeluaran_jenis'] as $row): ?>
              <div class="col-md-3">
                <div class="box box-primary box-solid text-center">
                  <div class="box-header with-border" style="height:60px;">
                    <strong><?= $row->pj_nama ?></strong>
                  </div>
                  <div class="box-body text-center">
                    <img src="<?= site_url(IMAGES_ICONS.'bulb-money-flat.png') ?>" width="30%">
                    <hr/>
                    <a href="<?= site_url('dashboard/pengeluaran/list/'.$this->uri->segment(3).'/'.$row->pj_id) ?>" class="btn btn-primary btn-block">Action</a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>

        <br/>


      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <div class="row">
      <div class="col-md-7">
        <div class="small-box bg-green rab">
            <div class="inner">
              <img src="<?= site_url(IMAGES_ICONS.'loading.svg') ?>" class="pull-right img-loading">
              <h3>Ringkasan RAB</h3>
              <div class="row">
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Modal</p>
                    <h4 id="modal">Rp. 0</h4>
                  </div>    
                </div>
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Penerimaan Penjualan</p>
                    <h4 id="penerimaan-penjualan">Rp. 0</h4>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Harga Pokok Produksi</p>
                    <h4 id="hpp">Rp. 0</h4>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Target Gros Profit Developer</p>
                    <h4 id="tgpd">Rp. 0</h4>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Biaya Umum dan Administrasi</p>
                    <h4 id="biaya-umum">Rp. 0</h4>
                  </div>
                </div>
                <div class="col-sm-6 col-xs-6 col-md-6">
                  <div style="margin-bottom: 20px;">
                    <p><i class="fa fa-arrow-right"></i> Target Laba Proyek</p>
                    <h4 id="target_laba_proyek">Rp. 0</h4>
                  </div>
                </div>
              </div>
              
              
            </div>
            
          </div>
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
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'ajaxQueue/jquery.ajaxQueue.min.js'); ?>"></script>

<script>
$('.img-loading').show();
    $(window).load(function(){
      jQuery.ajaxQueue({
        url: "<?= site_url('pengeluaran/get_mpp/'.$this->uri->segment(3)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('.img-loading').hide();
        $('#modal').html('Rp. ' + data.modal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#penerimaan-penjualan').html('Rp. ' + data.penerimaan_penjualan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#hpp').html('Rp. ' + data.hpp.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        var tgpd = (parseInt(data.modal) + parseInt(data.penerimaan_penjualan)) - parseInt(data.hpp);
        $('#tgpd').html('Rp. ' + tgpd.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        $('#biaya-umum').html('Rp. ' + data.biaya_umum.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        var target_laba_proyek = parseInt(tgpd) - parseInt(data.biaya_umum);
        $('#target_laba_proyek').html('Rp. ' + target_laba_proyek.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
      });

    });
</script>
