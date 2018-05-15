<?php

require_once '../configuracion/config.php';
require_once "../models/woof_model.php";  

$modeloWoof = new es\ucm\fdi\aw\Woof_Model();

//Obtener datos de la publicacion

$UserID = $_POST['UserID'];
$MediaID = $_POST['MediaID'];
$Puntos = $_POST['Puntos'];

$Modifica = $modeloWoof->compruebaWoof($UserID, $MediaID);
if($Modifica > 0){
	echo 'Se actualiza woof '.$modeloWoof->actualizaWoof($Puntos, $UserID, $MediaID);
	
}else if($modeloWoof->nuevoWoof($Puntos, $UserID, $MediaID) != NULL){
	echo 'Nuevo woof ';
	if($urlFoto) 
		$_SESSION['fotoPerfilMascota'] = $urlFoto;
	
}else{
	echo 'MAL';
}
// header('Location: ../views/home.php');
// exit;


?>