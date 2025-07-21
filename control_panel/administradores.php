<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de admins */
        $C_consulta = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
        $consulta = $C_consulta->find();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Administradores | Panel de control</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Administradores</h1>

                    <!-- Tabla Administradores -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de administradores</h6>
                        </div>
                        <div class="card-body" class="justify-content-center">
                            <div class="table-responsive">
                                <form id="formulario">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                        <thead class="text-dark">
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Tipo de admin</th>
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
                                                foreach($consulta as $admin){
                                            ?>
                                            <tr role="row">
                                                <td><span id="admin_tdNombres"><?php echo $admin['nombres']; ?></span></td>
                                                <td><span id="admin_tdApellidos"><?php echo $admin['apellidos']; ?></span></td>
                                                <td><span id="admin_tdCorreo"><?php echo $admin["correo"]; ?></span></td>
                                                <td><span id="admin_tdTipoAdmin"><?php if($admin["tipo_admin"] == 1) { echo 'root'; }else{ echo 'estandar'; } ?></span></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td class="text-white">
                                                        <a id="btn_editarAdmin" class="btn btn-success a_panel" data-toggle="modal" data-target="#AdminModalE"><i class="fas fa-pencil-alt" style="color: white !important;"></i></a>
                                                        <a class="btn btn-danger a_panel" onclick="ConfirmarEliminacion('administradores','<?php echo $admin['_id']?>')"><i class="fas fa-trash" style="color: white !important;"></i></a>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" name="eliminar-mult[]" value="<?php echo $admin['_id']?>">
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
                                            <div class="col-12 col-md-6 mb-2 text-center">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AdminModal"><i class="fas fa-user-plus"></i> Agregar un nuevo administrador</button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-5 text-center">
                                                <button class="btn btn-danger" type="submit" onclick="EliminacionMult('administradores')"><i class="fas fa-user-times"></i> Eliminar registros seleccionados</button>
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

    <!-- Modal Agregar admin-->
    <form id="agregar" class="needs-validation" novalidate>
        <div class="modal fade" id="AdminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombres_agregar" class="form-label">Nombre</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="nombres" required id="nombres_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos_agregar" class="form-label">Apellidos</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="apellidos" required id="apellidos_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa al menos un apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="correo_agregar" class="form-label">Correo electrónico</label>
                            <input class="form-control" autocapitalize="off" type="email" name="correo" required id="correo_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un email.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password_agregar" class="form-label">Contraseña</label>
                            <input class="form-control" type="password" autocapitalize="off" name="password" required id="password_agregar" minlength="8">
                            <small class="form-text text-muted">Minimo 8 carácteres.</small>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa una contraseña.</div>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_admin_agregar" class="form-label">Tipo de admin</label>
                            <select name="tipo_admin" required id="tipo_admin_agregar" class="custom-select mb-3">
                                <option value="1" selected>root</option>
                                <option value="2">estandar</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un tipo de usuario.</div>
                        </div>                                                                
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="agregarAdmin('administradores')">Agregar administrador</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Editar admin-->
    <form id="editar" class="needs-validation" novalidate>
        <div class="modal fade" id="AdminModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombres_editar" class="form-label">Nombre(s)</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="nombres" required id="nombres_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos_editar" class="form-label">Apellido(s)</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="apellidos" required id="apellidos_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa al menos un apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="correo_editar" class="form-label">Correo electrónico</label>
                            <input class="form-control" type="email" name="correo" required id="correo_editar" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_admin_editar" class="form-label">Tipo de admin</label>
                            <select name="tipo_admin" required id="tipo_admin_editar" class="custom-select">
                                <option value="1">root</option>
                                <option value="2">estandar</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un tipo de usuario.</div>
                        </div>                                                                
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="editarAdmin('administradores')">Guardar cambios</button>
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