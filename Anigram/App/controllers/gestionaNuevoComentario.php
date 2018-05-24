<?php

require_once '../configuracion/config.php';
require_once "../models/comentarios_model.php";  

$modeloWoof = new es\ucm\fdi\aw\Comentario_Model();

//Obtener datos de la publicacion

$UserID = $_POST['UserID'];
$MediaID = $_POST['MediaID'];
$Comentario = $_POST['Comentario'];

if($modeloWoof->nuevoComentario($Comentario, $UserID, $MediaID) != NULL){
	echo 'Nuevo comentario ';
}else{
	echo 'MAL';
}
header('Location: ../views/home.php');
exit;


?>