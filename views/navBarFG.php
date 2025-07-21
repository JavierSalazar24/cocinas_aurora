<!--Navbar Responsive || falta logo-->
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
                <a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/"><img width='89' height='89' src='images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></a>
              </div>
            </div>
            <ul class="rd-navbar-nav">
              <li>
                <a title="Cocinas Aurora inicio" href="https://cocinas-aurora.herokuapp.com/">Inicio</a>
              </li>
              <li class="menuActive">
                <a title="Cocinas Aurora menu de la semana" href="https://cocinas-aurora.herokuapp.com/#menus">Menú de la semana</a>
                <ul class="rd-navbar-dropdown">
                  <li class="menu_item">
                    <a title="Cocinas Aurora comida del dia lunes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Lunes">Lunes</a>
                  </li>
                  <li class="menu_item">
                    <a title="Cocinas Aurora comida del dia martes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Martes">Martes</a>
                  </li>
                  <li class="menu_item">
                    <a title="Cocinas Aurora comida del dia miercoles" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Miercoles">Miercoles</a>
                  </li>
                  <li class="menu_item">
                    <a title="Cocinas Aurora comida del dia jueves" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Jueves">Jueves</a>
                  </li>
                  <li class="menu_item">
                    <a title="Cocinas Aurora comida del dia viernes" href="https://cocinas-aurora.herokuapp.com/comidas_dia?dia=Viernes">Viernes</a>
                  </li>
                </ul>
              </li>
              <li>
                <a title="Cocinas Aurora descargar aplicacion" href="https://cocinas-aurora.herokuapp.com/#app">Descargar APP</a>
              </li>
              <li>
                <a title="Cocinas Aurora porciones" href="https://cocinas-aurora.herokuapp.com/#porciones">Porciones</a>
              </li>
              <li>
                <a title="Cocinas Aurora ven a visitarnos" href="https://cocinas-aurora.herokuapp.com/#visitanos">Ven a visitarnos</a>
              </li>
              <li>
                <a title="Cocinas Aurora contactanos" href="https://cocinas-aurora.herokuapp.com/#contactanos">Contáctanos</a>
              </li>
              <li class="menu_item">
                <a title="Cocinas Aurora preguntas frecuentes" href="https://cocinas-aurora.herokuapp.com/faq">FAQ</a>
              </li>
              <li class="perfilActive">
                <a href="#" id="perfilNav"><?php echo $_SESSION["usuarioSocial"]["first_name"].' '.$_SESSION["usuarioSocial"]["last_name"] ?></a>
                <ul class="rd-navbar-dropdown">
                  <li class="menu_item">
                    <a title="Cocinas Aurora perfil" href="https://cocinas-aurora.herokuapp.com/perfil">Perfil</a>
                  </li>
                  <li>                    
                    <a href="https://cocinas-aurora.herokuapp.com/php/cerrar_sesion">Cerrar Sesión</a>
                  </li>                 
                </ul>
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

<!-- Logo y nombre del negocio || falta el logo -->
<section class="navBars section-32 position-absolute veil reveal-md-block">
    <div class="shell-wide">
      <div class="range range-sm-justify range-sm-middle">
        <div class="cell-md-4 cell-lg-3">
          <!--Navbar Brand-->
          <div class="rd-navbar-brand text-left"><a title="cocina economica Cocinas Aurora" href="https://cocinas-aurora.herokuapp.com/" class="reveal-inline-block">
              <div class="unit unit-xs-middle unit-md unit-md-horizontal unit-spacing-xxs">
                <div class="unit-left"><img width='89' height='89' src='images/logo_cocina_economica.png' alt='Logo de Cocinas Aurora' /></div>
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