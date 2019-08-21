<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>

  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">

</head>

<body class="skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="/admin" class="navbar-brand"><b>Admin</b>CENA</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <?php if ($this->userInfo['user']->hasPermission('user_view')) : ?>
              <li class="active"><a href="<?php echo BASE_URL; ?>usuario">Usuarios <span class="sr-only">(current)</span></a></li>
              <?php endif; ?>



            </ul>

          </div>

          <?php if ($this->userInfo['user']->usr_info() != 'cliente') : ?>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-success notificacao-mensagem "></span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header notificacao-mensagem-header"></li>
                  <li>
                    <ul class="menu">
                      <?php
                        foreach ($this->userInfo['notificacao'] as $not) :
                          $propriedades = json_decode($not['propriedades']);


                          ?>
                      <li>
                        <a href="#">
                          <h4>
                            <?php echo $not['notificacao_tipo']; ?>
                            <small><i class="fa fa-clock-o"></i> 2 mins</small>
                          </h4>
                          <p><?php echo $propriedades->msg; ?></p>
                        </a>
                      </li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">Ver todas</a></li>
                </ul>
              </li>
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-warning">1</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">1 notificação</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> obra faltando documento
                        </a>
                      </li>

                    </ul>
                  </li>
                  <li class="footer"><a href="#">Ver todas</a></li>
                </ul>
              </li>
              <li class="dropdown tasks-menu">


              </li>

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="/admin/login/logout">
                  <!-- The user image in the navbar-->
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"> <?php echo ucfirst($this->userInfo['userName']['login']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                    <p>
                      <?php echo $this->userInfo['userName']['login']; ?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo BASE_URL; ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>
          <?php else : ?>

                          

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="/admin/login/logout">
                  <!-- The user image in the navbar-->
                  <!-- <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"> <?php echo ucfirst($this->userInfo['userName']['login']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <!-- <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

                    <p>
                      <?php echo $this->userInfo['userName']['login']; ?>
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                      <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                      </div>
                      <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                      </div>
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo BASE_URL; ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </div>


          <?php endif; ?>
        </div>
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 style="text-align: center;">

            <?php echo ucfirst($viewData['pageController']) ?>

          </h1>
        </section>

        <!-- Main content -->
        <section class="content">

          <?php if (isset($_SESSION['alert'])) : ?>
          <div class="goaway" id="goaway">
            <div class="center">
              <div class="alert alert-<?php echo $_SESSION['alert']['tipo']; ?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $_SESSION['alert']['mensagem']; ?>
              </div>
            </div>
          </div>
          <?php unset($_SESSION['alert']); ?>

          <?php endif; ?>
          <?php $this->loadViewInTemplate($viewName, $viewData); ?>
        </section>
      </div>
    </div>

    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.0.1
        </div>
        <strong></strong> All rights reserved.
      </div>
    </footer>
  </div>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        $("#goaway").fadeOut().empty();
      }, 2000);
    }, false);


    function verificarNotificacao() {

      $.ajax({
        url: 'ajax/verificarMensagem',
        type: 'POST',
        dataType: 'json',
        success: function(json) {
          console.log(json[7]);

          if (json[7] > 0) {
            $('.notificacao-mensagem').html(json[7]);
            $('.notificacao-mensagem-header').html('Você tem ' + json[7] + ' Notificações Pendente');
            $('.notificacao-mensagem').addClass('fa-blink');
          } else {
            $('.notificacao-mensagem').html('0');
            $('.notificacao-mensagem-header').html('Você não tem nenhuma notificação');
            $('.notificacao-mensagem').removeClass('fa-blink');
          }

        }
      });

    }

    $(function() {
      setInterval(verificarNotificacao, 20000);
      //verificarNotificacao();

      $('.notificacoes').on('click', function() {

      });

      $('.addNotif').on('click', function() {
        $.ajax({
          url: 'add.php'
        });
      });
    });
  </script>



  <script src="<?php echo BASE_URL; ?>node_modules/sweetalert/dist/sweetalert.min.js"></script>

  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/timepicker/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/plugins/iCheck/icheck.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/js/demo.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/bower_components/moment/min/moment.min.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/js/script.js"></script>
  <script src="<?php echo BASE_URL; ?>assets/css/AdminLTE-2.4.5/dist/js/pages/dashboard.js"></script>
  <script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>'
  </script>

  <?php if (isset($_SESSION['form'])) : ?>
  <script type="text/javascript">
    var title = '<?php echo $_SESSION['form']['success']; ?>';
    var text = '<?php echo $_SESSION['form']['mensagem']; ?>';
    var icon = '<?php echo $_SESSION['form']['type']; ?>';
    var pageController = '<?php echo $viewData['pageController']; ?>';

    swal({
        title: title,
        text: text,
        icon: icon,
        buttons: 'OK',
      })
      .then((value) => {

        <?php unset($_SESSION['form']); ?>
        /*window.location.href = BASE_URL+pageController;*/
      });
  </script>

  <?php endif; ?>




</body>

</html>