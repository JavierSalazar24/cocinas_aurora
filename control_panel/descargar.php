<?php

  /* Crear una sesion */
  session_start();
  require_once '../vendor/autoload.php';


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
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos.css">
    <title>Descargar App | Panel de control</title>
    <style>
        @media screen and (max-width: 800px){.IOSQR, .androidQR{display: none;}}
    </style>
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
                  <div class="row justify-content-center">
                    <section class="col-12 col-md-6 connectedSortable">
                        <div class="content-body">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header">Descargar app en Android</div>
                                <img class="card-img-top" src="img/android.png" alt="Imagen de descargar app para la plataforma Android">
                                <div class="card-body">
                                    <p class="card-title">Desde tu celular puedes descargar el panel de control para Android</p>
                                    <p class="card-text"><a href="app/cocinas_aurora_app_panel.apk" download="cocinas_aurora_app_panel.apk" class="text-white"><i class="fab fa-android"></i> click aquí</a></p>
                                    <button type="button" class="btn btn-warning text-white androidQR" data-toggle="modal" data-target="#AndroidModal"><i class="fal fa-qrcode"></i> Escanear app para Android</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="col-12 col-md-6 connectedSortable">
                        <div class="content-body">
                            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                                <div class="card-header">Descargar app en IOS</div>
                                <img class="card-img-top" src="img/ios.png" alt="Imagen de descargar app para la plataforma IOS">
                                <div class="card-body">
                                    <p class="card-title">Desde tu celular puedes descargar el panel de control para IOS</p>
                                    <p class="card-text"class="descargarIOS"><a href="app/cocinas_aurora_app_panel.ipa" download="cocinas_aurora_app_panel.ipa" class="text-white"><i class="fab fa-apple"></i> click aquí</a></p>
                                    <button type="button" class="btn btn-warning text-white IOSQR" data-toggle="modal" data-target="#IOSModal"><i class="fal fa-qrcode"></i> Escanear app para IOS</button>
                                </div>
                            </div>
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

    <div class="modal fade" id="AndroidModal" aria-hidden="true" aria-labelledby="QRAndrodidLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QRAndrodidLabel">Escanear QR para descargar panel de control en Android</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img loading="lazy" src="app/qr_appAndroid.png" alt="Imágen de Android para descargar" class="img-responsive" style="width: 100%; height: 100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    

    <div class="modal fade" id="IOSModal" aria-hidden="true" aria-labelledby="QRIOSLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="QRIOSLabel">Escanear QR para descargar panel de control en IOS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img loading="lazy" src="app/qr_appAndroid.png" alt="Imágen de Android para descargar" class="img-responsive" style="width: 100%; height: 100%">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos Script -->
    <?php include "views/script_AdminLTE.php"?>
    <script src="js/sb-admin-2.min.js"></script>
    <!-- LINK ACTIVE -->
    <script src="js/active.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>

<?php
    }else{
        header('Location: https://cocinas-aurora.herokuapp.com/');
    }
?>

