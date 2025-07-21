<?php

  session_start();

  if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){
      header("Location: https://cocinas-aurora.herokuapp.com/control_panel");
  }else{

    if(!empty($_REQUEST['token'])){

        $token = $_REQUEST['token'];
        $correo = $_REQUEST['correo'];

        require_once 'vendor/autoload.php';

        $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes;
        $consulta_cliente = $C_clientes->findOne([
            '$and' => [
                ['correo' => $correo], ['token' => $token]
            ]
        ]);

        if(!empty($consulta_cliente)){

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="https://cocinas-aurora.herokuapp.com/images/favicon.png" type="image/x-icon">
    <link rel="stylesheet preload" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet preload" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> ❤️ Nueva contraseña | Cocinas Aurora ❤️ </title>
    <style>
        body::-webkit-scrollbar {
            width: 10px !important;
            background-color: rgb(224, 118, 68) !important;
        }

        body::-webkit-scrollbar-thumb {
            background-color: rgba(255, 236, 66, 0.986) !important;
            border-radius: 7px !important;
        }
        .row {
            box-shadow: 5px 5px 10px 6px rgba(0, 0, 0, 0.068);
            border-radius: 8px;
            width: 80%;
            margin: auto;
        }

        .formulario {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .container {
            margin-top: 100px;
        }

        .form-control:focus {
            border-color: #FFC107;
            box-shadow: none;
            background: transparent;
        }

        .divOjo{
            width: 30px;
        }

        .icono {
            position: absolute;
            width: 60px;
            height: 100%;
            border: none;
            cursor: pointer;
            background: none;
            font-size: 18px;
            color: #555;
            right: 0;
            outline: 0 !important;
        }

        .icono.active {
            color: #555;
        }

        .descripcion{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row mt-5 pt-5 mb-5 pb-5">
            <div class="col">
                <h3 class="text-center">Actualizar contraseña</h3>
                <div id="maquina">
                    <p class="text-center">Ingrese su nueva contraseña, verifíquela y guardela</p>
                </div>
                <span class="descripcion"></span>

                <div class="mt-3 pt-3 text-center">
                    <a href="https://cocinas-aurora.herokuapp.com/"> <img src="https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png" alt="Logo de la empresa"> </a>
                </div>
                <form id="form_nuevaPass" autocomplete="off">
                    <div class="form-group mt-5 formulario">
                        <div class="col-12 col-md-6 mb-3 input-group">
                            <input type="password" minlength="8" title="Completa este campo / Mínimo 8 carácteres" class="clave text-center form-control form-control-lg" placeholder="Ingresa tu nueva contraseña" name="pass" id="pass" autocomplete="off" required>
                            <div class="divOjo input-group-text"><button type="button" class="icono fas fa-eye mostrarClave"></button></div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 input-group">
                            <input type="password" minlength="8" title="Completa este campo / Mínimo 8 carácteres" class="clave text-center form-control form-control-lg" placeholder="Confirma tu nueva contraseña" name="conf_pass" id="conf_pass" autocomplete="off" required>
                            <div class="divOjo input-group-text"><button type="button" class="icono fas fa-eye mostrarClave"></button></div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 mt-2">
                            <button type="submit" id="btnGuardar" class="btnEnviar btn btn-block btn-outline-warning">Guardar</button>
                        </div>

                        <input type="hidden" name="correo" value="<?php echo $correo ?>">
                    </div>
                </form>
                <div class="text-center">
                    <a href="https://cocinas-aurora.herokuapp.com/login_register">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
    <!-- Efecto maquina de escribir -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11" async></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/password.js" async></script>
    <!-- Script bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous" async></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous" async></script>
    <script>
        document.oncontextmenu = function () {
            return false
        }
    </script>
</body>

</html>

<?php
        }else{
            header("Location: https://cocinas-aurora.herokuapp.com/login_register");
        }
    }else{
        header("Location: https://cocinas-aurora.herokuapp.com/login_register");
    }
    }
?>