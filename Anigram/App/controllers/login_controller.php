<?php
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";        

    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();
        
        
    $usuario = htmlspecialchars(trim(strip_tags($_REQUEST['user'])));
    $pass = htmlspecialchars(trim(strip_tags($_REQUEST['password'])));
    
    $result = $modeloUsuario->getDatosLogin($usuario);

    $log =  $modeloUsuario->login($usuario, $pass, $result);

    if($log){

        $_SESSION['LoginSuccess'] = true;
        $_SESSION['UserID'] = $result['ID'];
        $_SESSION['Nombre'] = $result['Nombre'];
        $_SESSION['RolUsuario'] = $result['Rol'];
        header('Location: ../views/home.php');
        echo 'SI!';

    }
    else {
        //$_SESSION['MensajeError'] = 'loginError';
        echo 'NO'; 
        //header('Location: ../views/login.php');
    }
    
?>