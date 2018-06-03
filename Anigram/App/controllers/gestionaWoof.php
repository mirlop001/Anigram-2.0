<?php

require_once '../configuracion/config.php';
require_once "../models/woof_model.php";  

$modeloWoof = new es\ucm\fdi\aw\Woof_Model();

//Obtener datos de la publicacion

$IDMascota = $_SESSION['IDPerfilActivo'];
$MediaID = $_POST['MediaID'];
$Puntos = $_POST['Puntos'];

$Modifica = $modeloWoof->compruebaWoof($IDMascota, $MediaID);

if($Modifica > 0){
	echo 'Se actualiza woof '.$modeloWoof->actualizaWoof($Puntos, $IDMascota, $MediaID);
	
}else 
	$result = $modeloWoof->nuevoWoof($Puntos, $IDMascota, $MediaID);

echo $result;

?>