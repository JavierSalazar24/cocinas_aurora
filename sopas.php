<?php

    session_start();
    require_once 'vendor/autoload.php';
    $consulta_horarios = (new MongoDB\Client('mongodb+srv://admin:adminBDCA@bdca.9e4qi.mongodb.net/cocinas_aurora?retryWrites=true&w=majority'))->cocinas_aurora->sopas;
    if(isset($_SESSION['admin']) || isset($_SESSION['estandar'])){
        header("Location: https://cocinas-aurora.herokuapp.com/control_panel/");
    }else{

        if(isset($_REQUEST['dia'])){

            $dia = $_REQUEST['dia'];

            if ($dia == 'Lunes'){
                $consulta = $consulta_horarios -> find(['dia' => $dia]);
            }else if ($dia == 'Martes'){
                $consulta = $consulta_horarios -> find(['dia' => $dia]);
            }else if ($dia == 'Miercoles'){
                $consulta = $consulta_horarios -> find(['dia' => $dia]);
            }else if ($dia == 'Jueves'){
                $consulta = $consulta_horarios -> find(['dia' => $dia]);
            }else if ($dia == 'Viernes'){
                $consulta = $consulta_horarios -> find(['dia' => $dia]);
            }else{
                header('Location: https://cocinas-aurora.herokuapp.com/#menus');
            }

        }else{
            header('Location: https://cocinas-aurora.herokuapp.com/#menus');
        }

?>

<!DOCTYPE html>
<html lang="es" class="wide wow-animation smoothscroll scrollTo">

<head>
    <!-- Estilos -->
    <?php include 'views/estilos.php' ?>
    <title> ❤️ Sopas del día <?php echo $dia ?> | Cocina Aurora ❤️ </title>
    <meta name="description" content="La comida del dia sobre las sopas🍝 que encontrarás cada día de la semana te sorprenderán🤩, porque cocina economica Cocinas Aurora tiene para ti las mejores sopas cada dia de la semana😍, visitanos de Lunes a Viernes y encontraras diferentes sopas delicias del dia.😋">
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

        <main class="page-content alimentos_img ">
            <section class="text-center">
                <div data-on="false" data-md-on="true" class="rd-parallax">
                    <div data-speed="0.05" data-type="html" class="rd-parallax-layer">
                        <div class="shell section-70 section-md-114">
                            <h1 class="text-bold view-animate fadeInUpSmall delay-04 h2">Sopas del día <?php echo $dia ?></h2>
                            <hr class="divider bg-gray-base view-animate fadeInUpSmall delay-06">
                            <div class="range range-xs-center offset-top-70">
                                <?php
                                    foreach($consulta as $comida){
                                ?>
                                    <div class="tarjeta_comida cell-sm-6 cell-md-4 cell-lg-3 view-animate fadeInRightSm delay-08 offset-top-10 offset-md-top-10">                                    
                                        <article class="tarjeta_comida_article post-news post-news-mod-1 view-animate fadeInRightSm delay-1">
                                            <img src="<?php echo 'https://cocinas-aurora.herokuapp.com/img_alimentos/'.$comida['imagen']?>" alt="<?php echo $comida['descripcion'] ?>" class="img-responsive" style="width: 100% !important; height: 240px !important;">
                                            <div class="post-news-body">
                                            <h4 class="text-primary"><?php echo $comida['nombre'] ?></h4>
                                            <div class="offset-top-20">
                                                <p><?php echo $comida['descripcion'] ?></p>
                                            </div>
                                            <div class="post-news-meta offset-top-20">
                                                <ul style="list-style-position: inside; margin: 0; padding: 0;">
                                                    <?php if($comida['precio_cuarto'] > 0 && $comida['precio_medio'] > 0 && $comida['precio_litro'] > 0 ){ ?>
                                                        <li class="text-left text-italic text-verde-oscuro text-center">El 1/4 a $<?php echo $comida['precio_cuarto'] ?> pesos MXN.</li>
                                                        <li class="text-left text-italic text-verde-oscuro text-center">El 1/2 a $<?php echo $comida['precio_medio'] ?> pesos MXN.</li>
                                                        <li class="text-left text-italic text-verde-oscuro text-center">El 1 litro a $<?php echo $comida['precio_litro'] ?> pesos MXN.</li>
                                                    <?php }else { ?>
                                                        <li class="text-left text-italic text-rojo text-center">No se ha añadido todavía un precio</li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </article>
                                    </div>
                                <?php
                                    }
                                ?>
                            </div>
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
        
        const menuActive = document.getElementsByClassName("menuActive")[0];
        menuActive.className = "active";
    </script>

</body>

</html>

<?php

    }

?>