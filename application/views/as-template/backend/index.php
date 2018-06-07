<?= doctype('html5'); ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $global_var['app_name']." ".$global_var['separator'] ?> Dasboard</title>
    <?php if($global_var['site_favicon'] != FALSE): ?>
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
    <?= link_tag(ASSET_PLUGIN.'sweetalert/sweetalert.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'datatables/dataTables.bootstrap.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'select2/select2.min.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'datepicker/datepicker3.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'daterangepicker/daterangepicker-bs3.css'); ?>
    <?= link_tag(ASSET_PLUGIN.'jQueryUI/jquery-ui.min.css'); ?>
    <script src="<?= site_url(ASSET_PLUGIN.'sweetalert/sweetalert.min.js'); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?= base_url(ASSET_JS.'html5shiv.min.js') ?>"></script>
        <script src="<?= base_url(ASSET_JS.'respond.min.js') ?>"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php
        //Header template
        if(!file_exists('application/views/as-template/backend/header.php')){
          show_404();
        }
        echo !empty($header) ? $header : '';
      ?>

      <?php
        //Left-menu template
        if(!file_exists('application/views/as-template/backend/left_menu.php')){
          show_404();
        }
        echo !empty($left_menu) ? $left_menu : '';
      ?>

      <?php
      //content
        echo !empty($content) ? $content : '';
      ?>

      <script>
        $(window).load(function(){
          $(document).on("click","a[id='logout']", function (e) {

            swal({
              title: "Are you sure?",
              text: "You will Log out",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, Log out!",
              cancelButtonText: "No, cancel plx!",
              closeOnConfirm: false,
              closeOnCancel: true
            },
            function(isConfirm){
              if (isConfirm) {
                swal("Success!", "Success logout", "success");
                window.location.href = '<?= site_url('dashboard/logout'); ?>';
              } else {
                  swal("Cancelled", "Your imaginary file is safe :)", "error");
              }
            });

          });

        });
      </script>

  </body>
</html>
