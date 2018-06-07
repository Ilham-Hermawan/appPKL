
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
      <li class="active">Project</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> Daftar Project</strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div style="margin-bottom:20px;">
          <div class="row">
            <div class="col-md-6">
              <a href="<?= site_url('dashboard/user/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
            </div>
            <div class="col-md-6 text-right">
              <button class="btn btn-default" id="btn-reload"><i class="fa fa-refresh"></i> Reload Data</button>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="box box-info box-solid">
              <div class="box-header with-border">
              </div>
              <div class="box-body">
                <img src="<?= site_url(IMAGES_ICONS.'apartment.svg') ?>">
                <h4 style="margin:0;">GREENLAND RESIDENCE</h4>
              </div>
            </div>
          </div>


        </div>

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

<script>
    $(window).load(function(){
      var level = $( "#filterLevel" ).val() || "all";
      var status = $( "#filterStatus" ).val() || "all";
      loadDt(level, status);

      $( "#btn-reload" ).click(function() {
        var level = "all";
        var status = "all";

        loadDt(level, status);

        $("#filterStatus").val('all').trigger("change");
        $("#filterLevel").val('all').trigger("change");
      });

      $( "#filterStatus" ).change(function() {
        var level = $( "#filterLevel" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";

        loadDt(level, status);
      });

      $( "#filterLevel" ).change(function() {
        var level = $( "#filterLevel" ).val() || "all";
        var status = $( "#filterStatus" ).val() || "all";

        loadDt(level, status);
      });

      $(document).on("click","a[id='btn-delete']", function (e) {
        var id = $(this).attr("data-id");
        var avatar = $(this).attr("data-avatar");

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
            window.location.href = '<?= site_url('dashboard/user/delete/'."'+id+'/'+avatar+'"); ?>';
          } else {
        	    swal("Cancelled", "Your imaginary file is safe :)", "error");
          }
        });

      });

      function loadDt(level, status){
        $('#data-table').DataTable({
          "processing": true,
          "serverSide": true,
          "bDestroy" : true,
          "ajax": "<?= site_url('user/get_list_data/'.'"+level+"/"+status+"'); ?>",
          "sServerMethod": "POST",
          "language": {
              "processing": "Sedang memuat data..."
          },
          "searching": true,
          "order": [[ 0, "desc" ]],
          "columns": [
            { "data": "user_id", "width": "5%", name: "user_id", "searchable": false, "sortable": false, className: 'text-center'},
            { "data": "user_avatar", "width": "5%", "sortable": false, name: "user_avatar", className: 'text-center' },
            { "data": "user_fullname", "searchable": true, name: "user_fullname" },
            { "data": "user_username", "width": "14%", "searchable": true, name: "user_username" },
            { "data": "user_level", "width": "10%", name: "user_level"},
            { "data": "user_status", "width": "10%", name: "user_status"},
            { "data": "user_created", "width": "17%", name: "user_created", "searchable": false, "sortable": false, className: 'text-center'}
          ],
          "columnDefs": [
            {
              "render": function ( data, type, row ) {
                return '<div class="btn-group">'+
                       '<a class="btn btn-success dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></a>'+
                       '<ul class="dropdown-menu" role="menu">'+
                       '<li><a href="<?= site_url('dashboard/user/edit/'."'+row.user_id+'") ?>" title="Edit"><span class="fa fa-pencil"></span> Edit</a></li>'+
                       '<li class="divider"></li>' +
                       '<li><a href="javascript:void(0)" data-id="'+row.user_id+'" data-avatar="'+row.user_avatar+'" title="Delete" id="btn-delete"><span class="fa fa-trash-o text-red"></span> Delete</a></li>'+
                       '</ul></div>';
              },
              "targets": 0 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return '<img src="<?= site_url(IMAGES_USER."'+row.user_avatar+'"); ?>" class="img-thumbnail" alt="avatar" title="'+row.user_fullname+'" width="60px">';
              },
              "targets": 1 // column index
            },
            {
              "render": function ( data, type, row ) {
                  if(data == "y"){
                    return '<span class="label-text bg-light-blue"><i class="fa fa-check"></i> Aktif</span>';
                  }
                  else{
                    return '<span class="label-text bg-red"><i class="fa fa-ban"></i> Tidak Aktif</span>';
                  }
              },
              "targets": 5 // column index
            },
            {
              "render": function ( data, type, row ) {
                  return moment(data).format("DD MMM YYYY hh:mm:ss a")
              },
              "targets": 6 // column index
            },

          ],
        });
      }

    });
</script>
