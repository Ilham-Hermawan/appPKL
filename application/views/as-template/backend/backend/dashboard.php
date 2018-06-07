
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
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?php if(!empty($this->session->flashdata('flashInfo'))): ?>
      <script>
        swal("Good job!", "Anda berhasil menyimpan data", "success");
      </script>
    <?php endif; ?>


    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <div class="row">
              <div class="col-md-3">
                <!-- <img src="bar-chart.png" width="50px"> -->
                <h1 class="fa fa-home" style="font-size:60px;margin-top:7px;"></h1>
              </div>
              <div class="col-md-9">
                <small class="stat-label">Total Project</small>
                <span class="processing">Menghitung data...</span>
                <h1 id="jumlah_perumahan"></h1>
              </div>
            </div>
          </div>

          <!-- <a href="<?= site_url('dashboard/rumah/list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div><!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <div class="row">
              <div class="col-md-3">
                <h1 class="fa fa-home" style="font-size:60px;margin-top:7px;"></h1>
              </div>
              <div class="col-md-9">
                <small class="stat-label">Total Kavling</small>
                <span class="processing">Menghitung data...</span>
                <h1 id="jumlah_kavling"></h1>
              </div>
            </div>
          </div>

          <!-- <a href="<?= site_url('dashboard/booking/list') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div><!-- ./col -->

      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <div class="row">
              <div class="col-md-3">
                <img src="<?= site_url(IMAGES_ICONS.'is-document.png') ?>" width="60px">
              </div>
              <div class="col-md-9">
                <small class="stat-label" id="booking">Booking per  </small>
                <span class="processing">Menghitung data...</span>
                <h1 id="jumlah_booking"></h1>
              </div>
            </div>
          </div>

          <!-- <a href="<?= site_url('dashboard/pelanggan/list'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
        </div>
      </div><!-- ./col -->

    </div><!-- /.row -->
    <!-- End row -->
    



  <div class="row">
    <div class="col-md-6">

      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Recently Login</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            <?php if(!empty($data['last_login'])): ?>
              <?php foreach($data['last_login'] as $row): ?>
                <li class="item">
                  <div class="product-img">
                    <img src="<?= site_url(IMAGES_USER.$row->user_avatar) ?>" class="img-thumbnail" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <?= $row->user_fullname ?>
                      <span class="product-description">
                        <?= date('d M Y H:i:s a', strtotime($row->umeta_lastlogin)); ?><br/>
                        <?php if($row->user_level === "0"): ?>
                          Level : <span class="text-red"><?= strtoupper(LEVEL_0); ?></span>
                        <?php elseif($row->user_level === "1"): ?>
                          Level : <span class="text-success"><?= strtoupper(LEVEL_1); ?></span>
                        <?php elseif($row->user_level === "2"): ?>
                          Level : <span class="text-blue"><?= strtoupper(LEVEL_2); ?></span>
                        <?php elseif($row->user_level === "3"): ?>
                          Level : <span class="text-purple"><?= strtoupper(LEVEL_3); ?></span>
                        <?php else: ?>
                          Level : <span><?= strtoupper(LEVEL_UNDIFINED); ?></span>
                        <?php endif; ?>
                      </span>
                  </div>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">

        </div>
        <!-- /.box-footer -->
      </div>

    </div><!-- /.col-md-6 -->
    <div class="col-md-6">

      <!-- PRODUCT LIST -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Recently Added Users</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <ul class="products-list product-list-in-box">
            <?php if(!empty($data['list_user'])): ?>
              <?php foreach($data['list_user'] as $row): ?>
                <li class="item">
                  <div class="product-img">
                    <img src="<?= site_url(IMAGES_USER.$row->user_avatar) ?>" class="img-thumbnail" alt="Product Image">
                  </div>
                  <div class="product-info">
                    <?= $row->user_fullname ?>
                      <span class="product-description">
                        <?= date('d M Y H:i:s a', strtotime($row->user_created)); ?><br/>
                        <?php if($row->user_level === "0"): ?>
                          Level : <span class="text-red"><?= strtoupper(LEVEL_0); ?></span>
                        <?php elseif($row->user_level === "1"): ?>
                          Level : <span class="text-success"><?= strtoupper(LEVEL_1); ?></span>
                        <?php elseif($row->user_level === "2"): ?>
                          Level : <span class="text-blue"><?= strtoupper(LEVEL_2); ?></span>
                        <?php elseif($row->user_level === "3"): ?>
                          Level : <span class="text-purple"><?= strtoupper(LEVEL_3); ?></span>
                        <?php else: ?>
                          Level : <span><?= strtoupper(LEVEL_UNDIFINED); ?></span>
                        <?php endif; ?>
                      </span>
                  </div>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-center">

        </div>
        <!-- /.box-footer -->
      </div>


    </div><!-- /.col-md-6 -->
  </div><!-- /.row -->


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>

<script>
  $(window).load(function(){
    get_data_box();

    function get_data_box(){
      $(".processing").show();
      $.ajax({
          type: "GET",
          url: "<?=site_url('dashboard/get_data_box/');?>",
          cache: false,
          success: function (data) {
              $(".processing").hide();
              var obj = $.parseJSON(data);
              //console.log(data);
              $("#jumlah_perumahan").html(obj.jumlah_perumahan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") || "0");
              $("#jumlah_kavling").html(obj.jumlah_kavling.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") || "0");
              $("#booking").html('Booking per ' + obj.bulan);
              $("#jumlah_booking").html(obj.jumlah_booking.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") || "0");

          },
          error: function(err) {
              console.log(err);
          }
      });
    }
  });
</script>
