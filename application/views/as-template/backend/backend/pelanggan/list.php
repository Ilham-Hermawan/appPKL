
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
      <li class="active">Pelanggan</li>
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
              <a href="<?= site_url('dashboard/pelanggan/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
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
          <th>
            <select class="form-control" name="filterJk" id="filterJk" style="width:70px !important;">
              <option value="all">All</option>
              <option value="l">LAKI-LAKI</option>
              <option value="p">PEREMPUAN</option>
            </select>
          </th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        <tr>
          <th class="dthead dthead-blue">Action</th>
          <th class="dthead dthead-blue">No. KTP</th>
          <th class="dthead dthead-blue">Nama Lengkap</th>
          <th class="dthead dthead-blue">JK</th>
          <th class="dthead dthead-blue">Alamat</th>
          <th class="dthead dthead-blue">Kontak</th>
          <th class="dthead dthead-blue">Pekerjaan</th>
          <th class="dthead dthead-blue">TTL</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>[Action]</th>
          <th>[No. KTP]</th>
          <th>[Nama Lengkap]</th>
          <th>[JK]</th>
          <th>[Alamat]</th>
          <th>[Kontak]</th>
          <th>[Pekerjaan]</th>
          <th>[TTL]</th>
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
      var jk = $( "#filterJk" ).val() || "all";
      loadDt(jk);

      $( "#btn-reload" ).click(function() {
        var jk = "all";

        loadDt(jk);

        $("#filterJk").val('all').trigger("change");
      });

      $( "#filterJk" ).change(function() {
        var jk = $( "#filterJk" ).val() || "all";

        loadDt(jk);
      });

      $('#view-modal').on('show.bs.modal', function(e) {
         var id = e.relatedTarget.dataset.id;
         //$(".modal-body #te").text( id );

         $.ajax({
             type: "GET",
             url: "<?=site_url('finance/get_pi_by_id/" + id + "');?>",
             cache: false,
             success: function (data) {
                 var obj = $.parseJSON(data);
                 //console.log(data);
                 $('#booking_no').val(obj.booking_no);
                 $('#pi_id').val(obj.pi_id);
                 $('#pelanggan_nama').val(obj.pelanggan_nama);
                 $('#rumah_nama').val(obj.rumah_nama);
                 if(obj.pi_harga){
                    $('#input_nominal').val(obj.pi_harga);
                 }
                 $('#input_nominal').priceFormat(rupiah);

             },
             error: function(err) {
                 console.log("ERROR AJAX");
             }
         });

      });

      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = $(this).attr("data-id");
        var ktp = $(this).attr("data-ktp");

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
            window.location.href = '<?= site_url('dashboard/pelanggan/delete/'."'+id+'/'+ktp+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      function loadDt(jk){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('pelanggan/get_list_data/'.'"+jk+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 2, "ASC" ]],
          "columns": [
            { "data": "pelanggan_id", "width": "7%", name: "pelanggan_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "pelanggan_ktp", "width": "11%", name: "pelanggan_ktp", "searchable": true, "sortable": true },
            { "data": "pelanggan_nama", name: "pelanggan_nama", "searchable": true, "sortable": true },
            { "data": "pelanggan_jk", "width": "2%", "searchable": false, "sortable": true, name: "pelanggan_jk" },
            { "data": "pelanggan_alamat", name: "pelanggan_alamat", "searchable": true, "sortable": true },
            { "data": "pelanggan_kontak", name: "pelanggan_kontak", "width": "8%", "searchable": true, "sortable": true},
            { "data": "pelanggan_pekerjaan", "width": "8%", name: "pelanggan_pekerjaan", "searchable": true, "sortable": true},
            { "data": "pelanggan_ttl", "width": "17%", name: "pelanggan_ttl", "searchable": true, "sortable": true }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/pelanggan/edit/'."'+row.pelanggan_id+'") ?>" title="Edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li><a href="<?= site_url('dashboard/pelanggan/transaksi/'."'+row.pelanggan_ktp+'"); ?>" title="Transaksi"><span class="fa fa-eye"></span> Transaksi</a></li>'+
                       '<li class="divider"></li>' +
                       '<li><a href="javascript:void(0)" data-id="'+row.pelanggan_id+'" data-ktp="'+row.pelanggan_ktp+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == "l"){
                    return 'LAKI-LAKI';
                  }
                  else{
                    return 'PEREMPUAN';
                  }
              },
              "targets": 3 // column index
            }

          ],
        });
      }

    });
</script>
