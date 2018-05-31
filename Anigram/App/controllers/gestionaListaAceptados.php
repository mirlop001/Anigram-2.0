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

$IDTipoMascota = htmlspecialchars(trim(strip_tags($_REQUEST['tipo'])));
$nombreMascota = htmlspecialchars(trim(strip_tags($_REQUEST['nombreMascota'])));
$nombreDueño = htmlspecialchars(trim(strip_tags($_REQUEST['nombreDueño'])));

// $idAmo = $usuario->getUserConMascota($nombreDueño);
// $mascotasByAmo = $mascota->getMascotasByIDUsuario($idAmo['ID']);
//  $IDTipoMascota = $tipoMascota->getIDByNombre($tipo);
if($IDTipoMascota || $nombreMascota || $nombreDueño){
    $_SESSION['conFiltro']= true;
    if($IDTipoMascota!=null && $nombreMascota == null && $nombreDueño ==null){
            $_SESSION['busquedaTipo'] = $IDTipoMascota;
            $_SESSION['mascotaByTipo'] = true;
            

    }
    else if($IDTipoMascota == null && $nombreMascota != null && $nombreDueño ==null){
            $_SESSION['busquedaNombreMascota'] = $nombreMascota;
            $_SESSION['mascotabyNombre'] = true;

    }
    else if($IDTipoMascota == null && $nombreMascota == null && $nombreDueño !=null){
        $IDAmo = $usuario->getUserConMascota($nombreDueño);
        $_SESSION['busquedaDueño'] = $IDAmo['ID'];
        $_SESSION['mascotabyDueño'] = true;

    }
    else if($IDTipoMascota!=null && $nombreMascota!=null && $nombreDueño == null){
            $_SESSION['busquedaNombreMascota'] = $nombreMascota;
            $_SESSION['busquedaTipo'] = $IDTipoMascota;
            $_SESSION['mascotaByNombreTipo'] = true;
    
    }
    else if($IDTipoMascota == null && $nombreMascota!=null && $nombreDueño != null){
        $_SESSION['busquedaMascota'] = $nombreMascota;
        $IDAmo = $usuario->getUserConMascota($nombreDueño);
        $_SESSION['busquedaAmo'] = $IDAmo['ID'];
        $_SESSION['mascotaByMascotaDueño'] = true;

   }
    else if($IDTipoMascota && $nombreMascota==null && $nombreDueño){
            $IDAmo = $usuario->getUserConMascota($nombreDueño);
            $_SESSION['busquedaNombreDueño'] = $IDAmo['ID'];
            $_SESSION['busquedaTipo'] = $IDTipoMascota; 
            $_SESSION['mascotaByDueñoTipo'] = true;
            
    }
    else if($IDTipoMascota && $nombreMascota && $nombreDueño){
            
            $_SESSION['nombreDueñoBuscado'] = $nombreDueño;
            $_SESSION['nombreMascotaBuscada']= $nombreMascota;
            $_SESSION['tipoBuscado'] = $IDTipoMascota;
            $_SESSION['IDAmoBuscado'] = $idAmo['ID'];
            $_SESSION['busquedafiltro']= true;
    }     
}  
                    
        
else $_SESSION['conFiltro']=false;
      
header('Location: ../views/amigos.php');
exit();
 

?>