<?php


$tabla = $_REQUEST['tabla'];

if($tabla == 'antojitos' || $tabla == 'guarniciones' || $tabla == 'guisos' || $tabla == 'postres' || $tabla == 'sopas'){                
        
    $img_path='../../img_alimentos/' . $_FILES['imagen']['name'];
    if(move_uploaded_file($_FILES['imagen']['tmp_name'],$img_path )){
        echo json_encode("correcto");
    }
   
}

?>