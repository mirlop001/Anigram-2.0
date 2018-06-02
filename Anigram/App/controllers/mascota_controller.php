<?php
namespace es\ucm\fdi\aw;
include_once '../models/media_model.php';
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
                    $drpTipos = $drpTipos."src='".__urlFotoIcono__.$tipo->getURLIcono()."' ";
                else   
                    $drpTipos = $drpTipos."src='".__urlFotoMascota__."'";
                    
                $drpTipos = $drpTipos."alt='perro-icon'><h2>".$tipo->getNombre()."</h2></li>";
            }
            return $drpTipos;
        }

        public static function getTiposMascotaBasic(){
            $modelo_tipoMascota = new TipoMascota_Model();
            $drpTipos = "";
            $tipos_mascota = $modelo_tipoMascota->getTiposMascota();
            
            foreach( $tipos_mascota as $tipo ){
                $drpTipos = $drpTipos." <li class='dropdown-item tipo-mascota-drp basic' href='#' value='".$tipo->getID()."' > <img ";
                
                if($tipo->getURLIcono() && $tipo->getURLIcono()!= "")
                    $drpTipos = $drpTipos."src='".__urlFotoIcono__.$tipo->getURLIcono()."' ";
                else   
                    $drpTipos = $drpTipos."src='".__urlFotoMascota__."'";
                    
                $drpTipos = $drpTipos."alt='icono de mascota ".$tipo->getNombre()."' /></li>";
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

        function getDatosMascota($IDMascota){
            $modelo_mascota = new Mascota_Model();
            return  $modelo_mascota->getMascotasByID($IDMascota);
            
        }

        function getPerfilMascota($IDMascota){
            $modelo_mascota = new Mascota_Model();
            $modelo_media = new Media_Model();
            $modelo_amigos = new Amigos_Model();

            if(isset($_SESSION['IDPerfilActivo'])){ 
                $idMascotaActual = $_SESSION['IDPerfilActivo'];
                $amistad = $modelo_amigos->compruebaAmistad($idMascotaActual, $IDMascota);
            }

            $mascota = $modelo_mascota->getMascotasByID($IDMascota);
            $publicaciones = $modelo_media->getImagenesMascota($IDMascota);
            $perfil =  '<div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h2 class="modal-title">'.$mascota->getNombre().'</h2>';
                if(isset($_SESSION['UserID'])){ 
                    $perfil = $perfil.'<button id="seguir-usuario" class="btn btn-default" value="'.$mascota->getID().'"';
                    
                    if($amistad == 'no_seguido'){   
                        $perfil = $perfil.'><h4>Seguir</h4>';
                    }else if($amistad == 'no_aceptado'){
                        $perfil = $perfil.'disabled ><h4>Pendiente</h4>';
                    }else if($amistad == 'aceptado'){
                        $perfil = $perfil.'disabled ><h4>Seguido</h4>';
                    }
                }
            $perfil = $perfil. '</button>';
            $perfil = $perfil.'</div>
            <div class="modal-body">
                <div class="row" id="imagen-perfil">
                    <img class="perfil-gr" src=';
                    if($mascota->getURLfoto() && $mascota->getURLfoto()!= "")
                        $perfil = $perfil.__urlFotoGuardada__.$mascota->getURLfoto();
                    else
                        $perfil = $perfil.__urlFotoMascota__;
                    $perfil = $perfil.' alt="Imagen temporal">
                    
                </div>

                <label for="Publicaciones">Publicaciones</label>
                <div class="row" id="publicaciones">';

                foreach($publicaciones as $publicacion){    
                    $perfil = $perfil.'<div class="col-4">
                        <img src="'.__urlFotoGuardada__.$publicacion->getURLImagen().'" alt="'.$publicacion->getDescripcion().'">
                    </div>';
                }
                $perfil = $perfil.'</div>
            </div></div>';

            return $perfil;
        }
        
        function getMPrincipal($IDUser){
            $modelo_mascota = new Mascota_Model();
            return $modelo_mascota->getMascotaPrincipalByID($IDUser);
        }

       
    
    }
?>

