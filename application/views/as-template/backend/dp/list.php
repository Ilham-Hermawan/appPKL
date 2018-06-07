
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
      <li class="active">Rencana DP</li>
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
              <a href="<?= site_url('dashboard/finance/transaksi/dp/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px !important;width:100% !important;">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th>
                <select class="form-control select2" name="filterPerumahan" id="filterPerumahan" style="font-size:12px;width:200px;">
                  <option value="all">All</option>
                  <?php if(!empty($data['perumahan'])): ?>
                    <?php foreach($data['perumahan'] as $row):  ?>
                      <option value="<?= $row->rumah_id ?>"><?= $row->rumah_nama ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </th>
              <th></th>
              <th>
                <select class="form-control select2" name="filterStatus" id="filterStatus" style="font-size:12px;width:100px;">
                  <option value="all">All</option>
                  <option value="y">Lunas</option>
                  <option value="n">Belum Lunas</option>
                </select>
              </th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Booking</th>
              <th class="dthead dthead-blue">Pelanggan</th>
              <th class="dthead dthead-blue">Perumahan</th>
              <th class="dthead dthead-blue">Keterangan</th>
              <th class="dthead dthead-blue">Status</th>
              <th class="dthead dthead-blue">Total</th>
              <th class="dthead dthead-blue">Created</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[Booking]</th>
              <th>[Pelanggan]</th>
              <th>[Perumahan]</th>
              <th>[Keterangan]</th>
              <th>[Status]</th>
              <th>[Total]</th>
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
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>

<script>
    $(window).load(function(){
      var perumahan = $( "#filterPerumahan" ).val() || "all";
      var status = $( "#filterStatus" ).val() || "all";
      $(".select2").select2();

      loadDt(perumahan, status);

      $( "#btn-reload" ).click(function() {
        var perumahan = "all";
        var status = "all";
        loadDt(perumahan, status);
        $("#filterPerumahan").val('all').trigger("change");
        $("#filterStatus").val('all').trigger("change");
      });

      $( "#filterPerumahan" ).change(function() {
        var perumahan = $( "#filterPerumahan" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";
        loadDt(perumahan, status);
      });

      $( "#filterStatus" ).change(function() {
        var perumahan = $( "#filterPerumahan" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";
        loadDt(perumahan, status);
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
            window.location.href = '<?= site_url('finance/dp_delete/'."'+id+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });


      function loadDt(perumahan, status){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('finance/get_dp_list/'.'"+perumahan+"/"+status+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 0, "DESC" ]],
          "columns": [
            { "data": "dp_id", "width": "1%", name: "dp_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "4%" },
            { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
            { "data": "rumah_nama", "sortable": true, "searchable": true, name: "rumah_nama", "width": "8%" },
            { "data": "dp_keterangan", "sortable": true, "searchable": true, name: "dp_keterangan" },
            { "data": "dp_status", "sortable": true, "searchable": true, name: "dp_status" },
            { "data": "dp_total", "sortable": true, "searchable": true, name: "dp_total", "width": "15%" },
            { "data": "dp_datetime", "sortable": false, "searchable": false, name: "dp_datetime", "width": "3%" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/finance/transaksi/dp/edit/'."'+row.dp_id+'"); ?>" title="Edit" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li><a href="javascript:void(0)" data-id="'+row.dp_id+'" title="Hapus" id="btn-hapus"><span class="fa fa-trash-o text-red"></span> Hapus</a></li>'+
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
                  if(data === 'y'){
                    return '<span class="label-text bg-green">LUNAS</span>';
                  }
                  else{
                    return '<span class="label-text bg-red">BELUM LUNAS</span>';
                  }
              },
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return 'Rp. '+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
              },
              "targets": 6 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == '0000-00-00 00:00:00'){
                    return '';
                  }
                  else{
                    return moment(data).format("DD MMM YYYY hh:mm:ss a")
                  }
              },
              "targets": 7 // column index
            },

          ],
        });
      }

    });
</script>
