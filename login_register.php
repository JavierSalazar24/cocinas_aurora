<?php
    session_start();
    if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){
        header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
    }elseif(isset($_SESSION['usuario']) || isset($_SESSION['usuarioSocial'])){
        header("Location: https://cocinas-aurora.herokuapp.com/");
    }elseif(!isset($_SESSION['usuario'])){
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="https://cocinas-aurora.herokuapp.com/images/favicon.png" type="image/x-icon">

    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!--========================================
        Fuentes - Tipo de letra - Iconografia 
    ==========================================-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet preload">
    <!--========================================
       Mis estilos
    ==========================================-->
    <link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/css/estilo.css">
    <title> ❤️ Login | Cocinas Aurora ❤️ </title>
    <meta name="description" content="En cocina economica cocinas aurora🧡 puedes iniciar sesión (login) o registrarse, para poderte conocer y atenderte con prioridad👫, a su vez, puedes estar en nuestro sitio web o descargar nuestra aplicación para recibir notificaciones a cerca de nuestros alimentos📱.">

</head>

<body>
    <div class="contenedor-login">
        <!-- Slider -->
        <div class="contenedor-slider">
            <div class="slider">
                <div class="slide fade ">
                    <img src="https://cocinas-aurora.herokuapp.com/images/img_login1.jpg" alt="Imagen 1 del carrousel">
                    <div class="contenido-slider">
                        <div class="logo">
                            <a rel="nofollow" href="https://cocinas-aurora.herokuapp.com/">
                                <img src="https://cocinas-aurora.herokuapp.com/images/logo-cocinas.png" alt="Logo de cocinas aurora">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="slide fade">
                    <img src="https://cocinas-aurora.herokuapp.com/images/img_login2.jpg" alt="Imagen 2 del carrousel" class="img2">
                    <div class="contenido-slider">
                        <div class="logo">
                            <a rel="nofollow" href="https://cocinas-aurora.herokuapp.com/">
                                <img src="https://cocinas-aurora.herokuapp.com/images/logo-cocinas.png" alt="Logo de cocinas aurora">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="slide fade">
                    <img src="https://cocinas-aurora.herokuapp.com/images/img_login3.jpg" alt="Imagen 3 del carrousel">
                    <div class="contenido-slider">
                        <div class="logo">
                            <a rel="nofollow" href="https://cocinas-aurora.herokuapp.com/">
                                <img src="https://cocinas-aurora.herokuapp.com/images/logo-cocinas.png" alt="Logo de cocinas aurora">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="prev"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="next"><i class="fas fa-chevron-right"></i></a>
            <div class="dots">
            </div>
        </div>

       <!-- Formularios -->
        <div class="contenedor-texto">
            <div class="contenedor-form">
                <h1 class="titulo">¡Bienvenido a Cocinas Aurora!</h1>
                <div id="maquina">
                    <p>Ingresa a tu cuenta para disfrutar de la mejor comida deliciosa que existe en Durango.</p>
                </div>
                <span class="descripcion"></span>

                <ul class="tabs-links">
                    <li class="tab-link active">Iniciar Sesión</li>
                    <li class="tab-link ">Regístrate</li>
                </ul>

                <!-- Formulario login -->                
                <form id="formLogin" class="formulario active" autocomplete="off">
                    <input type="text" placeholder="Correo electrónico" autocapitalize="off" autocapitalize="off" title="Completa este campo / example@gmail.com" class="input-text" name="correo" required>
                    <div class="grupo-input">
                        <input type="password" autocapitalize="off" minlength="8" title="Completa este campo / Mínimo 8 carácteres" placeholder="Contraseña" name="password" class="input-text clave" required>
                        <button type="button" class="icono fas fa-eye mostrarClave"></button>
                    </div>

                    <a href="https://cocinas-aurora.herokuapp.com/recuperar" class="link">¿Ovidaste tu contraseña?</a>
                    <button class="btn" id="btnLogin" type="submit">Iniciar Sesión</button>
                    <a href="https://cocinas-aurora.herokuapp.com/" class="btn2">Volver al inicio</a>

                    <div class="redes_sociales">
                        <div class="icono_redSocial div_facebook" id="face" title="Iniciar sesión con Facebook">
                            <button class="buttonIcono" type="button"><i class="fab fa-facebook-f"></i></button>
                        </div>
                        <div class="icono_redSocial div_google" id="google" title="Iniciar sesión con Google">
                            <button class="buttonIcono" type="button"><i class="fab fa-google"></i></button>
                        </div>
                    </div>
                </form>

               <!-- Formulario registrarse -->
                <form id="formRegistro" class="formulario" autocomplete="off">
                    <input type="text" title="Completa este campo / Solo letras" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Nombre(s)" class="input-text" name="nombres" required>
                    <input type="text" title="Completa este campo / Solo letras" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Apellido(s)" class="input-text" name="apellidos" required>
                    <input type="email" title="Completa este campo / example@gmail.com" placeholder="Correo electrónico" class="input-text" name="correo" required>

                    <div class="grupo-input">
                        <input type="password" autocapitalize="off" minlength="8" title="Completa este campo / Mínimo 8 carácteres" placeholder="Contraseña" name="password" class="input-text clave" required>
                        <button type="button" class="icono fas fa-eye mostrarClave"></button>
                    </div>

                    <label class="contenedor-cbx animate">
                        Acepto los terminos de <a href="https://cocinas-aurora.herokuapp.com/privacidad" rel="nofollow" target="_blank">privacidad</a>.
                        <input type="checkbox" id="terminos" checked>
                        <span class="cbx-marca"></span>
                    </label>

                    <button class="btn" id="btnRegistro" type="submit">Crear Cuenta</button>
                    <a href="https://cocinas-aurora.herokuapp.com/" class="btn2">Volver al inicio</a>
                </form>
                
            </div>
        </div>
    </div>



    <!--========================================
       Mis Scripts
    ==========================================-->
    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/sweetalert.js"></script>
    <!-- Efecto maquina de escribir -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script src="./js/app.js"></script>
    <script defer>
        document.oncontextmenu = function(){
            return false
        }
    </script>
    <!-- redes sociales -->
    <script src="https://cocinas-aurora.herokuapp.com/js/facebook.js"></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/google.js"></script>
</body>

</html>


<?php
    }
?>