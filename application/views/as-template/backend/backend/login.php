<?= doctype('html5'); ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $app_name." ".$separator ?> Login</title>
    <?php if($site_favicon != FALSE): ?>
    <link rel="icon" type="image/x-icon" href="<?= site_url(IMAGES_WEB.'favicon.ico'); ?>" />
    <?php endif; ?>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <?= link_tag(ASSET_CSS.'bootstrap.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'font-awesome/css/font-awesome.min.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'ionicons/css/ionicons.min.css'); ?>
    <?= link_tag(ASSET_CSS.'AdminLTE.css'); ?>
    <?= link_tag(ASSET_CSS.'_all-skins.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'sweetalert/sweet-alert.css'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?= base_url(ASSET_JS.'html5shiv.min.js') ?>"></script>
        <script src="<?= base_url(ASSET_JS.'respond.min.js') ?>"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo text-center">
        <a href="<?= site_url(); ?>">
          <img src="<?= site_url(IMAGES_WEB."logo.png"); ?>" width="200px" alt="Viland Property" title="Viland Property">
        </a>
      </div><!-- /.login-logo -->

      <div style="background:#fff;padding:30px;border-radius:2px;border:1px solid rgba(207, 207, 207, 0.5);border-bottom:10px solid rgba(228, 228, 228, 0.7);">

        <h2 style="margin:0 0 30px 0;font-family:LatoWebThin;">Viland Property System <small>Version <?= $app_version ?></small></h2>

        <?php
          $atrform = array(
            'role' => 'form',
            'id' => 'formLogin'
          );
        ?>
        <?= form_open("auth/check_login", $atrform); ?>
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group has-feedback">
              <?php
               $atrUsername = array(
                 'type'        => 'text',
                 'id'          => 'inputUsername',
                 'name'        => 'inputUsername',
                 'class'       => 'form-control input-lg',
                 'placeholder' => 'Username',
                 'maxlength'   => "10",
                 'autocomplete'=> 'off',
                 'required'    => 'required'
               );
              ?>
              <?= form_label('Username', 'inputUsername'); ?>
              <?= form_input($atrUsername); ?>
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <?php if(form_error('inputUsername')){ echo form_error('inputUsername', '<div class="text-danger">', '</div>'); }?>
          </div>
          <div class="col-lg-4">
            <div class="form-group has-feedback">
              <?php
               $atrPassword = array(
                 'type'        => 'password',
                 'id'          => 'inputPassword',
                 'name'        => 'inputPassword',
                 'class'       => 'form-control input-lg',
                 'placeholder' => 'Password',
                 'maxlength'   => "10",
                 'autocomplete'=> 'off',
                 'required'    => 'required'
               );
              ?>

              <?= form_label('Password', 'inputPassword'); ?>
              <?= form_input($atrPassword); ?>
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <?php if(form_error('inputPassword')){ echo form_error('inputPassword', '<div class="text-danger">', '</div>'); }?>
            </div>
          </div>
          <div class="col-lg-4">

            <button type="submit" class="btn btn-primary btn-block btn-flat btn-lg" style="margin-top:24px" id="btnID">
              <img src="<?= site_url(IMAGES_WEB.'loading_2.svg'); ?>" id="img-loading" style="margin-right:0.5em;width:20pt;">
              <span id="sign-in">Sign In</span>
            </button>
          </div>
        </div><!-- /.row -->
        <?= form_close(); ?>

        <?= $this->session->flashdata('flashInfo'); ?>

      </div>
      <div style="margin:20px 0;color:#333;font-family:LatoWebThin;" class="text-center">
        Powered by <?= POWERED_BY ?><br/>
        2016 <?= (date('Y') != "2016") ? "-".date('Y') : ""; ?>
      </div>

    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url(ASSET_PLUGIN."jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <script src="<?= base_url(ASSET_PLUGIN."jQueryUI/jquery-ui.min.js"); ?>"></script>
    <script src="<?= base_url(ASSET_JS."bootstrap.min.js"); ?>"></script>
    <script src="<?= base_url(ASSET_JS."jquery.validate.min.js"); ?>"></script>
    <script>
      $(window).load(function() {

        $("[id$=inputUsername]").focus();
        $("#img-loading").hide();
        $("#sign-in").show();

        $('form#formLogin').submit(function(){
          document.getElementById("btnID").disabled = true;
          $('#img-loading').show();
          $('#sign-in').hide();
        });

        $("#formLogin").validate({
          rules: {
            inputUsername: "required",
            inputPassword: "required",
            inputUsername: {
              required: true,
              maxlength: 10
            },
            inputPassword: {
              required: true,
              maxlength: 10
            }
          },
          messages: {

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
  </body>
</html>
