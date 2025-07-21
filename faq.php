<?php
  session_start();
  require_once 'vendor/autoload.php';

  if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){
      header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
  }else{

?>


<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://cocinas-aurora.herokuapp.com/images/favicon.png" type="image/x-icon">
	<!-- Estilos -->	
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/css/style.css">
	<link rel="stylesheet" href="https://cocinas-aurora.herokuapp.com/css/darkmode.css">
	<style>
		.enlace_asistencia{
			text-decoration: underline !important;
		}
	</style>
	<title> ❤️ FAQ | Cocinas Aurora ❤️ </title>
	<meta name="description" content="En cocina economica cocinas aurora🧡 tenemos las respuestas a las preguntas mas frecuentes que te haces📝, puedes entrar y enterarte de que es lo más común que la gente se pregunta sobre nuestro negocio y cual es nuestra respuesta✅. Esta separado en secciones para darte una mejor visión de estas preguntas, no te quedes sin respuesta y si no estas conforme, envianos un mensaje por medio de nuestro formulario👨‍💻👩‍💻.">
	<script type="application/ld+json">
		{
		"@context": "https://schema.org",
		"@type": "FAQPage",
		"mainEntity": [{
			"@type": "Question",
			"name": "¿Qué métodos de pago tienen?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Contamos con dos principales métodos de pago, los cuales son en efectivo y cualquier tipo de tarjeta."
			}
		},{
			"@type": "Question",
			"name": "¿Qué tipo de moneda aceptan?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Por el momento solo aceptamos moneda nacional."
			}
		},{
			"@type": "Question",
			"name": "¿Puedo realizar algún pedido?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Claro, lo puede realizar llamando a este número: 618 812 77 76 o vía: Whatsapp."
			}
		},{
			"@type": "Question",
			"name": "¿Tienen entregas a domicilio?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Así es, contamos con un servicio externo, al cual se le marca cuando se solicita un servicio a domicilio."
			}
		},{
			"@type": "Question",
			"name": "¿Cuánto tiempo tardan en entregar la comida?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Se tarda aproximadamente 25 a 30 minutos o dependiendo el clima del día."
			}
		},{
			"@type": "Question",
			"name": "¿Los envíos tiene costo extra?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Se hace una valoración de donde se encuentra el cliente y dependiendo de su ubicación es el cobro del servicio."
			}
		},{
			"@type": "Question",
			"name": "¿Cuentan con política de privacidad?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Si, contamos con una política de privacidad sobre nuestro sitio web y aplicación móvil que puedes ver desde aquí."
			}
		},{
			"@type": "Question",
			"name": "¿Cómo puedo saber si son confiables?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Contamos con certificado web SSL, que Google nos certifica como sitio web confiable y seguro para poder navegar en él. Puedes encontrar más información de este certificado aquí."
			}
		},{
			"@type": "Question",
			"name": "¿Qué pasa con mis datos personales?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Tus datos personales son guardados y almacenados en nuestra Base de Datos para poder estar en contacto contigo. Recuerda que contamos con certificado SSL y este nos ayuda a que tu información viaje segura a nuestros servidores."
			}
		},{
			"@type": "Question",
			"name": "¿Cuentan con algún certificado de sanidad?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Si, contamos con el certificado NOM 256 SSA1 2012, la cual valida nuestros productos con la norma de sanidad. Puedes encontrar más información de este certificado aquí."
			}
		},{
			"@type": "Question",
			"name": "¿Cuales son sus protocolos de sanidad?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Uso de cubrebocas obligatorio para los clientes y personal.
		Desinfectarse las manos.
		Vinil para que los clientes no tengan contacto con la comida.
		La persona que cobra no toca en ningún momento la comida."
			}
		},{
			"@type": "Question",
			"name": "¿Su personal es limpio en su área de trabajo?",
			"acceptedAnswer": {
			"@type": "Answer",
			"text": "Cada uno tiene su área de trabajo y cada cierto tiempo la limpian y desinfectan."
			}
		}]
		}
	</script>
</head>

