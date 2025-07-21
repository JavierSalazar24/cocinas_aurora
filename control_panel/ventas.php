<?php

    /* Crear una sesion */
    session_start();
    require_once '../vendor/autoload.php';

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, '');
    $d = date('w');


    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
        
        include_once 'views/consultas.php';

        /* consulta de ventas */
        $C_consulta= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->ventas; 
        $consulta = $C_consulta->find();

        $dias = array(
            1 => "Lunes",
            2 => "Martes",
            3 => "Miercoles",
            4 => "Jueves",
            5 => "Viernes",
        );

        $platillos = array();

        $C_antojitos= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->antojitos; 
        $consultaAn =  $C_antojitos->find();

        $C_guisos= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guisos; 
        $consultaGui = $C_guisos->find();

        $C_guarniciones= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guarniciones; 
        $consultaGua = $C_guarniciones->find();

        $C_postres= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->postres; 
        $consultaPo =  $C_postres->find();

        $C_sopas= (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->sopas; 
        $consultaSo =  $C_sopas->find();

        foreach($consultaAn as $antojitos){
            $platillos[] = $antojitos['nombre'];
        }
        foreach($consultaGui as $guisos){
            $platillos[] = $guisos['nombre'];
        }
        foreach($consultaGua as $guarniciones){
            $platillos[] = $guarniciones['nombre'];
        }
        foreach($consultaPo as $postres){
            $platillos[] = $postres['nombre'];
        }
        foreach($consultaSo as $sopas){
            $platillos[] = $sopas['nombre'];
        }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once 'views/estilos_tablas.php'; ?>
    <title>Ventas | Panel de control</title>
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
                    <h1 class="h3 mb-2 text-gray-800">Ventas</h1>

                    <!-- Tabla Ventas -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-warning">Tabla de ventas</h6>
                        </div>
                        <div class="card-body" class="justify-content-center">
                            <div class="table-responsive">
                                <form id="formulario">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">                            
                                        <thead class="text-dark">
                                            <th>ID</th>
                                            <th>Dia de la semana</th>
                                            <th>Nombre del platillo</th>
                                            <th>Cantidad vendida</th>
                                            <th>Total de la venta</th>
                                            <th>Fecha de la venta</th>
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
                                                foreach($consulta as $venta){
                                            ?>
                                            <tr role="row">
                                                <td><span id="venta_tdID"><?php echo $venta['_id'] ?></span></td>
                                                <td><span id="venta_tdDia"><?php echo $venta['dia_semana']; ?></span></td>
                                                <td><span id="venta_tdNombre"><?php echo $venta['nombre_comida']; ?></span></td>
                                                <td><span id="venta_tdCantidad"><?php echo $venta['cantidad']; ?></span></td>
                                                <td><span id="venta_tdTotal"><?php echo $venta['total']; ?></span></td>
                                                <td><?php echo $venta['fecha']; ?></td>
                                                <?php
                                                    if(isset($_SESSION['admin'])){
                                                ?>
                                                    <td class="text-white">
                                                        <a id="btn_editarVenta" class="btn btn-success a_panel" data-toggle="modal" data-target="#VentaModalE"><i class="fas fa-pencil-alt" style="color: white !important;"></i></a>
                                                        <a class="btn btn-danger a_panel" onclick="ConfirmarEliminacion('ventas','<?php echo $venta['_id']?>')"><i class="fas fa-trash" style="color: white !important;"></i></a>
                                                        <div class="form-check form-check-inline">
                                                            <input type="checkbox" name="eliminar-mult[]" value="<?php echo $venta['_id']?>">
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
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VentaModal"><i class="fas fa-plus"></i> Agregar nueva venta</button>
                                            </div>
                                            <div class="col-12 col-md-6 mb-5 text-center">
                                                <button class="btn btn-danger" type="submit" onclick="EliminacionMult('ventas')"><i class="fas fa-minus-circle"></i> Eliminar registros seleccionados</button>
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
        <div class="modal fade" id="VentaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dia_agregar" class="form-label">Día de la semana</label>
                            <select name="dia" required id="dia_agregar" class="custom-select mb-3">
                                <option value="<?php echo $dias[$d] ?>" selected><?php echo $dias[$d] ?></option>
                                <?php
                                    for ($i=1; $i <= count($dias); $i++) { 
                                        if ($dias[$i] != $dias[$d]) {
                                            
                                ?>
                                    <option value="<?php echo $dias[$i] ?>"><?php echo $dias[$i] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un día de la semana.</div>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_agregar" class="form-label">Nombre del platillo</label>
                            <select name="nombre" required id="nombre_agregar" class="custom-select mb-3">
                                <?php
                                    foreach($platillos as $platillo) { 
                                            
                                ?>
                                    <option value="<?php echo $platillo ?>"><?php echo $platillo ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre del platillo.</div>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_agregar" class="form-label">Cantidad</label>
                            <input class="form-control" type="text" name="cantidad" required id="cantidad_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa una cantidad.</div>
                        </div>
                        <div class="mb-3">
                            <label for="total_agregar" class="form-label">Total</label>
                            <input class="form-control" type="number" name="total" required id="total_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa el total.</div>
                        </div>    
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="agregarVenta('ventas')">Agregar venta</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Editar admin-->
    <form id="editar" class="needs-validation" novalidate>
        <div class="modal fade" id="VentaModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar venta</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                    <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id" required id="id_editar" readonly>
                            <label for="dia_editar" class="form-label">Día de la semana</label>
                            <select name="dia" required id="dia_editar" class="custom-select mb-3">
                                <option value="<?php echo $dias[$d] ?>" selected><?php echo $dias[$d] ?></option>
                                <?php
                                    for ($i=1; $i <= count($dias); $i++) { 
                                        if ($dias[$i] != $dias[$d]) {
                                            
                                ?>
                                    <option value="<?php echo $dias[$i] ?>"><?php echo $dias[$i] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un día de la semana.</div>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_editar" class="form-label">Nombre del platillo</label>
                            <select name="nombre" required id="nombre_editar" class="custom-select mb-3">
                                <?php
                                    foreach($platillos as $platillo) { 
                                            
                                ?>
                                    <option value="<?php echo $platillo ?>"><?php echo $platillo ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un nombre del platillo.</div>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_editar" class="form-label">Cantidad</label>
                            <input class="form-control" type="text" name="cantidad" required id="cantidad_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa una cantidad.</div>
                        </div>
                        <div class="mb-3">
                            <label for="total_editar" class="form-label">Total</label>
                            <input class="form-control" type="number" name="total" required id="total_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa el total.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" onclick="editarVenta('ventas')">Guardar cambios</button>
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
        header("Location: https://cocinas-aurora.herokuapp.com/");
    }

?>