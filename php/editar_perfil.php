<?php

    session_start();
    require_once '../vendor/autoload.php';
    $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes;
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['correo'])){

        $nombresE = $_POST['nombres'];
        $apellidosE = $_POST['apellidos'];
        $correoE = $_POST['correo'];

        $nombres = preg_replace("/[[:space:]]/"," ",trim($nombresE));
        $apellidos = preg_replace("/[[:space:]]/"," ",trim($apellidosE));
        $correo = preg_replace("/[[:space:]]/"," ",trim($correoE));

        $update = $C_clientes -> updateOne(
            ['correo' => $correo],
            ['$set' => ['nombres' => $nombres, 'apellidos' => $apellidos]]
        );
        
        if ($update) {
            echo json_encode("correcto");
        } else {
            echo json_encode("error");
        }

    }else {
        echo json_encode('vacio');
    }
?>