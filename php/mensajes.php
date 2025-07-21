<?php

    require_once '../vendor/autoload.php';
    $C_mensajes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->mensajes; 
    if (!empty($_POST['nombre'] && !empty($_POST['correo']) && !empty($_POST['mensaje']))) {
        
        $nombreE = $_POST['nombre'];
        $mensajeE = $_POST['mensaje'];
        $correoE = $_POST['correo'];

        $nombre = preg_replace("/[[:space:]]/"," ",trim($nombreE));
        $mensaje = preg_replace("/[[:space:]]/"," ",trim($mensajeE));
        $correo = preg_replace("/[[:space:]]/"," ",trim($correoE));

        $insert = $C_mensajes->insertOne([
            'nombres' => $nombre,
            'correo' => $correo,
            'mensaje' => $mensaje,
        ]);

        if($insert){
            echo json_encode("correcto");
        }else{
            echo json_encode("error");
        }

    } else {
        echo json_encode("vacio");    
    }
    

?>