<?php
  session_start();
  require_once 'vendor/autoload.php';

  if(isset($_SESSION['admin'])||isset($_SESSION['estandar'])){
      header("Location: https://cocinas-aurora.herokuapp.com/control_panel");
  }else if(isset($_SESSION['usuario']) || isset($_SESSION['usuarioSocial'])){    

?>

<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">
  <head>
    <!-- Estilos -->
    <?php include 'views/estilos.php' ?>
    <title> ❤️ Perfil | Cocinas Aurora ❤️ </title>
    <meta name="description" content="En cocina economica cocinas aurora🧡 puedes editar y mejorar tu perfil👫, para poderte conocer y atenderte con prioridad, simplemente edita tu información con tus datos que quieras dar a conocer💻. Puedes estar en nuestro sitio web o descargar nuestra aplicación para recibir notificaciones a cerca de nuestros alimentos📱.">
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
      
      <main class="perfil page-content">
        <section class="section-70 section-md-114">
          <div class="shell">
            <div class="range range-xs-center offset-top-70">
              <div class="cell-sm-4 text-sm-left">
                <div class="inset-sm-right-30">
                  <img src="<?php if (isset($_SESSION['usuario'])){ echo 'https://cocinas-aurora.herokuapp.com/images/perfil.png'; }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['picture']; }?>" width="340" height="340" alt="Imagen del usuario <?php if (isset($_SESSION['usuario'])){ echo $nombres.' '.$apellidos; }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['first_name'].' '.$_SESSION['usuarioSocial']['last_name']; } ?>" class="img-responsive reveal-inline-block">
                  <div class="offset-top-15 offset-sm-top-30">
                    <?php if (isset($_SESSION['usuario'])){?>
                      <button style="max-width: 340px; margin-left:auto; margin-right:auto" class="btn btn-primary btn-block" id="btnPerfil" type="button">Editar perfil</button>
                    <?php }else if (isset($_SESSION['usuarioSocial']['red']) && $_SESSION['usuarioSocial']['red'] == 'facebook'){ ?>
                      <button style="max-width: 340px; margin-left:auto; margin-right:auto" class="btn btn-primary btn-block" id="btnPerfilFace" type="button">Editar perfil</button>
                    <?php }else if (isset($_SESSION['usuarioSocial']['red']) && $_SESSION['usuarioSocial']['red'] == 'google'){ ?> 
                      <button style="max-width: 340px; margin-left:auto; margin-right:auto" class="btn btn-primary btn-block" id="btnPerfilGoogle" type="button">Editar perfil</button>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="cell-sm-8 text-left">
                <?php if (isset($_SESSION['usuario'])){?>
                  <div><h2 class="text-bold"><span id="nombrePerfil"><?php echo $nombres ?></span> <span id="apellidosPerfil"><?php echo $apellidos ?></span></h2></div>                                
                <?php }else if(isset($_SESSION['usuarioSocial'])){ ?>
                  <div><h2 class="text-bold"><?php echo $_SESSION["usuarioSocial"]["first_name"].' '.$_SESSION["usuarioSocial"]["last_name"] ?></h2></div>
                <?php } ?>
                <p class="offset-top-10">Cliente</p>
                <div class="offset-top-15 offset-sm-top-30"><hr class="divider bg-madison hr-left-0"></div>
                <div class="offset-top-30 offset-sm-top-60"><h6 class="text-bold">Información</h6><div class="text-subline"></div></div>
					      <form id="formPerfil" data-form-output="form-output-global" data-form-type="contact" class="rd-mailform text-left">
                  <div class="offset-top-20">
                    <div class="range">
                      <div class="cell-lg-6 view-animate fadeInLeftSm delay-06">
                        <div class="form-group">
                          <label for="nombres" class="form-label form-label-outside">Nombre(s)</label>
                          <input id="nombres" type="text" name="nombres" data-constraints="@Required" class="form-control" value="<?php if (isset($_SESSION['usuario'])){ echo $nombres; }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['first_name']; }?>" disabled>
                        </div>
                      </div>
                      <div class="cell-lg-6 offset-top-12 offset-lg-top-0 view-animate fadeInRightSm delay-06">
                        <div class="form-group">
                          <label for="apellidos" class="form-label form-label-outside">Apellido(s)</label>
                          <input id="apellidos" type="text" name="apellidos" data-constraints="@Required" class="form-control" value="<?php if (isset($_SESSION['usuario'])){ echo $apellidos; }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['last_name']; }?>" disabled>
                        </div>
                      </div>
                      <div class="cell-lg-6 view-animate fadeInLeftSm delay-06 offset-top-10">
                        <div class="form-group">
                          <label for="correo" class="form-label form-label-outside">Correo</label>
                          <input id="correo" type="text" name="correo" data-constraints="@Required" class="form-control" value="<?php if (isset($_SESSION['usuario'])){ echo $correo; }elseif(isset($_SESSION['usuarioSocial']['email'])){ echo $_SESSION['usuarioSocial']['email']; }else{ echo '****************'; }?>" readonly>
                        </div>
                      </div>
                    </div>
                  </div>
					      </form>
              </div>
            </div>
          </div>
        </section>
      </main>

      <!-- Footer-->
      <footer class="indexZ page-footer">
        <?php include 'views/footer.php' ?>
      </footer>

    </div>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/sweetalert.js"></script>
    <!-- Java script-->
    <script src="./js/perfil.js" async></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/core.min.js"></script>
    <script src="https://cocinas-aurora.herokuapp.com/js/script.js" async></script>
    <!-- Link activado -->
    <script>    
      const currentLocation = location.href;
      const menuItem = document.querySelectorAll(".menu_item");
      const menuLength = menuItem.length;
      for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].children[0].href === currentLocation)
          menuItem[i].className = "active";
      }

      const perfilActive = document.getElementsByClassName("perfilActive")[0];
      perfilActive.className = "active";
      // document.oncontextmenu = function(){
      //     return false
      // }
    </script>
    <script src="https://cocinas-aurora.herokuapp.com/js/darkmode.js" async></script>
  </body>
</html>

<?php
  }else if(!isset($_SESSION['usuario'])){
    header("Location: https://cocinas-aurora.herokuapp.com/login_register");
  }
?>