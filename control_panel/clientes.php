<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de clientes */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
        $consulta = $C_consulta->find();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Clientes | Panel de control</title>
</head>

<body id="page-top">

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
                <div class="container-fluid">

                    <!-- Titulo -->
                    <h1 class="h3 mb-2 text-gray-800">Clientes</h1>

                    <!-- Tabla Administradores -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de clientes</h6>
                        </div>
                        <div class="card-body" class="justify-content-center">
                            <div class="table-responsive">
                                <form id="formulario">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                        <thead class="text-dark">
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <?php
                                                if(isset($_SESSION['admin'])){
                                            ?>
                                                <th>Acciones</th>
                                            <?php
                                                }
                                            ?>
                                        </thead>
                                    
                                        <tbody class="text-dark">
                                            <?php
                                                foreach($consulta as $cliente){
                                            ?>
                                            <tr role="row">
                                                <td><?php echo $cliente['nombres']; ?></td>
                                                <td><?php echo $cliente['apellidos']; ?></td>
                                                <td><?php echo $cliente["correo"]; ?></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td>
                                                        <a class="btn btn-danger a_panel" onclick="ConfirmarEliminacion('clientes','<?php echo $cliente['_id']?>')"><i class="fas fa-trash text-white"></i></a>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" name="eliminar-mult[]" value="<?php echo $cliente['_id']?>">
                                                        </div>
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>                                    
                                    </table>
                                    <?php
                                        if(isset($_SESSION['admin'])){
                                    ?>
                                        <div class="row mt-5">                                        
                                            <div class="col-12 mb-5 text-center">
                                                <button class="btn btn-danger" type="submit" onclick="EliminacionMult('clientes')"><i class="fas fa-user-times"></i> Eliminar registros seleccionados</button>
                                            </div>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            <!-- Fin Contenido central -->

            <!-- Footer -->
                <?php include_once "views/footer.php" ?>
            <!-- Fin de Footer -->
        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include_once 'views/script_tablas.php' ?>

</body>

</html>

<?php
    }else{
        header('Location: https://cocinas-aurora.herokuapp.com/');
    }
?>