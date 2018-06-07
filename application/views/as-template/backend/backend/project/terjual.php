
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
      <li><a href="#">Project</a></li>
      <li class="active">Terjual</li>
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

        <h1 class="text-center" style="margin:0;"><?= !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : "-" ?><br/>
          <small>Daftar unit yang terjual</small>
        </h1>
        <hr/>

        <div class="row">
          <div class="col-md-12">
            <table id="tabel" class="table table-bordered table-hover table-striped" width="100%">
              <thead>
                <tr>
                  <th class="dthead dthead-blue">BLOK</th>
                  <th class="dthead dthead-blue">KTP</th>
                  <th class="dthead dthead-blue">NAMA</th>
                  <th class="dthead dthead-blue">NO BOOKING</th>
                  <th class="dthead dthead-blue">ACTION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <th>[BLOK]</th>
                  <th>[KTP]</th>
                  <th>[NAMA]</th>
                  <th>[NO BOOKING]</th>
                  <th>[ACTION]</th>
                </tr>
              </tfoot>
            </table>

          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">

      </div>
    </div><!-- /.box -->


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('.input-harga').priceFormat(rupiah);

    reload_data();

    $("#AddRow").click(function(){
       addRow();
    });

    $(document).on("click","a[class='btn-detail']", function (e) {
      var id = $(this).attr("data-id");
      var status = $(this).attr("data-status");

      swal({
        title: "Anda Yakin?",
        text: "Semua data yang berhubungan dengan project ini akan dihapus",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yakin",
        confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax(
                {
                    type: "get",
                    url: "<?= site_url('project/save_batal/'.'"+id+"/"+status+"'); ?>",
                    success: function(data){
                    }
                }
            )
          .done(function(data) {
            swal("Dibatalkan!", "Booking sudah dibatalkan", "success");
            reload_data();
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });
      });

    });

    function reload_data(){
      var id = '<?= $this->uri->segment(4) ?>';

      loadDt(id);
    }

    function loadDt(id){
      $('#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('project/get_data_terjual/'.'"+id+"'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 0, "ASC" ]],
        "columns": [
          { "data": "kavling_blok", name: "kavling_blok", "searchable": true, "sortable": true, className: 'text-center', "width": "8%"},
          { "data": "pelanggan_ktp", "sortable": true, "searchable": true, name: "pelanggan_ktp", "width": "20%" },
          { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
          { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "18%", className: 'text-center' },
          { "data": "booking_id", "sortable": true, "searchable": true, name: "booking_id", "width": "8%" }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<strong class="text-blue">'+data+'</strong>';
            },
            "targets": 0 // column index
          },

          {
            "render": function ( data, type, row ) {
              return '<strong class="text-green">'+data+'</strong>';
            },
            "targets": 3 // column index
          },

          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group pull-right">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="<?= site_url('dashboard/booking/print/'."'+row.booking_id+'") ?>" target="_blank" title="Kwitansi" id="btn-kwitansi"><span class="fa fa-print"></span> Kwitansi</a></li>'+
                     '<li><a href="<?= site_url('dashboard/booking/edit/'."'+row.booking_id+'") ?>" title="Edit" id="btn-edit"><span class="fa fa-edit"></span> Edit</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" class="btn-detail" data-id="'+row.booking_id+'" data-status="1" title="Tidak Lolos BI Checking"><span class="fa fa-ban text-red"></span> Tidak Lolos BI Checking</a></li>'+
                     '<li><a href="javascript:void(0)" class="btn-detail" data-id="'+row.booking_id+'" data-status="2" title="Pembatalan Sepihak"><span class="fa fa-ban text-red"></span> Pembatalan Sepihak</a></li>'+
                     '<li><a href="javascript:void(0)" class="btn-detail" data-id="'+row.booking_id+'" data-status="3" title="Ditolak Bank"><span class="fa fa-ban text-red"></span> Ditolak Bank</a></li>'+
                     '</ul></div>';
            },
            "targets": 4 // column index
          },


        ],
      });
    }


  });
</script>
