
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
        <div style="margin-bottom:20px;">
          <div class="row">
            <div class="col-md-6">
              <a href="<?= site_url('dashboard/pengeluaran/bayar/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>" class="btn btn-primary"><i class="fa fa-money"></i> Pengeluaran</a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px !important;" width="100%">
          <thead>
            <tr>
              <th class="dthead dthead-blue" style="width:5%;">Action</th>
              <th class="dthead dthead-blue">Uraian</th>
              <th class="dthead dthead-blue" style="width:20%;">Jumlah Pengeluaran</th>
            </tr>
          </thead>
          <tbody>
            <?php $total = 0; ?>
            <?php if(!empty($data['detil'])): ?>
              <?php foreach($data['detil'] as $row): ?>
                <?php
                $total = $total + $row->sub_total;
                ?>
                <tr>
                  <td>
                    <div class="btn-group">
                      <a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                           <li><a href="<?= site_url('dashboard/pengeluaran/history/'.$this->uri->segment(4).'/'.$row->pp_id) ?>" title="History" id="btn-history"><span class="fa fa-history"></span> History</a></li>
                        </ul>
                    </div>
                  </td>
                  <td><?= $row->pengeluaran_nama ?></td>
                  <td>
                    <?php if($row->sub_total != NULL): ?>
                      Rp. <span class="pull-right"><?= number_format($row->sub_total) ?></span>
                    <?php else: ?>
                      Rp. <span class="pull-right">0</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4">No data available in table</td>
              </tr>
            <?php endif; ?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-right" colspan="2" style="padding-top:20px;">Total</th>
              <th><h4 class="text-green">Rp. <span class="pull-right"><?= number_format($total) ?></h4></th>
            </tr>
            <tr>
              <th>[Action]</th>
              <th>[Uraian]</th>
              <th>[Jumlah Pengeluaran]</th>
            </tr>
          </tfoot>
        </table>

      </div><!-- /.box-body -->
      <div class="box-footer text-right">
        <a href="<?= site_url('dashboard/pengeluaran/'.$this->uri->segment(4)) ?>" class="btn btn-default">Kembali</a>
      </div>
    </div><!-- /.box -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Informasi Detil Booking</h4>
                </div>
                <div class="modal-body edit-content">
                  <div style="border:1px solid #cfcfcf;padding:10px;">
                    <strong style="margin:0;">KELENGKAPAN</strong>
                  </div>

                  <div class="row" style="margin:10px 0;">
                    dsadasdf
                  </div><!--end row-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->


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
      var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};

      // reload_data();

      

      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = $(this).attr("data-id");

        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#dd5555",
          confirmButtonText: "Hapus!",
          cancelButtonText: "Tutup",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Success!", "Sudah dihapus", "success");
            window.location.href = '<?= site_url('dashboard/transaksi/penerimaan/delete/'."'+id+'"); ?>';
          } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });





    });
</script>
