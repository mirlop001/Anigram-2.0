<?php

require_once '../configuracion/config.php';
require_once "publicacion_controller.php";   


$page = htmlspecialchars(trim(strip_tags($_REQUEST['page'])));
$publicacionController = new es\ucm\fdi\aw\Publicacion_Controller($page);

echo $publicacionController->getUltimasPublicaciones();

?>