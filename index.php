<?php
  session_start();
  require_once 'vendor/autoload.php';

  if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
    header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
  }else{

    /* consultar horarios de los dias de la semana que se abre */
      $consulta_horarios = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->horarios; 
      
      $horario_lunes = $consulta_horarios -> findOne(['dia' => 'Lunes']);      
      $apertura_lunes = $horario_lunes['horario_apertura'];
      $cierre_lunes = $horario_lunes['horario_cierre'];

      $horario_martes = $consulta_horarios -> findOne(['dia' => 'Martes']);
      $apertura_martes = $horario_martes['horario_apertura'];
      $cierre_martes = $horario_martes['horario_cierre'];

      $horario_miercoles = $consulta_horarios -> findOne(['dia' => 'Miercoles']);
      $apertura_miercoles = $horario_miercoles['horario_apertura'];
      $cierre_miercoles = $horario_miercoles['horario_cierre'];

      $horario_jueves = $consulta_horarios -> findOne(['dia' => 'Jueves']);
      $apertura_jueves = $horario_jueves['horario_apertura'];
      $cierre_jueves = $horario_jueves['horario_cierre'];

      $horario_viernes = $consulta_horarios -> findOne(['dia' => 'Viernes']);
      $apertura_viernes = $horario_viernes['horario_apertura'];
      $cierre_viernes = $horario_viernes['horario_cierre'];

    /* Fecha y hora actual */
      date_default_timezone_set('America/Mexico_city');
      setlocale(LC_ALL, '');
      $numeroSemana = date("N");
      $mes = date('n');
      $anio = date('Y');
      $ahora = time();

      $hora = date('G');
      $minutos = date("i");
      $horacompleta = $hora.$minutos;

    /* Días */
      $diaHoy = date("d", $ahora);

      $dias = array(
        1 => $diaL = 0,
        2 => $diaM = 0,
        3 => $diaMi = 0,
        4 => $diaJ = 0,
        5 => $diaV = 0,
        6 => $diaS = 0,
        7 => $diaD = 0,
      );
      if ($numeroSemana == 1) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 6; $i++) {
          $dia = strtotime("+$i day", $ahora);
          $dias[$i+1] = date("d", $dia);
        }

      } else if ($numeroSemana == 2) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 1; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

        $numeroSemana = 2;

        for ($i=1; $i <= 5; $i++) {
          $dia = strtotime("+$i day", $ahora);      
          $dias[$numeroSemana+1] = date("d", $dia);
          $numeroSemana++;
        }

      } else if ($numeroSemana == 3) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 2; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

        $numeroSemana = 3;

        for ($i=1; $i <= 4; $i++) {
          $dia = strtotime("+$i day", $ahora);      
          $dias[$numeroSemana+1] = date("d", $dia);
          $numeroSemana++;
        }

      } else if ($numeroSemana == 4) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 3; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

        $numeroSemana = 4;

        for ($i=1; $i <= 3; $i++) {
          $dia = strtotime("+$i day", $ahora);      
          $dias[$numeroSemana+1] = date("d", $dia);
          $numeroSemana++;
        }

      } else if ($numeroSemana == 5) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 4; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

        $numeroSemana = 5;

        for ($i=1; $i <= 2; $i++) {
          $dia = strtotime("+$i day", $ahora);      
          $dias[$numeroSemana+1] = date("d", $dia);
          $numeroSemana++;
        }

      } else if ($numeroSemana == 6) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 5; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

        $numeroSemana = 6;

        for ($i=1; $i <= 1; $i++) {
          $dia = strtotime("+$i day", $ahora);      
          $dias[$numeroSemana+1] = date("d", $dia);
          $numeroSemana++;
        }

      } else if ($numeroSemana == 7) {

        $dias[$numeroSemana] = date("d", $ahora);

        for ($i=1; $i <= 6; $i++) {
          $dia = strtotime("-$i day", $ahora);      
          $dias[$numeroSemana-1] = date("d", $dia);
          $numeroSemana--;
        }

      }

    /* Meses */
      $meses = array(
        1 => "Enero",
        2 => "Febrero",
        3 => "Marzo",
        4 => "Abril",
        5 => "Mayo",
        6 => "Junio",
        7 => "Julio",
        8 => "Agosto",
        9 => "Septiembre",
        10 => "Octubre",
        11 => "Noviembre",
        12 => "Diciembre",
      );
    
    /* Formateando horario de apertura y cierre que se guardo en la Base de datos */
                //Lunes
      $aperturaLBD = new DateTime($apertura_lunes);
      $aperturaLBD = $aperturaLBD->format('Gi');
      $cierreLBD = new DateTime($cierre_lunes);
      $cierreLBD = $cierreLBD->format('Gi');
                  //Martes
      $aperturaMBD = new DateTime($apertura_martes);
      $aperturaMBD = $aperturaMBD->format('Gi');
      $cierreMBD = new DateTime($cierre_martes);
      $cierreMBD = $cierreMBD->format('Gi');
                  //Miercoles
      $aperturaMiBD = new DateTime($apertura_miercoles);
      $aperturaMiBD = $aperturaMiBD->format('Gi');
      $cierreMiBD = new DateTime($cierre_miercoles);
      $cierreMiBD = $cierreMiBD->format('Gi');
                  //Jueves
      $aperturaJBD = new DateTime($apertura_jueves);
      $aperturaJBD = $aperturaJBD->format('Gi');
      $cierreJBD = new DateTime($cierre_jueves);
      $cierreJBD = $cierreJBD->format('Gi');
                  //Viernes
      $aperturaVBD = new DateTime($apertura_viernes);
      $aperturaVBD = $aperturaVBD->format('Gi');
      $cierreVBD = new DateTime($cierre_viernes);
      $cierreVBD = $cierreVBD->format('Gi');


