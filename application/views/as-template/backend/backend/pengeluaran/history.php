
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
              <!-- <a href="<?= site_url('dashboard/pengeluaran/bayar/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>" class="btn btn-primary"><i class="fa fa-money"></i> Tambah Data</a> -->
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover table-striped" style="font-size:13px !important;" width="100%">
          <thead>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Tanggal</th>
              <th class="dthead dthead-blue">No</th>
              <th class="dthead dthead-blue">Penerima</th>
              <th class="dthead dthead-blue">Satuan</th>
              <th class="dthead dthead-blue">Sub Jumlah</th>
              <th class="dthead dthead-blue">Volume</th>
              <th class="dthead dthead-blue">Total</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[Tanggal]</th>
              <th>[No]</th>
              <th>[Penerima]</th>
              <th>[Satuan]</th>
              <th>[Sub Jumlah]</th>
              <th>[Volume]</th>
              <th>[Total]</th>
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

      reload_data();

      $( "#btn-reload" ).click(function() {
        loadDt();
      });

      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = $(this).attr("data-id");

        swal({
          title: "Are you sure?",
          text: "Are you sure that you want to delete?",
          type: "warning",
          showCancelButton: true,
          closeOnConfirm: false,
          confirmButtonText: "Yes, cancel it!",
          confirmButtonColor: "#ec6c62"
          }, function() {
              $.ajax(
                  {
                      type: "get",
                      url: "<?= site_url('pengeluaran/delete_pengeluaran_history/'.'"+id+"'); ?>",
                      success: function(data){
                      }
                  }
              )
            .done(function(data) {
              swal("Deleted!", "Your imaginary file has been deleted.", "success");
              loadDt();
            })
            .error(function(data) {
              swal("Oops", "We couldn't connect to the server!", "error");
            });
        });
      });

      function reload_data(){
        loadDt();
      }


      function loadDt(){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('pengeluaran/get_history_pengeluaran/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 1, "ASC" ]],
          "columns": [
            { "data": "pengeluaran_id", "width": "5%", name: "pengeluaran_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "pengeluaran_tanggal", "sortable": true, "searchable": true, name: "pengeluaran_tanggal", "width": "3%", className: 'text-center' },
            { "data": "pengeluaran_no", "sortable": true, "searchable": true, name: "pengeluaran_no",  "width": "14%" },
            { "data": "pengeluaran_kepada", "sortable": true, "searchable": true, name: "pengeluaran_kepada", },
            { "data": "pengeluaran_satuan", "sortable": true, "searchable": true, name: "pengeluaran_satuan", "width": "8%" },
            { "data": "pengeluaran_harga_satuan", "sortable": true, "searchable": true, name: "pengeluaran_harga_satuan", "width": "12%", },
            { "data": "pengeluaran_volume", "sortable": true, "searchable": true, name: "pengeluaran_volume", "width": "8%", className: 'text-center' },
            { "data": "pengeluaran_harga_satuan", "sortable": true, "searchable": true, name: "pengeluaran_harga_satuan", "width": "12%", }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/pengeluaran/bayar/'.$this->uri->segment(4).'/'.$this->uri->segment(4).'/'."'+row.pengeluaran_id+'") ?>" title="Edit" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li><a href="<?= site_url('dashboard/pengeluaran/kwitansi/'."'+row.pengeluaran_id+'") ?>" target="_blank" title="Kwitansi" id="btn-kwitansi"><span class="fa fa-print"></span> Kwitansi</a></li>'+
                       '<li class="divider"></li>' +
                       '<li><a href="javascript:void(0)" data-id="'+row.pengeluaran_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return moment(data).format("DD/MM/YYYY")
              },
              "targets": 1 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span class="text-blue text-bold">'+data+'</span>';
              },
              "targets": 2 // column index
            },
            {
              "render": function ( data, type, row ) {
                return 'Rp. <span class="pull-right">'+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
              },
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                var total = parseInt(row.pengeluaran_volume) * parseInt(data);
                return 'Rp. <span class="pull-right">'+total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
              },
              "targets": 7 // column index
            },

          ],
        });
      }

    });
</script>
