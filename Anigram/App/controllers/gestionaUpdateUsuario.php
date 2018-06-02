<?php

use es\ucm\fdi\aw\SubidaImagen_Controller;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";
    require_once "../models/mascota_model.php";
    require_once "../controllers/gestionaSubidaImagen.php";
    require_once "../controllers/password_compat-master/lib/password.php";

    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();
    $modeloMascota = new es\ucm\fdi\aw\Mascota_Model();

    $urlFoto = null;
    $urlFotoMascota = null;
    $nombreCompleto = null;
    $email = null;
    $clave1 = null;
    $clave2 = null;
    $rol = null;

    $nombre = null;
    $raza  = null;
    $tipo = null;
    $bio = null;
    $fotoPerfilMascota = null;

    $nuevoNombre = null;
    $nuevaRaza = null;
    $nuevoTipo = 1;
    $nuevaBio = null;
    $nuevafotoPerfilMascota = null;

    $nombre_comercio = null;
    $telefono =null;
    $email_comercio = null;
    $descripcion = null;
    $fotoPerfilComercio = null;

    //Obtener datos usuario actualizados
    if(isset($_FILES["fotoPerfilUsuario"]["name"][0]))
        $urlFoto = basename($_FILES["fotoPerfilUsuario"]["name"]);
    if(isset($_POST['nombreCompleto'])) $nombreCompleto = htmlspecialchars(trim(strip_tags($_POST['nombreCompleto'])));
    if(isset($_POST['email'])) $email = htmlspecialchars(trim(strip_tags($_POST['email'])));
    if(isset($_POST['clave1'])) $clave1 = htmlspecialchars(trim(strip_tags($_POST['clave1'])));
    if(isset($_POST['clave2'])) $clave2 = htmlspecialchars(trim(strip_tags($_POST['clave2'])));
    if(isset($_POST['rol'])) $rol = htmlspecialchars(trim(strip_tags($_POST['rol'])));


    //Mascota update
    if(isset($_POST['nombre']))   $nombreMascota = htmlspecialchars(trim(strip_tags($_POST['nombre'])));
    if(isset($_POST['raza']))   $raza = htmlspecialchars(trim(strip_tags($_POST['raza'])));
    if(isset($_POST['tipo']))$tipo = htmlspecialchars(trim(strip_tags($_POST['tipo'])));
    if(isset($_POST['bio']))$bio = htmlspecialchars(trim(strip_tags($_POST['bio'])));
    if(isset($_FILES['fotoPerfilMascota']))if($_FILES['fotoPerfilMascota']) $urlFotoMascota = $_SESSION['UserID'].'-'.$_FILES['fotoPerfilMascota'];

    //NuevaMascota
    if(isset($_POST['nuevoNombre']))$nuevoNombreMascota = htmlspecialchars(trim(strip_tags($_POST['nuevoNombre'])));
    if(isset($_POST['nuevaRaza']))$nuevaRaza = htmlspecialchars(trim(strip_tags($_POST['nuevaRaza'])));
    if(isset($_POST['nuevoTipo']))$nuevoTipo = htmlspecialchars(trim(strip_tags($_POST['nuevoTipo'])));
    if(isset($_POST['nuevaBio']))$nuevaBio = htmlspecialchars(trim(strip_tags($_POST['nuevaBio'])));
    if(isset($_FILES["nuevafotoPerfilMascota"]["name"][0])&& $_FILES["nuevafotoPerfilMascota"]["name"][0]!= "") 
        $nuevafotoPerfilMascota = $_SESSION['UserID'].'-'.basename($_FILES['nuevafotoPerfilMascota']["name"]);

    //Obtener foto de la mascota
    if(isset($_FILES["fotoPerfilMascota"]["name"][0])&& $_FILES["fotoPerfilMascota"]["name"][0]!= "")
        $urlFotoMascota = $_SESSION['UserID'].'-'.basename($_FILES["fotoPerfilMascota"]["name"]);

    //Comercio
    if(isset($_POST['nombre_comercio'])) $nombreComercio = htmlspecialchars(trim(strip_tags($_POST['nombre_comercio'])));
    if(isset($_POST['telefono'])) $telefono = htmlspecialchars(trim(strip_tags($_POST['telefono'])));
    if(isset($_POST['email_comercio'])) $correo = htmlspecialchars(trim(strip_tags($_POST['email_comercio'])));
    if(isset($_POST['descripcion'])) $descripcion = htmlspecialchars(trim(strip_tags($_POST['descripcion'])));
    $urlFotoComercio = "";

    //Obtener foto del comercio
    if(isset($_FILES["fotoPerfilComercio"]["name"][0])&& $_FILES["fotoPerfilComercio"]["name"][0]!= "")
        $urlFotoComercio = $_SESSION['UserID'].'-'.basename($_FILES["fotoPerfilComercio"]["name"]);

    if($clave1){
        $hash =  password_hash($clave1, PASSWORD_BCRYPT);
        $modeloUsuario->actualizaPass($hash);
    }

    if($email){
        $modeloUsuario->actualizaEmail($email);
    }

    if($nombreCompleto){
        $modeloUsuario->actualizaNombreUsuario($nombreCompleto);
        $_SESSION['ErrorRegistro'] = false;
        $_SESSION['Nombre'] = $nombreCompleto;

        if(isset($_FILES['fotoPerfilUsuario']) && $_FILES['fotoPerfilUsuario']['error'] == 0){
            $nombre_imagen = $_FILES['fotoPerfilUsuario']['name'];
            $imagen_tmp =$_FILES['fotoPerfilUsuario']['tmp_name'];
            $foto = $_SESSION['UserID'].'-'.$nombre_imagen;
            $_SESSION['fotoPerfilUsuario'] = $_SESSION['UserID'].'-'.$nombre_imagen;

            $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $_SESSION['UserID'], $urlFoto);
            $imagen->guardaImagen();

            echo 'IMAGEN GUARDADA';
        }
    }
    $mascota = $modeloMascota->getMascotaPrincipalByID($_SESSION['UserID']);
    $idMascota = $mascota->getID();

    if($nombreMascota){
        $modeloMascota->updateNombre($nombreMascota, $idMascota );
    }

    if($raza){
        $modeloMascota->updateRaza($raza, $idMascota);
    }

    if($tipo){
        $modeloMascota->updateTipo($tipo, $idMascota);
    }

    if($bio){
        $modeloMascota->updateBio($bio, $idMascota);
    }

    if($urlFotoMascota){
        $modeloMascota->updateURL($urlFotoMascota, $idMascota);
        $_SESSION['fotoPerfilMascota'] = __urlFotoGuardada__.$urlFotoMascota;
        $_SESSION['fotoPerfilActivo'] = __urlFotoGuardada__.$urlFotoMascota;
        
        if(isset($_FILES['fotoPerfilMascota']) && $_FILES['fotoPerfilMascota']['error'] == 0){
            $nombre_imagen = $_FILES['fotoPerfilMascota']['name'];
            $imagen_tmp =$_FILES['fotoPerfilMascota']['tmp_name'];
            $foto = $_SESSION['UserID'].'-'.$nombre_imagen;
            $_SESSION['fotoPerfilMascota'] = $_SESSION['UserID'].'-'.$nombre_imagen;

            $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $_SESSION['UserID'], $urlFotoMascota);
            $imagen->guardaImagen();

            echo 'IMAGEN GUARDADA';
        }
    }


    if($nuevoNombreMascota  && $nuevaRaza && $nuevoTipo ){
        if($modeloMascota->registraMascota($_SESSION['UserID'], $nuevoTipo, $nuevoNombreMascota, $nuevaRaza, $nuevaBio, $nuevafotoPerfilMascota) ){

            if($urlFoto ){
                $_SESSION['fotoPerfilMascota'] = __urlFotoGuardada__.$nuevafotoPerfilMascota;
                $_SESSION['fotoPerfilActivo'] = __urlFotoGuardada__.$nuevafotoPerfilMascota;
                if(isset($_FILES['nuevafotoPerfilMascota']) && $_FILES['nuevafotoPerfilMascota']['error'] == 0){
                    $nombre_imagen = $_FILES['nuevafotoPerfilMascota']['name'];
                    $imagen_tmp =$_FILES['nuevafotoPerfilMascota']['tmp_name'];
                    $foto = $_SESSION['UserID'].'-'.$nombre_imagen;
                    $_SESSION['nuevafotoPerfilMascota'] = $_SESSION['UserID'].'-'.$nombre_imagen;
        
                    $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $_SESSION['UserID'], $nuevafotoPerfilMascota);
                    $imagen->guardaImagen();
        
                    echo 'IMAGEN GUARDADA';
                }
            }    
            return new Exception('Error en el registro');
        }
        else {
            return new Exception('Error en el registro');
        }
        echo 'crea nuevo';
    }
echo 'nombre: '.$nuevoNombreMascota.' raza: '.$nuevaRaza.' tipo: '.$nuevoTipo;


?>
