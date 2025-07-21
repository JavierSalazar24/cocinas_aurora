<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de notas */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->notas; 
        $consulta = $C_consulta->find();

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
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_panel.css">
    <link href="https://cocinas-aurora.herokuapp.com/control_panel/css/estilos_responsivo.css" rel="stylesheet">
    <title>Notas | Panel de control</title>

</head>

<body>

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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Notas & Calendario</h1>
                    </div>

                    <div class="row align-items-center justify-content-center">
                        <section class="col-lg-7 connectedSortable">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Notas rápidas</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
                                    <ul class="todo-list">
                                        <?php 
                                            foreach ($consulta as $nota) {
                                        ?>
                                        <li>
                                            <!-- drag handle -->
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>
                                            <?php
                                            if ($nota['estatus'] == "pendiente") {
                                            ?> 
                                                <p class="d-none" id="p_idNota"><?php echo $nota['_id']?></p>
                                                <input type="checkbox" onclick="editarEstatusNota('notas','<?php echo $nota['_id'] ?>')">
                                                <span id="s_Nota" class="text"><?php echo $nota['nota'] ?></span>
                                                <small class="badge badge-warning" style="color: white;"><i class="fa fa-clock-o"></i> 
                                                    <?php echo $nota['fecha'];?>
                                                </small>
                                                <div class="tools d-flex pt-1 pb-0">
                                                    <i class="fa fa-edit" data-toggle="modal" data-target="#EditarNotaModal<?php echo $nota['_id'] ?>"></i>
                                                    <i class="fa fa-trash-o" onclick="ConfirmarEliminacion('notas','<?php echo $nota['_id'] ?>')"></i>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <p class="d-none" id="p_idNota"><?php echo $nota['_id']?></p>
                                                <input type="checkbox" onclick="editarEstatusNota('notas','<?php echo $nota['_id'] ?>')" checked>
                                                <span class="text text-secondary"><s id="s_Nota"> <?php echo $nota['nota'] ?></s></span>
                                                <small class="badge badge-secondary"><i class="fa fa-clock-o"></i> 
                                                    <?php echo $nota['fecha'];?>
                                                </small>
                                                <div class="tools d-flex pt-1 pb-0">
                                                    <i class="fa fa-edit" data-toggle="modal" data-target="#EditarNotaModal<?php echo $nota['_id'] ?>"></i>
                                                    <i class="fa fa-trash-o" onclick="ConfirmarEliminacion('notas','<?php echo $nota['_id'] ?>')"></i>
                                                </div>
                                            <?php
                                            }
                                            ?>                                          
                                        </li>

                                        <!-- Modal editar nota -->
                                        <form id="editar" class="needs-validation" novalidate>
                                            <div class="modal fade" id="EditarNotaModal<?php echo $nota['_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-success">
                                                            <h5 class="modal-title text-white" id="exampleModalLabel">Editar Nota</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <div class="mb-3">
                                                                <label for="editar_nota" class="form-label">Nota:</label>
                                                                <textarea class="form-control" name="nota" id="nota_editar" required><?php echo $nota['nota'] ?></textarea>
                                                                <div class="valid-feedback">Correcto.</div>
                                                                <div class="invalid-feedback">Por favor ingresa un nota.</div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success" onclick="editarNota('notas', '<?php echo $nota['_id'] ?>')">Editar nota</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                            }
                                        ?>  
                                    </ul>
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer clearfix no-border">
                                    <button type="button" class="btn btn-dark pull-right" data-toggle="modal" data-target="#NotaModal">
                                        <i class="fa fa-plus"></i> Agregar nota
                                    </button>
                                </div>
                            </div>
                        </section>
                        
                        <section class=" col-lg-5 connectedSortable">
                            <div class="box box-solid bg-green-gradient">
                                <div class="box-header bg-warning">
                                    <i class="fa fa-calendar"></i>

                                    <h3 class="box-title">Calendario</h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                    <!-- button with a dropdown -->                        
                                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-widget="remove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <div class="box-body no-padding bg-warning">
                                <div id="calendar" style="width: 100%"></div>
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
                            <label for="agregar_nota" class="form-label">Nota:</label>
                            <textarea class="form-control" name="nota" id="agregar_nota" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nota.</div>
                            <input type="hidden" name="estatus" value="pendiente">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" onclick="agregarNota('notas')" class="btn btn-primary">Guardar nota</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>    

    <!-- Validación de los formularios -->
	<script src="../js/validacion_formulario.js"></script>
    <!-- Estilos Script-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <!-- SweetAlert CDN -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Agregar nota -->
    <script type="text/javascript" src="js/agregar_editar.js"></script>
    <!-- Eliminar nota -->
    <script type="text/javascript" src="js/eliminar.js"></script>
    <?php include "views/script_calendario.php"?>
    <!-- LINK ACTIVE -->
    <script src="js/active.js"></script>
</body>

</html>

<?php
    }else{
        header("Location: https://cocinas-aurora.herokuapp.com/");
    }
?>