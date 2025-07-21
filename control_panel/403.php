<?php

    session_start();
    require_once '../vendor/autoload.php';

    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){

        include 'views/consultas.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>    
    <title>Error 403 | Panel de control</title>
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
            <div id="content">
                <div class="container-fluid mt-5">
                    <!-- Contenido error 404 -->
                    <div class="text-center pt-5">
                        <div class="error mx-auto" data-text="403">403</div>
                        <p class="lead text-gray-800 mb-5">Página no disponible</p>
                        <p class="text-gray-500 mb-0">Usted no tiene permiso para acceder al directorio solicitado....</p>
                        <a href="https://cocinas-aurora.herokuapp.com/control_panel/">&larr; Volver al inicio</a>
                    </div>
                    <!-- Fin de Contenido error 404 -->
                </div>
            </div>
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