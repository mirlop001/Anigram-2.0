<?php
namespace es\ucm\fdi\aw;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";  
    require_once "../models/mascota_model.php";
    require_once "../models/amigos_model.php";
    require_once "../models/tipoMascota_model.php";

$amigos = new Amigos_Model();
$mascota = new Mascota_Model();
$tipoMascota = new TipoMascota_Model();
$usuario = new Usuario_Model();
$userActual = $_SESSION['IDPerfilActivo'];
$idSeguidor = $_REQUEST['mascotaID'];
if(isset($_REQUEST['Aceptar'])){
    $amigos->aceptarPeticion($idSeguidor, $userActual);
}
else if(isset($_REQUEST['Rechazar'])){
    $amigos->rechazarPeticion($idSeguidor, $userActual);
}
header('Location: ../views/amigos.php')
?>