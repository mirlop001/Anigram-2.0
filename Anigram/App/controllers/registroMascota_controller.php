<?php
session_start();
require_once "../models/mascota_model.php";  

$modeloMascota = new Mascota_Model();

//Obtener datos de la mascota
if(isset($_FILES["fotoPerfilUsuario"]["name"][0]))
	$urlFoto = _IMG_PATH.$_FILES["fotoPerfilUsuario"]["name"][0];

$nombre = htmlspecialchars(trim(strip_tags($_REQUEST['nombre'])));
$raza = htmlspecialchars(trim(strip_tags($_REQUEST['raza'])));
$tipo = htmlspecialchars(trim(strip_tags($_REQUEST['tipo'])));
$bio = htmlspecialchars(trim(strip_tags($_REQUEST['bio'])));

if($modeloMascota->registraMascota($tipo, $nombre, $raza, $bio)){
	echo "Registrada"; 
}
else {
	echo "Fallo al registrar"; 
}

echo "Mascota registrada <a href='index.php'> Volver </a>"; 

?>