
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
      <li class="active">Tersedia</li>
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

        <h1 class="text-center" style="margin:0;"><?= !empty($data['set']->rumah_nama) ? $data['set']->rumah_nama : "-" ?><br/>
          <small>Silahkan klik <strong>Book Now</strong> untuk <strong>Booking</strong></small>
        </h1>
        <hr/>

        <div class="row">
          <div class="col-md-12">
            <table id="tabel" class="table table-bordered table-hover table-striped" width="100%">
              <thead>
                <tr>
                  <th class="dthead dthead-blue">BLOK</th>
                  <th class="dthead dthead-blue">LUAS BANGUNAN</th>
                  <th class="dthead dthead-blue">LUAS TANAH</th>
                  <th class="dthead dthead-blue">SHM</th>
                  <th class="dthead dthead-blue">NO SHM</th>
                  <th class="dthead dthead-blue">IMB</th>
                  <th class="dthead dthead-blue">NO IMB</th>
                  <th class="dthead dthead-blue">HARGA</th>
                  <th class="dthead dthead-blue">ACTION</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                  <th>[BLOK]</th>
                  <th>[LB]</th>
                  <th>[LT]</th>
                  <th>[SHM]</th>
                  <th>[NO SHM]</th>
                  <th>[IMB]</th>
                  <th>[NO IMB]</th>
                  <th>[HARGA]</th>
                  <th>[ACTION]</th>
                </tr>
              </tfoot>
            </table>

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
          <a href="<?php echo site_url('dashboard/rumah/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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

    function reload_data(){
      var id = '<?= $this->uri->segment(4) ?>';

      loadDt(id);
    }

    function loadDt(id){
      $('#tabel').DataTable({
        "processing": true,
        "serverSide": true,
        "bDestroy" : true,
        "ajax": "<?= site_url('project/get_data_tersedia/'.'"+id+"'); ?>",
        "sServerMethod": "POST",
        "language": {
            "processing": "Sedang memuat data..."
        },
        "searching": true,
        "order": [[ 0, "ASC" ]],
        "columns": [
          { "data": "kavling_blok", name: "kavling_blok", "searchable": true, "sortable": true, className: 'text-center'},
          { "data": "kavling_lb", "sortable": true, "searchable": true, name: "kavling_lb" },
          { "data": "kavling_lt", "sortable": true, "searchable": true, name: "kavling_lt" },
          { "data": "kavling_shm", "sortable": true, "searchable": true, name: "kavling_shm", "width": "12%" },
          { "data": "kavling_shm_no", "sortable": true, "searchable": true, name: "kavling_shm_no", "width": "12%" },
          { "data": "kavling_imb", "sortable": true, "searchable": true, name: "kavling_imb", "width": "12%" },
          { "data": "kavling_imb_no", "sortable": true, "searchable": true, name: "kavling_imb_no", "width": "12%" },
          { "data": "kavling_harga", "sortable": true, "searchable": true, name: "kavling_harga", "width": "16%" },
          { "data": "kavling_id", "sortable": true, "searchable": true, name: "kavling_id", "width": "11%" }
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
              if(data === 'y'){
                var shm = 'ADA';
              }
              else if(data === 'n'){
                var shm = 'TIDAK ADA';
              }
              else if(data === 'p'){
                var shm = 'PROSES';
              }
              else{
                var shm = '-';
              }
              return shm;
            },
            "targets": 3 // column index
          },
          {
            "render": function ( data, type, row ) {
              if(data){
                return data;
              }
              else{
                return '-';
              }
            },
            "targets": 4 // column index
          },
          {
            "render": function ( data, type, row ) {
              if(data === 'y'){
                var imb = 'ADA';
              }
              else if(data === 'n'){
                var imb = 'TIDAK ADA';
              }
              else if(data === 'p'){
                var imb = 'PROSES';
              }
              else{
                var imb = '-';
              }
              return imb;
            },
            "targets": 5 // column index
          },
          {
            "render": function ( data, type, row ) {
              if(data === "0"){
                return "Harga belum di set";
              }
              else{
                return 'Rp. '+data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              }
            },
            "targets": 7 // column index
          },
          {
            "render": function ( data, type, row ) {
              return '<a href="<?= site_url('dashboard/project/booking/'.$this->uri->segment(4).'/'."'+data+'"); ?>" class="btn btn-danger"><i class="fa fa-book"></i> Book Now</span>';
            },
            "targets": 8 // column index
          },


        ],
      });
    }


  });
</script>
