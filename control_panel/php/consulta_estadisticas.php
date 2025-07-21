<?php

    session_start();
    require_once '../../vendor/autoload.php';

    if(isset($_SESSION['estandar']) || isset($_SESSION['admin'])){


        /* Contar consultas */
        $consulta_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
        $consulta_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
        $consulta_ventas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->ventas; 

        $numAd = $consulta_admins -> count();
        $numCl = $consulta_clientes -> count();
        $numVe = $consulta_ventas -> count();

        $array = array(
            0  => $numAd,
            1  => $numCl,
            2  => $numVe,
        );

        $datos = $array[0].$array[1].$array[2];

        echo json_encode($datos);

    }elseif (isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {
        header("Location: ../../index");
    }

?>