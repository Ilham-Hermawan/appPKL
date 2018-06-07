
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
      <li class="active">Penerimaan</li>
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
              <!-- <a href="<?= site_url('dashboard/transaksi/penerimaan/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a> -->
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px !important;" width="100%">
          <thead>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Blok</th>
              <th class="dthead dthead-blue">Pelanggan</th>
              <th class="dthead dthead-blue">No Booking</th>
              <th class="dthead dthead-blue">Harga</th>
              <th class="dthead dthead-blue">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[Blok]</th>
              <th>[Pelanggan]</th>
              <th>[No Booking]</th>
              <th>[Harga]</th>
              <th>[Tanggal]</th>
            </tr>
          </tfoot>
        </table>

      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- Modal Informasi Detil  -->
    <div id="view-total" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Informasi Penerimaan</h4>
                </div>
                <div class="modal-body edit-content">
                  <table width="100%" class="table">
                    <tr>
                      <th width="30%">No Booking</th>
                      <th width="4%">:</th>
                      <td style="text-align:left;"><span id="no-booking"><span class="fa fa-spinner fa-spin"></span><span class="fa fa-spinner fa-spin"></span></span></td>
                    </tr>
                    <tr>
                      <th width="30%">Nama Pelanggan</th>
                      <th width="4%">:</th>
                      <td style="text-align:left;"><span id="nama-pelanggan"><span class="fa fa-spinner fa-spin"></span></span></td>
                    </tr>
                  </table>
                  <hr/>
                  <div class="row text-center">
                    <div class="col-md-6">
                      <p>TOTAL HARGA</p>
                      <h2 class="text-green" id="harga"><span class="fa fa-spinner fa-spin"></span></h2>
                    </div>
                    <div class="col-md-6">
                      <p>TOTAL PENERIMAAN</p>
                      <h2 class="text-green" id="total"><span class="fa fa-spinner fa-spin"></span></h2>
                    </div>
                  </div>
                  <br />
                  <div class="row text-center" style="background:#efefef;padding:20px;">
                    <p>SISA YANG HARUS DIBAYAR</p>
                    <h2 class="text-danger" id="sisa"><span class="fa fa-spinner fa-spin"></span></h2>
                  </div>

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
        var perumahan = $( "#filterPerumahan" ).val() || "all";

        loadDt(perumahan);

        $("#filterPerumahan").val('all').trigger("change");
      });

      $( "#filterPerumahan" ).change(function() {
        var perumahan = $( "#filterPerumahan" ).val() || "all";

        loadDt(perumahan);
      });

      $(document).on("click","a[id='btn-total']", function (e) {
        var id = $(this).attr("data-id");

        $('#no-booking').html('<span class="fa fa-spinner fa-spin"></span>');
        $('#nama-pelanggan').html('<span class="fa fa-spinner fa-spin"></span>');
        $('#harga').html('<span class="fa fa-spinner fa-spin"></span>');
        $('#total').html('<span class="fa fa-spinner fa-spin"></span>');
        $('#sisa').html('<span class="fa fa-spinner fa-spin"></span>');

        $.ajax({
             type: "GET",
             url: "<?=site_url('penerimaan/get_total/" + id + "');?>",
             cache: false,
             success: function (data) {
                 var obj = $.parseJSON(data);
                 //console.log(data);
                 $('#no-booking').html(obj.no_booking);
                 $('#nama-pelanggan').html(obj.nama_pelanggan);
                 $('#harga').html('Rp. ' + obj.harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                 $('#total').html('Rp. '+ obj.total_penerimaan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                 $('#sisa').html('Rp. '+ (parseInt(obj.harga) - parseInt(obj.total_penerimaan)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
             },
             error: function(err) {
               $('#harga').html('<span class="fa fa-spinner fa-spin"></span>');
               $('#total').html('<span class="fa fa-spinner fa-spin"></span>');
               $('#sisa').html('<span class="fa fa-spinner fa-spin"></span>');
                 console.log(err);
             }
         });

      });

      // $('#view-total').on('show.bs.modal', function(e) {
      //    var id = e.relatedTarget.dataset.id;
      // });

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

      function reload_data(){
        var id = '<?= $this->uri->segment(3) ?>'
        var dt1 = $( "#dt1" ).val() || "0";
        var dt2 = $( "#dt2" ).val() || "0";

        loadDt(id, dt1, dt2);
      }


      function loadDt(id, dt1, dt2){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('penerimaan/get_penerimaan_list/'.'"+id+"/"+dt1+"/"+dt2+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 1, "ASC" ]],
          "columns": [
            { "data": "booking_id", "width": "5%", name: "booking_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "kavling_blok", "sortable": true, "searchable": true, name: "kavling_blok`", "width": "5%", className: 'text-center' },
            { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
            { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "18%" },
            { "data": "harga", "sortable": true, "searchable": true, name: "harga", "width": "16%" },
            { "data": "booking_date", "sortable": true, "searchable": true, name: "booking_date", "width": "11%", className: 'text-center' }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/penerimaan/detil/'.$this->uri->segment(3).'/'."'+row.booking_id+'") ?>" title="Bayar" id="btn-detil"><span class="fa fa-eye"></span> Detil</a></li>'+
                       '<li><a href="javascript:void(0)" id="btn-total" data-target="#view-total" data-id="'+row.booking_id+'" data-toggle="modal" title="Total" id="btn-detil"><span class="fa fa-money"></span> Total</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span class="text-blue text-bold">'+data+'</span>';
              },
              "targets": 1 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span class="text-green text-bold">'+data+'</span>';
              },
              "targets": 3 // column index
            },
            {
              "render": function ( data, type, row ) {
                return 'Rp. <span class="pull-right">'+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
              },
              "targets": 4 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return moment(data).format("DD/MM/YYYY")
              },
              "targets": 5 // column index
            },

          ],
        });
      }

    });
</script>
