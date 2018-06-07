
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
      <li class="active">Pencairan Induk</li>
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
                <select class="form-control select2" name="filterPerumahan" id="filterPerumahan" style="font-size:12px;">
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
                <select class="form-control" name="filterStatus" id="filterStatus" style="font-size:12px;width:70px !important">
                  <option value="all">All</option>
                  <option value="p">PROSES</option>
                  <option value="s">SUDAH</option>
                </select>
              </th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">No Booking</th>
              <th class="dthead dthead-blue">Pelanggan</th>
              <th class="dthead dthead-blue">Perumahan</th>
              <th class="dthead dthead-blue">Blok</th>
              <th class="dthead dthead-blue">Status</th>
              <th class="dthead dthead-blue">Nominal</th>
              <th class="dthead dthead-blue">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[No Booking]</th>
              <th>[Pelanggan]</th>
              <th>[Perumahan]</th>
              <th>[Blok]</th>
              <th>[Status]</th>
              <th>[Nominal]</th>
              <th>[Tanggal]</th>
            </tr>
          </tfoot>
        </table>

      </div><!-- /.box-body -->
    </div><!-- /.box -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Set Nominal</h4>
                </div>
                <div class="modal-body edit-content">
                  <div class="callout callout-info" style="padding:10px;">
                    <strong style="margin:0;"><i class="fa fa-money"></i> PENCAIRAN INDUK</strong>
                  </div>
                  <?= form_open('finance/save_pi'); ?>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>No. Booking</label>
                        <input type="text" id="booking_no" class="form-control" placeholder="Booking No" readonly="true">
                        <input type="hidden" id="pi_id" name="pi_id">
                      </div>
                    </div>
                  </div><!--end form-group-->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Pelanggan</label>
                        <input type="text" id="pelanggan_nama" class="form-control" placeholder="Pelanggan" readonly="true">
                      </div>
                    </div>
                  </div><!--end form-group-->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Perumahan</label>
                        <input type="text" id="rumah_nama" class="form-control" placeholder="Perumahan" readonly="true">
                      </div>
                    </div>
                  </div><!--end form-group-->
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <label>Nominal</label>
                        <input type="text" id="input_nominal" name="input_nominal" class="form-control input-lg" placeholder="Rp. 0" autocomplete="off">
                      </div>
                    </div>
                  </div><!--end form-group-->



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
              <?= form_close(); ?>
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
      var perumahan = $( "#filterPerumahan" ).val() || "all";
      var status = $( "#filterStatus" ).val() || "all";

      loadDt(perumahan, status);

      $( "#btn-reload" ).click(function() {
        var perumahan = $( "#filterPerumahan" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";

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


      $(document).on("click","a[id='btn-sudah']", function (e) {
        var id = $(this).attr("data-id");
        var status = $(this).attr("status-id");
        var booking_id = $(this).attr("booking-id");

        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#55dd87",
          confirmButtonText: "Sudah",
          cancelButtonText: "Tutup",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Success!", "Sudah diterima.", "success");
            window.location.href = '<?= site_url('finance/change_pi_status/'."'+id+'/'+status+'/'+booking_id+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      $(document).on("click","a[id='btn-proses']", function (e) {
        var id = $(this).attr("data-id");
        var status = $(this).attr("status-id");
        var booking_id = $(this).attr("booking-id");

        swal({
          title: "Are you sure?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3393f7",
          confirmButtonText: "Proses",
          cancelButtonText: "Tutup",
          closeOnConfirm: false,
          closeOnCancel: true
        },
        function(isConfirm){
          if (isConfirm) {
            swal("Success!", "Sudah diterima.", "success");
            window.location.href = '<?= site_url('finance/change_pi_status/'."'+id+'/'+status+'/'+booking_id+'"); ?>';
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
          "ajax": "<?= site_url('finance/get_pi_list/'.'"+perumahan+"/"+status+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 0, "DESC" ]],
          "columns": [
            { "data": "pi_id", "width": "8%", name: "pi_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "8%" },
            { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
            { "data": "rumah_nama", "sortable": true, "searchable": true, name: "rumah_nama" },
            { "data": "kavling_blok", "sortable": true, "searchable": true, name: "kavling_blok", "width": "6%", className: 'text-center' },
            { "data": "pi_status", "sortable": true, "searchable": true, name: "pi_status", "width": "6%" },
            { "data": "pi_harga", "sortable": true, "searchable": true, name: "pi_harga" },
            { "data": "pi_datetime", "sortable": true, "searchable": true, name: "pi_datetime","width": "18%" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="javascript:void(0)" data-id="'+row.pi_id+'" status-id="s" booking-id="'+row.booking_id+'" title="Sudah" id="btn-sudah"><span class="fa fa-check text-green"></span> Sudah</a></li>'+
                       '<li><a href="javascript:void(0)" data-id="'+row.pi_id+'" status-id="p" booking-id="'+row.booking_id+'" title="Proses" id="btn-proses"><span class="fa fa-spinner text-blue"></span> Proses</a></li>'+
                       '<li><a href="#myModal" data-target="#view-modal" data-toggle="modal" class="btn-detail" data-id="'+row.booking_id+'" title="View"><span class="fa fa-money"></span> Set Nominal</a></li>'+
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
                if(data === "p"){
                  return '<span class="label-text bg-light-blue">PROSES</span>';
                }
                else{
                  return '<span class="label-text bg-green">SUDAH</span>';
                }
              },
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                if(!data){
                  return 'Rp. 0';
                }
                else{
                  return 'Rp. '+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                }
              },
              "targets": 6 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == '0000-00-00 00:00:00'){
                    return 'Belum diproses';
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
