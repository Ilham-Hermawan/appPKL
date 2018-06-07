
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
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li><a href="<?= site_url('dashboard/rumah/list'); ?>">Pengeluaran</a></li>
      <li class="active">Bayar</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->pp_id) ? $id = $data['set']->pp_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formRumah'
      );
    ?>
    <?= form_open("pengeluaran/save_pembayaran_pengeluaran", $atrform); ?>
    <?php
      $pj_id = $this->uri->segment(5);
      $project_id = $this->uri->segment(4);
      $id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '0';
    ?>
    <?= form_hidden('pj_id', $pj_id); ?>
    <?= form_hidden('project_id', $project_id); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

        <!-- START CUSTOM TABS -->
          <div class="row">
            <div class="col-md-6">

              <div class="form-group">
                <label>No Kwitansi</label>
                <?php $pengeluaran_no = !empty($data['set']->pengeluaran_no) ? $data['set']->pengeluaran_no : 'auto';  ?>
                <?php if($pengeluaran_no != 'auto'): ?>
                  <input type="text" class="form-control" name="no-kwitansi" id="no-kwitansi" value="<?= $pengeluaran_no ?>" placeholder="No Kwitansi" readonly="true">
                <?php else: ?>
                  <input type="text" class="form-control" name="no-kwitansi" id="no-kwitansi" value="<?= $pengeluaran_no ?>" placeholder="No Kwitansi">
                <?php endif; ?>
                <span class="help-block">Isi dengan auto untuk nomor otomatis</span>
              </div>

              <div class="row">
                <div class="col-md-10">

                  <div class="form-group">
                    <label>Uraian</label>
                    <select id="kategori" class="form-control" name="kategori">
                    </select>
                  </div>

                </div>

                <div class="col-md-2 text-right">
                  <button class="btn btn-info" type="button" style="margin-top:25px" id="btn-tambah" data-target="#view-modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i></button>
                </div>

              </div>

              <div class="form-group">
                <label>Kepada</label>
                <?php $kepada = !empty($data['set']->pengeluaran_kepada) ? $data['set']->pengeluaran_kepada : set_value('kepada');  ?>
                <input type="text" autocomplete="off" class="form-control" id="kepada" name="kepada" placeholder="Kepada" value="<?= $kepada ?>">
              </div>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                  <label>Volume</label>
                    <?php $volume = !empty($data['set']->pengeluaran_volume) ? $data['set']->pengeluaran_volume : set_value('volume');  ?>
                    <input type="text" autocomplete="off" class="form-control" id="volume" name="volume" placeholder="Volume" value="<?= $volume ?>">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                  <label>Satuan</label>
                    <?php $satuan = !empty($data['set']->pengeluaran_satuan) ? $data['set']->pengeluaran_satuan : set_value('satuan');  ?>
                    <input type="text" autocomplete="off" class="form-control" id="satuan" name="satuan" placeholder="Satuan" value="<?= $satuan ?>">
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                  <label>Harga Satuan</label>
                    <?php $harga_satuan = !empty($data['set']->pengeluaran_harga_satuan) ? $data['set']->pengeluaran_harga_satuan : set_value('harga_satuan');  ?>
                    <input type="text" autocomplete="off" class="form-control harga" id="harga_satuan" name="harga_satuan" placeholder="Rp. 0" value="<?= $harga_satuan ?>">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>Total</label>
                <?php $total = !empty($data['set']->pengeluaran_total) ? $data['set']->pengeluaran_total : set_value('total');  ?>
                <input type="text" class="form-control harga input-lg" name="total" readonly="true" id="total" placeholder="Rp. 0" autocomplete="off" value="<?= $total ?>">
              </div>


              <div class="form-group">
                <label>Tanggal</label>
                <?php $tanggal = !empty($data['set']->pengeluaran_tanggal) ? $data['set']->pengeluaran_tanggal : date('Y-m-d');  ?>
                <input type="text" data-date-format="yyyy-mm-dd" name="tanggal" class="form-control pull-right datepicker" id="dt-ppjb" value="<?= $tanggal ?>">
              </div>

            </div>

            <div class="col-md-6">

            </div>
          </div><!-- /.row -->


      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/pengeluaran/list/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>" title="Back" class="btn btn-default">Kembali</a>
          <?= form_submit($atrBtn); ?>

        </div>
      </div>
    </div><!-- /.box -->
    <?= form_close(); ?>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Modal Informasi Detil  -->
