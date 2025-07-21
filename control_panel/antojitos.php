<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';

    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){  
        
        include_once 'views/consultas.php';

        /* consulta de antojitos */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->antojitos; 
        $consulta = $C_consulta->find();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Antojitos | Panel de control</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Antojitos</h1>

                    <!-- Tabla Antojitos -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de antojitos</h6>
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
                                            <th>Precio orden/pieza</th>
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
                                                foreach($consulta as $antojitos){
                                            ?>
                                            <tr role="row">
                                                <td><span id="comida_tdID"><?php echo $antojitos['_id']; ?></span></td>
                                                <td><span id="comida_tdNombre"><?php echo $antojitos['nombre']; ?></span></td>
                                                <td><span id="comida_tdDia"><?php echo $antojitos['dia']; ?></span></td>
                                                <td><span id="comida_tdDesc"><?php echo $antojitos["descripcion"]; ?></span></td>
                                                <td><span id="comida_tdPrecio">$<?php echo $antojitos["precio"]; ?> <?php echo $antojitos["pieza_orden"]; ?></span></td>
                                                <td><img id="alimentoIMG" height="60rem" src="../img_alimentos/<?php echo $antojitos['imagen']?>"></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td class="text-white">
                                                        <a id="btn_editarAntojito" class="btn btn-success a_panel" data-toggle="modal" data-target="#AntojitosModalE"><i class="fas fa-pencil-alt" style="color: white !important;"></i></a>
                                                        <a class="btn btn-danger a_panel" onclick="ConfirmarEliminacion('antojitos', '<?php echo $antojitos['_id']?>')"><i class="fas fa-trash" style="color: white !important;"></i></a>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" name="eliminar-mult[]" value="<?php echo $antojitos['_id']?>">
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AntojitosModal" id="alimento_agregar"><i class="fas fa-plus"></i> Agregar nuevo antojito</button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-5 text-center">
                                                <button class="btn btn-danger" type="submit" onclick="EliminacionMult('antojitos')"><i class="fas fa-minus-circle"></i> Eliminar registros seleccionados</button>
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

    <!-- Modal Agregar antojitos-->
    <form id="agregar" class="needs-validation" novalidate>
        <div class="modal fade" id="AntojitosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar antojitos</h5>
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
                            <select name="dia_semana" required id="dia_semana_agregar" class="custom-select">
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
                            <input class="form-control" type="text" name="descripcion" required id="descripcion_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe una descripción.</div>
                        </div>
                        <div class="mb-3 div_precioPieza_agregar">
                            <label for="precioOrden_agregar" class="form-label">Precio</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precio" required id="precioOrden_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un precio.</div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pieza_orden" id="ordenText_agregar" value="c/ orden" checked>
                            <label class="form-check-label" for="ordenText_agregar">cada orden</label>
                        </div>
                        <div class="form-check form-check-inline mb-5">
                            <input class="form-check-input" type="radio" name="pieza_orden" id="piezaText_agregar" value="c/ pieza">
                            <label class="form-check-label" for="piezaText_agregar">cada pieza</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="agregarAlimento('antojitos')">Agregar antojitos</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Editar antojitos-->
    <form id="editar" class="needs-validation" novalidate>
        <div class="modal fade" id="AntojitosModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar antojitos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="imgPrev_editar" class="form-label">Imagen</label>
                            <div class="img_prev">
                                <img src="" id="imgPrev_editar"/>
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
                            <select name="dia_semana" required id="dia_semana_editar" class="custom-select">
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
                        <div class="mb-3 div_precioPieza_editar">
                            <label for="precioOrden_editar" class="form-label">Precio</label>
                            <input class="form-control" pattern="[0-9.]+" type="tel" name="precio" required id="precioPiezaOrden_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor introduce un precio.</div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="pieza_orden" id="ordenText_editar" value="c/ orden">
                            <label class="form-check-label" for="ordenText_editar">cada orden</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input class="form-check-input" type="radio" name="pieza_orden" id="piezaText_editar" value="c/ pieza">
                            <label class="form-check-label" for="piezaText_editar">cada pieza</label>
                        </div>                        
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="editarAlimento('antojitos')">Editar antojitos</button>
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