
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
      <li class="active">Project</li>
      <li class="active">Display</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> Daftar Project</strong></h3>

        <div class="box-tools pull-right">
          <div class="btn-group pull-right">
            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i> Action <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="<?= site_url('dashboard/project/kavling/'.$data['project']->rumah_id) ?>" title="Kavling"><span class="fa fa-home"></span> Kavling</a></li>
                <li><a href="<?= site_url('dashboard/project/edit/'.$data['project']->rumah_id) ?>" title="Edit"><span class="fa fa-pencil"></span> Edit Project</a></li>
                <li class="divider"></li>
                <li><a href="javascript:void(0)" class="text-red" title="Delete" id="btn-delete"><span class="fa fa-trash-o"></span> Delete</a></li>
              </ul>
          </div>
        </div>

      </div>
      <div class="box-body">

        <div class="row">
          <div class="col-md-4">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <i class="fa fa-home"></i> INFO <strong>PROJECT</strong>
              </div>
              <div class="box-body">
                <div class="text-center">
                  <img src="<?= site_url(IMAGES_ICONS.'flathome.png') ?>" width="30%">
                </div>
                <hr>
                <small class="text-blue">Nama Perumahan : </small>
                <h4 style="margin:0;"><?= !empty($data['project']->rumah_nama) ? strtoupper($data['project']->rumah_nama) : '-' ?></h4>
                <br/>
                <div class="row">
                  <div class="col-md-6">
                    <small class="text-blue">Kode Perumahan : </small>
                    <h4 style="margin:0;"><?= !empty($data['project']->rumah_kode) ? "<strong>".$data['project']->rumah_kode."</strong>" : '-' ?></h4>
                    <br/>
                  </div>
                  <div class="col-md-6">
                    <small class="text-blue">Kavling : </small>
                    <h4 style="margin:0;"><?= !empty($data['count_kavling']) ? '<strong>'.$data['count_kavling'].'</strong>' : '-' ?></h4>
                  </div>
                </div>

                <small class="text-blue">Alamat : </small>
                <h5 style="margin:0;"><?= !empty($data['project']->rumah_alamat) ? $data['project']->rumah_alamat : '-' ?></h5>
                <br/>
                <small class="text-blue">Kelurahan : </small>
                <h5 style="margin:0;"><?= !empty($data['project']->rumah_desa) ? $data['project']->rumah_desa : '-' ?></h5>
                <br/>
                <small class="text-blue">Kecamatan : </small>
                <h5 style="margin:0;"><?= !empty($data['project']->rumah_kecamatan) ? $data['project']->rumah_kecamatan : '-' ?></h5>
                <br/>
                <small class="text-blue">Kota : </small>
                <h5 style="margin:0;"><?= !empty($data['project']->rumah_kota) ? $data['project']->rumah_kota : '-' ?></h5>
                <br/>
                <small class="text-blue">Provinsi : </small>
                <h5 style="margin:0;"><?= !empty($data['project']->rumah_provinsi) ? $data['project']->rumah_provinsi : '-' ?></h5>
              </div>
            </div>
          </div>

          <div class="col-md-4">

            <div class="box box-success box-solid">
              <div class="box-header with-border">
                <i class="fa fa-home"></i> UNIT <strong>TERSEDIA</strong>
              </div>
              <div class="box-body text-center">
                <div class="text-center">
                  <img src="<?= site_url(IMAGES_ICONS.'flathome.png') ?>" width="30%">
                </div>
                <hr>
                <h2 style="margin:0;">
                  <img id="tersedia-loading" src="<?= site_url(IMAGES_ICONS.'loading.svg') ?>" width="24px">
                  <strong id="tersedia"></strong>
                </h2>
                <small>Unit</small>
                <a href="<?= site_url('dashboard/project/tersedia/'.$this->uri->segment(4)); ?>" class="btn btn-block btn-primary" style="margin-top:10px;">Detil</a>
              </div>
            </div>

          </div>

          <div class="col-md-4">

            <div class="box box-danger box-solid">
              <div class="box-header with-border">
                <i class="fa fa-home"></i> UNIT <strong>TERJUAL</strong>
              </div>
              <div class="box-body text-center">
                <div class="text-center">
                  <img src="<?= site_url(IMAGES_ICONS.'flathome.png') ?>" width="30%">
                </div>
                <hr>
                <h2 style="margin:0;">
                  <img id="terjual-loading" src="<?= site_url(IMAGES_ICONS.'loading.svg') ?>" width="24px">
                  <strong id="terjual"></strong>
                </h2>
                <small>Unit</small>
                <a href="<?= site_url('dashboard/project/terjual/'.$this->uri->segment(4)); ?>" class="btn btn-block btn-primary" style="margin-top:10px;">Detil</a>
              </div>
            </div>

          </div>


          <div class="col-md-4">
            &nbsp;
          </div>

          <div class="col-md-4">

            <div class="box box-danger box-solid">
              <div class="box-header with-border">
                <i class="fa fa-times"></i> UNIT <strong>DIBATALKAN</strong>
              </div>
              <div class="box-body text-center">
                <div class="text-center">
                  <img src="<?= site_url(IMAGES_ICONS.'playstation-cross-icon.png') ?>" width="30%">
                </div>
                <hr>
                <a href="<?= site_url('dashboard/project/dibatalkan/'.$this->uri->segment(4)); ?>" class="btn btn-block btn-primary" style="margin-top:10px;">Daftar Unit yang dibatalkan</a>
              </div>
            </div>

          </div>


        </div>

      </div><!-- /.box-body -->
    </div><!-- /.box -->


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'ajaxQueue/jquery.ajaxQueue.min.js'); ?>"></script>

<script>
    $(window).load(function(){
      $('#tersedia-loading').show();
      $('#tersedia').hide();
      $('#terjual-loading').show();
      $('#terjual').hide();

      jQuery.ajaxQueue({
        url: "<?= site_url('project/count_tersedia/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#tersedia-loading').hide();
        $('#tersedia').text(data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        $('#tersedia').show();
      });

      jQuery.ajaxQueue({
        url: "<?= site_url('project/count_terjual/'.$this->uri->segment(4)) ?>",
        dataType: "json"
      }).done(function( data ) {
        $('#terjual-loading').hide();
        $('#terjual').text(data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        $('#terjual').show();
      });

      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = <?= $this->uri->segment(4) ?>;

        swal({
          title: "Are you sure?",
          text: "Semua data yang berhubungan dengan project ini akan dihapus",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, delete it!",
          confirmButtonColor: "#ec6c62"
          }, function() {
              $.ajax(
                  {
                      type: "get",
                      url: "<?= site_url('project/delete_project/'.'"+id+"'); ?>",
                      success: function(data){
                      }
                  }
              )
            .done(function(data) {
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
              location.href='<?= site_url('dashboard/project') ?>';
            })
            .error(function(data) {
              swal("Oops", "We couldn't connect to the server!", "error");
            });
        });

      });

    });
</script>
