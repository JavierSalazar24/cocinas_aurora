<?php

    /* Traer la fecha local (México) */
    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, '');
    $dia=date('d');
    $mes = date('n');
    $anio=date('Y');
    /* Meses */
    $meses = array(
        1 => "enero",
        2 => "febrero",
        3 => "marzo",
        4 => "abril",
        5 => "mayo",
        6 => "junio",
        7 => "julio",
        8 => "agosto",
        9 => "septiembre",
        10 => "octubre",
        11 => "noviembre",
        12 => "diciembre",
    );

    $fecha=$dia . ' de ' . $meses[$mes] . ' del ' . $anio;

    if (isset($_SESSION['admin'])) {
        $correo = $_SESSION['admin'];
    } else if (isset($_SESSION['estandar'])){
        $correo = $_SESSION['estandar'];
    }    

    /* consulta de admin */
    $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
    $info = $C_admins->findOne(['correo' => $correo]);
    $nombres = $info['nombres'];
    $apellidos = $info['apellidos'];
    
?>