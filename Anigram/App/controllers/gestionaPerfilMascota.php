<?php
    require_once '../configuracion/config.php';
    require_once 'mascota_controller.php'; 
    require_once 'amigos_controller.php'; 

    $comando = htmlspecialchars(trim(strip_tags($_REQUEST['comando'])));
    $idMascota = htmlspecialchars(trim(strip_tags($_REQUEST['idMascota'])));

    $mascota_controller = new es\ucm\fdi\aw\Mascota_Controller();
    $amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();

    if($comando == 'verPerfil'){
        echo $mascota_controller->getPerfilMascota($idMascota);

    }else if($comando == 'seguirMascota'){
            echo $amigos_controller->seguirMascota($idMascota); 
    }
?>