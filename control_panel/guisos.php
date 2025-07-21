<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de guisos */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guisos; 
        $consulta = $C_consulta->find();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Guisos | Panel de control</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Guisos</h1>

                    <!-- Tabla Guisos -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de guisos</h6>
                        </div>
                        <div class="card-body" class="justify-content-center">
                            <div class="table-responsive">
                                <form id="formulario">
                                    <table class="table table-bordered" id="alimentos" width="100%" cellspacing="0">                            
                                        <thead class="text-dark">
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Día</th>
                                            <th>Descripción</th>
                                            <th>Precio 1/4</th>
                                            <th>Precio 1/2</th>
                                            <th>Precio Litro</th>
                                            <th>Imagen</th>
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
                                                foreach($consulta as $guisos){
                                            ?>
                                            <tr role="row">
                                                <td><span id="comida_tdID"><?php echo $guisos['_id']; ?></span></td>
                                                <td><span id="comida_tdNombre"><?php echo $guisos['nombre']; ?></span></td>
                                                <td><span id="comida_tdDia"><?php echo $guisos['dia']; ?></span></td>
                                                <td><span id="comida_tdDesc"><?php echo $guisos["descripcion"]; ?></span></td>
                                                <td><span id="comida_tdPrecioCuarto"><?php echo $guisos["precio_cuarto"]; ?></td>
                                                <td><span id="comida_tdPrecioMedio"><?php echo $guisos["precio_medio"]; ?></td>
                                                <td><span id="comida_tdPrecioLitro"><?php echo $guisos["precio_litro"]; ?></td>
                                                <td><img id="alimentoIMG" height="60rem" src="../img_alimentos/<?php echo $guisos['imagen']?>"></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td class="text-white">
                                                        <a id="btn_editarAlimento" class="btn btn-success a_panel" data-toggle="modal" data-target="#GuisoModalE"><i class="fas fa-pencil-alt" style="color: white !important;"></i></a>
                                                        <a class="btn btn-danger a_panel" onclick="ConfirmarEliminacion('guisos', '<?php echo $guisos['_id']?>')"><i class="fas fa-trash" style="color: white !important;"></i></a>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" name="eliminar-mult[]" value="<?php echo $guisos['_id']?>">
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#GuisoModal" id="alimento_agregar"><i class="fas fa-plus"></i> Agregar nuevo guiso</button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-5 text-center">
                                                <button class="btn btn-danger" type="submit" onclick="EliminacionMult('guisos')"><i class="fas fa-minus-circle"></i> Eliminar registros seleccionados</button>
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

    <!-- Modal Agregar guiso-->
    <form id="agregar" class="needs-validation" novalidate>
        <div class="modal fade" id="GuisoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar guiso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="imgPrev_agregar" class="form-label">Imagen</label>
                            <div class="img_prev">
                                <img src="" id="imgPrev_agregar"/>
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="file" id="archivo_agregar" name="imagen">
                        </div>
                        <div class="mb-3">
                            <label for="nombre_agregar" class="form-label">Nombre del platillo</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="nombre" required id="nombre_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="dia_semana_agregar" class="form-label">Selecciona el día de la semana</label>
                            <select name="dia_semana" required id="dia_semana_agregar" class="custom-select mb-3">
                                <option value="Lunes" selected>Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miercoles">Miercoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona un día de la semana.</div>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_agregar" class="form-label">Escribe una descripción</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="descripcion" required id="descripcion_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe una descripción.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioCuarto_agregar" class="form-label">Precio del 1/4</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioCuarto" required id="precioCuarto_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el cuarto.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioMedio_agregar" class="form-label">Precio del 1/2</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioMedio" required id="precioMedio_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el medio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioLitro_agregar" class="form-label">Precio del litro</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioLitro" required id="precioLitro_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el litro.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="agregarAlimento('guisos')">Agregar guiso</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Editar guiso-->
    <form id="editar" class="needs-validation" novalidate>
        <div class="modal fade" id="GuisoModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar guiso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="imgPrev_editar" class="form-label">Imagen</label>
                            <div class="img_prev">
                                <img src="" id="imgPrev_editar" />
                            </div>
                        </div>
                        <div class="mb-4">
                            <input type="file" id="archivo_editar" name="imagen">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id" required id="id_editar" readonly>
                            <label for="nombre_editar" class="form-label">Nombre del platillo</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="nombre" required id="nombre_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="dia_semana_editar" class="form-label">Selecciona el día de la semana</label>
                            <select name="dia_semana" required id="dia_semana_editar" class="custom-select mb-3">
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
                            <label for="descripcion_editar" class="form-label">Escribe una descripción</label>
                            <input class="form-control" type="text" name="descripcion" required id="descripcion_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe una descripción.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioCuarto_editar" class="form-label">Precio 1/4</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioCuarto" required id="precioCuarto_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el cuarto.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioMedio_editar" class="form-label">Precio 1/2</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioMedio" required id="precioMedio_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el medio.</div>
                        </div>
                        <div class="mb-3">
                            <label for="precioLitro_editar" class="form-label">Precio Litro</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precioLitro" required id="precioLitro_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe un precio para el litro.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="editarAlimento('guisos')">Editar guiso</button>
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