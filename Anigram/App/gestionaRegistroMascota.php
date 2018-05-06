<?php
    require_once './configuracion/config.php';
	require_once "./models/mascota_model.php";  

$modeloMascota = new es\ucm\fdi\aw\Mascota_Model();
$urlFoto = NULL;

//Obtener datos de la mascota
if($_GET['urlFoto']) $urlFoto = $_GET['urlFoto'];
$amo = $_GET['id_amo'];
$nombre = htmlspecialchars(trim(strip_tags($_GET['nombre'])));
$raza = htmlspecialchars(trim(strip_tags($_GET['raza'])));
$tipo = htmlspecialchars(trim(strip_tags($_GET['tipo'])));
$bio = htmlspecialchars(trim(strip_tags($_GET['bio'])));

if($registrado = $modeloMascota->registraMascota($amo, $tipo, $nombre, $raza, $bio, $urlFoto) == true){

	if($urlFoto) 
		$_SESSION['fotoPerfilMascota'] = $urlFoto;
	
	header('Location: ./views/home.php');
}
else {
	header('Location: ./views/registro.php');
}


?>