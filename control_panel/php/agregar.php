<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';  

    session_start();
    error_reporting(0);
    require_once '../../vendor/autoload.php';

    date_default_timezone_set('America/Mexico_City');
    setlocale(LC_ALL, '');
    $fecha=date("d/m/Y");
    $anio = date('Y');

    if(isset($_SESSION['admin'])){

        if (isset($_REQUEST['tabla'])) {

            $tabla = $_REQUEST['tabla'];

            if ($tabla == 'administradores') {
                $C_admins = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->admins; 
                if(!empty($_POST['nombres'])&&!empty($_POST['apellidos'])&&!empty($_POST['correo'])&&!empty($_POST['password'])&&!empty($_POST['tipo_admin'])){
    
                    $nombres = $_POST['nombres'];
                    $apellidos = $_POST['apellidos'];
                    $correo = $_POST['correo'];
                    $password = MD5($_POST['password']);
                    $tipo_admin = intval($_POST['tipo_admin']);
    
                    $insert = $C_admins->insertOne([
                        'nombres' => $nombres,
                        'apellidos' => $apellidos,
                        'correo' => $correo,
                        'password' => $password,
                        'tipo_admin' => $tipo_admin,
                    ]);
                }else{
                    echo json_encode('vacio');
                }
            } else if($tabla == 'antojitos' || $tabla == 'guarniciones' || $tabla == 'guisos' || $tabla == 'postres' || $tabla == 'sopas'){                
                $C_alimento = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->$tabla;
                if(!empty($_POST['nombre'])&&!empty($_POST['dia_semana'])&&!empty($_POST['descripcion'])){
                    
                    $imagen=$_FILES['imagen']['name'];

                    if (!empty($imagen)) {
                        $ruta=$_FILES['imagen']['tmp_name'];
                        $destino="../../img_alimentos/".$imagen;
                        copy($ruta,$destino);
                    } else {
                        $imagen="noimagen.png";
                    }
                    
    
                    $nombre = $_POST['nombre'];
                    $dia = $_POST['dia_semana'];
                    $descripcion = $_POST['descripcion'];

                        if($tabla == 'antojitos'){
                            $pieza_orden = $_POST['pieza_orden'];
                            $precio = floatval($_POST['precio']);
                            $insert = $C_alimento->insertOne([
                                'nombre' => $nombre,
                                'dia' => $dia,
                                'descripcion' => $descripcion,
                                'precio' => $precio,
                                'pieza_orden' => $pieza_orden,
                                'imagen' => $imagen,
                            ]);
                        }else{
                            $precioCuarto = floatval($_POST['precioCuarto']);
                            $precioMedio = floatval($_POST['precioMedio']);
                            $precioLitro = floatval($_POST['precioLitro']);
                            $insert = $C_alimento->insertOne([
                                'nombre' => $nombre,
                                'dia' => $dia,
                                'descripcion' => $descripcion,
                                'precio_cuarto' => $precioCuarto,
                                'precio_medio' => $precioMedio,
                                'precio_litro' => $precioLitro,
                                'imagen' => $imagen,
                            ]);
                        }            

                }else{
                    echo json_encode('vacio');
                }
            }else if($tabla == 'notas' || $tabla == 'notasI'){    
                $C_notas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->notas; 
                if (!empty($_POST['nota'])&&!empty($_POST['estatus'])) {
    
                    $nota = $_POST['nota'];
                    $estatus = $_POST['estatus'];
        
                    $insert = $C_notas->insertOne([
                        'nota' => $nota,
                        'estatus' => $estatus,
                        'fecha' => $fecha,
                    ]);
        
                }else{
                    echo json_encode('vacio');
                }
            }else if($tabla == 'correo'){                                              

                if (empty($_POST['email']) && empty($_POST['mensaje_correo'])) {

                    echo json_encode('vacio');
            
                } else {
            
                    $destino= $_POST['email'];
                    $mensaje = $_POST["mensaje_correo"];
                    $mail = new PHPMailer;
                    $mail -> CharSet = "UTF-8";
            
                    try {
                        $mail->isSMTP();                                                //Send using SMTP
                        $mail->SMTPDebug  =   0;                                        //Enable verbose debug output
                        $mail->Host       =   'smtp.gmail.com';                         //Set the SMTP server to send through
                        $mail->Port       =   465;                                      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                        $mail->SMTPSecure =   'ssl';                                    //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->SMTPAuth   =   true;                                     //Enable SMTP authentication
                        $mail->Username   =   "cocinasaurora@gmail.com";                //SMTP username
                        $mail->Password   =   "cocinasaurora1985";                      //SMTP password
            
                        //Recipients
                        $mail->setFrom('cocinasaurora@gmail.com', 'Cocinas Aurora');
                        $mail->addAddress($destino, "Cliente");           //Add a recipient                
            
                        //Content
                        $mail->isHTML(true);                                            //Set email format to HTML
                        $mail->Subject = 'Respuesta de Cocinas Aurora';
                        $mail->Body    = "<!DOCTYPE html>
                                    <html lang='es'>

                                        <head>
                                            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                                            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                            <title>Respuesta | Cocinas Aurora</title>
                                            <style type='text/css'>
                                                body {
                                                    width: 100% !important;
                                                    height: 100%;
                                                    margin: 0;
                                                    line-height: 1.4;
                                                    background-color: #F2F4F6;
                                                    color: #74787E;
                                                    -webkit-text-size-adjust: none;
                                                }
                                        
                                                @media only screen and (max-width: 600px) {
                                                    .email-body_inner {
                                                        width: 100% !important;
                                                    }
                                        
                                                    .email-footer {
                                                        width: 100% !important;
                                                    }
                                                }
                                        
                                                @media only screen and (max-width: 500px) {
                                                    .button {
                                                        width: 100% !important;
                                                    }
                                                }
                                                .titulo-mensaje {
                                                    text-align: center !important;
                                                    color: #000 !important;
                                                }
                                                .parrafo-mensaje{
                                                    text-align: left !important;
                                                    font-size: 18px !important;
                                                    color: #000 !important;
                                                }
                                            </style>
                                        
                                        </head>

                                        <body>
                                            <table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding:
                                                0; width: 100%; background-color:#F2F4F6'>
                                                <tr>
                                                    <td align=' center'
                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                        <table class='email-content' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin:
                                                            0; padding: 0; width: 100%;'>
                                                            <tr>
                                                                <td class='email-masthead'
                                                                    style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 25px 0; word-break: break-word;'
                                                                    align='center'>
                                                                    <a class='ancla-cocinas' href='https://cocinas-aurora.herokuapp.com/'
                                                                        class='email-masthead_name' style='box-sizing: border-box; color: #bbbfc3; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none;
                                                                        text-shadow: 0 1px 0 white;'>
                                                                        Cocinas Aurora
                                                                    </a>
                                                                </td>
                                                            </tr>
                                        
                                                            <tr>
                                                                <td class='email-body' width='100%' cellpadding='0' cellspacing='0' style='-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break:
                                                                    break-word;' bgcolor='#FFFFFF'>
                                                                    <table class='email-body_inner' align='center' width='570' cellpadding='0' cellspacing='0'
                                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;'
                                                                        bgcolor='#FFFFFF'>
                                        
                                                                        <tr>
                                                                            <td class='content-cell' style='text-align: right; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <h1 class='titulo-mensaje' style='box-sizing: border-box; color: #000; font-family: Arial, Helvetica, sans-serif; font-size: 30px !important; font-weight: bold;
                                                                                    margin-top: 0;' align='left'>Estimado cliente</h1>
                                                                                <p class='parrafo-mensaje'>$mensaje</p>                                                                                                                 
                                                                            </td>                                                                            
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;
                                                                    word-break: break-word;'>
                                                                    <table class='email-footer' align='center' width='570' cellpadding='0' cellspacing='0'
                                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;'>
                                                                        <tr>
                                                                            <td class='content-cell' align='center'
                                                                                style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <p class='sub align-center' style='box-sizing: border-box; color: #AEAEAE; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='center'>©$anio Cocinas Aurora. Todos los derechos
                                                                                    reservados.</p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </body>

                                    </html>";                
    
                        $mail->send();

                        $insert = true;

                    } catch (Exception $e) {
                        echo ($e);
                    }
                
                }
            }else if($tabla == 'ventas'){
                $C_ventas = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->ventas; 
                if (!empty($_POST['dia'])&&!empty($_POST['nombre'])&&!empty($_POST['cantidad'])&&!empty($_POST['total'])) {
    
                    $dia = $_POST['dia'];
                    $nombre = $_POST['nombre'];
                    $cantidad = $_POST['cantidad'];
                    $total = floatval($_POST['total']);

        
                    $insert = $C_ventas->insertOne([
                        'dia_semana' => $dia,
                        'nombre_comida' => $nombre,
                        'cantidad' => $cantidad,
                        'total' => $total,
                        'fecha' => $fecha,
                    ]);
        
                }else{
                    echo json_encode('vacio');
                }
            }else{
                header("Location: ../index.php");
            }

            if ($insert) {
                if ($tabla == 'correo') {
                    echo json_encode('correo');
                }else if ($tabla == 'notasI') {
                    echo json_encode('notasI');
                }else if ($tabla == 'notas') {
                    echo json_encode('notas');
                }else {
                    echo json_encode('correcto');
                }
            }else{
                echo json_encode('error');
            }
        }else{
            header("Location: ../index");
        }

    }elseif (isset($_SESSION['usuario'])||!isset($_SESSION['usuario'])) {
        header("Location: ../../index");
    }elseif(isset($_SESSION['estandar'])){
        header("Location: ../index");
    }
?>