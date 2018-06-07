
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
      <li class="active">Dibatalkan</li>
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
          <small>Daftar unit yang dibatalkan</small>
        </h1>
        <hr/>

        <div class="row">
          <div class="col-md-12">
            <table id="tabel" class="table table-bordered table-hover table-striped" width="100%">
              <thead>
                <tr>
                  <th class="dthead dthead-blue">BLOK</th>
                  <th class="dthead dthead-blue">KTP</th>
                  <th class="dthead dthead-blue">NO BOOKING</th>
                  <th class="dthead dthead-blue">STATUS</th>
                  <th class="dthead dthead-blue">POTONGAN</th>
                  <th class="dthead dthead-blue">BATAL</th>
                  <th class="dthead dthead-blue">ACTION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <th>[BLOK]</th>
                  <th>[KTP]</th>
                  <th>[NO BOOKING]</th>
                  <th>[STATUS]</th>
                  <th>[POTONGAN]</th>
                  <th>[BATAL]</th>
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

    $(document).on("click","a[id='btn-delete']", function (e) {
      var id = $(this).attr("data-id");

      swal({
        title: "Anda Yakin?",
        text: "data akan dihapus",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yakin",
        confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax(
                {
                    type: "get",
                    url: "<?= site_url('project/delete_batal/'.'"+id+"'); ?>",
                    success: function(data){
                    }
                }
            )
          .done(function(data) {
            swal("Dihapus!", "Data sudah dibatalkan", "success");
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
        "ajax": "<?= site_url('project/get_data_dibatalkan/'.'"+id+"'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 0, "ASC" ]],
        "columns": [
          { "data": "kavling_blok", name: "kavling_blok", "searchable": true, "sortable": true, className: 'text-center', "width": "8%"},
          { "data": "pelanggan_ktp", "sortable": true, "searchable": true, name: "pelanggan_ktp"},
          { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "18%", className: 'text-center' },
          { "data": "batal_status", "sortable": true, "searchable": true, name: "batal_status" },
          { "data": "batal_potongan", "sortable": true, "searchable": true, name: "batal_potongan" },
          { "data": "booking_batal", "sortable": true, "searchable": true, name: "booking_batal", "width": "8%", className: 'text-center' },
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
              return row.pelanggan_nama+'<br/>NO. KTP : '+data;
            },
            "targets": 1 // column index
          },
          {
            "render": function ( data, type, row ) {
              return '<strong class="text-green">'+data+'</strong>';
            },
            "targets": 2 // column index
          },
          {
            "render": function ( data, type, row ) {
              if(data == '1'){
                var status = 'Tidak lolos BI Checking';
              }
              else if(data == '2'){
                var status = 'Pembatalan Sepihak';
              }
              else{
                var status = 'Ditolak Bank';
              }
              return status;
            },
            "targets": 3// column index
          },
          {
            "render": function ( data, type, row ) {
              return 'Rp. <span class="pull-right">'+ data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
            },
            "targets": 4// column index
          },

          {
            "render": function ( data, type, row ) {
              return moment(data).format("DD/MM/YYYY");
            },
            "targets": 5// column index
          },

          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group pull-right">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="javascript:void(0)" id="btn-delete" data-id="'+row.batal_id+'" title="Hapus"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 6 // column index
          },


        ],
      });
    }


  });
</script>
