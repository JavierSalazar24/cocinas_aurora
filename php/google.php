<?php
    session_start();
    require_once '../vendor/autoload.php';
    header("Content-type: application/json; charset=utf-8");
        
    $_SESSION['usuarioSocial'] = json_decode(file_get_contents("php://input"), true);
    if(!empty($_SESSION["usuarioSocial"])){

        $correo = $_SESSION['usuarioSocial']['email'];
        $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
        $cuenta_admin = $C_admins->findOne(['correo' => $correo]);

        if(!empty($cuenta_admin)){
      
            if ($cuenta_admin['tipo_admin'] == 1) {
                $_SESSION['admin'] = $correo;
            }else if($cuenta_admin['tipo_admin'] == 2){
                $_SESSION['estandar'] = $correo;
            }

            echo json_encode('admin');

        }else{
            echo json_encode("correcto");
        }
    }else{
        echo json_encode("error");
    }



?>