<div id="view-modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Kategori</h4>
          </div>
          <div class="modal-body edit-content">

            <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" class="form-control" id="nama" placeholder="Nama Kategori">
              <input type="hidden" class="form-control" id="id" value="0">
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
            </div>

            <hr/>

            <table id="tabel-kategori" width="100%" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="dthead dthead-blue">Action</th>
                  <th class="dthead dthead-blue">Nama Kategori</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>


          </div>
        </div>
    </div>
</div>
<!-- end Modal Informasi Detil -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>

  $(window).load(function(){
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $(".select2").select2();
    $( ".harga" ).priceFormat(rupiah);

    $('.datepicker').datepicker({
      autoclose: true
    });

    load_option();

    $('#view-modal-tambah').on('show.bs.modal', function(e) {
      $('#nama').val('');
      $('#id').val('0');
      table_kategori();
    });

    $('#view-modal-tambah').on('hidden.bs.modal', function () {
      load_option();
    });

    $('#volume').keyup(function() {
      hitung_total();
    });

    $('#harga_satuan').keyup(function() {
      hitung_total();
    });

    $(document).on("click","a[id='btn-edit']", function (e) {
      $("[id$=nama]").focus();
      $('#nama').val($(this).attr("data-nama"));
      $('#id').val($(this).attr("data-id"));
    });

    $("#btn-simpan").click(function(){

      $.ajax({
          type: 'POST',
          url: '<?= site_url('pengeluaran/save_pengeluaran_kategori'); ?>',
          data: {
              'pengeluaran_nama': $('#nama').val(),
              'id' : $('#id').val(),
              'pp_kategori'   : '<?= $this->uri->segment(5) ?>'
          },
          success: function(data) {
            // $('#view-modal-tambah').modal('toggle');
            $('#nama').val('');
            $('#id').val('0');
            table_kategori();
          },
          error: function (ts) {
            console.log(ts.responseText);
          }

      });

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
                    url: "<?= site_url('pengeluaran/delete_pengeluaran_kategori/'.'"+id+"'); ?>",
                    success: function(data){
                    }
                }
            )
          .done(function(data) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            table_kategori();
          })
          .error(function(data) {
            swal("Oops", "We couldn't connect to the server!", "error");
          });
      });
    });

    function hitung_total(){
      var total = parseInt($('#volume').val()) * parseInt($('#harga_satuan').unmask());
      $('#total').val(total);
      $( ".harga" ).priceFormat(rupiah);
    }
    function load_option(){

      $.getJSON("<?= site_url('pengeluaran/get_kategori_pengeluaran/'.$this->uri->segment(5).'/'.$this->uri->segment(4)) ?>", function(data) {
          var options = $("#kategori");
          //don't forget error handling!
          if(!data){
            options.append($("<option />").val('').text('Silahkan Tambah Kategori'));
          }
          else{
            $('#kategori').find('option').remove();
            var x = 0;
            $.each(data, function(item) {
              console.log();
                options.append($("<option />").val(data[x].pp_id).text(data[x].pengeluaran_nama));
                <?php if(!empty($this->uri->segment(6))): ?>
                    $("#kategori option[value='<?= $data['set']->pp_id ?>']").prop('selected', true);
                <?php endif; ?>
                x++;
            });
          }

      });
    }


    function table_kategori(){
      $('#tabel-kategori').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('pengeluaran/get_pengeluaran_kategori_list/'.$this->uri->segment(5)) ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 1, "ASC" ]],
        "columns": [
          { "data": "pp_id", "width": "5%", name: "pp_id", "searchable": false, "sortable": false, className: 'text-center'},
          { "data": "pengeluaran_nama", "sortable": true, "searchable": true, name: "pengeluaran_nama" }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="javascript:void(0)" data-id="'+row.pp_id+'" data-nama="'+row.pengeluaran_nama+'" title="Detil" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" data-id="'+row.pp_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 0 // column index
          },

        ],
      });
    }


  });
</script>
