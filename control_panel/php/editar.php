<?php

    session_start();
    error_reporting(0);
    require_once '../../vendor/autoload.php';

    if(isset($_SESSION['admin'])){

        if (isset($_REQUEST['tabla'])) {

            $tabla = $_REQUEST['tabla'];
            if ($tabla == 'administradores') {
                $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
                if(!empty($_POST['nombres'])&&!empty($_POST['apellidos'])&&!empty($_POST['correo'])&&!empty($_POST['tipo_admin'])){

                    $nombres = $_POST['nombres'];
                    $apellidos = $_POST['apellidos'];
                    $correo = $_POST['correo'];
                    $tipo_admin = intval($_POST['tipo_admin']);
        
                    $update = $C_admins -> updateOne(
                        ['correo' => $correo],
                        ['$set' => ['nombres' => $nombres, 'apellidos' => $apellidos, 'tipo_admin' => $tipo_admin]]
                    );

                }else{
                    echo json_encode('vacio');
                }
            } else if($tabla == 'antojitos' || $tabla == 'guarniciones' || $tabla == 'guisos' || $tabla == 'postres' || $tabla == 'sopas'){
                $C_alimento = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->$tabla;
                if(!empty($_POST['id'])&&!empty($_POST['nombre'])&&!empty($_POST['dia_semana'])&&!empty($_POST['descripcion'])){
                
                    $imagen=$_FILES['imagen']['name'];                    
    
                    $id = $_POST['id'];
                    $nombre = $_POST['nombre'];
                    $dia = $_POST['dia_semana'];
                    $descripcion = $_POST['descripcion'];                    

                    if($tabla == 'antojitos'){
                        $pieza_orden = $_POST['pieza_orden'];
                        $precio = floatval($_POST['precio']);                        
                        if (!empty($imagen)) { //si manda imagen entra aquí

                           //eliminar imagen que ya estaba para agregar una nueva 
                            $foto = $C_alimento->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);
                            if(!empty($foto['imagen'])){
                                if(file_exists("../../img_alimentos/".$foto['imagen'])){
                                    if($foto['imagen'] != 'noimagen.png'){
                                        unlink("../../img_alimentos/".$foto['imagen']);
                                    }
                                }
                            }

                            $ruta=$_FILES['imagen']['tmp_name'];
                            $destino="../../img_alimentos/".$imagen;
                            copy($ruta,$destino);
                            $update = $C_alimento -> updateOne(
                                ['_id' => new MongoDB\BSON\ObjectID($id)],
                                ['$set' => ['nombre' => $nombre, 'dia' => $dia, 'descripcion' => $descripcion, 'precio' => $precio, 'pieza_orden' => $pieza_orden, 'imagen' => $imagen]]
                            );
                        }else{ //si no manda imagen entra aquí
                            $update = $C_alimento -> updateOne(
                                ['_id' => new MongoDB\BSON\ObjectID($id)],
                                ['$set' => ['nombre' => $nombre, 'dia' => $dia, 'descripcion' => $descripcion, 'precio' => $precio, 'pieza_orden' => $pieza_orden]]
                            );
                        }   
                    }else{
                        $precioCuarto = floatval($_POST['precioCuarto']);
                        $precioMedio = floatval($_POST['precioMedio']);
                        $precioLitro = floatval($_POST['precioLitro']);
                        if (!empty($imagen)) {
                            $ruta=$_FILES['imagen']['tmp_name'];
                            $destino="../../img_alimentos/".$imagen;
                            copy($ruta,$destino);
                            $update = $C_alimento -> updateOne(
                                ['_id' => new MongoDB\BSON\ObjectID($id)],
                                ['$set' => ['nombre' => $nombre, 'dia' => $dia, 'descripcion' => $descripcion, 'precio_cuarto' => $precioCuarto, 'precio_medio' => $precioMedio, 'precio_litro' => $precioLitro, 'imagen' => $imagen]]
                            );
                        }else{
                            $update = $C_alimento -> updateOne(
                                ['_id' => new MongoDB\BSON\ObjectID($id)],
                                ['$set' => ['nombre' => $nombre, 'dia' => $dia, 'descripcion' => $descripcion, 'precio_cuarto' => $precioCuarto, 'precio_medio' => $precioMedio, 'precio_litro' => $precioLitro]]
                            );
                        }                      
                    }

                    
                }else{
                    echo json_encode('vacio');
                }
            }else if($tabla == 'notas' || $tabla == 'notasI'){
                $C_notas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->notas; 
                date_default_timezone_set('America/Mexico_City');
                setlocale(LC_ALL, '');
                $fecha=date("d/m/Y");
    
                if (isset($_REQUEST['id'])) {

                    $id = $_REQUEST['id'];
                    if(!empty($_POST['nota'])){

                        $nota = $_POST['nota'];
                        $update = mysqli_query($conexion, "UPDATE notas SET nota = '$nota', fecha = '$fecha' WHERE id = '$id' ");

                        $update = $C_notas -> updateOne(
                            ['_id' => new MongoDB\BSON\ObjectID($id)],
                            ['$set' => ['nota' => $nota, 'fecha' => $fecha]]
                        );

                    }else{

                        $info = $C_notas->findOne(['_id' => new MongoDB\BSON\ObjectID($id)]);                        
                        $estatus = $info['estatus'];
                        if ($estatus == "pendiente") {
                            $estatus = "realizada";
                        } else {
                            $estatus = "pendiente";            
                        }
            
                        $update = $C_notas -> updateOne(
                            ['_id' => new MongoDB\BSON\ObjectID($id)],
                            ['$set' => ['estatus' => $estatus, 'fecha' => $fecha]]
                        );

                        if($tabla == 'notas'){
                            header("Location: ../notas");
                        }else{
                            header("Location: ../index");
                        }
                    }

        
                }else{
                    echo json_encode('vacio');
                }
            }else if($tabla == 'ventas'){
                $C_ventas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->ventas; 
                if (!empty($_POST['id'])&&!empty($_POST['dia'])&&!empty($_POST['nombre'])&&!empty($_POST['cantidad'])&&!empty($_POST['total'])) {
    
                    $id = $_POST['id'];
                    $dia = $_POST['dia'];
                    $nombre = $_POST['nombre'];
                    $cantidad = $_POST['cantidad'];
                    $total = floatval($_POST['total']);

                    $update = $C_ventas -> updateOne(
                        ['_id' => new MongoDB\BSON\ObjectID($id)],
                        ['$set' => ['dia_semana' => $dia, 'nombre_comida' => $nombre, 'cantidad' => $cantidad, 'total' => $total]]
                    );
        
                }else{
                    echo json_encode('vacio');
                }
            }else if($tabla == 'horarios'){
                $C_horarios = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->horarios; 
                if(!empty($_POST['id'])&&!empty($_POST['dia'])&&!empty($_POST['apertura'])&&!empty($_POST['cierre'])){

                    $id = $_POST['id'];
                    $dia = $_POST['dia'];
                    $apertura = $_POST['apertura'];
                    $cierre = $_POST['cierre'];

                    $hrsA = new DateTime($apertura);
                    $apertura = $hrsA->format('h:ia');

                    $hrsC = new DateTime($cierre);
                    $cierre = $hrsC->format('h:ia');
        
                    $update = $C_horarios -> updateOne(
                        ['_id' => new MongoDB\BSON\ObjectID($id)],
                        ['$set' => ['dia' => $dia, 'horario_apertura' => $apertura, 'horario_cierre' => $cierre]]
                    );
                }else{
                    echo json_encode('vacio');
                }
            }else{
                header("Location: ../");
            }

            if ($update) {
                if ($tabla == 'notasI') {
                    echo json_encode('notasI');
                }else if ($tabla == 'notas') {
                    echo json_encode('notas');
                }else {
                    echo json_encode('correcto');
                }
            }else{
                echo json_encode('error');
            }
        }else{
            header("Location: ../");
        }

    }elseif (isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {
        header("Location: ../../");
    }elseif(isset($_SESSION['estandar'])){
        header("Location: ../");
    }
?>