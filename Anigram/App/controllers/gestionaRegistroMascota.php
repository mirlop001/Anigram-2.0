<?php
    require_once '../configuracion/config.php';
	require_once "../models/mascota_model.php";  

	$modeloMascota = new es\ucm\fdi\aw\Mascota_Model();
	$urlFoto = NULL;

	//Obtener datos de la mascota
	$amo = $_GET['id_amo'];
	$nombre = htmlspecialchars(trim(strip_tags($_GET['nombre'])));
	$raza = htmlspecialchars(trim(strip_tags($_GET['raza'])));
	$tipo = htmlspecialchars(trim(strip_tags($_GET['tipo'])));
	$bio = htmlspecialchars(trim(strip_tags($_GET['bio'])));
	if($_GET['urlFoto']) $urlFoto = $_GET['urlFoto'];

	$nueva_mascota = $modeloMascota->registraMascota($amo, $tipo, $nombre, $raza, $bio, $urlFoto);
	if($nueva_mascota){
		$_SESSION['IDPerfilActivo'] = $nueva_mascota; 
		
		if($urlFoto ) 
			$_SESSION['fotoPerfilActivo'] = __urlFotoGuardada__.$urlFoto;
		return new Exception('Error en el registro');
	}	
	else {
		return new Exception('Error en el registro');
	}
?>