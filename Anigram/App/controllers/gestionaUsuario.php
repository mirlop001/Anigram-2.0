<?php 
    require_once "usuario_controller.php";  
    require_once "mascota_controller.php";  
	require_once "../models/usuario_model.php";  
	require_once "../models/mascota_model.php";  

    $usuario_controller = new es\ucm\fdi\aw\Usuario_Controller();
    $mascota_controller = new es\ucm\fdi\aw\Mascota_Controller();
    $result = false;

    $email = htmlspecialchars(trim(strip_tags($_POST['UserMail'])));
    
    if($_POST['comprobacion'] == 'registro')
        $result = ($usuario_controller->getUserByEmail($_POST['UserMail']) == 0);
        
    else{
        $clave = htmlspecialchars(trim(strip_tags($_POST['Password'])));
        $usuario = $usuario_controller->getDatosLogin( $email);
        if($usuario){
            if($result = password_verify($clave, $usuario->getClave())){
                $mascota = $mascota_controller->getDatosMascotaPrincipal( $usuario->getMascotaPrincipal());
                $_SESSION['LoginSuccess'] = true;
                $_SESSION['UserID'] = $usuario->getID();
                $_SESSION['RolUsuario'] = $usuario->getRol();
                $_SESSION['Email'] = $usuario->getEmail(); 
                
                $_SESSION['IDPerfilActivo'] = $mascota->getID();
                $_SESSION['fotoPerfilActivo'] = ($mascota->getURLFoto() != "")? __urlFotoGuardada__.$mascota->getURLFoto():__urlFotoUsuario__;
                $_SESSION['NombrePerfilActivo'] = $mascota->getNombre();
            }
        }
    }   
    echo $result;
?>