<?php
  ob_start();

  session_start();
  require_once 'vendor/autoload.php';

  if(!isset($_REQUEST['dia'])){
    header('Location: https://cocinas-aurora.herokuapp.com/#menus');
  }

  $dia = $_REQUEST['dia'];

?>

<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">

<head>
  <!-- Estilos -->
  <?php include 'views/estilos.php' ?>
  <title> ❤️ Comidas del día <?php echo $dia ?> | Cocinas Aurora ❤️ </title>
  <meta name="description" content="El menu de la semana se presenta con los antojitos🌮, guarniciones🥗, guisos🍲, postres🍮 y sopas🍝 y son las principales comidas del día de la cocina economica Cocinas Aurora🧡, donde diariamente te ofrecemos diferentes platillos de los distintos platillos que tenemos😍. Puedes visitarnos en Cocinas Aurora para ver el menú del día☀️, de Lunes a Viernes y comprar la mejor comida de Durango😋.">
</head>

<body>
  <!-- Page-->
  <div class="page text-center">
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

    <main class="comidas_dia page-content section-70 section-md-114">
      <section>
        <div class="shell">
          <?php
            if($dia == 'Lunes' || $dia == 'Martes' || $dia == 'Miercoles' || $dia == 'Jueves' || $dia == 'Viernes'){
          ?>

            <h1 class="text-bold h2">Comidas del día <?php echo $dia ?></h2>
            <hr class="divider bg-madison">
            <div class="range offset-top-50">
              <span class="text-primary" style="font-size: 23px">&#8592;</span>
              <div data-items="2" data-xs-items="2" data-sm-items="2" data-lg-items="5" data-xl-items="5" data-nav="true"
                data-dots="true" data-mouse-drag="true" data-photo-swipe-gallery="" data-flickr-tags="tm-61184"
                data-stage-padding="0" data-xl-stage-padding="0" class="owl-carousel flickr">
                <a title="Cocinas Aurora menu semanal de guisos" href="https://cocinas-aurora.herokuapp.com/guisos?dia=<?php echo $dia ?>" data-type="flickr-item" class="thumbnail-default thumbnail-flickr">
                  <img data-title="menus semanal del día <?php echo $dia ?>" src="https://cocinas-aurora.herokuapp.com/images/guisos.jpg" alt="menu semanal del día <?php echo $dia ?>">
                  <span class="icon">GUISOS</span>
                </a>
                <a title="Cocinas Aurora menu semanal de sopas" href="https://cocinas-aurora.herokuapp.com/sopas?dia=<?php echo $dia ?>" data-type="flickr-item" class="thumbnail-default thumbnail-flickr">
                  <img data-title="menus semanal del día <?php echo $dia ?>" src="https://cocinas-aurora.herokuapp.com/images/sopas.jpg" alt="menu semanal del día <?php echo $dia ?>">
                  <span class="icon">SOPAS</span>
                </a>
                <a title="Cocinas Aurora menu semanal de guarniciones" href="https://cocinas-aurora.herokuapp.com/guarniciones?dia=<?php echo $dia ?>" data-type="flickr-item" class="thumbnail-default thumbnail-flickr">
                  <img data-title="menus semanal del día <?php echo $dia ?>" src="https://cocinas-aurora.herokuapp.com/images/guarniciones.jpg" alt="menu semanal del día <?php echo $dia ?>">
                  <span class="icon">GUARNICIONES</span>
                </a>
                <a title="Cocinas Aurora menu semanal de antojitos" href="https://cocinas-aurora.herokuapp.com/antojitos?dia=<?php echo $dia ?>" data-type="flickr-item" class="thumbnail-default thumbnail-flickr">
                  <img data-title="menus semanal del día <?php echo $dia ?>" src="https://cocinas-aurora.herokuapp.com/images/antojitos.jpeg" alt="menu semanal del día <?php echo $dia ?>">
                  <span class="icon">ANTOJITOS</span>
                </a>
                <a title="Cocinas Aurora menu semanal de postres" href="https://cocinas-aurora.herokuapp.com/postres?dia=<?php echo $dia ?>" data-type="flickr-item" class="thumbnail-default thumbnail-flickr">
                  <img data-title="menus semanal del día <?php echo $dia ?>" src="https://cocinas-aurora.herokuapp.com/images/postres.jpeg" alt="menu semanal del día <?php echo $dia ?>">
                  <span class="icon">POSTRES</span>
                </a>
              </div>
            </div>

          <?php
            }else{
              header('Location: https://cocinas-aurora.herokuapp.com/#menus');
            }
          ?>
        </div>
      </section>
    </main>

    <!-- Corporate footer-->
    <footer class="page-footer">
      <?php include 'views/footer.php' ?>
    </footer>
  </div>
  
  <!-- Java script-->
  <script src="https://cocinas-aurora.herokuapp.com/js/core.min.js"></script>
  <script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
  <!-- LINK ACTIVADO -->
  <script>    
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll(".menu_item");
    const menuLength = menuItem.length;
    for (let i = 0; i < menuLength; i++) {
      if (menuItem[i].children[0].href === currentLocation)
        menuItem[i].className = "active";
    }

    const menuActive = document.getElementsByClassName("menuActive")[0];
    menuActive.className = "active";
    document.oncontextmenu = function(){
      return false
    }
    document.onkeydown = function(){
      return false
    }
  </script>
  <script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>

</body>

</html>

<?php

  if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
    header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
  }
  ob_end_flush();
?>
