<?php
namespace es\ucm\fdi\aw;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";  
    require_once "../models/mascota_model.php";
    require_once "../models/amigos_model.php";
    require_once "../models/tipoMascota_model.php";

$amigos = new Amigos_Model();
$mascota = new Mascota_Model();
$tipoMascota = new TipoMascota_Model();
$usuario = new Usuario_Model();

$tipo = htmlspecialchars(trim(strip_tags($_REQUEST['tipo'])));
$nombreMascota = htmlspecialchars(trim(strip_tags($_REQUEST['nombreMascota'])));
$nombreDueño = htmlspecialchars(trim(strip_tags($_REQUEST['nombreDueño'])));

$idAmo = $usuario->getUserConMascota($nombreDueño);
$mascotasByAmo = $mascota->getMascotasByIDUsuario($idAmo['ID']);


//$mascotaBuscada = $mascota->getMascotasByIDUsuario($id)
        if($tipo && $nombreMascota && $nombreDueño){
                    $_SESSION['conFiltro']=true;
                    $_SESSION['nombreDueñoBuscado'] = $nombreDueño;
                    $_SESSION['nombreMascotaBuscada']= $nombreMascota;
                    $_SESSION['tipoBuscado'] = $tipo;
                    $_SESSION['IDAmoBuscado'] = $idAmo['ID'];
              
                    }
                    
                    
                
 
        
        else {
            $_SESSION['conFiltro']=false;
        }
    

         header('Location: ../views/amigos.php');
         exit();
 

?>