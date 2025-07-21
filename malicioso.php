<?php
    
    echo "<link rel='icon' href='../favicon.png' type='image/x-icon'>";

    // Inicializar la sesión.
    // Si está usando session_name("algo"), ¡no lo olvide ahora!
    session_start();    

    // Destruir todas las variables de sesión.
    $_SESSION = array();


    $_SESSION['admin'] = "pepe@gmail.com";

    var_dump($_SESSION);


?>