<?php
    require_once '../configuracion/config.php';
    require_once 'mascota_controller.php'; 
    require_once 'publicacion_controller.php'; 
    require_once 'amigos_controller.php'; 

    $comando = htmlspecialchars(trim(strip_tags($_REQUEST['comando'])));
    if(isset($_REQUEST['idMascota'])) $idMascota = htmlspecialchars(trim(strip_tags($_REQUEST['idMascota'])));
    if(isset($_REQUEST['idMedia'])) $idMedia = htmlspecialchars(trim(strip_tags($_REQUEST['idMedia'])));

    $mascota_controller = new es\ucm\fdi\aw\Mascota_Controller();
    $amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();
    $publicacion_controller = new es\ucm\fdi\aw\Publicacion_Controller();

    if($comando == 'verPerfil'){
        echo $mascota_controller->getPerfilMascota($idMascota);

    }else if($comando == 'seguirMascota'){
        echo $amigos_controller->seguirMascota($idMascota); 

    }
    else if($comando == 'verImagen'){
        echo  $publicacion_controller->vistaImagen($idMedia);
    }
?>