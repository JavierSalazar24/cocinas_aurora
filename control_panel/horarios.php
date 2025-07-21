<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de horarios */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->horarios; 
        $consulta = $C_consulta->find();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Horarios | Panel de control</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Horarios</h1>

                    <!-- Tabla Horarios -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de horarios</h6>
                        </div>
                        <div class="card-body" class="justify-content-center">
                            <div class="table-responsive">
                                <form id="formulario">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                        <thead class="text-dark">
                                            <th>ID</th>
                                            <th>Día</th>
                                            <th>Horario de apertura</th>
                                            <th>Horario de cierre</th>
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
                                                foreach($consulta as $horarios){
                                            ?>
                                            <tr role="row">
                                                <td><span id="horario_tdID"><?php echo $horarios['_id']; ?></span></td>
                                                <td><span id="horario_tdDia"><?php echo $horarios['dia']; ?></span></td>
                                                <td><span id="horario_tdHorarioApertura"><?php 
                                                        $hrsA = new DateTime($horarios['horario_apertura']);
                                                        echo $hrsA->format('h:ia');
                                                ?></span></td>
                                                <td><span id="horario_tdHorarioCierre"><?php 
                                                        $hrsC = new DateTime($horarios['horario_cierre']);
                                                        echo $hrsC->format('h:ia');
                                                ?></span></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td class="text-white">
                                                        <a id="btn_editarHorario" class="btn btn-success a_panel" data-toggle="modal" data-target="#HorariosModalE"><i class="fas fa-pencil-alt" style="color: white !important;"></i></a>
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

    <!-- Modal Editar horario -->
    <form id="editar" class="needs-validation" novalidate>
        <div class="modal fade" id="HorariosModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar horario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id" required id="id_editar" readonly>
                            <label for="dia_editar" class="form-label">Selecciona el día de la semana</label>
                            <select name="dia" required id="dia_editar" class="custom-select mb-3">
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona un día de la semana.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="apertura_editar" class="form-label">Escribe el horario de apertura</label>
                            <input class="form-control" type="time" name="apertura" required id="apertura_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un horario de apertura.</div>
                        </div>
                        <div class="mb-3">
                            <label for="cierre_editar" class="form-label">Escribe el horario de cierre</label>
                            <input class="form-control" type="time" name="cierre" required id="cierre_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un horario de cierre.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="editarHorario('horarios')">Editar horario</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Validación de los formularios -->
	<script src="../js/validacion_formulario.js"></script>
    <?php include_once 'views/script_tablas.php' ?>

</body>

</html>

<?php
    }else{
        header('Location: https://cocinas-aurora.herokuapp.com/');
    }
?>    