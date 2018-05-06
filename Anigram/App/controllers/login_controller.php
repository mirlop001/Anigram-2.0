<?php
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";        
    require_once "./password_compat-master/lib/password.php";        

    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();
        
        
    $usuario = htmlspecialchars(trim(strip_tags($_REQUEST['user'])));
    $pass = htmlspecialchars(trim(strip_tags($_REQUEST['password'])));
    
    $result = $modeloUsuario->getDatosLogin($usuario);
    $c = password_hash($pass, PASSWORD_BCRYPT);
    // $log =  $modeloUsuario->login($usuario, $pass, $result);
    if(password_verify($pass,  $result['Clave'])){

        $_SESSION['LoginSuccess'] = true;
        $_SESSION['UserID'] = $result['ID'];
        $_SESSION['Nombre'] = $result['Nombre'];
        $_SESSION['RolUsuario'] = $result['Rol'];
        header('Location: ../views/home.php');
        exit;
    }
    else {
        //$_SESSION['MensajeError'] = 'loginError';
        header('Location: ../views/login.php');
        exit;
        
    }
    
?>