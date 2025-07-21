<?php

  /* Crear una sesion */
  session_start();
  require_once '../vendor/autoload.php';

  $_SESSION['admin'] = "javieralejandrosalazartorres@gmail.com";

  if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
    include_once 'views/consultas.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Chrome, Firefox OS y Opera -->
    <meta name="theme-color" content="#f6a414"/>
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#f6a414"/>
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="https://cocinas-aurora.herokuapp.com/images/favicon.png" type="image/x-icon">
    <!-- Estilos -->
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/bootstrap/dist/css/bootstrap_copy.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/AdminLTE_copy.min.css" rel="stylesheet">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_responsivo.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_panel.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Enviar Correo | Panel de control</title>
</head>

<body>

    <div id="wrapper">

          <!-- Barra lateral -->
          <?php include_once "views/navBar_lateral.php"?>
          <!-- Fin Barra lateral -->

          <!-- Contenido completo -->
          <div id="content-wrapper" class="d-flex flex-column">

            <!-- Barra sueperior -->
            <?php include_once "views/navBar_superior.php"?>
            <!-- Fin de Barra sueperior -->

            <!-- Contenido central -->
            <div id="content">
              <div class="container-fluid">
                  <!-- Page Heading -->
                  <div class="d-sm-flex align-items-center justify-content-center mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Correo</h1>
                  </div>

                  <div class="row justify-content-center">
                    <section class="col-10 connectedSortable">
                      <div class="box box-info">
                        <div class="box-header">
                          <i class="fa fa-envelope"></i>

                          <h3 class="box-title">Enviar Email</h3>
                          <div class="pull-right box-tools">
                            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                              title="Remove">
                              <i class="fa fa-times"></i></button>
                          </div>
                        </div>
                        <form id="agregar">
                          <div class="box-body">
                            <div class="mb-2">
                              <label for="email">Destino:</label>
                              <input class="form-control" type="email" name="email" id="email">
                            </div>
                            <div>
                              <textarea class="textarea" placeholder="Escribe tu mensaje..." name="mensaje_correo"
                                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                            </div>
                          </div>
                          <div class="box-footer clearfix">
                            <button type="submit" onclick="enviarCorreo('correo')" class="pull-right btn btn-dark" id="sendEmail">
                              Enviar <i class="fa fa-arrow-circle-right"></i>
                            </button>
                          </div>
                        </form>
                      </div>
                    </section>
                  </div>
              </div>
            </div>
            <!-- Fin Contenido central -->

            <!-- Footer -->
            <?php include_once "views/footer.php" ?>
            <!-- Fin de Footer -->

          </div>
    </div>

  <!-- Estilos Script -->
  <?php include "views/script_AdminLTE.php"?>
  <script src="js/sb-admin-2.min.js"></script>
  <!-- SweetAlert CDN -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- Enviar correo -->
  <script src="js/agregar_editar.js"></script>
  <!-- LINK ACTIVE -->
  <script src="js/active.js"></script>
</body>

</html>

<?php
  }else{
    header('Location: https://cocinas-aurora.herokuapp.com/');
  }
?>

