
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
      !empty($data['set']->rumah_id) ? $id_rumah = $data['set']->rumah_id : $id_rumah = "0";
      !empty($data['detil']) ? $id = 1 : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formRumah'
      );
    ?>
    <?= form_open("dashboard/rumah/kavling_save", $atrform); ?>
    <?= form_hidden('id_rumah', $id_rumah); ?>
    <?= form_hidden('id', $id); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div style="padding:10px;border:1px solid rgba(207, 207, 207, 0.5);border-radius:3px;">
              <div class="form-group">
                <?php
                  $atrNama = array(
                    'type'        => 'text',
                    'id'          => 'inputNama',
                    'name'        => 'inputNama',
                    'class'       => 'form-control',
                    'placeholder' => 'Nama Perumahan',
                    'readonly'    => 'true',
                    'maxlength'   => "255",
                    'autocomplete'=> 'off',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : set_value('inputNama')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Nama Perumahan', 'inputNama'); ?>
                    <?= form_input($atrNama); ?>
                    <?php if(form_error('inputNama')){ echo form_error('inputNama', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
              <div class="form-group">
                <?php
                  $atrAlamat = array(
                    'type'        => 'text',
                    'id'          => 'inputAlamat',
                    'name'        => 'inputAlamat',
                    'class'       => 'form-control',
                    'placeholder' => 'Alamat Perumahan',
                    'autocomplete'=> 'off',
                    'rows'        => '2',
                    'readonly'    => 'true',
                    'required'    => 'required',
                    'value'       => !empty($data['set']->rumah_alamat) ? $data['set']->rumah_alamat : set_value('inputAlamat')
                  );
                ?>
                <div class="row">
                  <div class="col-sm-12">
                    <?= form_label('Alamat Perumahan', 'inputAlamat'); ?>
                    <?= form_textarea($atrAlamat); ?>
                    <?php if(form_error('inputAlamat')){ echo form_error('inputAlamat', '<div class="text-danger">', '</div>'); }?>
                  </div>
                </div>
              </div><!--end form-group-->
            </div>
          </div>
          <div class="col-md-12">
            <table id="kavling" class="table table-bordered table-hover table-striped" width="100%">
              <thead>
                <tr>
                  <th class="dthead dthead-blue" width="5%">NO</th>
                  <th class="dthead dthead-blue" width="9%">BLOK</th>
                  <th class="dthead dthead-blue" width="10%">LUAS BANGUNAN</th>
                  <th class="dthead dthead-blue" width="10%">LUAS TANAH</th>
                  <th class="dthead dthead-blue">SHM</th>
                  <th class="dthead dthead-blue" width="10%">NO SHM</th>
                  <th class="dthead dthead-blue">IMB</th>
                  <th class="dthead dthead-blue" width="10%">NO IMB</th>
                  <th class="dthead dthead-blue">HARGA</th>
                  <th class="dthead dthead-blue" width="5%"></th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($data['detil'])): ?>
                  <?php $x = 1; ?>
                  <?php foreach($data['detil'] as $row): ?>
                    <tr>
                      <td class="text-center"><?= $x++; ?></td>
                      <td>
                        <input type="text" value="<?= $row->kavling_blok ?>" class="form-control" name="blok[]" maxlength="50" autocomplete="off" placeholder="Blok">
                        <input type="hidden" name="kavling_id[]" value="<?= $row->kavling_id ?>">
                      </td>
                      <td>
                        <input type="text" value="<?= $row->kavling_lb ?>" class="form-control" name="lb[]" maxlength="255" autocomplete="off" placeholder="LB">
                      </td>
                      <td>
                        <input type="text" value="<?= $row->kavling_lt ?>" class="form-control" name="lt[]" maxlength="255" autocomplete="off" placeholder="LT">
                      </td>
                      <td>
                        <?php
                          $shm = !empty($row->kavling_shm) ? $row->kavling_shm : set_value('inputShm[]');
                          $inputShm = array(
                            'y' => "ADA",
                            'p' => "PROSES"
                          );
                        ?>
                        <?= form_dropdown('inputShm[]', $inputShm, $shm, 'class="form-control"'); ?>
                      </td>
                      <td>
                        <input type="text" value="<?= $row->kavling_shm_no ?>" class="form-control" name="shmno[]" maxlength="50" autocomplete="off" placeholder="No SHM">
                      </td>
                      <td>
                        <?php
                          $imb = !empty($row->kavling_imb) ? $row->kavling_imb : set_value('inputImb[]');
                          $inputImb = array(
                            'y' => "ADA",
                            'p' => "PROSES"
                          );
                        ?>
                        <?= form_dropdown('inputImb[]', $inputImb, $imb, 'class="form-control"'); ?>
                      </td>
                      <td>
                        <input type="text" value="<?= $row->kavling_imb_no ?>" class="form-control" name="imbno[]" maxlength="50" autocomplete="off" placeholder="No IMB">
                      </td>
                      <td>
                        <input type="text" value="<?= $row->kavling_harga ?>" class="form-control input-harga" name="harga[]" autocomplete="off" placeholder="Rp. 0">
                      </td>
                      <td>
                        <a class="btn btn-danger" href="<?= site_url('rumah/kavling_delete/'.$row->kavling_id.'/'.$id_rumah); ?>" /><i class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>[NO]</th>
                  <th>[BLOK]</th>
                  <th>[LB]</th>
                  <th>[LT]</th>
                  <th>[SHM]</th>
                  <th>[NO SHM]</th>
                  <th>[IMB]</th>
                  <th>[NO IMB]</th>
                  <th>[HARGA]</th>
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
          <a href="<?php echo site_url('dashboard/project/display/'.$this->uri->segment(4)); ?>" title="Back" class="btn btn-default">Kembali</a>
          <?= form_submit($atrBtn); ?>
        </div>
      </div>
    </div><!-- /.box -->
    <?= form_close(); ?>


  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<?php $this->load->view(PATH_BACKEND.'footer'); ?>
<?php $this->load->view(PATH_BACKEND.'default_js'); ?>

<!-- AdminLTE App -->
<script src="<?= base_url(ASSET_JS."app.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
<script src="<?= base_url(ASSET_JS."jquery.price_format.2.0.min.js"); ?>"></script>

<script>
  function deleteRow(row){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('kavling').deleteRow(i);
  }

  $(window).load(function(){
    var x = 1;
    var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
    $('.input-harga').priceFormat(rupiah);

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
                            '<td>'+
                            '</td>'+
                            '<td>'+
                            '<input id="b' + x + '" type="text" class="form-control" name="blok[]" maxlength="50" autocomplete="off" placeholder="Blok">'+
                            '</td>'+
                            '<td>'+
                            '<input id="' + x + '" type="text" class="form-control" name="lb[]" maxlength="255" autocomplete="off" placeholder="LB">'+
                            '</td>'+
                            '<td>'+
                            '<input id="' + x + '" type="text" class="form-control" name="lt[]" maxlength="255" autocomplete="off" placeholder="LT">'+
                            '</td>'+
                            '</td>'+
                            '<td>'+
                            '<select name="inputShm[]" class="form-control">'+
                            '<option value="y">ADA</option>'+
                            '<option value="p">PROSES</option>'+
                            '</select>'+
                            '</td>'+
                            '<td>'+
                            '<input type="text" class="form-control" name="shmno[]" maxlength="50" autocomplete="off" placeholder="No SHM">'+
                            '</td>'+
                            '<td>'+
                            '<select name="inputImb[]" class="form-control">'+
                            '<option value="y">ADA</option>'+
                            '<option value="p">PROSES</option>'+
                            '</select>'+
                            '</td>'+
                            '<td>'+
                            '<input type="text" class="form-control" name="imbno[]" maxlength="50" autocomplete="off" placeholder="No IMB">'+
                            '</td>'+
                            '<td>'+
                            '<input id="' + x + '" type="text" class="form-control input-harga" name="harga[]" autocomplete="off" placeholder="Rp. 0">'+
                            '</td>'+
                            '<td><button id="' + x + '" type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></button></td>'+
                            '</tr>'+
                            '');
      $('.input-harga').priceFormat(rupiah);

      $( "input[id=b"+ x +"]" ).focus();
    }

  });
</script>
