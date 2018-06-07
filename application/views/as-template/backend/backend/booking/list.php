
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header content-header-default">
    <h1 style="font-size:28px;">
      <?= $data['header_title'] ?>
      <?php if(!empty($data['sub_header_title'])):  ?>
      <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?= site_url('dashboard'); ?>">Home</a></li>
      <li class="active">Booking</li>
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
        <div style="margin-bottom:10px;">
          <div class="row" style="margin-bottom:20px;">
            <div class="col-md-6">
              <a href="javascript:void(0)" class="btn btn-info" id="cetak-wawancara" data-target="#view-modal-wawancara" data-toggle="modal"><i class="fa fa-print"></i> Wawancara</a>
              <a href="javascript:void(0)" class="btn btn-info" id="cetak-lpa" data-target="#view-modal-lpa" data-toggle="modal"><i class="fa fa-print"></i> LPA</a>
              <a href="javascript:void(0)" class="btn btn-info" id="cetak-akad" data-target="#view-modal-akad" data-toggle="modal"><i class="fa fa-print"></i> Akad</a>
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

        <table id="data-table" class="table table-bordered table-hover" style="font-size:13px;" width="100%">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Pelanggan</th>
              <th class="dthead dthead-blue">KTP</th>
              <th class="dthead dthead-blue">No Booking</th>
              <th class="dthead dthead-blue">Blok</th>
              <th class="dthead dthead-blue">Harga</th>
              <th class="dthead dthead-blue">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Action]</th>
              <th>[Pelanggan]</th>
              <th>[KTP]</th>
              <th>[No Booking]</th>
              <th>[Blok]</th>
              <th>[Harga]</th>
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
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Informasi Detil Booking</h4>
                </div>
                <div class="modal-body edit-content">
                  <div class="callout callout-info">
                    <strong style="margin:0;"><i class="fa fa-user"></i> INFORMASI PELANGGAN</strong>
                  </div>

                  <div class="row" style="margin:10px 0;">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>KTP</label>
                        <input type="text" id="inputKtp" class="form-control" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <input type="text" id="inputNama" class="form-control" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea id="inputAlamat" rows="3" class="form-control" readonly="true"></textarea>
                      </div>
                    </div><!--end col-md-6-->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" id="inputJk" class="form-control" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Kontak</label>
                        <input type="text" id="inputKontak" class="form-control" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>Pekerjaan</label>
                        <input type="text" id="inputPekerjaan" class="form-control" readonly="true">
                      </div>
                    </div><!--end col-md-6-->
                  </div><!--end row-->

                  <div class="callout callout-info">
                    <strong style="margin:0;"><i class="fa fa-book"></i> INFORMASI BOOKING</strong>
                  </div>

                  <div class="row" style="margin:10px 0;">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Perumahan</label>
                        <textarea id="inputPerumahan" rows="3" class="form-control" readonly="true"></textarea>
                        <!-- <input type="text" id="" class="form-control" readonly="true"> -->
                      </div>
                      <div class="form-group">
                        <label>Alamat</label>
                        <textarea id="inputAlamatRumah" rows="5" class="form-control" readonly="true"></textarea>
                      </div>
                    </div><!--end col-md-6-->
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Blok</label>
                            <input type="text" id="inputBlok" class="form-control" readonly="true">
                          </div>
                          <div class="form-group">
                            <label>Tipe</label>
                            <input type="text" id="inputTipe" class="form-control" readonly="true">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>LB</label>
                            <input type="text" id="inputLB" class="form-control" readonly="true">
                          </div>
                          <div class="form-group">
                            <label>LT</label>
                            <input type="text" id="inputLT" class="form-control" readonly="true">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Harga</label>
                        <input type="text" id="inputHarga" class="form-control harga" readonly="true">
                      </div>
                      <div class="form-group">
                        <label>DP</label>
                        <input type="text" id="inputDp" class="form-control harga" readonly="true">
                      </div>

                    </div><!--end col-md-6-->
                  </div><!--end row-->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-wawancara" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-print"></i> Cetak Dokument Wawancara</h4>
                </div>
                <div class="modal-body edit-content">

                  <p>Silahkan pilih tanggal dokumen wawancara yang akan di cetak.</p>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="datepicker-wawancara">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="wawancara-cek">
                      <i class="fa fa-save"></i> Cek Dokumen
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->

    <!-- Modal LPA  -->
    <div id="view-modal-lpa" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-print"></i> Cetak Dokumen LPA</h4>
                </div>
                <div class="modal-body edit-content">

                  <p>Silahkan pilih tanggal dokumen LPA yang akan di cetak.</p>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="datepicker-lpa">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="lpa-cek">
                      <i class="fa fa-save"></i> Cek Dokumen
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- end Modal LPA -->

    <!-- Modal Informasi Detil  -->
    <div id="view-modal-akad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-print"></i> Cetak Dokumen Akad</h4>
                </div>
                <div class="modal-body edit-content">

                  <p>Silahkan pilih tanggal dokumen Akad yang akan di cetak.</p>

                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker input-lg" id="datepicker-akad">
                  </div>
                  <br/><br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="akad-cek">
                      <i class="fa fa-save"></i> Cek Dokumen
                    </button>
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
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
    $(window).load(function(){
      $(".select2").select2();
      $("#filterDiv").hide();

      <?php if(!empty($data['wawancara'])): ?>

          var wawancara = [
            <?php
              foreach($data['wawancara'] as $rowz){
                if($rowz->wawancara_tanggal != '0000-00-00'){
                  echo '"'.date('d/n/Y', strtotime($rowz->wawancara_tanggal)).'",';
                }
              }
            ?>
          ];

      <?php else: ?>
        var wawancara = [];
      <?php endif; ?>

      $('#datepicker-wawancara').datepicker({
        autoclose: true,
        todayHighlight: true,
        beforeShowDay: function(date){
           var d = date;
           var curr_date = d.getDate();
           var curr_month = d.getMonth() + 1; //Months are zero based
           var curr_year = d.getFullYear();
           var formattedDate = curr_date + "/" + curr_month + "/" + curr_year

           if ($.inArray(formattedDate, wawancara) != -1){
             return {
                classes: 'activeClass'
             };
           }
          return;
        }
      });

      <?php if(!empty($data['lpa'])): ?>
        var lpa = [
          <?php
            foreach($data['lpa'] as $rowz){
              if($rowz->lpa_tanggal != '0000-00-00'){
                echo '"'.date('d/n/Y', strtotime($rowz->lpa_tanggal)).'",';
              }
            }
          ?>
        ];


      <?php else: ?>
        var lpa = [];
      <?php endif; ?>

      $('#datepicker-lpa').datepicker({
        autoclose: true,
        todayHighlight: true,
        beforeShowDay: function(date){
           var d = date;
           var curr_date = d.getDate();
           var curr_month = d.getMonth() + 1; //Months are zero based
           var curr_year = d.getFullYear();
           var formattedDate = curr_date + "/" + curr_month + "/" + curr_year

           if ($.inArray(formattedDate, lpa) != -1){
             return {
                classes: 'activeClass'
             };
           }
          return;
        }
      });

      <?php if(!empty($data['akad'])): ?>
        var akad = [
          <?php
            foreach($data['akad'] as $rowz){
              if($rowz->akad_date != '0000-00-00'){
                echo '"'.date('d/n/Y', strtotime($rowz->akad_date)).'",';
              }
            }
          ?>
        ];


      <?php else: ?>
        var akad = [];
      <?php endif; ?>


      $('#datepicker-akad').datepicker({
        autoclose: true,
        todayHighlight: true,
        beforeShowDay: function(date){
           var d = date;
           var curr_date = d.getDate();
           var curr_month = d.getMonth() + 1; //Months are zero based
           var curr_year = d.getFullYear();
           var formattedDate = curr_date + "/" + curr_month + "/" + curr_year

           if ($.inArray(formattedDate, akad) != -1){
             return {
                classes: 'activeClass'
             };
           }
          return;
        }
      });



      var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};

      reload_data();

      $("#btn-filter-toogle").click(function(){
        $("#filterDiv").slideToggle("fast");
      });

      $( "#btn-reload" ).click(function() {
        $("#filterStatus").val('all');
        $('.datepicker').datepicker('setDate', null);
        $("#filterPerumahan").val('all').change();
      });

      $( "#wawancara-cek" ).click(function() {
        // var tgl = $( "#datepicker-wawancara" ).val();

         $.ajax({
             type: "GET",
             url: "<?=site_url('project/get_wawancara_dokument');?>",
             data: {
               'tanggal': $( "#datepicker-wawancara" ).val(),
             },
             cache: false,
             success: function (data) {
                var obj = $.parseJSON(data);
                //console.log(data);
                if(obj.status == 'y'){
                  window.location.href = "<?= site_url('dashboard/admin/transaksi/wawancara/dokument/'.'"+obj.id+"'); ?>";
                }
                else{
                  swal("Not Found", "Data tidak ditemukan", "error");
                }
             },
             error: function(err) {
                 console.log(err);
             }
         });


      });

      $( "#lpa-cek" ).click(function() {
        var tgl = $( "#dt-lpa" ).val();
         $.ajax({
             type: "GET",
             url: "<?=site_url('project/get_lpa_dokument');?>",
             data: {
               'tanggal': $( "#datepicker-lpa" ).val(),
             },
             cache: false,
             success: function (data) {
                var obj = $.parseJSON(data);
                //console.log(data);
                if(obj.status == 'y'){
                  window.location.href = "<?= site_url('dashboard/admin/transaksi/lpa/dokument/'.'"+obj.id+"'); ?>";
                }
                else{
                  swal("Not Found", "Data tidak ditemukan", "error");
                }
             },
             error: function(err) {
                 console.log(err);
             }
         });


      });


      $( "#akad-cek" ).click(function() {
         $.ajax({
             type: "GET",
             url: "<?=site_url('project/get_akad_dokument');?>",
             data: {
               'tanggal': $( "#datepicker-akad" ).val(),
             },
             cache: false,
             success: function (data) {
                 var obj = $.parseJSON(data);
                 //console.log(data);
                if(obj.status == 'y'){

                  window.location.href = "<?= site_url('dashboard/admin/transaksi/akad/dokument/'.'"+obj.id+"'); ?>";
                }
                else{
                  swal("Not Found", "Data Akad tidak ditemukan", "error");
                }
             },
             error: function(err) {
                 console.log(err);
             }
         });


      });

      $( "#btnFilter" ).click(function() {
        reload_data();
      });

      $( "#filterPerumahan" ).change(function() {
        reload_data();
      });

      $( "#filterStatus" ).change(function() {
        reload_data();
      });

      $('#view-modal').on('show.bs.modal', function(e) {
         var id = e.relatedTarget.dataset.id;
         //$(".modal-body #te").text( id );

         $.ajax({
             type: "GET",
             url: "<?=site_url('booking/get_data_by_id/" + id + "');?>",
             cache: false,
             success: function (data) {
                 var obj = $.parseJSON(data);
                 //console.log(data);
                 $('#inputKtp').val(obj.pelanggan_id);
                 $('#inputNama').val(obj.pelanggan_nama);
                 $('#inputAlamat').val(obj.pelanggan_alamat);
                 if(obj.pelanggan_jk === "l"){
                   var jk = "LAKI-LAKI";
                 }
                 else{
                   var jk = "PEREMPUAN";
                 }
                 $('#inputJk').val(jk);
                 $('#inputKontak').val(obj.pelanggan_kontak);
                 $('#inputPekerjaan').val(obj.pelanggan_pekerjaan);
                 $('#inputPerumahan').val(obj.rumah_nama);
                 $('#inputAlamatRumah').val(obj.rumah_alamat);
                 $('#inputBlok').val(obj.kavling_blok);
                 $('#inputLB').val(obj.kavling_lb);
                 $('#inputLT').val(obj.kavling_lt);
                 $('#inputTipe').val(obj.kavling_tipe);
                 $('#inputHarga').val(obj.kavling_harga);
                 $('#inputDp').val(obj.booking_dp);
                 $( ".harga" ).priceFormat(rupiah);
             },
             error: function(err) {
                 console.log(err);
             }
         });

      });

      $('#view-modal-wawancara').on('show.bs.modal', function(e) {
         //$(".modal-body #te").text( id );

        //  $.ajax({
        //      type: "GET",
        //      url: "<?=site_url('booking/get_data_by_id/" + id + "');?>",
        //      cache: false,
        //      success: function (data) {
        //          var obj = $.parseJSON(data);
        //          //console.log(data);
        //          $('#inputKtp').val(obj.pelanggan_id);
        //          $('#inputNama').val(obj.pelanggan_nama);
        //          $('#inputAlamat').val(obj.pelanggan_alamat);
        //          if(obj.pelanggan_jk === "l"){
        //            var jk = "LAKI-LAKI";
        //          }
        //          else{
        //            var jk = "PEREMPUAN";
        //          }
        //          $('#inputJk').val(jk);
        //          $('#inputKontak').val(obj.pelanggan_kontak);
        //          $('#inputPekerjaan').val(obj.pelanggan_pekerjaan);
        //          $('#inputPerumahan').val(obj.rumah_nama);
        //          $('#inputAlamatRumah').val(obj.rumah_alamat);
        //          $('#inputBlok').val(obj.kavling_blok);
        //          $('#inputLB').val(obj.kavling_lb);
        //          $('#inputLT').val(obj.kavling_lt);
        //          $('#inputTipe').val(obj.kavling_tipe);
        //          $('#inputHarga').val(obj.kavling_harga);
        //          $('#inputDp').val(obj.booking_dp);
        //          $( ".harga" ).priceFormat(rupiah);
        //      },
        //      error: function(err) {
        //          console.log(err);
        //      }
        //  });

      });


      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = $(this).attr("data-id");
        var pelanggan_id = $(this).attr("pelanggan-id");

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
            window.location.href = '<?= site_url('dashboard/booking/delete/'."'+id+'/'+pelanggan_id+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      function reload_data(){
        var id = '<?= $this->uri->segment(4) ?>'
        var dt1 = $( "#dt1" ).val() || "0";
        var dt2 = $( "#dt2" ).val() || "0";

        loadDt(id, dt1, dt2);
      }

      function loadDt(id, dt1, dt2){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('project/get_booking_list/'.'"+id+"/"+dt1+"/"+dt2+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 4, "ASC" ]],
          "columns": [
            { "data": "booking_id", "width": "5%", name: "booking_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "pelanggan_nama", "sortable": true, "searchable": true, name: "pelanggan_nama" },
            { "data": "pelanggan_ktp", "sortable": true, "searchable": true, name: "pelanggan_ktp",  "width": "8%" },
            { "data": "booking_no", "sortable": true, "searchable": true, name: "booking_no", "width": "16%" },
            { "data": "kavling_blok", "sortable": true, "searchable": true, name: "kavling_blok`", "width": "5%", className: 'text-center' },
            { "data": "harga", "sortable": true, "searchable": true, name: "harga", "width": "16%" },
            { "data": "booking_date", "sortable": true, "searchable": true, name: "booking_date", "width": "11%", className: 'text-center' }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/booking/detil/'."'+row.booking_id+'") ?>" title="Detil" id="btn-detil"><span class="fa fa-eye"></span> Detil</a></li>'+
                      //  '<li><a href="<?= site_url('dashboard/booking/print/'."'+row.booking_id+'") ?>" target="_blank" title="Kwitansi" id="btn-kwitansi"><span class="fa fa-print"></span> Kwitansi</a></li>'+
                       '<li class="divider"></li>' +
                       '<li><a href="javascript:void(0)" data-id="'+row.booking_id+'" pelanggan-id="'+row.pelanggan_ktp+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                return '<span class="text-blue text-bold">'+data+'</span>';
              },
              "targets": 4 // column index
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
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return moment(data).format("DD/MM/YYYY")
              },
              "targets": 6 // column index
            },

          ],
        });
      }

    });
</script>
