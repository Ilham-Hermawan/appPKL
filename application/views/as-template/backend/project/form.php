
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

    <?php
      !empty($data['set']->rumah_id) ? $id = $data['set']->rumah_id : $id = "0";

      $atrform = array(
        'role' => 'form',
        'id'   => 'formRumah'
      );
    ?>
    <?= form_open_multipart("dashboard/rumah/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>

    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> Tambah Project</strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">

         <div class="row">
           <div class="col-md-6">

             <div class="form-group">
               <?php
                 $atrNama = array(
                   'type'        => 'text',
                   'id'          => 'inputNama',
                   'name'        => 'inputNama',
                   'class'       => 'form-control',
                   'placeholder' => 'Nama Perumahan',
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
                 $atrKode = array(
                   'type'        => 'text',
                   'id'          => 'inputKode',
                   'name'        => 'inputKode',
                   'class'       => 'form-control',
                   'placeholder' => 'Kode Perumahan',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->rumah_kode) ? $data['set']->rumah_kode : set_value('inputKode')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-5">
                   <?= form_label('Kode Perumahan', 'inputKode'); ?>
                   <?= form_input($atrKode); ?>
                   <?php if(form_error('inputKode')){ echo form_error('inputKode', '<div class="text-danger">', '</div>'); }?>
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
                   'rows'        => '4',
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

             <div class="form-group">
               <?php
                 $atrModal = array(
                   'type'        => 'text',
                   'id'          => 'inputModal',
                   'name'        => 'inputModal',
                   'class'       => 'form-control harga',
                   'placeholder' => 'Rp. 0',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->modal_awal) ? $data['set']->modal_awal : set_value('inputModal')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-12">
                   <?= form_label('Modal Awal', 'inputModal'); ?>
                   <?= form_input($atrModal); ?>
                   <?php if(form_error('inputModal')){ echo form_error('inputModal', '<div class="text-danger">', '</div>'); }?>
                 </div>
               </div>
             </div><!--end form-group-->


           </div>

           <div class="col-md-6" style="padding-left:10px;border-left:1px solid #F4F4F4;">

             <div class="form-group">
               <?php
                 $atrDesa = array(
                   'type'        => 'text',
                   'id'          => 'inputDesa',
                   'name'        => 'inputDesa',
                   'class'       => 'form-control',
                   'placeholder' => 'Desa / Kelurahan',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->rumah_desa) ? $data['set']->rumah_desa : set_value('inputDesa')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-12">
                   <?= form_label('Desa / Kelurahan', 'inputDesa'); ?>
                   <?= form_input($atrDesa); ?>
                   <?php if(form_error('inputDesa')){ echo form_error('inputDesa', '<div class="text-danger">', '</div>'); }?>
                 </div>
               </div>
             </div><!--end form-group-->
             <div class="form-group">
               <?php
                 $atrKecamatan = array(
                   'type'        => 'text',
                   'id'          => 'inputKecamatan',
                   'name'        => 'inputKecamatan',
                   'class'       => 'form-control',
                   'placeholder' => 'Kecamatan',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->rumah_kecamatan) ? $data['set']->rumah_kecamatan : set_value('inputKecamatan')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-12">
                   <?= form_label('Kecamatan', 'inputKecamatan'); ?>
                   <?= form_input($atrKecamatan); ?>
                   <?php if(form_error('inputKecamatan')){ echo form_error('inputKecamatan', '<div class="text-danger">', '</div>'); }?>
                 </div>
               </div>
             </div><!--end form-group-->
             <div class="form-group">
               <?php
                 $atrKota = array(
                   'type'        => 'text',
                   'id'          => 'inputKota',
                   'name'        => 'inputKota',
                   'class'       => 'form-control',
                   'placeholder' => 'Kota',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->rumah_kota) ? $data['set']->rumah_kota : set_value('inputKota')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-12">
                   <?= form_label('Kota', 'inputKota'); ?>
                   <?= form_input($atrKota); ?>
                   <?php if(form_error('inputKota')){ echo form_error('inputKota', '<div class="text-danger">', '</div>'); }?>
                 </div>
               </div>
             </div><!--end form-group-->
             <div class="form-group">
               <?php
                 $atrProvinsi = array(
                   'type'        => 'text',
                   'id'          => 'inputProvinsi',
                   'name'        => 'inputProvinsi',
                   'class'       => 'form-control',
                   'placeholder' => 'Provinsi',
                   'maxlength'   => "255",
                   'autocomplete'=> 'off',
                   'required'    => 'required',
                   'value'       => !empty($data['set']->rumah_provinsi) ? $data['set']->rumah_provinsi : set_value('inputProvinsi')
                 );
               ?>
               <div class="row">
                 <div class="col-sm-12">
                   <?= form_label('Provinsi', 'inputProvinsi'); ?>
                   <?= form_input($atrProvinsi); ?>
                   <?php if(form_error('inputProvinsi')){ echo form_error('inputProvinsi', '<div class="text-danger">', '</div>'); }?>
                 </div>
               </div>
             </div><!--end form-group-->


           </div>

         </div>



      </div><!-- /.box-body -->
      <div class="box-footer text-right">
        <?php
          $atrBtn = array(
            'class' => 'btn btn-primary',
            'value' => 'Simpan Data'
          );
        ?>
        <a href="<?php echo site_url('dashboard'); ?>" title="Back" class="btn btn-default">Kembali</a>
        <?= form_submit($atrBtn); ?>
      </div>
    </div><!-- /.box -->
    <?= form_close(); ?>


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

<script>
    $(window).load(function(){
      var rupiah ={prefix: 'Rp. ', thousandsSeparator: '.', centsLimit: 0};
      var level = $( "#filterLevel" ).val() || "all";
      var status = $( "#filterStatus" ).val() || "all";
      $( ".harga" ).priceFormat(rupiah);
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
