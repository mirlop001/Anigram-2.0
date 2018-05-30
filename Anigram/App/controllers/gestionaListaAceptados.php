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

// $idAmo = $usuario->getUserConMascota($nombreDueño);
// $mascotasByAmo = $mascota->getMascotasByIDUsuario($idAmo['ID']);
 $IDTipoMascota = $tipoMascota->getIDByNombre($tipo);
if($tipo || $nombreMascota || $nombreDueño){
    $_SESSION['conFiltro']= true;
    if($tipo!=null && $nombreMascota == null && $nombreDueño ==null){
            $_SESSION['busquedaTipo'] = $IDTipoMascota['ID']; 
            $_SESSION['mascotaByTipo'] = true;
            

    }
    else if($tipo!=null && $nombreMascota!=null && $nombreDueño == null){
            $_SESSION['busquedaNombreMascota'] = $nombreMascota;
            $_SESSION['busquedaTipo'] = $IDTipoMascota['ID']; 
            $_SESSION['mascotaByNombreTipo'] = true;
    
    }
    else if($tipo && $nombreMascota==null && $nombreDueño){
            $IDAmo = $usuario->getUserConMascota($nombreDueño);
            $_SESSION['busquedaNombreDueño'] = $IDAmo['ID'];
            $_SESSION['busquedaTipo'] = $IDTipoMascota['ID']; 
            $_SESSION['mascotaByDueñoTipo'] = true;
            
    }
    else if($tipo && $nombreMascota && $nombreDueño){
            
            $_SESSION['nombreDueñoBuscado'] = $nombreDueño;
            $_SESSION['nombreMascotaBuscada']= $nombreMascota;
            $_SESSION['tipoBuscado'] = $tipo;
            $_SESSION['IDAmoBuscado'] = $idAmo['ID'];               
              
    }     
}  
                    
        
else $_SESSION['conFiltro']=false;
      
header('Location: ../views/amigos.php');
exit();
 

?>