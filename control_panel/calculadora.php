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
    <title>Calculadora | Panel de control</title>
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
                    <section class="col-10 connectedSortable">
                        <div class="content-body">
                            <div class="content-calculator">
                                <div class="screen">
                                    <input type="text" placeholder="0" disabled id="screen-result">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="7" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="8" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="9" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="+" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="4" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="5" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="6" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="-" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="1" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="2" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="3" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="*" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="0" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius">
                                    <input type="button" value="/" onclick="getData(this)">
                                </div>
                                <div class="btn-cal btn-cal-radius btn-clean">
                                    <input type="button" value="C" class="clean" onclick="clean()">
                                </div>
                                <div class="btn-cal btn-cal-radius btn-equal">
                                    <input type="button" value="=" class="equal" onclick="calculate()">
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

    <!-- Estilos Script -->
    <?php include "views/script_AdminLTE.php"?>
    <script src="js/sb-admin-2.min.js"></script>
    <!-- LINK ACTIVE -->
    <script src="js/active.js"></script>
    <!-- Calculadora -->
    <script src="js/calculadora.js"></script>
</body>

</html>

<?php
    }else{
        header('Location: https://cocinas-aurora.herokuapp.com/');
    }
?>

