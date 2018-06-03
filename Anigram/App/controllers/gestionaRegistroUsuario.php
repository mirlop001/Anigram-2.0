<?php

use es\ucm\fdi\aw\SubidaImagen_Controller;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";
    require_once "../controllers/gestionaSubidaImagen.php";
    require_once "../controllers/password_compat-master/lib/password.php";
	require_once "../models/mascota_model.php";

	$modeloMascota = new es\ucm\fdi\aw\Mascota_Model();
    $modeloUsuario = new es\ucm\fdi\aw\Usuario_Model();
    $response = null;
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
    $urlFotoMascota = "";

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
        $_SESSION['NombreCompleto'] = $nombreCompleto;
        $_SESSION['RolUsuario'] = $rol;
        $_SESSION['Email'] = $email; 

        if(isset($_FILES['perfilUsuario']) && $_FILES['perfilUsuario']['error'] == 0){
            $nombre_imagen = $_FILES['perfilUsuario']['name'];
            $imagen_tmp =$_FILES['perfilUsuario']['tmp_name'];
            $foto = $result.'-'.$nombre_imagen;

            $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $foto);
            $imagen->guardaImagen();
            
            echo 'IMAGEN GUARDADA';
        }

        if($rol == 1){

            if(isset($_FILES['fotoPerfilMascota']) && $_FILES['fotoPerfilMascota']['error'] == 0){
                $nombre_imagen = $_FILES['fotoPerfilMascota']['name'];
                $imagen_tmp =$_FILES['fotoPerfilMascota']['tmp_name'];
                $urlFotoMascota = $result.'-'.$nombre_imagen;

                $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $urlFotoMascota);
                $imagen->guardaImagen();
            }
            
            $nueva_mascota = $modeloMascota->registraMascota($result, $tipo, $nombreMascota, $raza, $bio, $urlFotoMascota);
            if($nueva_mascota){
                $_SESSION['IDPerfilActivo'] = $nueva_mascota;

                if($urlFotoMascota )
                    $_SESSION['fotoPerfilActivo'] = __urlFotoGuardada__.$urlFotoMascota;
                $response = 'OK!';
                // return new Exception('Error en el registro');
            }
        }else if($rol == 2){
            if(isset($_FILES['fotoPerfilComercio'])  && $_FILES['fotoPerfilComercio']['error'] == 0){
                $nombre_imagen = $_FILES['fotoPerfilComercio']['name'];
                $imagen_tmp =$_FILES['fotoPerfilComercio']['tmp_name'];
                $urlFotoMascota = $result.'-'.$nombre_imagen;

                $imagen = new SubidaImagen_Controller($imagen_tmp, $nombre_imagen, $result, $urlFotoComercio);
                $imagen->guardaImagen();
            }
            header('Location: ./gestionaRegistroComercio.php?id_amo='.$result.'&nombre='.$nombreComercio.'&telefono='.$telefono.'&correo='.$correo.'&descripcion='.$descripcion.'&urlFoto='.$urlFotoComercio);
            exit;

        }else{
            header('Location: ../views/registro.php');
            exit;
        }
    
    }
    echo $response;

?>
