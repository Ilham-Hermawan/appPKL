
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
      <li class="active">PPJB</li>
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
              &nbsp;
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-filter-toogle"><i class="fa fa-filter"></i> Filter</button>
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <div id="filterDiv" style="padding:10px;border:1px solid #ebebeb;margin-bottom:20px;background:#f9f9f9;">
          <div class="row">
            <div class="col-md-3">

              <div class="form-group">
               <label>Dari Tanggal:</label>
               <div class="input-group date">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker" id="dt1">
               </div><!-- /.input group -->
             </div><!-- /.form group -->

            </div><!--end col-md-3-->

            <div class="col-md-3">

              <div class="form-group">
               <label>Sampai Tanggal:</label>
               <div class="input-group date">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker" id="dt2">
               </div><!-- /.input group -->
             </div><!-- /.form group -->

            </div><!--end col-md-3-->

            <div class="col-md-3">

              <button class="btn btn-default" style="margin:26px 0 0px 0;" id="btnFilter"><i class="fa fa-search"></i> Filter</button>

            </div><!--end col-md-3-->


          </div><!--end row-->
        </div><!--end filterdiv-->

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px !important;" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th>
                <select class="form-control select2" name="filterPerumahan" id="filterPerumahan" style="font-size:12px;width:170px !important">
                  <option value="all">All</option>
                  <?php if(!empty($data['perumahan'])): ?>
                    <?php foreach($data['perumahan'] as $row):  ?>
                      <option value="<?= $row->rumah_id ?>"><?= $row->rumah_nama ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </th>
              <th>
                <select class="form-control" name="filterStatus" id="filterStatus" style="font-size:12px;width:70px !important">
                  <option value="all">All</option>
                  <option value="p">PROSES</option>
                  <option value="y">DITERIMA</option>
                  <option value="n">DITOLAK</option>
                </select>
              </th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">No Booking</th>
              <th class="dthead dthead-blue">NO PPJB</th>
              <th class="dthead dthead-blue">Pelanggan</th>
              <th class="dthead dthead-blue">Perumahan</th>
              <th class="dthead dthead-blue">Status</th>
              <th class="dthead dthead-blue">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[No Booking]</th>
              <th>[NO PPJB]</th>
              <th>[Pelanggan]</th>
              <th>[Perumahan]</th>
              <th>[Status]</th>
              <th>[Tanggal]</th>
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
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
    $(window).load(function(){
      $(".select2").select2();
      $("#filterDiv").hide();
      $('.datepicker').datepicker({
        autoclose: true
      });
      var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};

      reload_data();

      $("#btn-filter-toogle").click(function(){
          $("#filterDiv").slideToggle("fast");
      });

      $( "#btnFilter" ).click(function() {
        reload_data();
      });

      $( "#btn-reload" ).click(function() {
        $("#filterStatus").val('all');
        $('.datepicker').datepicker('setDate', null);
        $("#filterPerumahan").val('all').change();
      });

      $( "#filterPerumahan" ).change(function() {
        reload_data();
      });

      $( "#filterStatus" ).change(function() {
        reload_data();
      });

      $(document).on("click","a[id='btn-diterima']", function (e) {
        var id = $(this).attr("data-id");
        var status = $(this).attr("status-id");
        var booking_id = $(this).attr("booking-id");
        var kavling_blok = $(this).attr("kavling-blok");
        var rumah_kode = $(this).attr("rumah-kode");

        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#55dd87",
          confirmButtonText: "Diterima",
          cancelButtonText: "Tutup",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Success!", "Sudah diterima.", "success");
            window.location.href = '<?= site_url('transaksi/change_ppjb_status/'."'+id+'/'+status+'/'+kavling_blok+'/'+booking_id+'/'+rumah_kode+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      $(document).on("click","a[id='btn-ditolak']", function (e) {
        var id = $(this).attr("data-id");
        var status = $(this).attr("status-id");
        var booking_id = $(this).attr("booking-id");
        var kavling_blok = $(this).attr("kavling-blok");

        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#dd5555",
          confirmButtonText: "Ditolak!",
          cancelButtonText: "Tutup",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Success!", "Sudah ditolak.", "success");
            window.location.href = '<?= site_url('transaksi/change_ppjb_status/'."'+id+'/'+status+'/'+kavling_blok+'/'+booking_id+'"); ?>';
          } else {
              swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      function reload_data(){
        var perumahan = $( "#filterPerumahan" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";
        var dt1 = $( "#dt1" ).val() || "0";
        var dt2 = $( "#dt2" ).val() || "0";

        loadDt(perumahan, status, dt1, dt2);
      }

      function loadDt(perumahan, status, dt1, dt2){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('transaksi/get_ppjb_list/'.'"+perumahan+"/"+status+"/"+dt1+"/"+dt2+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 0, "DESC" ]],
          "columns": [
            { "data": "ppjb_id", "width": "5%", name: "ppjb_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "16%" },
            { "data": "ppjb_no", "sortable": true, "searchable": true, name: "ppjb_no", "width": "16%" },
            { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
            { "data": "rumah_nama", "sortable": true, "searchable": true, name: "rumah_nama", "width": "18%" },
            { "data": "ppjb_status", "sortable": true, "searchable": true, name: "ppjb_status", "width": "6%" },
            { "data": "ppjb_datetime", "sortable": true, "searchable": true, name: "ppjb_datetime", "width": "11%" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                if(row.ppjb_status === "y"){
                  return '<div class="btn-group">'+
                         '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                         '<ul class="dropdown-menu" role="menu">'+
                         '<li><a href="<?= site_url('dashboard/admin/transaksi/ppjb/dokument/'."'+row.booking_id+'"); ?>" target="_blank" title="Print" id="btn-print"><span class="fa fa-print"></span> Print</a></li>'+
                         '<li><a href="javascript:void(0)" data-id="'+row.ppjb_id+'" kode-rumah="'+row.rumah_kode+'" status-id="y" kavling-blok="'+row.kavling_blok+'" booking-id="'+row.booking_id+'" title="Diterima" id="btn-diterima"><span class="fa fa-check text-green"></span> Diterima</a></li>'+
                         '<li><a href="javascript:void(0)" data-id="'+row.ppjb_id+'" status-id="n" kavling-blok="'+row.kavling_blok+'" booking-id="'+row.booking_id+'" title="Ditolak" id="btn-ditolak"><span class="fa fa-ban text-red"></span> Ditolak</a></li>'+
                         '</ul></div>';
                }
                else{
                  return '<div class="btn-group">'+
                         '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                         '<ul class="dropdown-menu" role="menu">'+
                         '<li><a href="javascript:void(0)" data-id="'+row.ppjb_id+'" kode-rumah="'+row.rumah_kode+'" status-id="y" kavling-blok="'+row.kavling_blok+'" booking-id="'+row.booking_id+'" title="Diterima" id="btn-diterima"><span class="fa fa-check text-green"></span> Diterima</a></li>'+
                         '<li><a href="javascript:void(0)" data-id="'+row.ppjb_id+'" status-id="n" kavling-blok="'+row.kavling_blok+'" booking-id="'+row.booking_id+'" title="Ditolak" id="btn-ditolak"><span class="fa fa-ban text-red"></span> Ditolak</a></li>'+
                         '</ul></div>';
                }

              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span class="text-blue">'+data+'</span>';
              },
              "targets": 1 // column index
            },
            {
              "render": function ( data, type, row ) {
                if(!data){
                  return 'Belum diproses';
                }
                else{
                  return '<span class="text-green">'+data+'</span>';
                }
              },
              "targets": 2 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span>KTP : '+row.pelanggan_ktp+'</span><br/><span>Nama : '+row.pelanggan_nama+'</span>';
              },
              "targets": 3 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span>'+data+'</span><br/><span>Blok : '+row.kavling_blok+'</span>';
              },
              "targets": 4 // column index
            },
            {
              "render": function ( data, type, row ) {
                if(data === "p"){
                  return '<span class="label-text bg-light-blue">PROSES</span>';
                }
                else if (data === "y"){
                  return '<span class="label-text bg-green">DITERIMA</span>';
                }
                else{
                  return '<span class="label-text bg-red">DITOLAK</span>';
                }
              },
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == '0000-00-00 00:00:00'){
                    return 'Belum diproses';
                  }
                  else{
                    return "<i class='ion-calendar'></i> : "+moment(data).format("DD/MM/YYYY")+"<br/><i class='ion-clock'></i> : "+moment(data).format("hh:mm:ss a")
                  }
              },
              "targets": 6 // column index
            },

          ],
        });
      }

    });
</script>
