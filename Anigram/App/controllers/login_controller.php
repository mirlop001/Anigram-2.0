<?php
    session_start();
        
    require_once "../models/usuario_model.php";   
    $modeloUsuario = new Usuario_Model();
        
        
    $usuario = htmlspecialchars(trim(strip_tags($_REQUEST['user'])));
    $pass = htmlspecialchars(trim(strip_tags($_REQUEST['password'])));

    $result = $modeloUsuario->getDatosLogin($usuario, $pass);
    
    if($result != null){
        $_SESSION['LoginSuccess'] = true;
        $_SESSION['UserID'] = $result['ID'];
        $_SESSION['Nombre'] = $result['Nombre'];
        $_SESSION['RolUsuario'] = $result['Rol'];
        header('Location: ../views/home.php');
    }
    else {
        $_SESSION['LoginSuccess'] = false;
        header('Location: ../views/login.php');
    }
    
?>