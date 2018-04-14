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


    //Registro de usuario y mascota
    if(($modeloUsuario->buscaUsuarioPorEmail($email) > 0)){
        $_SESSION['MensajeError'] = "El usuario";
        header('Location: ../views/registro.php');
    }else if(($modeloUsuario->buscaUsuarioPorEmail($email) > 0)){
        $_SESSION['MensajeError'] = "";
        header('Location: ../views/registro.php');
    }else{
        if($result = $modeloUsuario->registraUsuario($nickname, $nombreCompleto, $email, $clave, $rol)){
            $_SESSION['ErrorRegistro'] = false;
            $_SESSION['UserID'] = $result;
            $_SESSION['Nombre'] = $nombreCompleto;
            $_SESSION['RolUsuario'] = $rol;
            header('Location: ../views/home.php');
        }
    }

?>