?>

<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">

<head>
  <!-- Estilos -->
  <?php include 'views/estilos.php' ?>
  <link rel="stylesheet" type="text/css" href="https://cocinas-aurora.herokuapp.com/css/lightslider.css" async/>    
  <title>❤️ Cocina económica - Cocinas Aurora ❤️ </title>  
  <meta name="description" content="La cocina economica Cocinas Aurora🧡❤️ ubicada en Durango🗺 en su sitio web, tiene para ti un menu semanal con alimentos a tu gusto🍲. Comida nueva de lunes a viernes, buscamos llegar día con día a tu mesa con comida tradicional😋. Puedes pedir tu comida para llevar o pedir comida a domicilio🏡. Los alimentos en nuestra cocina economica son hechos con amor💓, calidad e higiene.">
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "Cocinas Aurora",
      "image": "https://cocinas-aurora.herokuapp.com/images/logo.png",
      "@id": "https://cocinas-aurora.herokuapp.com/images/logo.png",
      "url": "https://cocinas-aurora.herokuapp.com/",
      "telephone": "618-812-77-76",
      "priceRange": "10 a 150 pesos",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Juan E. García",
        "addressLocality": "Durango",
        "postalCode": "34139",
        "addressCountry": "MX"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": 24.0168433,
        "longitude": -104.6716584
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "09:00",
        "closes": "16:30"
      },
      "sameAs": [
        "https://www.facebook.com/Cocina-Aurora-105747607811097",
        "https://cocinas-aurora.herokuapp.com/"
      ] 
    }
  </script>
  <style>
    .rw-ui-button {
      display: none !important;
    }
    @media screen and (max-width: 352px) {
      .rw-ui-info{
        font-size: 13px !important;
      }
    }
  </style>
</head>

