<?php
session_start();
	
require_once "../models/usuario_model.php";   
$modeloUsuario = new Usuario_Model();


//Obtener datos usuario
if(isset($_FILES["fotoPerfilUsuario"]["name"][0]))
    $urlFoto = _IMG_PATH.$_FILES["fotoPerfilUsuario"]["name"][0];

$nickname = htmlspecialchars(trim(strip_tags($_REQUEST['nickname'])));
$nombreCompleto = htmlspecialchars(trim(strip_tags($_REQUEST['nombreCompleto'])));
$email = htmlspecialchars(trim(strip_tags($_REQUEST['email'])));
$clave = htmlspecialchars(trim(strip_tags($_REQUEST['clave1'])));
$rol = htmlspecialchars(trim(strip_tags($_REQUEST['rol'])));
//Obtener datos Mascota
//(...)

//Registro de usuario y mascota
if($modeloUsuario->registraUsuario($nickname, $nombreCompleto, $email, $clave, $rol)){
    if($modeloUsuario->getDatosLogin($email, $clave)){
        $_SESSION['LoginSuccess'] = true;
        $_SESSION['Nombre'] = $result['ID'];
        $_SESSION['RolUsuario'] = $rol;
    }
}

header('Location: ../views/home.php');

?>