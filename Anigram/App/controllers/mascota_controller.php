<?php
namespace es\ucm\fdi\aw;
include '../models/tipoMascota_model.php';
    class Mascota_Controller{
        function __Construct(){}
        
        public static function getTiposMascota(){
            $modelo_tipoMascota = new TipoMascota_Model();
            $drpTipos = "";
            $tipos_mascota = $modelo_tipoMascota->getTiposMascota();
            
            foreach( $tipos_mascota as $tipo ){
                $drpTipos = $drpTipos." <li class='dropdown-item tipo-mascota-drp' href='#' value='".$tipo->getID()."' > <img src='../../public/img/".$tipo->getURLIcono()."' alt='perro-icon'><h2>".$tipo->getNombre()."</h2></li>";
            }
            return $drpTipos;
        }
    
    }
?>