<body>
	
	<div class="page" id="asistencia">
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
					<nav data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
					data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-lg-stick-up="false"
					data-lg-hover-on="false" class="rd-navbar rd-navbar-humburger-menu" data-auto-height="false">
					<div class="rd-navbar-inner">
						<div class="rd-navbar-panel">
						<button title="Menú de navegación" data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
						<h4 class="panel-title veil-md"><a href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
						</div>
						<div class="rd-navbar-menu-wrap clearfix">
						<div class="rd-navbar-nav-wrap">
							<div class="rd-navbar-mobile-scroll">
							<div class="rd-navbar-mobile-header-wrap">
								<div class="rd-navbar-mobile-brand">
									<a href="https://cocinas-aurora.herokuapp.com/"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></a>
								</div>
							</div>
							<ul class="rd-navbar-nav">
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Inicio</a>
								</li>
								<li>
								<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#menus">Menú de la semana</a>
								<ul class="rd-navbar-dropdown">
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Lunes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Martes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Miercoles</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Jueves</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Viernes</a>
									</li>
								</ul>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#app" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Descargar APP</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#porciones" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Porciones</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#visitanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Ven a visitarnos</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#contactanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Contáctanos</a>
								</li>
								<li class="active">
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/faq" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">FAQ</a>
								</li>
								<li>
									<a href="#" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;"><?php echo $nombres.' '.$apellidos ?></a>
								<ul class="rd-navbar-dropdown">
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/perfil" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Perfil</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/php/cerrar_sesion" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Cerrar Sesión</a>
									</li>                 
								</ul>
								</li>
								<li>
									<button class="switch align-items-center" id="switch">
										<span><i class="fas fa-moon"></i></span>
										<span><i class="fas fa-sun"></i></span>
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
				<section class="navBars section-32 position-absolute veil reveal-md-block">
					<div class="shell-wide">
					<div class="range range-sm-justify range-sm-middle">
						<div class="cell-md-4 cell-lg-3">
						<!--Navbar Brand-->
						<div class="rd-navbar-brand text-left"><a href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
							<div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
								<div class="unit-left"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></div>
								<div class="unit-body text-xl-left">
								<div>
									<div class="h6 barnd-name text-bold" style="font-family: Merriweather, sans-serif !important; font-size: 18px;">Cocinas Aurora</div>
								</div>
								<div>
									<div class="brand-slogan text-italic font-accent text-base" style="font-family: Open Sans, sans-serif !important;">Comida con amor</div>
								</div>
								</div>
							</div>
							</a></div>
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
						<h4 class="panel-title veil-md"><a href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
						</div>
						<div class="rd-navbar-menu-wrap clearfix">
						<div class="rd-navbar-nav-wrap">
							<div class="rd-navbar-mobile-scroll">
							<div class="rd-navbar-mobile-header-wrap">
								<div class="rd-navbar-mobile-brand">
									<a href="https://cocinas-aurora.herokuapp.com/"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></a>
								</div>
							</div>
							<ul class="rd-navbar-nav">
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;"">Inicio</a>
								</li>
								<li>
								<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#menus">Menú de la semana</a>
								<ul class="rd-navbar-dropdown">
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Lunes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Martes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Miercoles</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Jueves</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Viernes</a>
									</li>
								</ul>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#app" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Descargar APP</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#porciones" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Porciones</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#visitanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Ven a visitarnos</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#contactanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Contáctanos</a>
								</li>
								<li class="active">
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/faq" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">FAQ</a>
								</li>
								<li>
									<a href="#" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;"><?php echo $_SESSION["usuarioSocial"]["first_name"].' '.$_SESSION["usuarioSocial"]["last_name"] ?></a>
								<ul class="rd-navbar-dropdown">
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/perfil" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Perfil</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/php/cerrar_sesion" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Cerrar Sesión</a>
									</li>                 
								</ul>
								</li>
								<li>
									<button class="switch align-items-center" id="switch">
										<span><i class="fas fa-moon"></i></span>
										<span><i class="fas fa-sun"></i></span>
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
				<section class="navBars section-32 position-absolute veil reveal-md-block">
					<div class="shell-wide">
					<div class="range range-sm-justify range-sm-middle">
						<div class="cell-md-4 cell-lg-3">
						<!--Navbar Brand-->
						<div class="rd-navbar-brand text-left"><a href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
							<div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
								<div class="unit-left"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></div>
								<div class="unit-body text-xl-left">
								<div>
									<div class="h6 barnd-name text-bold" style="font-family: Merriweather, sans-serif !important; font-size: 18px;">Cocinas Aurora</div>
								</div>
								<div>
									<div class="brand-slogan text-italic font-accent text-base" style="font-family: Open Sans, sans-serif !important;">Comida con amor</div>
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
						<h4 class="panel-title veil-md"><a href="https://cocinas-aurora.herokuapp.com/">Cocinas Aurora</a></h4>
						</div>
						<div class="rd-navbar-menu-wrap clearfix">
						<div class="rd-navbar-nav-wrap">
							<div class="rd-navbar-mobile-scroll">
							<div class="rd-navbar-mobile-header-wrap">
								<div class="rd-navbar-mobile-brand">
								<a href="https://cocinas-aurora.herokuapp.com/"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></a>
								</div>
							</div>
							<ul class="rd-navbar-nav">
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Inicio</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#menus" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Menú de la semana</a>
								<ul class="rd-navbar-dropdown">
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Lunes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Martes</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Miercoles</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Jueves</a>
									</li>
									<li>
										<a href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Viernes</a>
									</li>
								</ul>
								</li>
								<li>
								<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#app" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Descargar APP</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#porciones" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Porciones</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#visitanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Ven a visitarnos</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/#contactanos" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Contáctanos</a>
								</li>
								<li class="active">
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/faq" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">FAQ</a>
								</li>
								<li>
									<a class="menu_item" href="https://cocinas-aurora.herokuapp.com/login_register" style="font-size: 18px !important; font-weight: 700 !important; line-height: 1.2 !important; font-family: Open Sans !important;">Iniciar sesión</a>
								</li>
								<li>
								<button class="switch" id="switch">
									<span><i class="fas fa-moon"></i></span>
									<span><i class="fas fa-sun"></i></span>
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
				<section class="navBars section-32 position-absolute veil reveal-md-block">
					<div class="shell-wide">
					<div class="range range-sm-justify range-sm-middle">
						<div class="cell-md-4 cell-lg-3">
						<!--Navbar Brand-->
						<div class="rd-navbar-brand text-left"><a href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
							<div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
								<div class="unit-left"><img width='89' height='89' src='https://cocinas-aurora.herokuapp.com/images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></div>
								<div class="unit-body text-xl-left">
								<div>
									<div class="h6 barnd-name text-bold" style="font-family: Open Sans, sans-serif !important; font-size: 18px;">Cocinas Aurora</div>
								</div>
								<div>
									<div class="brand-slogan text-italic font-accent text-base" style="font-family: Open Sans, sans-serif !important;">Comida con amor</div>
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

		<main class="container">		
			<div class="row justify-content-center mt-2">
				<div id="asistencia-preguntas" class="col-12">
					<main class="main_asistencia">
						<h1 class="titulo">Preguntas Frecuentes</h1>
						<div class="categorias" id="categorias">
							<div class="categoria activa view-animate fadeInLeftSm delay-04" data-categoria="metodos-pago">
								<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z"/></svg>
								<p>Métodos de pago</p>
							</div>
							<div class="categoria view-animate fadeInUpSmall delay-06" data-categoria="entregas">
								<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M7 24h-5v-9h5v1.735c.638-.198 1.322-.495 1.765-.689.642-.28 1.259-.417 1.887-.417 1.214 0 2.205.499 4.303 1.205.64.214 1.076.716 1.175 1.306 1.124-.863 2.92-2.257 2.937-2.27.357-.284.773-.434 1.2-.434.952 0 1.751.763 1.751 1.708 0 .49-.219.977-.627 1.356-1.378 1.28-2.445 2.233-3.387 3.074-.56.501-1.066.952-1.548 1.393-.749.687-1.518 1.006-2.421 1.006-.405 0-.832-.065-1.308-.2-2.773-.783-4.484-1.036-5.727-1.105v1.332zm-1-8h-3v7h3v-7zm1 5.664c2.092.118 4.405.696 5.999 1.147.817.231 1.761.354 2.782-.581 1.279-1.172 2.722-2.413 4.929-4.463.824-.765-.178-1.783-1.022-1.113 0 0-2.961 2.299-3.689 2.843-.379.285-.695.519-1.148.519-.107 0-.223-.013-.349-.042-.655-.151-1.883-.425-2.755-.701-.575-.183-.371-.993.268-.858.447.093 1.594.35 2.201.52 1.017.281 1.276-.867.422-1.152-.562-.19-.537-.198-1.889-.665-1.301-.451-2.214-.753-3.585-.156-.639.278-1.432.616-2.164.814v3.888zm3.79-19.913l3.21-1.751 7 3.86v7.677l-7 3.735-7-3.735v-7.719l3.784-2.064.002-.005.004.002zm2.71 6.015l-5.5-2.864v6.035l5.5 2.935v-6.106zm1 .001v6.105l5.5-2.935v-6l-5.5 2.83zm1.77-2.035l-5.47-2.848-2.202 1.202 5.404 2.813 2.268-1.167zm-4.412-3.425l5.501 2.864 2.042-1.051-5.404-2.979-2.139 1.166z"/></svg>
								<p>Pedidos</p>
							</div>
							<div class="categoria view-animate zoomInSmall delay-08" data-categoria="seguridad">
								<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 0c-3.371 2.866-5.484 3-9 3v11.535c0 4.603 3.203 5.804 9 9.465 5.797-3.661 9-4.862 9-9.465v-11.535c-3.516 0-5.629-.134-9-3zm0 1.292c2.942 2.31 5.12 2.655 8 2.701v10.542c0 3.891-2.638 4.943-8 8.284-5.375-3.35-8-4.414-8-8.284v-10.542c2.88-.046 5.058-.391 8-2.701zm5 7.739l-5.992 6.623-3.672-3.931.701-.683 3.008 3.184 5.227-5.878.728.685z"/></svg>
								<p>Seguridad</p>
							</div>
							<div class="categoria view-animate fadeInRightSm delay-1" data-categoria="cuenta">
								<svg viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M9.484 15.696l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm0-5l-.711-.696-2.552 2.607-1.539-1.452-.698.709 2.25 2.136 3.25-3.304zm10.516 11.304h-8v1h8v-1zm0-5h-8v1h8v-1zm0-5h-8v1h8v-1zm4-5h-24v20h24v-20zm-1 19h-22v-18h22v18z"/></svg>
								<p>Higiene</p>
							</div>
						</div>
						
						<!-- Preguntas -->
						<div class="preguntas">
							<!-- Preguntas Metodos de pago -->
							<div class="contenedor-preguntas activo" data-categoria="metodos-pago">
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-04">
									<p class="pregunta text-middle">¿Qué métodos de pago tienen? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Contamos con dos principales métodos de pago, los cuales son en efectivo y cualquier tipo de tarjeta.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-06">
									<p class="pregunta">¿Qué tipo de moneda aceptan? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Por el momento solo aceptamos moneda nacional.</p>
								</div>
							</div>
							<!-- Preguntas pedidos -->
							<div class="contenedor-preguntas" data-categoria="entregas">
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-04">
									<p class="pregunta">¿Puedo realizar algún pedido? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Claro, lo puede realizar llamando a este número: <a rel="nofollow" href="tel:6188127776">618 812 77 76</a> o vía: <a rel="nofollow" href="https://wa.me/526188127776?text=Me%20interesa%20algo%20del%20menú" target="_blank">Whatsapp</a>.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-06">
									<p class="pregunta">¿Tienen entregas a domicilio? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Así es, contamos con un servicio externo, al cual se le marca cuando se solicita un servicio a domicilio.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-08">
									<p class="pregunta">¿Cuánto tiempo tardan en entregar la comida? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Se tarda aproximadamente 25 a 30 minutos o dependiendo el clima del día.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-1">
									<p class="pregunta">¿Los envíos tiene costo extra? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Se hace una valoración de donde se encuentra el cliente y dependiendo de su ubicación es el cobro del servicio.</p>
								</div>
							</div>
							<!-- Preguntas Seguridad -->
							<div class="contenedor-preguntas" data-categoria="seguridad">
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-04">
									<p class="pregunta">¿Cuentan con política de privacidad? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Si, contamos con una política de privacidad sobre nuestro sitio web y aplicación móvil que puedes ver desde <a rel="nofollow" href="https://cocinas-aurora.herokuapp.com/privacidad" target="_blank" style="text-decoration: underline;">aquí</a>.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-06">
									<p class="pregunta">¿Cómo puedo saber si son confiables? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Contamos con certificado web SSL, que Google nos certifica como sitio web confiable y seguro para poder navegar en él. Puedes encontrar más información de este certificado <a rel="nofollow" href="https://www.websecurity.digicert.com/es/es/security-topics/what-is-ssl-tls-https" target="_blank" style="text-decoration: underline;">aquí</a>.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-08">
									<p class="pregunta">¿Qué pasa con mis datos personales? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Tus datos personales son guardados y almacenados en nuestra Base de Datos para poder estar en contacto contigo. Recuerda que contamos con certificado SSL y este nos ayuda a que tu información viaje segura a nuestros servidores.</p>
								</div>
							</div>
							<!-- Preguntas Higiene -->
							<div class="contenedor-preguntas" data-categoria="cuenta">
								<div class="contenedor-pregunta view-animate fadeInLeftSm delay-04">
									<p class="pregunta">¿Cuentan con algún certificado de sanidad? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Si, contamos con el certificado NOM 256 SSA1 2012, la cual valida nuestros productos con la norma de sanidad. Puedes encontrar más información de este certificado <a rel="nofollow" href="https://dof.gob.mx/nota_detalle.php?codigo=5286029&fecha=29/01/2013" target="_blank" style="text-decoration: underline;">aquí</a>.</p>
								</div>
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-06">
									<p class="pregunta">¿Cuales son sus protocolos de sanidad? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
										<ul class="respuesta">
											<li>Uso de cubrebocas obligatorio para los clientes y personal.</li>
											<li>Desinfectarse las manos.</li>
											<li>Vínil para que los clientes no tengan contacto con la comida.</li>
											<li>La persona que cobra no toca en ningún momento la comida.</li>
										</ul>
								</div>								
								<div class="contenedor-pregunta view-animate fadeInRightSm delay-1">
									<p class="pregunta">¿Su personal es limpio en su área de trabajo? <img src="https://cocinas-aurora.herokuapp.com/images/suma.svg" alt="Abrir Respuesta" /></p>
									<p class="respuesta">Cada uno tiene su área de trabajo y cada cierto tiempo la limpian y desinfectan.</p>
								</div>								
							</div>
						</div>
					</main>
				</div>
				<section class="section-70 section-md-114">
					<div class="shell">
						<div class="range range-xs-center">
							<div class="cell-xs-10 cell-md-8 text-md-left">
								<h2 class="text-bold view-animate view-animate zoomInSmall delay-04" style="font-family: Roboto, san-serif !important">Ponte en contacto</h2>
								<hr class="divider bg-madison hr-sm-left-0 view-animate view-animate zoomInSmall delay-04">
								<div class="offset-top-30 offset-md-top-60 view-animate view-animate zoomInSmall delay-04">
									<p>Puede contactarnos de la forma que le resulte más conveniente. Estamos disponibles las 24 horas del día, los 7 días de la semana, por teléfono o correo electrónico. También puede utilizar un formulario de contacto rápido a continuación o visitar nuestro local personalmente. Estaremos encantados de responder a sus preguntas.</p>
								</div>
								<div class="offset-top-30">
									<form id="form_mensajes" data-form-output="form-output-global" data-form-type="contact" class="rd-mailform text-left">
										<div class="range">
											<div class="cell-lg-6 view-animate fadeInLeftSm delay-06">
												<div class="form-group">
													<label for="nombre" class="form-label form-label-outside">Tú nombre</label>
													<input id="nombre" type="text" name="nombre" data-constraints="@Required" class="form-control">
												</div>
											</div>
											<div class="cell-lg-6 offset-top-12 offset-lg-top-0 view-animate fadeInRightSm delay-06">
												<div class="form-group">
													<label for="correo" class="form-label form-label-outside">Correo electrónico</label>
													<input id="correo" type="email" name="correo" data-constraints="@Required @Email" class="form-control">
												</div>
											</div>
											<div class="cell-lg-12 offset-top-12 view-animate fadeInUpSmall delay-06">
												<div class="form-group">
													<label for="mensaje" class="form-label form-label-outside">Mensaje o duda</label>
													<textarea id="mensaje" name="mensaje" data-constraints="@Required" style="height: 220px" class="form-control"></textarea>
												</div>
											</div>
										</div>
										<div class="text-center text-lg-left offset-top-20 view-animate zoomInSmall delay-08">
											<button type="submit" class="btn btn-primary">Enviar mensaje</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</main>
	</div>	

	<!-- Activar link -->
	<script>
		document.oncontextmenu = function(){
			return false
		}
	</script>
	<!-- Estilos Script -->
	<script src="https://kit.fontawesome.com/56b0f801ce.js" crossorigin="anonymous" async></script>
	<script src="https://cocinas-aurora.herokuapp.com/js/asistencia.js" async></script>
	<!-- Java script-->
  	<script src="https://cocinas-aurora.herokuapp.com/js/core.min.js"></script>
  	<script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
	<!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/sweetalert.js" async></script>
	<!-- Petición POST -->
	<script src="https://cocinas-aurora.herokuapp.com/js/mensajes.js" async></script>		
	<script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>		
</body>

</html>

<?php
  }
?>