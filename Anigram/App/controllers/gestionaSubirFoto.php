<?php

use es\ucm\fdi\aw\SubidaImagen_Controller;
    require_once '../configuracion/config.php';
    require_once "gestionaSubidaImagen.php";   
	require_once "../models/media_model.php";  

$modeloMedia = new es\ucm\fdi\aw\Media_Model();

$userID = $_SESSION['UserID'];
$IDmascota = $_SESSION['IDPerfilActivo'];

//Obtener datos de la mascota
if(isset($_FILES['fotoMascota']) && $_FILES['fotoMascota']['error'] == 0){
    $nombre_imagen = $_FILES['fotoMascota']['name'];
    $imagen_tmp =$_FILES['fotoMascota']['tmp_name'];
    $foto = $userID.'-'.$nombre_imagen;

    $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $userID, $foto);
    $imagen->guardaImagen();
}
$registrado = $modeloMedia->insertaNuevaImagen($IDmascota, $foto) == true;

	header('Location: ../views/home.php');

?>