<?php

    session_start();
    require_once '../../vendor/autoload.php';

    if(isset($_SESSION['estandar']) || isset($_SESSION['admin'])){

        /* Contar consultas */
        $consulta_guisos = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guisos; 
        $consulta_sopas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->sopas; 
        $consulta_guarniciones = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->guarniciones; 
        $consulta_antojitos = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->antojitos; 
        $consulta_postres = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->postres; 
        
        $numGui = $consulta_guisos -> count();
        $numSo = $consulta_sopas -> count();
        $numGua = $consulta_guarniciones -> count();
        $numAn = $consulta_antojitos -> count();
        $numPo = $consulta_postres -> count();

        $array = array(
            0  => $numGui,
            1  => $numSo,
            2  => $numGua,
            3  => $numAn,
            4  => $numPo
        );

        $datos = $array[0].$array[1].$array[2].$array[3].$array[4];

        echo json_encode($datos);

    }elseif (isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {
        header("Location: ../../index");
    }

?>