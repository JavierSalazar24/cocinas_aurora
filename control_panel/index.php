<?php

    session_start();
    require_once '../vendor/autoload.php';

    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){

        date_default_timezone_set('America/Mexico_City');
        setlocale(LC_ALL, '');
        $dia=date('d');
        $mes = date('n');
        $anio=date('Y');
        /* Meses */
        $meses = array(
            1 => "enero",
            2 => "febrero",
            3 => "marzo",
            4 => "abril",
            5 => "mayo",
            6 => "junio",
            7 => "julio",
            8 => "agosto",
            9 => "septiembre",
            10 => "octubre",
            11 => "noviembre",
            12 => "diciembre",
        );
    
        $fecha=$dia . ' de ' . $meses[$mes] . ' del ' . $anio;

        if (isset($_SESSION['admin'])) {
            $correo = $_SESSION['admin'];
        } else if (isset($_SESSION['estandar'])){
            $correo = $_SESSION['estandar'];
        }

        /* Contar consultas */
        $consulta_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
        $consulta_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
        $consulta_guisos = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guisos; 
        $consulta_sopas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->sopas; 
        $consulta_guarniciones = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guarniciones; 
        $consulta_antojitos = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->antojitos; 
        $consulta_postres = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->postres; 
        $consulta_ventas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->ventas; 
        $consulta_mensajes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->mensajes; 
        $consulta_horarios = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->horarios; 

        $numAd = $consulta_admins -> count();
        $numCl = $consulta_clientes -> count();
        $numGui = $consulta_guisos -> count();
        $numSo = $consulta_sopas -> count();
        $numGua = $consulta_guarniciones -> count();
        $numAn = $consulta_antojitos -> count();
        $numPo = $consulta_postres -> count();
        $numVe = $consulta_ventas -> count();
        $numMe = $consulta_mensajes -> count();
        $numHo = $consulta_horarios -> count();

        /* consulta notas */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->notas; 
        $consulta_notas = $C_consulta->find();

        if(isset($_SESSION["admin"]) || isset($_SESSION['estandar'])){        
            /* consulta de admin */
            $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
            $info = $C_admins->findOne(['correo' => $correo]);
            $nombres = $info['nombres'];
            $apellidos = $info['apellidos'];
        }
        

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Estilos de la barra de direcciones en movil-->
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
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_panel.css" rel="stylesheet">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_responsivo.css" rel="stylesheet">
    <title>Panel de control | Cocinas Aurora</title>
</head>

<body id="page-top" class="hold-transition sidebar-mini">

    <!-- Page Wrapper -->
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
            <?php include_once "views/contenido.php" ?>
            <!-- Fin Contenido central -->

            <!-- Footer -->
            <?php include_once "views/footer.php" ?>
            <!-- Fin de Footer -->
        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal agregar nota -->
    <form id="agregar" class="needs-validation" novalidate>
        <div class="modal fade" id="NotaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Agregar nota</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                            <label for="nota" class="form-label">Nota:</label>
                            <textarea class="form-control" name="nota" id="nota" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                            <input type="hidden" name="estatus" value="pendiente">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="agregarNota('notasI')" class="btn btn-primary">Guardar nota</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Validación de los formularios -->
	<script src="../js/validacion_formulario.js"></script>
    <!-- Estilos Script -->
    <?php include "views/script_calendario.php"?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- SweetAlert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Agregar -->
    <script type="text/javascript" src="js/agregar_editar.js"></script>
    <!-- Eliminar -->
    <script type="text/javascript" src="js/eliminar.js"></script>
    <!-- LINK ACTIVE -->
    <script src="js/active.js"></script>    

</body>

</html>

<?php

    }else{
        header('Location: https://cocinas-aurora.herokuapp.com/');
    }

?>