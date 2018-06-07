
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
      <li><a href="<?= site_url('dashboard/user/list'); ?>">Users</a></li>
      <li class="active">Add</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <?= $this->session->flashdata('flashInfo'); ?>

    <?php
      !empty($data['set']->user_id) ? $id = $data['set']->user_id : $id = "0";
      !empty($data['set']->user_avatar) ? $gambar = $data['set']->user_avatar : $gambar = "0";
      $atrform = array(
        'role' => 'form',
        'id' => 'formUser'
      );
    ?>
    <?= form_open_multipart("dashboard/user/save", $atrform); ?>
    <?= form_hidden('id', $id); ?>
    <?= form_hidden('gambar', $gambar); ?>
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title text-primary"><strong><i class="fa fa-navicon"></i> <?= $data['sub_header_title'] ?></strong></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-2">
            <?php if($id === "0"): ?>
              <img src="<?= site_url(IMAGES_USER.'no-photo.jpg'); ?>" id="output" width="100%" class="img-thumbnail">
            <?php else: ?>
              <img src="<?= site_url(IMAGES_USER.$gambar); ?>" id="output" width="100%" class="img-thumbnail">
            <?php endif; ?>
            <span class="help-block text-center">Preview Avatar</span>
          </div>
          <div class="col-md-10" style="border-left:1px solid rgba(207, 207, 207, 0.5);">

            <div class="form-group">
              <?php
                $atrFullname = array(
                  'type'        => 'text',
                  'id'          => 'inputFullName',
                  'name'        => 'inputFullName',
                  'class'       => 'form-control',
                  'placeholder' => 'Nama Lengkap',
                  'maxlength'   => "50",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->user_fullname) ? $data['set']->user_fullname : set_value('inputFullName')
                );
              ?>
              <div class="row">
                <div class="col-sm-5">
                  <?= form_label('Nama Lengkap', 'inputFullName'); ?>
                  <?= form_input($atrFullname); ?>
                  <?php if(form_error('inputFullName')){ echo form_error('inputFullName', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrUsername = array(
                  'type'        => 'text',
                  'id'          => 'inputUsername',
                  'name'        => 'inputUsername',
                  'class'       => 'form-control',
                  'placeholder' => 'Username',
                  'maxlength'   => "10",
                  'autocomplete'=> 'off',
                  'required'    => 'required',
                  'value'       => !empty($data['set']->user_username) ? $data['set']->user_username : set_value('inputUsername')

                );
                if($id != "0"){
                  $atrUsername['readonly'] = 'true';
                }
              ?>
              <div class="row">
                <div class="col-sm-3">
                  <?= form_label('Username', 'inputUsername'); ?>
                  <?= form_input($atrUsername); ?>
                  <?php if(form_error('inputUsername')){ echo form_error('inputUsername', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <div class="form-group">
              <?php
                $atrPassword = array(
                  'id'          => 'inputPassword',
                  'name'        => 'inputPassword',
                  'class'       => 'form-control',
                  'placeholder' => 'Password',
                  'maxlength'   => "10",
                  'autocomplete'=> 'off'
                );
                if($id === "0"){
                  $atrPassword['required'] = 'required';
                }
              ?>
              <div class="row">
                <div class="col-sm-3">
                  <?= form_label('Password', 'inputPassword'); ?>
                  <?= form_password($atrPassword); ?>
                  <?php if(form_error('inputPassword')){ echo form_error('inputPassword', '<div class="text-danger">', '</div>'); }?>
                  <?php if($id != "0"): ?>
                    <span class="help-block"><strong>Kosongkan</strong> password jika Anda tidak ingin mengubah password</span>
                  <?php endif; ?>
                </div>
              </div>
            </div><!--end form-group-->

            <?php if($this->uri->segment(3) != 'edit_profile'): ?>
            <div class="form-group">
              <?php
                $user_level = !empty($data['set']->user_level) ? $data['set']->user_level : set_value('inputLevel');
                if($this->session->userdata('userlevel') === "0"){
                  $inputLevel['0'] = LEVEL_0;
                }
                $inputLevel = array(
                  '1' => LEVEL_1,
                  '2' => LEVEL_2,
                  '3' => LEVEL_3
                );

              ?>
              <div class="row">
                <div class="col-sm-3">
                  <?= form_label('Level', 'inputLevel'); ?>
                  <?= form_dropdown('inputLevel', $inputLevel, $user_level, 'class="form-control"'); ?>
                  <?php if(form_error('inputLevel')){ echo form_error('inputLevel', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <?php else: ?>
              <?= form_hidden('inputLevel', $data['set']->user_level); ?>
            <?php endif; ?>
            <?php if($this->uri->segment(3) != 'edit_profile'): ?>
            <div class="form-group">
              <?php
                $user_status = !empty($data['set']->user_status) ? $data['set']->user_status : set_value('inputStatus');
                $inputStatus = array(
                  'y' => 'Aktif',
                  'n' => 'Tidak Aktif'
                );

              ?>
              <div class="row">
                <div class="col-sm-3">
                  <?= form_label('Status', 'inputStatus'); ?>
                  <?= form_dropdown('inputStatus', $inputStatus, $user_status, 'class="form-control"'); ?>
                  <?php if(form_error('inputStatus')){ echo form_error('inputStatus', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->
            <?php else: ?>
              <?= form_hidden('inputStatus', $data['set']->user_status); ?>
            <?php endif; ?>
            <div class="form-group">
              <div class="row">
                <div class="col-sm-10">
                  <?= form_label('Status', 'inputAvatar'); ?>
                  <input type="file" accept="image/*" name="input_gambar" onchange="loadFile(event)">
                  <span class="help-block">
                    Format Support : JPG/JPEG/PNG <br/>
                    Max File : 1 MB
                  </span>
                  <?php if(form_error('inputAvatar')){ echo form_error('inputAvatar', '<div class="text-danger">', '</div>'); }?>
                </div>
              </div>
            </div><!--end form-group-->

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
          <a href="<?php echo site_url('dashboard/user/list'); ?>" title="Back" class="btn btn-default">Kembali</a>
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
<script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>

<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };

  $(window).load(function(){
    $("#formUser").validate({
      rules: {
        inputFullName: {
          required: true,
          maxlength:50
        },
        inputUsername: {
          required: true,
          maxlength: 10
        },
        inputPassword: {
          <?php if($id == "0"): ?>
          required: true,
          <?php endif; ?>
          maxlength: 10
        }
      },
      messages: {
        inputFullName: {
          required: "Nama Lengkap tidak boleh kosong",
          maxlength: "Batas maksimal 50 karakter"
        },
        inputUsername: {
          required: "Username tidak boleh kosong",
          maxlength: "Batas maksimal 10 karakter"
        },
        inputPassword: {
          required: "Password tidak boleh kosong",
          maxlength: "Batas maksimal 10 karakter"
        }
      }
    });

  });
</script>
