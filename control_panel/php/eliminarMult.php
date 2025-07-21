<?php

    session_start();
    require_once '../../vendor/autoload.php';

    if(isset($_SESSION['admin'])){

        if (isset($_REQUEST['tabla'])) {

            $tabla = $_REQUEST['tabla'];

            if($tabla == 'administradores'){
                $tabla = 'admins';
            }

            $C_tabla = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->$tabla;
            foreach($_POST['eliminar-mult'] as $id_borrar){
                if($tabla == 'antojitos' || $tabla == 'guarniciones' || $tabla == 'guisos' || $tabla == 'postres' || $tabla == 'sopas'){
                    $foto = $C_tabla->findOne(['_id' => new MongoDB\BSON\ObjectID($id_borrar)]);
                    if(!empty($foto['imagen'])){
                        if(file_exists("../../img_alimentos/".$foto['imagen'])){
                            if($foto['imagen'] != 'noimagen.png'){
                                unlink("../../img_alimentos/".$foto['imagen']);
                            }
                        }
                    }
                }
                $delete = $C_tabla->deleteMany(['_id' => new MongoDB\BSON\ObjectID($id_borrar)]);
            }
            
            if($delete){
                echo json_encode("correcto");
            }else {
                echo json_encode('error');
            }
        
        }else{
            header('Location: ../index');
        }

    }elseif(isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {
        header("Location: ../../index");
    }elseif(isset($_SESSION['estandar'])) {
        header("Location: ../index");
    }

?>