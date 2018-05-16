<?php

use es\ucm\fdi\aw\SubidaImagen_Controller;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";
    require_once "../controllers/gestionaSubidaImagen.php";
    require_once "../controllers/password_compat-master/lib/password.php";

    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();

    $urlFoto = null;
    //Obtener datos usuario
    if(isset($_FILES["fotoPerfilUsuario"]["name"][0]))
        $urlFoto = basename($_FILES["fotoPerfilUsuario"]["name"]);

    $nombreCompleto = htmlspecialchars(trim(strip_tags($_POST['nombreCompleto'])));
    $email = htmlspecialchars(trim(strip_tags($_POST['email'])));
    $clave1 = htmlspecialchars(trim(strip_tags($_POST['clave1'])));
    $clave2 = htmlspecialchars(trim(strip_tags($_POST['clave2'])));
    $rol = htmlspecialchars(trim(strip_tags($_POST['rol'])));

    //Mascota
    $nombreMascota = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
    $raza = htmlspecialchars(trim(strip_tags($_POST['raza'])));
    $tipo = htmlspecialchars(trim(strip_tags($_POST['tipo'])));
    $bio = htmlspecialchars(trim(strip_tags($_POST['bio'])));
    $urlFotoMascota = basename($_FILES["fotoPerfilComercio"]["name"]);

    //Obtener foto de la mascota
    if(isset($_FILES["fotoPerfilMascota"]["name"][0])&& $_FILES["fotoPerfilMascota"]["name"][0]!= "")
        $urlFotoMascota = basename($_FILES["fotoPerfilMascota"]["name"]);



    //Comercio
    $nombreComercio = htmlspecialchars(trim(strip_tags($_POST['nombre_comercio'])));
    $telefono = htmlspecialchars(trim(strip_tags($_POST['telefono'])));
    $correo = htmlspecialchars(trim(strip_tags($_POST['email_comercio'])));
    $descripcion = htmlspecialchars(trim(strip_tags($_POST['descripcion'])));
    $urlFotoComercio = "";

    //Obtener foto del comercio
    if(isset($_FILES["fotoPerfilComercio"]["name"][0])&& $_FILES["fotoPerfilComercio"]["name"][0]!= "")
        $urlFotoComercio = basename($_FILES["fotoPerfilComercio"]["name"]);

    $hash =  password_hash($clave1, PASSWORD_BCRYPT);
    if($result = $modeloUsuario->registraUsuario($nombreCompleto, $email, $hash , $rol, $urlFoto)){
        $_SESSION['ErrorRegistro'] = false;
        $_SESSION['UserID'] = $result;
        $_SESSION['Nombre'] = $nombreCompleto;
        $_SESSION['RolUsuario'] = $rol;

        if(isset($_FILES['fotoPerfilUsuario']) && $_FILES['fotoPerfilUsuario']['error'] == 0){
            $nombre_imagen = $_FILES['fotoPerfilUsuario']['name'];
            $imagen_tmp =$_FILES['fotoPerfilUsuario']['tmp_name'];
            $foto = $result.'-'.$nombre_imagen;
            $_SESSION['fotoPerfilUsuario'] = $result.'-'.$nombre_imagen;

            $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $foto);
            $imagen->guardaImagen();
            
            echo 'IMAGEN GUARDADA';
        }

        if($rol == 1){

            if(isset($_FILES['fotoPerfilMascota']) && $_FILES['fotoPerfilMascota']['error'] == 0){
                $nombre_imagen = $_FILES['fotoPerfilMascota']['name'];
                $imagen_tmp =$_FILES['fotoPerfilMascota']['tmp_name'];

                $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $urlFotoMascota);
                $imagen->guardaImagen();
            }
            echo 'va al registro mascota';
            header('Location: ./gestionaRegistroMascota.php?id_amo='.$result.'&nombre='.$nombreMascota.'&raza='.$raza.'&tipo='.$tipo.'&bio='.$bio.'&urlFoto='.$result.'-'.$urlFotoMascota);
            exit;
        }else if($rol == 2){
            if(isset($_FILES['fotoPerfilComercio'])  && $_FILES['fotoPerfilComercio']['error'] == 0){
                $nombre_imagen = $_FILES['fotoPerfilComercio']['name'];
                $imagen_tmp =$_FILES['fotoPerfilComercio']['tmp_name'];

                $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $urlFotoComercio);
                $imagen->guardaImagen();
            }
            echo 'va al registro comercio';
            header('Location: ./gestionaRegistroComercio.php?id_amo='.$result.'&nombre='.$nombreComercio.'&telefono='.$telefono.'&correo='.$correo.'&descripcion='.$descripcion.'&urlFoto='.$result.'-'.$urlFotoComercio);
            exit;

        }else{
            echo 'ERROR';
            header('Location: ../views/registro.php');
            exit;
        }
    
    }

?>