<body>
  <!-- Preloader -->
  <div class="demo">
    <div class="loader">
      <div class="box">
        <div class="box-inner-1">
          <div class="box-1"></div>
          <div class="box-2"></div>
        </div>
        <div class="box-inner-2">
          <div class="box-3"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Progressbar -->
  <div class="container-progressbar">
    <div class="progressbar"></div>
  </div>
  
  <!-- Page-->
  <div class="page text-center">
    <header class="page-head header-panel-absolute">
      <?php
        if(isset($_SESSION['usuario'])){

          $correo = $_SESSION['usuario'];
    
          $C_clientes = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->clientes; 
          $info = $C_clientes->findOne(['correo' => $correo]);
          $nombres = $info['nombres'];
          $apellidos = $info['apellidos'];
      ?>

        <!--Navbar Responsive -->
        <div class="rd-navbar-wrap">
            <nav title="Menú de navegación" data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
              data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-lg-stick-up="false"
              data-lg-hover-on="false" class="rd-navbar rd-navbar-humburger-menu" data-auto-height="false">
              <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                  <button title="Menú de navegación" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
                  <h4 class="panel-title veil-md"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
                </div>
                <div class="rd-navbar-menu-wrap clearfix">
                  <div class="rd-navbar-nav-wrap">
                    <div class="rd-navbar-mobile-scroll">
                      <div class="rd-navbar-mobile-header-wrap">
                        <div class="rd-navbar-mobile-brand">
                          <a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/"><img loading="lazy" width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></a>
                        </div>
                      </div>
                      <ul class="rd-navbar-nav">
                        <li class="active">
                          <a title="Cocinas Aurora inicio" class="menu_item" href="#inicio">Inicio</a>
                        </li>
                        <li>
                          <a title="Cocinas Aurora menu de la semana" class="menu_item" href="#menus">Menú de la semana</a>
                          <ul class="rd-navbar-dropdown">
                            <li>
                              <a title="Cocinas Aurora comida del dia lunes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes">Lunes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia martes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes">Martes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles">Miercoles</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia jueves" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves">Jueves</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia viernes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes">Viernes</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a title="Cocinas Aurora descargar aplicacion" class="menu_item" href="#app">Descargar APP</a>
                        </li>
                        <li>
                          <a title="Cocinas Aurora porciones" class="menu_item" href="#porciones">Porciones</a>
                        </li>
                        <li>
                          <a title="Cocinas Aurora ven a visitarnos" class="menu_item" href="#visitanos">Ven a visitarnos</a>
                        </li>
                        <li>
                          <a title="Cocinas Aurora contactanos" class="menu_item" href="#contactanos">Contáctanos</a>
                        </li>
                        <li>
                          <a title="Cocinas Aurora preguntas frecuentes" class="menu_item" href="https://cocinas-aurora.herokuapp.com/faq">FAQ</a>
                        </li>
                        <li>
                          <a href="#" id="perfilNav"><?php echo $nombres.' '.$apellidos ?></a>
                          <ul class="rd-navbar-dropdown">
                            <li>
                              <a title="Cocinas Aurora perfil" href="https://cocinas-aurora.herokuapp.com/perfil">Perfil</a>
                            </li>
                            <li>
                              <a href="https://cocinas-aurora.herokuapp.com/php/cerrar_sesion">Cerrar Sesión</a>
                            </li>                 
                          </ul>
                        </li>
                        <li>
                        <button class="switch align-items-center" id="switch">
                          <span><i class="fa-moon-o"></i></span>
                          <span><i class="fa-sun-o"></i></span>
                        </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
        </div>

        <!-- Logo y nombre del negocio -->
        <section class="section-32 position-absolute veil reveal-md-block">
            <div class="shell-wide">
              <div class="range range-sm-justify range-sm-middle">
                <div class="cell-md-4 cell-lg-3">
                  <!--Navbar Brand-->
                  <div class="rd-navbar-brand text-left">
                    <a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
                      <div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
                        <div class="unit-left"><img loading="lazy" width='89' height='89' src='./images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></div>
                        <div class="unit-body text-xl-left">
                          <div>
                            <div class="h6 barnd-name text-bold">Cocinas Aurora</div>
                          </div>
                          <div>
                            <div class="brand-slogan text-italic font-accent text-base">Comida con amor</div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
        </section>

      <?php
        }else if (isset($_SESSION['usuarioSocial'])){
      ?>

        <!--Navbar Responsive -->
        <div class="rd-navbar-wrap">
            <nav data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
              data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-lg-stick-up="false"
              data-lg-hover-on="false" class="rd-navbar rd-navbar-humburger-menu" data-auto-height="false">
              <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                  <button title="Menú de navegación" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
                  <h4 class="panel-title veil-md"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
                </div>
                <div class="rd-navbar-menu-wrap clearfix">
                  <div class="rd-navbar-nav-wrap">
                    <div class="rd-navbar-mobile-scroll">
                      <div class="rd-navbar-mobile-header-wrap">
                        <div class="rd-navbar-mobile-brand">
                          <a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/"><img loading="lazy" width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></a>
                        </div>
                      </div>
                      <ul class="rd-navbar-nav">
                        <li class="active">
                          <a class="menu_item" title="Cocinas Aurora inicio" href="#inicio">Inicio</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora menu de la semana" href="#menus">Menú de la semana</a>
                          <ul class="rd-navbar-dropdown">
                            <li>
                              <a title="Cocinas Aurora comida del dia lunes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes">Lunes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia martes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes">Martes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles">Miercoles</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia jueves" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves">Jueves</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia viernes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes">Viernes</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora descargar aplicacion" href="#app">Descargar APP</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora porciones" href="#porciones">Porciones</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora ven a visitarnos" href="#visitanos">Ven a visitarnos</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora contactanos" href="#contactanos">Contáctanos</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora preguntas frecuentes" href="https://cocinas-aurora.herokuapp.com/faq">FAQ</a>
                        </li>
                        <li>
                          <a href="#" id="perfilNav"><?php echo $_SESSION["usuarioSocial"]["first_name"].' '.$_SESSION["usuarioSocial"]["last_name"] ?></a>
                          <ul class="rd-navbar-dropdown">
                            <li>
                              <a title="Cocinas Aurora perfil" href="https://cocinas-aurora.herokuapp.com/perfil">Perfil</a>
                            </li>
                            <li>
                              <a href="https://cocinas-aurora.herokuapp.com/php/cerrar_sesion">Cerrar Sesión</a>
                            </li>                 
                          </ul>
                        </li>
                        <li>
                        <button class="switch align-items-center" id="switch">
                          <span><i class="fa-moon-o"></i></span>
                          <span><i class="fa-sun-o"></i></span>
                        </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
        </div>

        <!-- Logo y nombre del negocio -->
        <section class="section-32 position-absolute veil reveal-md-block">
              <div class="shell-wide">
                <div class="range range-sm-justify range-sm-middle">
                  <div class="cell-md-4 cell-lg-3">
                    <!--Navbar Brand-->
                    <div class="rd-navbar-brand text-left"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
                        <div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
                          <div class="unit-left"><img loading="lazy" width='89' height='89' src='./images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></div>
                          <div class="unit-body text-xl-left">
                            <div>
                              <div class="h6 barnd-name text-bold">Cocinas Aurora</div>
                            </div>
                            <div>
                              <div class="brand-slogan text-italic font-accent text-base">Comida con amor</div>
                            </div>
                          </div>
                        </div>
                      </a></div>
                  </div>
                </div>
              </div>
        </section>

      <?php
        }else if (!isset($_SESSION['usuario'])){
      ?>

        <!--Navbar Responsive -->
        <div class="rd-navbar-wrap">
            <nav data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
              data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-lg-stick-up="false"
              data-lg-hover-on="false" class="rd-navbar rd-navbar-humburger-menu" data-auto-height="false">
              <div class="rd-navbar-inner">
                <div class="rd-navbar-panel">
                  <button title="Menú de navegación" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap"
                    class="rd-navbar-toggle"><span></span></button>
                  <h4 class="panel-title veil-md"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
                </div>
                <div class="rd-navbar-menu-wrap clearfix">
                  <div class="rd-navbar-nav-wrap">
                    <div class="rd-navbar-mobile-scroll">
                      <div class="rd-navbar-mobile-header-wrap">
                        <div class="rd-navbar-mobile-brand">
                          <a title="cocina economica Cocinas Aurora " href="https://cocinas-aurora.herokuapp.com/"><img loading="lazy" width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></a>
                        </div>
                      </div>
                      <ul class="rd-navbar-nav">
                        <li class="active">
                          <a class="menu_item" title="Cocinas Aurora inicio" href="#inicio">Inicio</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora menu de la semana" href="#menus">Menú de la semana</a>
                          <ul class="rd-navbar-dropdown">
                            <li>
                              <a title="Cocinas Aurora comida del dia lunes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes">Lunes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia martes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes">Martes</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles">Miercoles</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia jueves" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves">Jueves</a>
                            </li>
                            <li>
                              <a title="Cocinas Aurora comida del dia viernes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes">Viernes</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora descargar aplicacion" href="#app">Descargar APP</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora porciones" href="#porciones">Porciones</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora ven a visitarnos" href="#visitanos">Ven a visitarnos</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora contactanos" href="#contactanos">Contáctanos</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora preguntas frecuentes" href="https://cocinas-aurora.herokuapp.com/faq">FAQ</a>
                        </li>
                        <li>
                          <a class="menu_item" title="Cocinas Aurora iniciar sesion (login)" href="/login_register">Iniciar sesión</a>
                        </li>
                        <li>
                          <button class="switch" id="switch">
                            <span><i class="fa-moon-o"></i></span>
                            <span><i class="fa-sun-o"></i></span>
                          </button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </nav>
        </div>

        <!-- Logo y nombre del negocio -->
        <section class="section-32 position-absolute veil reveal-md-block">
            <div class="shell-wide">
              <div class="range range-sm-justify range-sm-middle">
                <div class="cell-md-4 cell-lg-3">
                  <!--Navbar Brand-->
                  <div class="rd-navbar-brand text-left"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
                      <div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
                        <div class="unit-left"><img loading="lazy" width='89px' height='89px' src='./images/logo_cocina_economica.png' alt='Logo de cocina económica Cocinas Aurora' /></div>
                        <div class="unit-body text-xl-left">
                          <div>
                            <div class="h6 barnd-name text-bold">Cocinas Aurora</div>
                          </div>
                          <div>
                            <div class="brand-slogan text-italic font-accent text-base">Comida con amor</div>
                          </div>
                        </div>
                      </div>
                    </a></div>
                </div>
              </div>
            </div>
        </section>
      
      <?php
        }
      ?>
    </header>

    <!-- Contenido total-->
    <main class="indexPrin page-content">

      <!-- Inicio -->
      <section id="inicio" class="seccion">
        <div data-height="100vh" data-loop="false" data-dragable="false" data-min-height="480px"
          data-slide-effect="true" class="swiper-container swiper-slider">
          <div class="swiper-wrapper">
            <div loading="lazy" data-slide-bg="images/bg-inicio.jpg" style="background-position: 80% center"
              class="swiper-slide">
              <div class="swiper-slide-caption">
                <div class="container">
                  <div class="range range-xs-center range-lg-left">
                    <div class="cell-md-10 text-md-left cell-xs-10">
                      <div class="jumbotron-custom bg-white-transparent">
                        <div>
                          <h1 class="text-bold">Cocina económica</h1>
                        </div>
                        <div class="offset-top-20 offset-xs-top-40 offset-xl-top-60">
                          <h5 class="text-justify font-default">Somos una empresa de alimentos o cocina económica llamada Cocinas Aurora ubicada en Durango, Dgo. La cual presta sus servicios desde 1985. Contamos con diferentes menús a lo largo de la semana con una comida tradicional para llegar día a día a su mesa; con calidad, amor e higine. Brindamos comida a domicilio.</h5>
                        </div>
                        <div class="offset-top-50 offset-xl-top-60">
                          <a title="cocina economica menu de la semana" href="https://cocinas-aurora.herokuapp.com/#menus" class="btn btn-primary">Ver menús</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Menús de la semana -->
      <section id="menus" class="seccion">
        <div class="shell-wide section-70 section-md-114">
          <h2 class="text-bold view-animate fadeInUpSmall delay-04">Menú de la semana</h2>
          <hr class="divider bg-madison view-animate fadeInUpSmall delay-06">
          <div class="range offset-top-60 range-xs-center">
            <div class="cell-sm-4 cell-md-4 cell-xl-3">
              <article class="post-event view-animate fadeInRightSm delay-08">
                <div class="post-event-img-overlay">
                  <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_lunes.jpg" alt="Menu semanal del día Lunes" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a title="cocina economica comida del dia lunes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes" class="menu-semana__dia btn btn-default">LUNES</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[1] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">                      
                      <?php 
                        if ($diaHoy == $dias[1]) {                                   
                          if($horacompleta < $aperturaLBD || $horacompleta >= $cierreLBD){ 
                      ?> 
                        <h6 class="text-rojo-oscuro">
                          Horario - Cerrado                              
                      <?php 
                        }else{ 
                      ?> 
                        <h6 class="text-rojo">
                          Horario -
                          <span class="text-success">
                            Abierto
                          </span>
                      <?php 
                          }
                        }else{
                      ?>
                          <h6 class="text-rojo">
                            Horario
                      <?php
                        }
                      ?>
                        </h6>
                        <ul class="list-inline list-inline-xs">
                          <li>
                            <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo"></span>
                            <span class="horario inset-left-10 text-black text-middle">
                              De <?php 
                                    $aperturaL = new DateTime($apertura_lunes);
                                    echo $aperturaL->format('h:ia');
                                  ?>
                              a   <?php 
                                    $cierreL = new DateTime($cierre_lunes);
                                    echo $cierreL->format('h:ia');
                                  ?>
                            </span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="cell-sm-4 cell-md-4 cell-xl-3 offset-top-50 offset-sm-top-0">
              <article class="post-event view-animate fadeInRightSm delay-06">
                <div class="post-event-img-overlay"><img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_martes.jpg" alt="Menu semanal del día Martes" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a title="cocina economica comida del dia martes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes" class="menu-semana__dia btn btn-default">MARTES</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[2] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">                      
                      <?php 
                        if ($diaHoy == $dias[2]) {                                   
                          if($horacompleta < $aperturaMBD || $horacompleta >= $cierreMBD){ 
                      ?> 
                        <h6 class="text-rojo-oscuro">
                          Horario - Cerrado
                      <?php 
                        }else{ 
                      ?> 
                        <h6 class="text-rojo">
                          Horario -
                          <span class="text-success">
                            Abierto
                          </span>
                      <?php 
                          }
                        }else{
                      ?>
                          <h6 class="text-rojo">
                            Horario
                      <?php
                        }
                      ?>
                        </h6>
                        <ul class="list-inline list-inline-xs">
                          <li>
                            <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo"></span>
                            <span class="horario inset-left-10 text-black text-middle">
                              De <?php 
                                    $aperturaM = new DateTime($apertura_martes);
                                    echo $aperturaM->format('h:ia');
                                  ?>
                              a   <?php 
                                    $cierreM = new DateTime($cierre_martes);
                                    echo $cierreM->format('h:ia');
                                  ?>
                            </span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="cell-sm-4 cell-md-4 cell-xl-3 offset-top-50 offset-sm-top-0">
              <article class="post-event view-animate fadeInLeftSm delay-06">
                <div class="post-event-img-overlay"><img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_miercoles.jpg" alt="Menu semanal del día Miercoles" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a title="cocina economica comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles" class="menu-semana__dia btn btn-default">MIERCOLES</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[3] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">                      
                      <?php 
                        if ($diaHoy == $dias[3]) {                                   
                          if($horacompleta < $aperturaMiBD || $horacompleta >= $cierreMiBD){ 
                      ?> 
                        <h6 class="text-rojo-oscuro">
                          Horario - Cerrado                              
                      <?php 
                        }else{ 
                      ?> 
                        <h6 class="text-rojo">
                          Horario -
                          <span class="text-success">
                            Abierto
                          </span>
                      <?php 
                          }
                        }else{
                      ?>
                          <h6 class="text-rojo">
                            Horario
                      <?php
                        }
                      ?>
                        </h6>
                        <ul class="list-inline list-inline-xs">
                          <li>
                            <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo"></span>
                            <span class="horario inset-left-10 text-black text-middle">
                              De <?php 
                                    $aperturaMi = new DateTime($apertura_miercoles);
                                    echo $aperturaMi->format('h:ia');
                                  ?>
                              a   <?php 
                                    $cierreMi = new DateTime($cierre_miercoles);
                                    echo $cierreMi->format('h:ia');
                                  ?>
                            </span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="cell-sm-4 cell-md-4 cell-xl-3 offset-top-50 offset-xl-top-0">
              <article class="post-event view-animate fadeInLeftSm delay-08">
                <div class="post-event-img-overlay"><img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_jueves.jpg" alt="Menu semanal del día Jueves" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a title="cocina economica comida del dia jueves" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves" class="menu-semana__dia btn btn-default">JUEVES</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[4] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">                      
                      <?php 
                        if ($diaHoy == $dias[4]) {                                   
                          if($horacompleta < $aperturaJBD || $horacompleta >= $cierreJBD){ 
                      ?> 
                        <h6 class="text-rojo-oscuro">
                          Horario - Cerrado                              
                      <?php 
                        }else{ 
                      ?> 
                        <h6 class="text-rojo">
                          Horario -
                          <span class="text-success">
                            Abierto
                          </span>
                      <?php 
                          }
                        }else{
                      ?>
                          <h6 class="text-rojo">
                            Horario
                      <?php
                        }
                      ?>
                        </h6>
                        <ul class="list-inline list-inline-xs">
                          <li>
                            <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo"></span>
                            <span class="horario inset-left-10 text-black text-middle">
                              De <?php 
                                    $aperturaJ = new DateTime($apertura_jueves);
                                    echo $aperturaJ->format('h:ia');
                                  ?>
                              a   <?php 
                                    $cierreJ = new DateTime($cierre_jueves);
                                    echo $cierreJ->format('h:ia');
                                  ?>
                            </span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="cell-sm-4 cell-md-4 cell-xl-3 offset-top-50 offset-xl-top-0">
              <article class="post-event view-animate fadeInLeftSm delay-08">
                <div class="post-event-img-overlay"><img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_viernes.jpg" alt="Menu semanal del día Viernes" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a title="cocina economica comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes" class="menu-semana__dia btn btn-default">VIERNES</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[5] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">                      
                      <?php 
                        if ($diaHoy == $dias[5]) {                                   
                          if($horacompleta < $aperturaVBD || $horacompleta >= $cierreVBD){ 
                      ?> 
                        <h6 class="text-rojo-oscuro">
                          Horario - Cerrado                              
                      <?php 
                        }else{ 
                      ?> 
                        <h6 class="text-rojo">
                          Horario -
                          <span class="text-success">
                            Abierto
                          </span>
                      <?php 
                          }
                        }else{
                      ?>
                          <h6 class="text-rojo">
                            Horario
                      <?php
                        }
                      ?>
                        </h6>
                        <ul class="list-inline list-inline-xs">
                          <li>
                            <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo"></span>
                            <span class="horario inset-left-10 text-black text-middle">
                              De <?php 
                                    $aperturaV = new DateTime($apertura_viernes);
                                    echo $aperturaV->format('h:ia');
                                  ?>
                              a   <?php 
                                    $cierreV = new DateTime($cierre_viernes);
                                    echo $cierreV->format('h:ia');
                                  ?>
                            </span>
                          </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div class="cell-sm-4 cell-md-4 cell-xl-3 offset-top-50 offset-xl-top-0">
              <article class="post-event view-animate fadeInLeftSm delay-08">
                <div class="post-event-img-overlay">
                  <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/menu_semanal_sabado_domingo.jpg" alt="Menu semanal de los dias Sábados y Domingos" class="img-responsive img_dia_index">
                  <div class="post-event-overlay context-dark">
                    <a id="sb" href="#" class="menu-semana__dia btn btn-default">SÁBADO / DOMINGO</a>
                  </div>
                </div>
                <div class="unit unit-lg unit-lg-horizontal">
                  <div class="unit-left">
                    <div class="post-event-meta text-center">
                      <div class="h3 text-bold reveal-inline-block reveal-lg-block"><?php echo $dias[6] ?> Y <?php echo $dias[7] ?></div>
                      <p class="reveal-inline-block reveal-lg-block">de <?php echo $meses[$mes] ?></p>
                      <span class="text-bold reveal-inline-block reveal-lg-block inset-left-0 inset-lg-left-0"><?php echo $anio ?></span>
                    </div>
                  </div>
                  <div class="unit-body">
                    <div class="post-event-body text-lg-left">
                      <h6 class="text-rojo-oscuro">Horario</h6>
                      <ul class="list-inline list-inline-xs">
                        <li>
                          <span class="icon icon-xxs mdi fa-clock-o text-middle text-rojo-oscuro"></span>
                          <span class="inset-left-10 text-bold text-rojo-oscuro text-middle">CERRADO</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>

      <!-- Descargar APP -->
      <section id="app" class="bg-catskill">
        <div class="shell section-70 section-md-114">
          <h2 class="text-bold view-animate fadeInUpSmall delay-04">Descargar App</h2>
          <hr class="divider bg-madison view-animate fadeInUpSmall delay-06">
          <div class="range offset-top-60 text-left range-xs-center">
            <div class="cell-md-5">
              <div class="range">
                <div class="cell-sm-12 cell-md-12 offset-md-top-30">
                  <article class="post-news post-news-mod-1 view-animate fadeInRightSm delay-1">
                    <a title="Cocinas Aurora descargar aplicacion android" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.apk" download="cocinas_aurora_app.apk">
                      <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/descargar_para_android.png" width="370" height="240" alt="Imágen de Android para descargar" class="img-responsive img-fullwidth">
                    </a>
                    <div class="post-news-body">
                      <h6><a title="Cocinas Aurora descargar aplicacion android" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.apk" download="cocinas_aurora_app.apk">Descargar para Android</a></h6>
                      <div class="offset-top-20">
                        <p>Desde tu celular puedes descargar nuestra aplicación para Android.</p>
                      </div>
                      <div class="post-news-meta offset-top-20">
                        <span class="icon icon-xs mdi fa-android text-middle text-madison"></span>
                        <span class="text-middle inset-left-10 text-italic text-black"><a title="Cocinas Aurora descargar aplicacion android" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.apk" download="cocinas_aurora_app.apk">click aquí</a></span>
                      </div>
                      <div class="post-news-meta offset-top-10 androidQR">
                        <span class="icon icon-xs mdi mdi-qrcode-scan text-middle text-madison"></span>
                        <span class="text-middle inset-left-10 text-italic text-black"><a title="Cocinas Aurora descargar aplicacion android" href="#" id="AndroidQRModalAbrir">escanear código QR para Android</a></span>
                      </div>
                    </div>
                  </article>
                </div>
              </div>
            </div>
            <div class="cell-md-5 offset-top-30 offset-md-top-0">
              <div class="range">                
                <div class="cell-sm-12 cell-md-12 offset-md-top-30">
                  <article class="post-news post-news-mod-1 view-animate fadeInUpSmall delay-08">
                    <a title="descargar aplicacion IOS" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.ipa" download="cocinas_aurora_app.ipa">
                      <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/descargar_para_ios.png" width="370" height="240" alt="Imágen de IOS para descargar" class="img-responsive img-fullwidth">
                    </a>
                    <div class="post-news-body">
                      <h6><a title="descargar aplicacion IOS" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.ipa" download="cocinas_aurora_app.ipa">Descargar para IOS</a></h6>
                      <div class="offset-top-20">
                        <p>Desde tu celular puedes descargar nuestra aplicación para IOS.</p>
                      </div>
                      <div class="post-news-meta offset-top-20">
                        <span class="icon icon-xs mdi fa-apple text-middle text-madison"></span>
                        <span class="text-middle inset-left-10 text-italic text-black"><a title="descargar aplicacion IOS" href="https://cocinas-aurora.herokuapp.com/app/cocinas_aurora_app.ipa" download="cocinas_aurora_app.ipa">click aquí</a></span>
                      </div>
                      <div class="post-news-meta offset-top-10 IOSQR">
                        <span class="icon icon-xs mdi mdi-qrcode-scan text-middle text-madison"></span>
                        <span class="text-middle inset-left-10 text-italic text-black"><a title="descargar aplicacion IOS" href="#" id="IOSQRModalAbrir">escanear código QR para IOS</a></span>
                      </div>
                    </div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Porciones de produto -->
      <section id="porciones" class="seccion">
        <div class="shell section-70 section-md-114">
          <h2 class="text-bold view-animate fadeInRightSm delay-04">Porciones</h2>
          <hr class="divider bg-madison view-animate fadeInRightSm delay-06">
          <div class="offset-top-35 offset-md-top-60 view-animate fadeInRightSm offset-bottom-70 delay-08">
            Diferentes porciones que se le ofrecen de nuestras comidas del día
          </div>
          <div class="range range-xs-center range-md-left offset-top-70 counters">
            <div class="cell-sm-6 cell-md-3">
              <div class="unit unit-vertical unit-spacing-xs view-animate zoomInSmall delay-04">
                <div class="unit-left">
                  <img loading="lazy" width="120px" height="110px" src="https://cocinas-aurora.herokuapp.com/images/comida_porcion_cuarto.png" alt="Comida por pocion de un cuarto"/>
                  <img loading="lazy" width="120px" height="110px" src="https://cocinas-aurora.herokuapp.com/images/comida_porcion_cuarto_charola.png" alt="Comida por pocion de un cuarto de orden"/>
                </div>
                <div class="unit-body">
                  <h6 class="text-bold">1/4</h6>
                </div>
              </div>
            </div>
            <div class="cell-sm-6 cell-md-3 offset-top-65 offset-sm-top-0">
              <div class="unit unit-vertical unit-spacing-xs view-animate zoomInSmall delay-06">
                <div class="unit-left">
                  <img loading="lazy" width="120px" height="110px" src="https://cocinas-aurora.herokuapp.com/images/comida_porcion_medio.png" alt="Comida por pocion de un medio"/>                  
                </div>
                <div class="unit-body">
                  <h6 class="text-bold">1/2</h6>
                </div>
              </div>
            </div>
            <div class="cell-sm-6 cell-md-3 offset-top-65 offset-md-top-0">
              <div class="unit unit-vertical unit-spacing-xs view-animate zoomInSmall delay-08">
                <div class="unit-left">
                  <img loading="lazy" width="120px" height="110px" src="https://cocinas-aurora.herokuapp.com/images/comida_porcion_litro.png" alt="Comida por pocion de un litro"/>
                </div>
                <div class="unit-body">
                  <h6 class="text-bold">1 Litro</h6>
                </div>
              </div>
            </div>
            <div class="cell-sm-6 cell-md-3 offset-top-65 offset-md-top-0">
              <div class="unit unit-vertical unit-spacing-xs view-animate zoomInSmall delay-1">
                <div class="unit-left">
                  <img loading="lazy" width="120px" height="110px" src="https://cocinas-aurora.herokuapp.com/images/comida_porcion_orden.png" alt="Comida por pocion de una orden"/>
                </div>
                <div class="unit-body">
                  <h6 class="text-bold">Orden</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Ven a visitarnos -->
      <section id="visitanos" class="seccion bg-catskill">
        <div class="shell section-70 section-md-114">
          <h2 class="text-bold view-animate fadeInRightSm delay-04">Ven a visitarnos</h2>
          <hr class="divider bg-madison view-animate fadeInRightSm delay-06">
          <div class="offset-top-35 offset-md-top-60 view-animate fadeInRightSm offset-bottom-70 delay-08">
            Ven a conocernos en Cocinas Aurora, la mejor cocina económica de Durango
          </div>
          <div class="contenedor offset-top-70 view-animate fadeInUpSmall delay-08">
            <ul id="autoWidth" class="cs-hidden">                
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_1.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_2.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_3.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_4.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/comida_del_dia_cocina_economica_cocinas_aurora_1.jpg" alt="Foto de la comida del día de cocina económica Cocinas Aurora">
                  </div>
                </li>                
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/comida_del_dia_cocina_economica_cocinas_aurora_2.jpg" alt="Foto de la comida del día de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/comida_del_dia_cocina_economica_cocinas_aurora_3.jpg" alt="Foto de la comida del día de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_5.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_6.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
                <li class="item-a">
                  <div class="boxing">
                    <img class="model" loading="lazy" src="https://cocinas-aurora.herokuapp.com/images/ubicacion_cocina_economica_cocinas_aurora_7.jpg" alt="Foto del establecimiento de cocina económica Cocinas Aurora">
                  </div>
                </li>
            </ul>
          </div>
        </div>
      </section>

      <!-- informacion de contácto-->
      <section id="contactanos" class="contacto section-image-aside section-image-aside-left text-sm-left offset-top-70 seccion">
        <div class="shell">
          <div class="range range-xs-center range-lg-right offset-top-70">
            <div class="cell-xs-12 cell-lg-4">
              <div class="section-image-aside-body section-70 section-md-114 section-md-bottom-100">
                <div class="range">
                  <div class="cell-sm-6 cell-lg-12">
                    <h6 class="text-bold">Contáctanos en Cocinas Aurora</h6>
                    <div class="text-subline"></div>
                    <div class="offset-top-30">
                      <ul class="list-unstyled contact-info list">
                        <li>
                          <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                            <div class="unit-left">
                              <span class="icon mdi mdi-phone text-middle icon-xs text-madison"></span>
                            </div>
                            <div class="unit-body"><a title="contáctanos por nuestro número" rel="nofollow" href="tel:6188127776" class="text-dark">Pedidos al 618-812-77-76</a></div>
                          </div>
                        </li>
                        <li class="offset-top-15">
                          <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                            <div class="unit-left">
                              <span class="icon mdi mdi-map-marker text-middle icon-xs text-madison"></span>
                            </div>
                            <div class="unit-body text-left">
                              <a rel="nofollow" title="contáctanos viniendo a nuestro establecimiento" href="https://www.google.com/maps/place/Cocinas+Aurora/@24.015187,-104.667593,20z/data=!4m5!3m4!1s0x0:0x2737e01c60bf9463!8m2!3d24.0152178!4d-104.6675796?hl=es" target="_blank" class="text-dark">
                                Juan E. García #1117 C.P 34139, Victoria de Durango, Durango, México</a>
                            </div>
                          </div>
                        </li>
                        <li class="offset-top-15">
                          <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                            <div class="unit-left">
                              <span class="icon mdi mdi-email-open text-middle icon-xs text-madison"></span>
                            </div>
                            <div class="unit-body">
                              <a rel="nofollow" title="contáctanos enviando un email" href="mailto:cocinaaurora@gmail.com" class="text-dark">cocinaaurora@gmail.com</a>
                            </div>
                          </div>
                        </li>
                        <li class="offset-top-15">
                          <div class="unit unit-horizontal unit-middle unit-spacing-xs">
                            <div class="unit-left">
                              <span class="icon mdi mdi-email-open text-middle icon-xs text-madison"></span>
                            </div>
                            <div class="unit-body">
                              <a rel="nofollow" title="contáctanos enviando un email" href="mailto:cocinasaurora@gmail.com" class="text-dark">cocinasaurora@gmail.com</a>
                            </div>
                          </div>
                        </li>                                              
                      </ul>
                    </div>
                    <div class="offset-top-25 text-left redessociales__contactanos">
                      <ul class="list-inline list-inline-sm list-inline-madison">
                        <li><a rel="nofollow" title="contáctanos visitando nuestro facebook" href="https://www.facebook.com/Cocina-Aurora-105747607811097" target="_blank" class="icon icon-xxs fa-facebook icon-rect icon-gray-light-filled"></a></li>
                        <li><a rel="nofollow" title="contáctanos enviando mensaje por whatsapp" href="https://wa.me/526188127776?text=Me%20interesa%20algo%20del%20menú" target="_blank" class="icon icon-xxs fa-whatsapp icon-rect icon-gray-light-filled"></a></li>                        
                      </ul>
                    </div>
                    <div class="offset-top-25 unit unit-horizontal unit-middle unit-spacing-xs">
                      <div class="unit-body">
                        <div class="rw-ui-container"></div>
                        <div>
                          <span class="icon mdi mdi-tooltip-edit text-middle icon-xs text-madison"></span>
                          <a rel="nofollow" title="Escribe una opinión" href="https://bit.ly/3mb1Ek4" target="_blank" class="text-dark">Escribe una opinión</a>                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="section-image-aside-map offset-top-60">
          <!-- RD Google Map-->
          <div class="mapa range range-xs-center rd-google-map rd-map-index">
            <iframe class="mapaIframe cell-xs-12 cell-sm-10 cell-md-12" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d361.5751639876831!2d-104.6677527974883!3d24.015218679783057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x869bc81afdeb4df3%3A0x2737e01c60bf9463!2sCocinas%20Aurora!5e0!3m2!1ses!2smx!4v1621566378680!5m2!1ses!2smx" style="border:0;" allowfullscreen="" width="100%" height="450px" loading="lazy" defer async></iframe>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer-->
    <footer class="page-footer offset-top-25">
      <div class="bg-madison context-dark">
        <div class="shell text-md-left section-15">
          <p>&copy;<span id="copyright-year"></span> Hecho por Cocinas Aurora. Todos los derechos reservados. <a rel="nofollow" title="politica de privacidad" href="https://cocinas-aurora.herokuapp.com/privacidad" style="color: #000; text-decoration: underline">Política de privacidad.</a></p>
        </div>
      </div>
    </footer>
  </div>

  <!-- Modal para Android -->
  <div id="AndroidQRModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2 class="h2_modal">Código QR para Android</h2>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">
          <p>Escanea nuestro código QR con tu celular Android para descargar nuestra app:</p>
          <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/app/qr_appAndroid.png" alt="Imágen de Android para descargar" class="img-responsive" style="width: 100%; height: 100%">
				</div>
			</div>
		</div>
	</div>

  <!-- Modal para IOS -->
  <div id="IOSQRModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
          <h2 class="h2_modal">Código QR para IOS</h2>
					<span class="close2" id="close2">&times;</span>
				</div>
				<div class="modal-body">
          <p>Escanea nuestro código QR con tu celular IOS para descargar nuestra app:</p>
          <img loading="lazy" src="https://cocinas-aurora.herokuapp.com/app/qr_appIOS.png" alt="Imágen de IOS para descargar" class="img-responsive" style="width: 100%; height: 100%">
				</div>
			</div>
		</div>
	</div>

  <!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/sweetalert.js" async></script>
  <!-- Java script subirla al head -->
  <script src="./js/core.min.js"></script>
  <!--Jquery-->
  <script src="./js/lightslider.js" async></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
  <script>
    document.oncontextmenu = function(){
        return false
    }
    document.onkeydown = function(){
        return false
    }
  </script>
  <script src="https://cocinas-aurora.herokuapp.com/js/activeIndicador.js" async></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>
  <script src="./main.js" defer></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/modal.js" async></script>
  <script type="text/javascript" defer>
    (function(d, t, e, m){
      window.RW_Async_Init = function(){
        RW.init({
            huid: "478356",
            uid: "106251638fe01b3eb2fb07142bbd6ae7",
            source: "website",
            options: {
                "advanced": {
                    "font": {
                        "hover": {
                            "color": "#E17000"
                        },
                        "italic": true,
                        "color": "#E17000",
                        "type": "\"Comic Sans MS\""
                    },
                    "text": {
                        "rateThis": "Calificar sitio web"
                    }
                },
                "size": "medium",
                "label": {
                    "background": "#FACDAA"
                },
                "lng": "es",
                "style": "crystal",
                "isDummy": false
            } 
        });
        RW.render();
    };
        // Append Rating-Widget JavaScript library.
    var rw, s = d.getElementsByTagName(e)[0], id = "rw-js",
        l = d.location, ck = "Y" + t.getFullYear() + 
        "M" + t.getMonth() + "D" + t.getDate(), p = l.protocol,
        f = ((l.search.indexOf("DBG=") > -1) ? "" : ".min"),
        a = ("https:" == p ? "secure." + m + "js/" : "js." + m);
    if (d.getElementById(id)) return;              
    rw = d.createElement(e);
    rw.id = id; rw.async = true; rw.type = "text/javascript";
    rw.src = p + "//" + a + "external" + f + ".js?ck=" + ck;
    s.parentNode.insertBefore(rw, s);
    }(document, new Date(), "script", "rating-widget.com/"));
  </script>
</body>

</html>

<?php
  }
?>