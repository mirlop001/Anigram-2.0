<?php

use es\ucm\fdi\aw\SubidaImagen_Controller;
    require_once './configuracion/config.php';
    require_once "./models/usuario_model.php";   
    require_once "./controllers/gestionaSubidaImagen.php";   

    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();

    $urlFoto = null;
    //Obtener datos usuario
    if(isset($_FILES["fotoPerfilUsuario"]["name"][0]))
        $urlFoto = basename($_FILES["fotoPerfilUsuario"]["name"]);

    $nickname = htmlspecialchars(trim(strip_tags($_REQUEST['nickname'])));
    $nombreCompleto = htmlspecialchars(trim(strip_tags($_REQUEST['nombreCompleto'])));
    $email = htmlspecialchars(trim(strip_tags($_REQUEST['email'])));
    $clave1 = htmlspecialchars(trim(strip_tags($_REQUEST['clave1'])));
    $clave2 = htmlspecialchars(trim(strip_tags($_REQUEST['clave2'])));
    $clave = password_hash($clave1, PASSWORD_BCRYPT);
    $rol = htmlspecialchars(trim(strip_tags($_REQUEST['rol'])));

    //Mascota
    $nombreMascota = htmlspecialchars(trim(strip_tags($_REQUEST['nombre'])));
    $raza = htmlspecialchars(trim(strip_tags($_REQUEST['raza'])));
    $tipo = htmlspecialchars(trim(strip_tags($_REQUEST['tipo'])));
    $bio = htmlspecialchars(trim(strip_tags($_REQUEST['bio'])));
    $urlFotoMascota = basename($_FILES["fotoPerfilComercio"]["name"]);
    
    //Obtener foto de la mascota
    if(isset($_FILES["fotoPerfilMascota"]["name"][0])&& $_FILES["fotoPerfilMascota"]["name"][0]!= "")
        $urlFotoMascota = __urlFotoGuardada__.basename($_FILES["fotoPerfilMascota"]["name"]);



    //Comercio
    $nombreComercio = htmlspecialchars(trim(strip_tags($_REQUEST['nombre_comercio'])));
    $telefono = htmlspecialchars(trim(strip_tags($_REQUEST['telefono'])));
    $correo = htmlspecialchars(trim(strip_tags($_REQUEST['email_comercio'])));
    $descripcion = htmlspecialchars(trim(strip_tags($_REQUEST['descripcion'])));
    $urlFotoComercio = "";

    //Obtener foto del comercio
        if(isset($_FILES["fotoPerfilComercio"]["name"][0])&& $_FILES["fotoPerfilComercio"]["name"][0]!= "")
            $urlFotoComercio = basename($_FILES["fotoPerfilComercio"]["name"]);

            
    if(strcmp($clave1 ,$clave2)){
        $_SESSION['MensajeError'] = "clavesDistintas";
        header('Location: ./views/registro.php');   
    }
    else if($modeloUsuario->buscaUsuarioPorNickname($nickname) > 0){
        $_SESSION['MensajeError'] = "nicknameExistente";
        header('Location: ./views/registro.php');

    }else if(($modeloUsuario->buscaUsuarioPorEmail($email) > 0)){
        $_SESSION['MensajeError'] = "usuarioExistente";
        header('Location: ./views/registro.php');

    }else{
        if($result = $modeloUsuario->registraUsuario($nickname, $nombreCompleto, $email, $clave, $rol, $urlFoto)){
            $_SESSION['ErrorRegistro'] = false;
            $_SESSION['UserID'] = $result;
            $_SESSION['Nombre'] = $nombreCompleto;
            $_SESSION['RolUsuario'] = $rol;
            
            if(isset($_FILES['fotoPerfilUsuario']) && $_FILES['fotoPerfilUsuario']['error'] == 0){
                $nombre_imagen = $_FILES['fotoPerfilUsuario']['name'];
                $imagen_tmp =$_FILES['fotoPerfilUsuario']['tmp_name'];
                $_SESSION['fotoPerfilUsuario'] = $nickname.'-'.$nombre_imagen;
                
               $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $nickname, $urlFoto);
               $imagen->guardaImagen();
            }

            if($rol == 1){

                if(isset($_FILES['fotoPerfilMascota']) && $_FILES['fotoPerfilMascota']['error'] == 0){
                    $nombre_imagen = $_FILES['fotoPerfilMascota']['name'];
                    $imagen_tmp =$_FILES['fotoPerfilMascota']['tmp_name'];
                    
                    $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $nickname, $urlFotoMascota);
                    $imagen->guardaImagen();
                }
                header('Location: ./gestionaRegistroMascota.php?id_amo='.$result.'&nombre='.$nombreMascota.'&raza='.$raza.'&tipo='.$tipo.'&bio='.$bio.'&urlFoto='.$urlFotoMascota);
            
            }else if($rol == 2){
                if(isset($_FILES['fotoPerfilComercio'])  && $_FILES['fotoPerfilComercio']['error'] == 0){
                    $nombre_imagen = $_FILES['fotoPerfilComercio']['name'];
                    $imagen_tmp =$_FILES['fotoPerfilComercio']['tmp_name'];
                    
                    $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $nickname, $urlFotoComercio);
                    $imagen->guardaImagen();
                }
                header('Location: ./gestionaRegistroComercio.php?id_amo='.$result.'&nombre='.$nombreComercio.'&telefono='.$telefono.'&correo='.$correo.'&descripcion='.$descripcion.'&urlFoto='.$urlFotoComercio);
                    
            }else
                header('Location: ./views/registro.php');
        }

        else{
            $_SESSION['MensajeError'] = "otro";
            header('Location: ./views/registro.php');
        }
    }

?>