<?php

    session_start();
    require_once '../vendor/autoload.php';
    $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
    $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['password'])){

        $nombresE = $_POST['nombres'];
        $apellidosE = $_POST['apellidos'];
        $correoE = $_POST['correo'];
        $passE = $_POST['password'];        

        $nombres = preg_replace("/[[:space:]]/"," ",trim($nombresE));
        $apellidos = preg_replace("/[[:space:]]/"," ",trim($apellidosE));
        $correo = preg_replace("/[[:space:]]/"," ",trim($correoE));
        $pass = MD5(preg_replace("/[[:space:]]/"," ",trim($passE)));

        $correo_busq_c = $C_clientes->findOne(['correo' => $correo]);
        $correo_busq_a = $C_admins->findOne(['correo' => $correo]);
  
      if(empty($correo_busq_a) && empty($correo_busq_c)){

        $token = sha1(uniqid($correo, true));

        $consulta_insert = $C_clientes->insertOne([
          'nombres' => $nombres,
          'apellidos' => $apellidos,
          'correo' => $correo,
          'password' => $pass,
          'token' => $token,
        ]); 

        if($consulta_insert){
          $_SESSION['usuario'] = $correo;
          echo json_encode('correcto');
        }else{
          echo json_encode('error');
        }
          
      }else {

        echo json_encode('existente');

      }

    }else {

        echo json_encode('vacio');

    }
?>