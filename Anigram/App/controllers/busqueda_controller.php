<?php
namespace es\ucm\fdi\aw;
include_once '../models/mascota_model.php';
include_once '../models/hashtag_model.php';
include_once '../models/comentarios_model.php';


    class Busqueda_Controller{
        function __Construct(){}

        
        function getBusquedaMascota($mascota){
            
            $imagenMascota = '<button class="btn-perfil basic" value="'.$mascota->getID().'" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">';
            
            if($mascota->getURLFoto() != ""){
                $imagenMascota = $imagenMascota.'<img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-basic .foto-perfil-mascota"  alt="foto-perfil-publicación">';
            } 
            $imagenMascota = $imagenMascota.'<h3>'.$mascota->getNombre().'</h3></button>';

            return $imagenMascota;
        }

        function getBusquedaHashtag($hashtag){
            
            $botonHashtag = '<button class="btn-basic word-square col-4" value="'.$hashtag->getIDMedia().'" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">';
            $botonHashtag = $botonHashtag.'<img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="img-result"  alt="foto-perfil-publicación"><h3>'.$mascota->getNombre().'</h3></button>';

            return $botonHashtag;
        }

        function getBusquedaComentarios($comentario){
            
            $botonComentario = '<button class="btn-basic word-square col-4" value="'.$comentario->getIDMedia().'" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">';
            $botonComentario = $botonComentario.'<img src="../../public/img/saved/137-IMG_2313.jpg" class="img-result" alt="foto-perfil-publicación"><h3>'.$comentario->getComentario().'</h3></button>';

            return $botonComentario;
        }

        function busquedaParcialMascotas($palabraClave){
            $modelo_mascota = new Mascota_Model;
            $mascotas_encontradas = $modelo_mascota->busquedaParcialMascotas($palabraClave);
            return $mascotas_encontradas;
        }

        function busquedaParcialHashtag($palabraClave){
            $hashtag_model = new Hashtag_Model;
            $hashtags_encontrados = $hashtag_model->busquedaParcialHashtag($palabraClave);

            return $hashtags_encontrados;
        }

        function busquedaParcialComentarios($palabraClave){
            $comentario_model = new Comentario_model;
            $comentarios_encontrados = $comentario_model->busquedaParcialComentarios($palabraClave);

            return $comentarios_encontrados;
        }
    }

?>