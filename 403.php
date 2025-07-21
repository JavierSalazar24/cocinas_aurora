<?php
  session_start();
  require_once 'vendor/autoload.php';

  if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
    header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
  }else{

?>

<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">

<head>
  <!-- Estilos -->
  <?php include 'views/estilos.php' ?>
  <title> ❤️ Página no encontrada | Cocinas Aurora ❤️ </title>
</head>

<body>
  <!-- Page-->
  <div class="page text-center">
    <!-- Page Header-->
    <header class="page-head header-panel-absolute">
      <?php

        if(isset($_SESSION['usuario'])){

          include 'views/navBarS.php';

        }else if(isset($_SESSION['usuarioSocial'])){

          include 'views/navBarFG.php';
        
        }else if (!isset($_SESSION['usuario'])){

          include 'views/navBar.php';

        }

      ?>
    </header>
    <!-- Page Content-->
    <main class="page-content pagina_error">
      <div class="section-404-cover">
        <div class="section-cover section-404 section-30">
          <div class="section-50">
            <div class="shell">
              <div>
                <h1 class="font-default"><span class="big text-light text-bold">403</span></h1>
              </div>
              <div class="offset-top-10">
                <h2 class="text-bold">Lo siento, esta página no está disponible</h2>
              </div>
              <div class="offset-top-15 offset-lg-top-30">
                <hr class="divider bg-madison">
              </div>
              <div class="offset-top-30 offset-lg-top-60">
                <p>Usted no tiene permiso para acceder al directorio solicitado. No existe un documento índice, o el directorio está protegido contra lectura.</p>
              </div>
              <div class="offset-top-15 offset-lg-top-30">
                <div class="group group-xl">
                  <a href="https://cocinas-aurora.herokuapp.com/" class="btn btn-primary btn-icon btn-icon btn-icon-left offset-top-10">
                    <span class="icon fa-arrow-left"></span>
                    <span>Volver a la página de inicio</span>
                  </a>
                  <a href="https://cocinas-aurora.herokuapp.com/#contactanos" class="btn btn-default btn-icon btn-icon btn-icon-left offset-top-10">
                    <span class="icon fa-envelope"></span>
                    <span>Contáctanos</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div>
            <p>
              &copy;<span id="copyright-year"></span> 
              Hecho por Cocinas Aurora. Todos los derechos reservados. 
              <a rel="nofollow" href="https://cocinas-aurora.herokuapp.com/privacidad" style="color: #000; text-decoration: underline">Política de privacidad.</a>
            </p>
          </div>
        </div>
      </div>
    </main>
  </div>

  <!-- Java script-->
  <script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/core.min.js"></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
  <script>
    document.oncontextmenu = function(){
        return false
    }
    document.onkeydown = function(){
        return false
    }
  </script>
</body>

</html>

<?php
  }
?>