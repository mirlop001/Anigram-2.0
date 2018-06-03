<?php
namespace es\ucm\fdi\aw;
include_once '../models/mascota_model.php';
include_once '../models/media_model.php';
include_once '../controllers/publicacion_controller.php';


    class Busqueda_Controller{
        function __Construct(){}

        
        function getBusquedaMascota($mascota){
            
            $imagenMascota = '<button class="btn-perfil basic" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >';
            
            if($mascota->getURLFoto() != ""){
                $imagenMascota = $imagenMascota.'<img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-basic .foto-perfil-mascota"  alt="foto-perfil-publicación">';
            } 
            $imagenMascota = $imagenMascota.'<h3>'.$mascota->getNombre().'</h3></button>';
            
            return $imagenMascota;
        }


        function busquedaParcialMascotas($palabraClave){
            $modelo_mascota = new Mascota_Model;
            $mascotas_encontradas = $modelo_mascota->busquedaParcialMascotas($palabraClave);
            return $mascotas_encontradas;
        }


        function busquedaParcialPublicaciones($palabraClave){
            $Publicacion_controller = new Publicacion_controller;
            $publicaciones = $Publicacion_controller->busquedaParcialPublicaciones($palabraClave, $palabraClave);

            return $publicaciones;
        }
    }

?>