<?php
require_once '../configuracion/config.php';
require_once 'mascota_controller.php'; 

$idMascota = htmlspecialchars(trim(strip_tags($_REQUEST['idMascota'])));
$mascota_controller = new es\ucm\fdi\aw\Mascota_Controller();

echo $mascota_controller->getPerfilMascota($idMascota);

?>