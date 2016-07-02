<?php
  session_start();

  $base_url='http://localhost:8888/';
 
  /*** error reporting on ***/
  error_reporting(E_ALL);

  /*** define the site path ***/
  $site_path = realpath(dirname(__FILE__));
  define ('__SITE_PATH', $site_path);

  /*** include the init.php file ***/
  include 'includes/init.php';

  /*** load the router ***/
  $registry->router = new router($registry);

  /*** set the controller path ***/
  $registry->router->setPath (__SITE_PATH . '/controller');

  /*** load up the template ***/
  $registry->template = new template($registry);

  $agenteLogueado = $_SESSION ? $_SESSION['agente'] : null;

  if (isset($_GET['ajax']) || isset($_POST['ajax'])){
    header('Content-type: application/json');
    $registry->router->loader();
    die;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mesa de ayuda</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="<?php echo $base_url; ?>public/css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/" class="navbar-brand"><b>Mesa</b> de ayuda</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Inicio</a></li>
            <?php if ($agenteLogueado['admin'] == 1){ ?>
            <li><a href="/agente">Agentes</a></li>
            <li><a href="/consulta">Consultas</a></li>
            <li><a href="/formulario">Formularios</a></li>
            <?php } ?>
          </ul>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <?php if ($agenteLogueado){ ?>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown"><?php echo $agenteLogueado['nombre'] ?> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="/agente/perfil">Perfil</a></li>
              <li><a href="#">Cambiar a "No Disponible"</a></li>
              <li class="divider"></li>
              <li><a href="/login/salir">Cerrar Sesion</a></li>
            </ul>
          </li>
          <?php }else{ ?>
            <li><a href="/login">Iniciar Sesi&oacute;n</a></li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">

      <!-- Main content -->
      <section class="content"> 
        
        <?php $registry->router->loader(); ?>

      </section>
      <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
  </div>
  
  <footer class="main-footer">
    <div class="container">

    </div> 
    <!-- /.container -->
  </footer>

</div>
<!-- ./wrapper -->
<!-- jQuery 2.2.0 -->
<script src="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/plugins/jQuery/jquery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $base_url; ?>vendor/almasaeed2010/adminlte/dist/js/app.min.js"></script>

</body>
</html>

