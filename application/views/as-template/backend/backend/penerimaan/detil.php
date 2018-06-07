
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
      <li><a href="#">Penerimaan</a></li>
      <li class="active">Detil</li>
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

        <h3 class="text-center" style="margin:0;">Data Detil Booking</h3>
        <hr/>

        <table width="100%" class="table table-bordered">
          <tr>
            <th style="width:15%;text-align:right">KTP</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_ktp ?></td>
            <th style="width:15%;text-align:right">Perumahan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->rumah_nama ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Nama</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_nama ?></td>
            <th style="width:15%;text-align:right">Alamat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->rumah_alamat.', Kelurahan '.$data['set']->rumah_desa.', Kec. '.$data['set']->rumah_kecamatan.', Kota '.$data['set']->rumah_kota.', Prov. '.$data['set']->rumah_provinsi ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Jenis Kelamin</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;">
              <?php
                if($data['set']->pelanggan_jk === "l"){
                  echo "LAKI-LAKI";
                }
                else{
                  echo "PEREMPUAN";
                }
                ?>
            </td>
            <th style="width:15%;text-align:right">Blok</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_blok ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">TTL</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_ttl ?></td>
            <th style="width:15%;text-align:right">Tipe</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_tipe ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Alamat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_alamat ?></td>
            <th style="width:15%;text-align:right">Luas Bangunan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_lb ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Alamat Surat</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_alamat_surat ?></td>
            <th style="width:15%;text-align:right">Luas Tanah</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->kavling_lt ?></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Kontak</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_kontak ?></td>
            <th style="width:15%;text-align:right">Harga</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;" class="text-green text-bold"><h4><?= "Rp. ".number_format($data['set']->harga) ?></h4></td>
          </tr>
          <tr>
            <th style="width:15%;text-align:right">Pekerjaan</th>
            <td style="width:1%;">:</td>
            <td style="width:34%;"><?= $data['set']->pelanggan_pekerjaan ?></td>
            <th style="width:15%;text-align:right">&nbsp;</th>
            <td style="width:1%;">&nbsp;</td>
            <td style="width:34%;">&nbsp;</td>
          </tr>
        </table>
        <hr/>
          <h3 class="text-center" style="margin:0;">Proses Penerimaan Uang Muka</h3>
        <hr/>

        <div style="margin:0px 0px 20px 0px;">
          <a href="<?= site_url('dashboard/penerimaan/bayar/'.$this->uri->segment(4).'/'.$this->uri->segment(5)) ?>" id="btn-bayar" class="btn btn-success"><i class="fa fa-money"></i> Bayar</a>
        </div>


        <table width="100%" class="table table-bordered table-hover" id="table-daftar-uang-muka">
          <thead>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Dari</th>
              <th class="dthead dthead-blue">Kategori</th>
              <th class="dthead dthead-blue">Uraian</th>
              <th class="dthead dthead-blue">No</th>
              <th class="dthead dthead-blue">Tanggal</th>
              <th class="dthead dthead-blue">Total</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" style="text-align:right !important;"><strong>TOTAL</strong></td>
              <td class="text-green">Rp <span class="pull-right"><?= !empty($data['total_uangmuka']) ? number_format($data['total_uangmuka']) : '0' ?></span></td>
            </tr>
          </tfoot>
        </table>

        <hr/>
          <h3 class="text-center" style="margin:0;">Proses Penerimaan Pencairan Bank</h3>
        <hr/>

        <table width="100%" class="table table-bordered table-hover" id="table-daftar-pencairan-bank">
          <thead>
            <tr>
              <th class="dthead dthead-blue">Action</th>
              <th class="dthead dthead-blue">Dari</th>
              <th class="dthead dthead-blue">Kategori</th>
              <th class="dthead dthead-blue">Uraian</th>
              <th class="dthead dthead-blue">No</th>
              <th class="dthead dthead-blue">Tanggal</th>
              <th class="dthead dthead-blue">Total</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="6" style="text-align:right !important;"><strong>TOTAL</strong></td>
              <td class="text-green">Rp <span class="pull-right"><?= !empty($data['total_penerimaanbank']) ? number_format($data['total_penerimaanbank']) : '0' ?></span></td>
            </tr>
          </tfoot>
        </table>

        </div><!-- /.box-body -->
      <div class="box-footer">

      </div>
    </div><!-- /.box -->


    <!-- Modal Informasi Detil  -->
    <div id="view-modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Penerimaan</h4>
              </div>
              <div class="modal-body edit-content">
                asd
              </div>
            </div>
        </div>
    </div>
    <!-- end Modal Informasi Detil -->


    <!-- Modal Informasi Detil  -->
    <div id="view-modal-bayar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Penerimaan</h4>
                </div>
                <div class="modal-body edit-content">

                  <div class="form-group">
                    <label>No Kwitansi</label>
                    <input type="text" class="form-control" id="no-kwitansi" value="auto" placeholder="No Kwitansi">
                    <span class="help-block">Isi dengan auto untuk nomor otomatis</span>
                  </div>

                  <div class="row">
                    <div class="col-md-10">

                      <div class="form-group">
                        <label>Kategori</label>
                        <select id="kategori" class="form-control input-lg">
                        </select>
                      </div>

                    </div>

                    <div class="col-md-2">
                      <button class="btn btn-info" type="button" style="margin-top:30px" id="btn-tambah" data-target="#view-modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i></button>
                    </div>

                  </div>

                  <div class="form-group">
                    <label>Dari</label>
                    <input type="text" class="form-control" id="dari" placeholder="Dari">
                  </div>

                  <div class="form-group">
                    <label>Total</label>
                    <input type="text" class="form-control harga" id="total" placeholder="Rp. 0">
                  </div>


                  <div class="form-group">
                    <label>Tanggal</label>
                    <input type="text" data-date-format="yyyy-mm-dd" class="form-control pull-right datepicker" id="dt-ppjb">
                  </div>
                  <br/><br/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
                    <button type="button" class="btn btn-primary btn-flat" id="ppjb-simpan">
                      <i class="fa fa-save"></i> Simpan
                      <!-- <img src="<?= site_url(IMAGES_WEB.'loading_2.svg') ?>" height="8px;"> -->
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
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'ajaxQueue/jquery.ajaxQueue.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."moment.min.js"); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('.input-harga').priceFormat(rupiah);
    $('.datepicker').datepicker({
      autoclose: true
    });

    load_data();

    $("#AddRow").click(function(){
       addRow();
    });

    $(document).on("click","a[id='btn-delete']", function (e) {
      var id = $(this).attr("data-id");

      swal({
        title: "Are you sure?",
        text: "Are you sure that you want to delete?",
        type: "warning",
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: "Yes, cancel it!",
        confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax(
                {
                    type: "get",
                    url: "<?= site_url('penerimaan/delete_penerimaan/'.'"+id+"'); ?>",
                    success: function(data){
                    }
                }
            )
          .done(function(data) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            load_data();
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });
      });

    });

    function load_data(){

      $('#table-daftar-uang-muka').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('penerimaan/get_pembayaran_penerimaan/'.$this->uri->segment(5).'/3'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 4, "DESC" ]],
        "columns": [
          { "data": "penerimaan_id", "width": "5%", name: "penerimaan_id", "searchable": false, "sortable": false, className: 'text-center'},
          { "data": "penerimaan_dari", "sortable": true, "searchable": true, name: "penerimaan_dari", "width": "14%" },
          { "data": "pkategori_nama", "sortable": true, "searchable": true, name: "pkategori_nama", "width": "14%" },
          { "data": "penerimaan_uraian", "sortable": true, "searchable": true, name: "penerimaan_uraian" },
          { "data": "penerimaan_no", "sortable": true, "searchable": true, name: "penerimaan_no",  "width": "18%" },
          { "data": "penerimaan_tanggal", "sortable": true, "searchable": true, name: "penerimaan_tanggal", "width": "4%", },
          { "data": "penerimaan_total", "sortable": true, "searchable": true, name: "penerimaan_total", "width": "16%", className: 'text-center' }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="<?= site_url('dashboard/penerimaan/bayar/'.$this->uri->segment(4).'/'."'+row.booking_id+'/'+row.penerimaan_id+'") ?>" title="Edit" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                     '<li><a href="<?= site_url('dashboard/penerimaan/kwitansi/'."'+row.penerimaan_id+'") ?>" target="_blank" title="Kwitansi" id="btn-kwitansi"><span class="fa fa-print"></span> Kwitansi</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" data-id="'+row.penerimaan_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 0 // column index
          },
          {
            "render": function ( data, type, row ) {
                return moment(data).format("DD/MM/YYYY")
            },
            "targets": 5 // column index
          },
          {
            "render": function ( data, type, row ) {
                return '<span class="text-green">'+data+'</span>';
            },
            "targets": 4 // column index
          },
          {
            "render": function ( data, type, row ) {
              return 'Rp. <span class="pull-right">'+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
            },
            "targets": 6 // column index
          },


        ],
      });


      $('#table-daftar-pencairan-bank').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('penerimaan/get_pembayaran_penerimaan/'.$this->uri->segment(5).'/2'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 4, "DESC" ]],
        "columns": [
          { "data": "penerimaan_id", "width": "5%", name: "penerimaan_id", "searchable": false, "sortable": false, className: 'text-center'},
          { "data": "penerimaan_dari", "sortable": true, "searchable": true, name: "penerimaan_dari", "width": "14%" },
          { "data": "pkategori_nama", "sortable": true, "searchable": true, name: "pkategori_nama", "width": "14%" },
          { "data": "penerimaan_uraian", "sortable": true, "searchable": true, name: "penerimaan_uraian" },
          { "data": "penerimaan_no", "sortable": true, "searchable": true, name: "penerimaan_no",  "width": "18%" },
          { "data": "penerimaan_tanggal", "sortable": true, "searchable": true, name: "penerimaan_tanggal", "width": "4%", },
          { "data": "penerimaan_total", "sortable": true, "searchable": true, name: "penerimaan_total", "width": "16%", className: 'text-center' }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="<?= site_url('dashboard/penerimaan/bayar/'.$this->uri->segment(4).'/'."'+row.booking_id+'/'+row.penerimaan_id+'") ?>" title="Edit" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                     '<li><a href="<?= site_url('dashboard/penerimaan/kwitansi/'."'+row.penerimaan_id+'") ?>" target="_blank" title="Kwitansi" id="btn-kwitansi"><span class="fa fa-print"></span> Kwitansi</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" data-id="'+row.penerimaan_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 0 // column index
          },
          {
            "render": function ( data, type, row ) {
                return moment(data).format("DD/MM/YYYY")
            },
            "targets": 5 // column index
          },
          {
            "render": function ( data, type, row ) {
                return '<span class="text-green">'+data+'</span>';
            },
            "targets": 4 // column index
          },
          {
            "render": function ( data, type, row ) {
              return 'Rp. <span class="pull-right">'+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+'</span>';
            },
            "targets": 6 // column index
          },


        ],
      });

    }


  });
</script>
