
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
      <li class="active">Rumah</li>
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
              <a href="<?= site_url('dashboard/rumah/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Kode</th>
              <th class="dthead dthead-blue">Perumahan</th>
              <th class="dthead dthead-blue">Alamat</th>
              <th class="dthead dthead-blue">Created</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[Kode]</th>
              <th>[Perumahan]</th>
              <th>[Alamat]</th>
              <th>[Created]</th>
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

<script>
    $(window).load(function(){

      loadDt();

      $( "#btn-reload" ).click(function() {
        loadDt();
      });

      $(document).on("click","a[id='btn-delete']", function (e) {
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
            window.location.href = '<?= site_url('dashboard/rumah/delete/'."'+id+'"); ?>';
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
          "ajax": "<?= site_url('rumah/get_list_data/'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 1, "asc" ]],
          "columns": [
            { "data": "rumah_id", "width": "8%", name: "rumah_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "rumah_kode", "width": "8%", "sortable": true, "searchable": true, name: "rumah_kode" },
            { "data": "rumah_nama", "sortable": true, "searchable": true, name: "rumah_nama" },
            { "data": "rumah_alamat", "sortable": true, "searchable": true, name: "rumah_alamat" },
            { "data": "rumah_created", "sortable": true, "searchable": true, name: "rumah_created", "width": "11%" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/rumah/edit/'."'+row.rumah_id+'") ?>" title="Edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li><a href="<?= site_url('dashboard/rumah/kavling/'."'+row.rumah_id+'") ?>" title="Kavling"><span class="fa fa-home"></span> Kavling</a></li>'+
                       '<li class="divider"></li>' +
                       '<li><a href="javascript:void(0)" data-id="'+row.rumah_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return "<i class='ion-calendar'></i> : "+moment(data).format("DD/MM/YYYY")+"<br/><i class='ion-clock'></i> : "+moment(data).format("hh:mm:ss a")
              },
              "targets": 4 // column index
            },

          ],
        });
      }

    });
</script>
