<?php
namespace es\ucm\fdi\aw;
include '../models/tipoMascota_model.php';
include '../models/mascota_model.php';

    class Mascota_Controller{
        function __Construct(){}
        
        public static function getTiposMascota(){
            $modelo_tipoMascota = new TipoMascota_Model();
            $drpTipos = "";
            $tipos_mascota = $modelo_tipoMascota->getTiposMascota();
            
            foreach( $tipos_mascota as $tipo ){
                $drpTipos = $drpTipos." <li class='dropdown-item tipo-mascota-drp' href='#' value='".$tipo->getID()."' > <img ";
                
                if($tipo->getURLIcono() && $tipo->getURLIcono()!= "")
                    $drpTipos = $drpTipos."src='__urlFotoIcono__".$tipo->getURLIcono()."' ";
                else   
                    $drpTipos = $drpTipos."src='".__urlFotoMascota__."'";
                    
                $drpTipos = $drpTipos."alt='perro-icon'><h2>".$tipo->getNombre()."</h2></li>";
            }
            return $drpTipos;
        }

        public static function getMascotasUsuario($usuario){
            $modelo_mascota = new Mascota_Model();
            $selectMascota = "";
            $mascotas = $modelo_mascota->getMascotasByIDUsuario($usuario);

            if($mascotas){
                foreach( $mascotas as $mascota ){
                    
                    // $selectMascota = $selectMascota."<div class='row'><div class='radio-mascota'><label><input type='radio' class='radio-mascotas' name='mascota' value='".$mascota->getID()."'><img class='perfil-md' ";
                    $selectMascota = $selectMascota.'<div class="div-seleccion-mascota"><button type="submit" name="idMascota" value="'.$mascota->getID().'" ><span class="d-inline-block" data-toggle="popover" data-content="Disabled popover"><img class="perfil-pe selector-mascota navbar-item" ';
                    
                    if($mascota->getURLfoto() && $mascota->getURLfoto()!= "")
                        $selectMascota = $selectMascota."src='".__urlFotoGuardada__.$mascota->getURLfoto()."' ";
                    else
                        $selectMascota = $selectMascota."src='".__urlFotoMascota__."'";
                    
                    $selectMascota = $selectMascota."alt='".$mascota->getNombre()."' /></span></button></div>";
                }
            }
            return $selectMascota;
        }

        function getDatosMascotaPrincipal($IDMascota){
            $modelo_mascota = new Mascota_Model();
            return  $modelo_mascota->getMascotasByID($IDMascota);
            
        }

    
    }
?>

