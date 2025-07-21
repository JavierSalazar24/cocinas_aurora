<?php

    require_once '../vendor/autoload.php';
    $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 

    if(!empty($_POST['pass']) && !empty($_POST['conf_pass']) && !empty($_POST['correo'])){


        $passE = $_POST['pass'];
        $conf_passE = $_POST['conf_pass'];
        $correo = $_POST['correo'];

        $pass = preg_replace("/[[:space:]]/"," ",trim($passE));
        $conf_pass = preg_replace("/[[:space:]]/"," ",trim($conf_passE));

        if($pass === $conf_pass){
            $pass_cifrada = md5($pass);
            $update = $C_clientes -> updateOne(
                ['correo' => $correo],
                ['$set' => ['password' => $pass_cifrada]]
            );
            if ($update) {
                echo json_encode("correcto");
            } else {
                echo json_encode("errors");
            }

        }else{
            echo json_encode("error");            
        }


    }else {
        echo json_encode('vacio');
    }

?>