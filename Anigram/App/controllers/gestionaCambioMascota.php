<?php
require_once '../configuracion/config.php';
require_once "../models/mascota_model.php";
// session_start();

$mascotaModel = new es\ucm\fdi\aw\Mascota_Model();

$idMascota = htmlspecialchars(trim(strip_tags($_REQUEST['idMascota'])));
$datosMascota = $mascotaModel->getMascotasByID($idMascota);
$urlImagenPerfil = ($datosMascota->getURLFoto() != "")? __urlFotoGuardada__.$datosMascota->getURLFoto():__urlFotoMascota__;

$_SESSION['IDPerfilActivo'] = $idMascota;
$_SESSION['fotoPerfilActivo'] =$urlImagenPerfil;
$_SESSION['NombrePerfilActivo'] = $datosMascota->getNombre();

echo $urlImagenPerfil;

?>