<?php
    session_start();
        
    require_once "../models/usuario_model.php";   
    require_once "../configuracion/mensajes.php";   
    $modeloUsuario = new Usuario_Model();
        
        
    $usuario = htmlspecialchars(trim(strip_tags($_REQUEST['user'])));
    $pass = htmlspecialchars(trim(strip_tags($_REQUEST['password'])));
    
    $result = $modeloUsuario->getDatosLogin($usuario);
    if($result != null){
        if(password_verify($pass, $result['Clave'])){
            $_SESSION['LoginSuccess'] = true;
            $_SESSION['UserID'] = $result['ID'];
            $_SESSION['Nombre'] = $result['Nombre'];
            $_SESSION['RolUsuario'] = $result['Rol'];
            header('Location: ../views/home.php');
            echo 'SI!';
        }       
        echo 'nope!';
        $verify = password_verify($pass, $result['Clave']);
        echo 'verify: '.$verify;
    }
    else {
        $_SESSION['MensajeError'] = 'loginError';

        header('Location: ../views/login.php');
    }
    
?>