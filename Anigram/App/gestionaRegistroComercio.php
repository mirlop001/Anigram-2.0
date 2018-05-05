<?php
    require_once './configuracion/config.php';
    require_once "./models/comercio_model.php";  

$modeloComercio = new es\ucm\fdi\aw\Comercio_Model();

$urlFoto = __urlFotoGuardada__.$_GET['urlFoto'];
$amo = $_GET['id_amo'];
$nombre = htmlspecialchars(trim(strip_tags($_GET['nombre'])));
$correo = htmlspecialchars(trim(strip_tags($_GET['correo'])));
$telefono = htmlspecialchars(trim(strip_tags($_GET['telefono'])));
$descripcion = htmlspecialchars(trim(strip_tags($_GET['descripcion'])));

if($registrado = $modeloComercio->registraComercio($amo, $nombre, $correo, $telefono, $descripcion, $urlFoto) == true){
	header('Location: ./views/home.php');
}
else {
	header('Location: ./views/registro.php');
}


?>