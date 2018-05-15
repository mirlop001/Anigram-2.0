<?php 
    require_once "usuario_controller.php";  
	require_once "../models/usuario_model.php";  

    $usuario_controller = new es\ucm\fdi\aw\Usuario_Controller();
    $result = false;

    $email = htmlspecialchars(trim(strip_tags($_POST['UserMail'])));
    $clave = htmlspecialchars(trim(strip_tags($_POST['Password'])));
    
    if($_POST['comprobacion'] == 'registro')
        $result = ($usuario_controller->getUserByEmail($_POST['UserMail']) == 0);
    else{
        $usuario = $usuario_controller->getDatosLogin( $email);
        if($usuario){
            if($result = password_verify($clave, $usuario['Clave'])){
                $_SESSION['LoginSuccess'] = true;
                $_SESSION['UserID'] = $usuario['ID'];
                $_SESSION['Nombre'] = $usuario['Nombre'];
                $_SESSION['RolUsuario'] = $usuario['Rol'];
                  
            }
        }
    }   
    echo $result;
?>