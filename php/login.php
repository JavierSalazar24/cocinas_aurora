<?php

    session_start();
    require_once '../vendor/autoload.php';
    
      if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){

        header("Location: control_panel/index");
  
      }elseif(isset($_SESSION['usuario'])){
      
        header("Location: index");
      
      }elseif(!isset($_SESSION['usuario'])){
      
        $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
        $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
        if (!empty($_POST['correo']) && !empty($_POST['password'])){        

          $correoE = $_POST['correo'];
          $passE = $_POST['password'];

          $correo = preg_replace("/[[:space:]]/"," ",trim($correoE));
          $pass = MD5(preg_replace("/[[:space:]]/"," ",trim($passE)));

          $cuenta_cliente = $C_clientes->findOne([
            '$and' => [
              ['correo' => $correo], ['password' => $pass]
            ]
          ]);

          $cuenta_admin = $C_admins->findOne([
            '$and' => [
              ['correo' => $correo], ['password' => $pass]
            ]
          ]);

          if(!empty($cuenta_cliente)){

            $_SESSION['usuario'] = $correo;

            echo json_encode('user');

          }else if(!empty($cuenta_admin)){          

            if ($cuenta_admin['tipo_admin'] == 1) {
              $_SESSION['admin'] = $correo;
            }else if($cuenta_admin['tipo_admin'] == 2){
              $_SESSION['estandar'] = $correo;
            }

            echo json_encode('admin');

          }else{
            
            echo json_encode('null');
            
          }
      
        }else{
          echo json_encode('vacio');
        }
    
    
      }


?>