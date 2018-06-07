
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
      <li class="active">Log Login</li>
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
              &nbsp;
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

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
              <th class="dthead dthead-blue">Tanggal</th>
              <th class="dthead dthead-blue">Full Name</th>
              <th class="dthead dthead-blue">IP</th>
              <th class="dthead dthead-blue">Platform</th>
              <th class="dthead dthead-blue">Version</th>
              <th class="dthead dthead-blue">Agent</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
          <tfoot>
            <tr>
              <th>[Tanggal]</th>
              <th>[Full Name]</th>
              <th>[IP]</th>
              <th>[Platform]</th>
              <th>[Version]</th>
              <th>[Agent]</th>
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
<script src="<?= site_url(ASSET_PLUGIN.'select2/select2.full.min.js'); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."daterangepicker/daterangepicker.js"); ?>"></script>
<script src="<?= base_url(ASSET_PLUGIN."datepicker/bootstrap-datepicker.js"); ?>"></script>

<script>
    $(window).load(function(){

      load_data();

      $( "#btn-reload" ).click(function() {
        load_data();
      });



      function load_data(){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('log/get_log_login/'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 4, "ASC" ]],
          "columns": [
            { "data": "umeta_lastlogin", "width": "17%", name: "umeta_lastlogin"},
            { "data": "user_fullname", name: "user_fullname" },
            { "data": "umeta_ip", name: "umeta_ip",  "width": "8%" },
            { "data": "umeta_platform", name: "umeta_platform", "width": "16%" },
            { "data": "umeta_version", name: "umeta_version", "width": "5%" },
            { "data": "umeta_agent", "sortable": true, "searchable": true, name: "umeta_agent" }
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return moment(data).format("DD/MM/YYYY h:mm:ss a")
              },
              "targets": 0 // column index
            },

          ],
        });
      }

    });
</script>
