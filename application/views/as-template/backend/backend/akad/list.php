
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
      <li class="active">Akad</li>
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
        <div style="margin-bottom:20px;">
          <div class="row">
            <div class="col-md-6">
              <a href="<?= site_url('dashboard/admin/transaksi/akad/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px !important;" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">NO Akad</th>
              <th class="dthead dthead-blue">TANGGAL</th>
              <th class="dthead dthead-blue">Perumahan</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[NO Akad]</th>
              <th>[Tanggal]</th>
              <th>[Perumahan]</th>
            </tr>
          </tfoot>
        </table>

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
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>

<script>
    $(window).load(function(){
      $(".select2").select2();

      loadDt();

      $( "#btn-reload" ).click(function() {
        loadDt();
      });

      $(document).on("click","a[id='btn-hapus']", function (e) {
        var id = $(this).attr("data-id");

        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this imaginary file!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel plx!",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            window.location.href = '<?= site_url('transaksi/akad_delete/'."'+id+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });


      function loadDt(){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('transaksi/get_akad_list/'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 0, "DESC" ]],
          "columns": [
            { "data": "akad_id", "width": "1%", name: "akad_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "akad_no", "sortable": true, "searchable": true, name: "akad_no", "width": "15%" },
            { "data": "rumah_nama", "sortable": true, "searchable": true, name: "rumah_nama" },
            { "data": "akad_date", "sortable": false, "searchable": false, name: "akad_date", "width": "3%" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/admin/transaksi/akad/dokument/'."'+row.akad_id+'"); ?>" target="_blank" title="Print" id="btn-print"><span class="fa fa-print"></span> Print</a></li>'+
                       '<li><a href="<?= site_url('dashboard/admin/transaksi/akad/edit/'."'+row.akad_id+'"); ?>" title="Edit" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li><a href="javascript:void(0)" data-id="'+row.akad_id+'" title="Hapus" id="btn-hapus"><span class="fa fa-trash-o text-red"></span> Hapus</a></li>'+
                       '</ul></div>';

              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return '<strong>'+data+'</strong>';
              },
              "targets": 1 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == '0000-00-00 00:00:00'){
                    return 'Belum diproses';
                  }
                  else{
                    return moment(data).format("DD MMM YYYY")
                  }
              },
              "targets": 3 // column index
            },

          ],
        });
      }

    });
</script>
