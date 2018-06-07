
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
      <li><a href="<?= site_url('dashboard/rumah/list'); ?>">Penerimaan</a></li>
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
    <?= form_open("penerimaan/save_pembayaran_penerimaan", $atrform); ?>
    <?php
      $booking_id = $this->uri->segment(5);
      $id = !empty($this->uri->segment(6)) ? $this->uri->segment(6) : '0';
      $project_id = $this->uri->segment(4);
    ?>
    <?= form_hidden('booking_id', $booking_id); ?>
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
                <?php $penerimaan_no = !empty($data['set']->penerimaan_no) ? $data['set']->penerimaan_no : 'auto';  ?>
                <?php if($penerimaan_no != 'auto'): ?>
                  <input type="text" class="form-control" name="no-kwitansi" id="no-kwitansi" value="<?= $penerimaan_no ?>" placeholder="No Kwitansi" readonly="true">
                <?php else: ?>
                  <input type="text" class="form-control" name="no-kwitansi" id="no-kwitansi" value="<?= $penerimaan_no ?>" placeholder="No Kwitansi">
                <?php endif; ?>
                <span class="help-block">Isi dengan auto untuk nomor otomatis</span>
              </div>

              <div class="row">
                <div class="col-md-10">

                  <div class="form-group">
                    <label>Kategori</label>
                    <select id="kategori" class="form-control" name="kategori">
                    </select>
                  </div>

                </div>

                <div class="col-md-2 text-right">
                  <button class="btn btn-info" type="button" style="margin-top:25px" id="btn-tambah" data-target="#view-modal-tambah" data-toggle="modal"><i class="fa fa-plus"></i></button>
                </div>

              </div>

              <div class="form-group">
                <label>Uraian</label>
                <select id="uraian" class="form-control" name="uraian">
                </select>
              </div>

              <div class="form-group">
                <label>Dari</label>
                <?php $dari = !empty($data['set']->penerimaan_dari) ? $data['set']->penerimaan_dari : $data['nama'];  ?>
                <input type="text" autocomplete="off" class="form-control" id="dari" name="dari" placeholder="Dari" value="<?= $dari ?>">
              </div>

              <div class="form-group">
                <label>Total</label>
                <?php $total = !empty($data['set']->penerimaan_total) ? $data['set']->penerimaan_total : set_value('total');  ?>
                <input type="text" class="form-control harga" name="total" id="total" placeholder="Rp. 0" autocomplete="off" value="<?= $total ?>">
              </div>


              <div class="form-group">
                <label>Tanggal</label>
                <?php $tanggal = !empty($data['set']->penerimaan_tanggal) ? $data['set']->penerimaan_tanggal : date('Y-m-d');  ?>
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
          <a href="<?php echo site_url('dashboard/penerimaan/detil/'.$this->uri->segment(4).'/'.$this->uri->segment(5)); ?>" title="Back" class="btn btn-default">Kembali</a>
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
    load_uraian();

    $('#view-modal-tambah').on('show.bs.modal', function(e) {
      $('#nama').val('');
      $('#id').val('0');
      table_kategori();
    });

    $('#view-modal-tambah').on('hidden.bs.modal', function () {
      load_option();
    });

    $( "#kategori" ).change(function() {
      load_uraian();
    });

    $("#btn-simpan").click(function(){

      $.ajax({
          type: 'POST',
          url: '<?= site_url('penerimaan/save_penerimaan_kategori'); ?>',
          data: {
              'pkategori_nama': $('#nama').val(),
              'id': $('#id').val()
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

    $(document).on("click","a[id='btn-edit']", function (e) {
      $("[id$=nama]").focus();
      $('#nama').val($(this).attr("data-nama"));
      $('#id').val($(this).attr("data-id"));
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
                    url: "<?= site_url('penerimaan/delete_penerimaan_kategori/'.'"+id+"'); ?>",
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


    function load_option(){
      var booking_id = '<?= $booking_id ?>';
      $.getJSON("<?= site_url('penerimaan/get_penerimaan_kategori/'.'"+booking_id+"') ?>", function(data) {
          var options = $("#kategori");
          //don't forget error handling!
          if(!data){
            options.append($("<option />").val('').text('Silahkan Tambah Kategori'));
          }
          else{
            var x = 0;
            $('#kategori').find('option').remove();
            $.each(data, function(item) {
              console.log();
                options.append($("<option />").val(data[x].pkategori_id).text(data[x].pkategori_nama));
                <?php if(!empty($this->uri->segment(6))): ?>
                    $("#kategori option[value='<?= $data['set']->pkategori_id ?>']").prop('selected', true);
                <?php endif; ?>
                x++;
            });
          }

      });
    }

    function load_uraian(){
      var booking = '<?= $this->uri->segment(5) ?>';
      <?php if(!empty($this->uri->segment(6))): ?>
      var kategori = <?= $data['set']->pkategori_id; ?>;
      var url = "<?= site_url('penerimaan/get_uraian2/'.'"+kategori+"/"+booking+"') ?>";
      <?php else: ?>
      var kategori = $('#kategori').val() || '2';
      var url = "<?= site_url('penerimaan/get_uraian/'.'"+kategori+"/"+booking+"') ?>";
      <?php endif; ?>

      $.getJSON(url, function(data) {
          var options = $("#uraian");
          //don't forget error handling!
          if(!data){
            options.append($("<option />").val('').text('Silahkan Tambah Kategori'));
          }
          else{
            var x = 0;
            $('#uraian').find('option').remove();
            $.each(data, function(item) {
              console.log();
                options.append($("<option />").val(data[x].up_id).text(data[x].up_nama));
                <?php if(!empty($this->uri->segment(6))): ?>
                    $("#uraian option[value='<?= $data['set']->penerimaan_uraian ?>']").prop('selected', true);
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
        "ajax": "<?= site_url('penerimaan/get_penerimaan_kategori_list/'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 1, "ASC" ]],
        "columns": [
          { "data": "pkategori_id", "width": "5%", name: "pkategori_id", "searchable": false, "sortable": false, className: 'text-center'},
          { "data": "pkategori_nama", "sortable": true, "searchable": true, name: "pkategori_nama" }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="javascript:void(0)" data-id="'+row.pkategori_id+'" data-nama="'+row.pkategori_nama+'" title="Detil" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" data-id="'+row.pkategori_id+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 0 // column index
          },

        ],
      });
    }


  });
</script>
