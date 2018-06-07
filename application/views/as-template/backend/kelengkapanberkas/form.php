
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
      <li><a href="<?= site_url('dashboard/rumah/list'); ?>">Rumah</a></li>
      <li class="active">Kavling</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->booking_id) ? $booking_id = $data['set']->booking_id : $booking_id = "0";
      !empty($data['set']->pelanggan_id) ? $pelanggan_id = $data['set']->pelanggan_id : $pelanggan_id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formBerkas'
      );
    ?>
    <?= form_open("dashboard/admin/transaksi/kelengkapanberkas/save", $atrform); ?>
    <?= form_hidden('booking_id', $booking_id); ?>
    <?= form_hidden('pelanggan_id', $pelanggan_id); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">
            <div style="padding:10px;border:1px solid rgba(207, 207, 207, 0.5);border-radius:3px;">
              <div class="form-group">
                <?php
                  $atrKtp = array(
                    'type'        => 'text',
                    'id'          => 'inputKtp',
                    'name'        => 'inputKtp',
                    'class'       => 'form-control',
                    'placeholder' => 'Ktp Pelanggan',
                    'readonly'    => 'true',
                    'maxlength'   => "255",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->pelanggan_ktp) ? $data['set']->pelanggan_ktp : set_value('inputKtp')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('KTP Pelangan', 'inputKtp'); ?>
                    <?= form_input($atrKtp); ?>
                    <?php if(form_error('inputKtp')){ echo form_error('inputKtp', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->

              <div class="form-group">
                <?php
                  $atrNama = array(
                    'type'        => 'text',
                    'id'          => 'inputNama',
                    'name'        => 'inputNama',
                    'class'       => 'form-control',
                    'placeholder' => 'Nama Pelanggan',
                    'readonly'    => 'true',
                    'maxlength'   => "255",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->pelanggan_nama) ? $data['set']->pelanggan_nama : set_value('inputNama')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Nama Pelangan', 'inputNama'); ?>
                    <?= form_input($atrNama); ?>
                    <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrAlamatPelanggan = array(
                    'type'        => 'text',
                    'id'          => 'inputAlamatPelanggan',
                    'name'        => 'inputAlamatPelanggan',
                    'class'       => 'form-control',
                    'placeholder' => 'Alamat Pelanggan',
                    'autocomplete'=> 'off',
                    'rows'        => '2',
                    'readonly'    => 'true',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->pelanggan_alamat) ? $data['set']->pelanggan_alamat : set_value('inputAlamatPelanggan')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Alamat Pelanggan', 'inputAlamatPelanggan'); ?>
                    <?= form_textarea($atrAlamatPelanggan); ?>
                    <?php if(form_error('inputAlamatPelanggan')){ echo form_error('inputAlamatPelanggan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrPerumahan = array(
                    'type'        => 'text',
                    'id'          => 'inputPerumahan',
                    'name'        => 'inputPerumahan',
                    'class'       => 'form-control',
                    'placeholder' => 'Nama Perumahan',
                    'autocomplete'=> 'off',
                    'readonly'    => 'true',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputPerumahan')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Perumahan', 'inputPerumahan'); ?>
                    <?= form_input($atrPerumahan); ?>
                    <?php if(form_error('inputPerumahan')){ echo form_error('inputPerumahan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrAlamatPerumahan = array(
                    'type'        => 'text',
                    'id'          => 'inputAlamatPerumahan',
                    'name'        => 'inputAlamatPerumahan',
                    'class'       => 'form-control',
                    'placeholder' => 'Alamat Perumahan',
                    'autocomplete'=> 'off',
                    'rows'        => '2',
                    'readonly'    => 'true',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputAlamatPerumahan')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Alamat Perumahan', 'inputAlamatPerumahan'); ?>
                    <?= form_textarea($atrAlamatPerumahan); ?>
                    <?php if(form_error('inputAlamatPerumahan')){ echo form_error('inputAlamatPerumahan', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrKavling = array(
                    'type'        => 'text',
                    'id'          => 'inputKavling',
                    'name'        => 'inputKavling',
                    'class'       => 'form-control',
                    'placeholder' => 'No Blok',
                    'autocomplete'=> 'off',
                    'readonly'    => 'true',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->kavling_blok) ? $data['set']->kavling_blok : set_value('inputKavling')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Kavling Blok', 'inputKavling'); ?>
                    <?= form_input($atrKavling); ?>
                    <?php if(form_error('inputKavling')){ echo form_error('inputKavling', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->


            </div>
          </div>
          <div class="col-md-8">

            <button type="button" class="btn btn-success" data-target="#modal-tambah-kategori" data-toggle="modal"><i class="fa fa-plus"></i> Tambah Kategori Berkas</button>
            <br />
            <hr />
            <table id="kavling" class="table table-bordered table-hover table-striped">
              <thead>
                <tr>
                  <th class="dthead dthead-blue" width="2%" style="text-align:center !important;">NO.</th>
                  <th class="dthead dthead-blue">Berkas</th>
                  <th class="dthead dthead-blue" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['detil'])): ?>
                  <?php $i = 1; ?>
                  <?php foreach($data['detil'] as $row): ?>
                    <tr>
                      <td class="text-center"><?= $i; ?></td>
                      <td>
                        <input type="text" value="<?= $row->kkb_nama ?>" readonly class="form-control" name="berkas[]" maxlength="255" autocomplete="off" placeholder="Berkas">
                        <input type="hidden" name="kelengkapan_id[]" value="<?= $row->kelengkapan_id ?>">
                        <input type="hidden" name="kkb_id[]" value="<?= $row->kkb_id ?>">
                      </td>
                      <td>
                        <a class="btn btn-danger" href="<?= site_url('transaksi/kelengkapanberkas_delete/'.$row->kelengkapan_id.'/'.$booking_id.'/'.$pelanggan_id); ?>" /><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                    <?php $i++; ?>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td></td>
                    <td>
                      <!-- <input type="text" class="form-control" name="berkas[]" maxlength="50" autocomplete="off" placeholder="Blok"> -->
                      <select id="berkas1" name="berkas[]" class="form-control select2">
                      </select>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger" onclick="deleteRow(this)"/><i class="fa fa-trash-o"></i></button>
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th></th>
                  <th>[Berkas]</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
            <button type="button" id="AddRow" class="btn btn-default btn-sm pull-right">[F2] Tambah</button>
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
        <div class="text-right">
          <?php
            $atrBtn = array(
              'class' => 'btn btn-primary',
              'value' => 'Simpan Data'
            );
          ?>
          <a href="<?php echo site_url('dashboard/booking/detil/'.$this->uri->segment(6)); ?>" title="Back" class="btn btn-default">Kembali</a>
          <?= form_submit($atrBtn); ?>
        </div>
      </div>
    </div><!-- /.box -->
    <?= form_close(); ?>

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!-- Modal Kategori  -->
<div id="modal-tambah-kategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-header2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-arrow-circle-o-right"></i> Kategori Berkas</h4>
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
                    <th class="dthead dthead-blue text-center"><i class="fa fa-gear"></i></th>
                    <th class="dthead dthead-blue">Nama Kategori</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
<!-- end Modal Kategori -->


<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('.input-harga').priceFormat(rupiah);
    load_option(x);

    $('#modal-tambah-kategori').on('show.bs.modal', function(e) {
      $('#nama').val('');
      $('#btn-simpan').html('Simpan');
      load_data();
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
        confirmButtonText: "Yes, Delete it!",
        confirmButtonColor: "#ec6c62"
        }, function() {
            $.ajax(
                {
                    type: "POST",
                    data:{
                      id : id
                    },
                    url: "<?= site_url('transaksi/delete_kelengkapan_berkas_data/'); ?>",
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

    $("#btn-simpan").click(function(){
      $('#btn-simpan').prop('disabled', true);
      $('#btn-simpan').html('<i class="fa fa-spinner fa-spin"></i> Menyimpan ...');
      $.ajax({
          type: 'POST',
          url: '<?= site_url('transaksi/save_kelengkapan_berkas_data'); ?>',
          data: {
              'pkategori_nama': $('#nama').val(),
              'id': $('#id').val()
          },
          success: function(data) {
            // $('#view-modal-tambah').modal('toggle');
            $('#nama').val('');
            $('#id').val('0');
            load_data();

            $('#btn-simpan').prop('disabled', false);
            $('#btn-simpan').html('Simpan');
          },
          error: function (ts) {
            // console.log(ts.responseText);
            $('#btn-simpan').prop('disabled', false);
            $('#btn-simpan').html('Simpan');
            swal('Error', 'Error Server', 'error');
          }

      });

    });

    $("#AddRow").click(function(){
       addRow();
    });

    $(document).keypress(function(e) {
      if(e.keyCode == 113) { //f2
        addRow();
      }
    });

    function addRow(){
      x++;
      $('#kavling').append(''+
                            '<tr>'+
                            '<td></td>'+
                            '<td>'+
                            '<select id="berkas'+x+'" name="berkas[]" class="form-control select2"></select>'+
                            // '<input type="text" class="form-control" name="berkas[]" maxlength="255" autocomplete="off" placeholder="Berkas">'+
                            '</td>'+
                            '<td><button id="' + x + '" type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>'+
                            '</tr>'+
                            '');
      $('.input-harga').priceFormat(rupiah);
      load_option(x);

      $( "input[id=b"+ x +"]" ).focus();
    }

    function load_option(z){
      $.getJSON("<?= site_url('transaksi/get_kkb/') ?>", function(data) {
          var options = $("#berkas"+z);
          if(!data){
            options.append($("<option />").val('').text('Silahkan Tambah Kategori'));
          }
          else{
            var x = 0;
            $('#berkas'+z).find('option').remove();
            // options.append('<option value="" selected="selected">SELECT</option>');
            $.each(data, function(item) {
              options.append($("<option />").val(data[x].kkb_id).text(data[x].kkb_nama));
              x++;
            });
            $(".select2").select2();
            $('option[value="'+data[0].kkb_id+'"]').prop('selected', true);
          }

      });
    }

    function load_data(){

      $('#tabel-kategori').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('transaksi/get_kelengkapan_berkas_data/'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 0, "desc" ]],
        "columns": [
          { "data": "kkb_id", "width": "5%", name: "kkb_id", "searchable": false, "sortable": false, className: 'text-center'},
          { "data": "kkb_nama", "sortable": false, name: "kkb_nama" }
        ],
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<div class="btn-group">'+
                     '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown"> <span class="fa fa-gear"></span> <span class="caret"></span></a>'+
                     '<ul class="dropdown-menu" role="menu">'+
                     '<li><a href="javascript:void(0)" data-id="'+row.kkb_id+'" data-nama="'+row.kkb_nama+'" title="Detil" id="btn-edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                     '<li class="divider"></li>' +
                     '<li><a href="javascript:void(0)" data-id="'+row.kkb_id+'" data-nama="'+row.kkb_nama+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                     '</ul></div>';
            },
            "targets": 0 // column index
          },
        ],
      });

    }

  });
</script>
