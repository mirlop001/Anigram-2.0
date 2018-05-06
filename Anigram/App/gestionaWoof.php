<?php

require_once './configuracion/config.php';
require_once "./models/woof_model.php";  

$modeloWoof = new es\ucm\fdi\aw\Woof_Model();

//Obtener datos de la publicacion

$UserID = htmlspecialchars(trim(strip_tags($_REQUEST['UserID'])));
$MediaID = htmlspecialchars(trim(strip_tags($_REQUEST['MediaID'])));
$Puntos = htmlspecialchars(trim(strip_tags($_REQUEST['Puntos'])));

if($registrado = $modeloWoof->nuevoWoof($Puntos, $UserID, $MediaID) == true){

	if($urlFoto) 
		$_SESSION['fotoPerfilMascota'] = $urlFoto;
	
}
else {
	header('Location: ./views/home.php');
}


?>