<?php 
    require_once "usuario_controller.php";  
	require_once "../models/usuario_model.php";  

    $usuario_controller = new es\ucm\fdi\aw\Usuario_Controller();
    $result = false;

    if($_POST['comprobacion'] == 'registro')
        $result = ($usuario_controller->getUserByEmail($_POST['UserMail']) == 0);
    else{
        $usuario = $usuario_controller->getDatosLogin($_POST['UserMail']);
        if($usuario){
            $result = password_verify($_POST['clave'], $usuario['Clave']);
        }
    }   
    echo $result;
?>