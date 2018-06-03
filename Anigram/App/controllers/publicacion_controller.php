<?php
namespace es\ucm\fdi\aw;
include_once '../models/media_model.php';
include_once '../models/woof_model.php';
include_once '../models/comentarios_model.php';
include_once '../models/usuario_model.php';
include_once '../models/hashtag_model.php';
include_once '../models/amigos_model.php';

    class Publicacion_Controller{
        private $actualPage;

        function __Construct($page = 0){
            $this->actualPage = $page;
        }

        function vistaImagen($idMedia){
            $media_model = new Media_Model;
            $comentario_model = new Comentario_Model;
            $woof_model = new Woof_Model;

            $publicacion = $media_model->getDatosPublicacion($idMedia);
            $comentarios = $comentario_model->getComentariosPublicacion($idMedia);
            $datos_imagen = "";

            if($publicacion){
                $datos_imagen = '<div class="modal-header">  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <button class="btn-perfil vista-imagen" value="'.$publicacion->getIDMascota().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                        <h2 class="modal-title">'.$publicacion->getNombreMascota().'</h2>
                    </button>';
                    
                $datos_imagen = $datos_imagen.'</div>
                <div class="modal-body">
                    <div class="row" id="vista-imagen">
                        <img class="vista-imagen" src='.__urlFotoGuardada__.$publicacion->getURLImagen().' alt="Imagen temporal">
                    </div>
                    <div class="row">
                        <div class="col-6 offset-3">
                            '.$this->displayWoofsForm($idMedia).'
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <label for="Publicaciones">Comentarios</label>
                    <div class="row" id="publicaciones">';
                        if($comentarios){
                            foreach($comentarios as $comentario){    
                                $datos_imagen = $datos_imagen.'<div class="col-4">
                                    <img src="'.__urlFotoGuardada__.$comentario->getImagenMascota().'" alt="'.$comentario->getComentario().'">
                                </div>';
                            }
                        }
                    $datos_imagen = $datos_imagen.'</div>
                </div>';
            }
            return $datos_imagen;
        }       

        private function getVistaPublicaciones($publicaciones){
            $modelo_media = new Media_Model();
            $modelo_woofs = new Woof_Model();
            $modelo_comentario = new Comentario_Model();
            $posts ="";
            
            
            foreach( $publicaciones as $publicacion ){
                $post = '<div class="row"><div class="publicacion offset-md-1 col-md-6 col-sm-12">
                                <button class="btn-perfil" value="'.$publicacion->getIDMascota().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                <label><img ';
                if($publicacion->getURLImagenMascota() != ""){
                    $post = $post.' src="'.__urlFotoGuardada__.$publicacion->getURLImagenMascota().'"';
                } 
                else   
                    $post = $post."src='".__urlFotoMascota__."'";
                                $post = $post.' class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$publicacion->getNombreMascota().'</label></button>
                            <div class="foto-publicada">
                                    <img  src="'.__urlFotoGuardada__.$publicacion->getURLImagen().'" alt="foto-publicada"/>
                            </div>
                        </div>
                        <div class="publicacion comentarios  offset-md-1 col-md-4 col-sm-12">
                            '.$this->displayWoofsForm($publicacion->getID()).'
                            <label >Ultimos woofs</label>
                            <div class="div-comentarios woofs">';
                
                $woofsPublicacion = $publicacion->getWoofs();
                if($woofsPublicacion)
                    foreach($woofsPublicacion as $woof){            
                        $post = $post.'<div class="row"> <div class="col-2"><img src="'.(($woof->getImagenMascota()!="")? __urlFotoGuardada__.$woof->getImagenMascota(): __urlFotoMascota__ ).'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div><div class="col-3"><h5 class="nombre-Mascota-post">'.$woof->getNombreMascota().'</h5></div><div class="woof-icons col-6">'.$this->getWoofsMascota($woof->getPuntos()).'</div></div>';
                        
                    }

                $post =  $post.'</div><div class="div-comentarios"><label >Ultimos comentarios</label>';
                if(isset($_SESSION["UserID"])){
                $post =  $post. '<form method="POST"  class="form-comentario publica-comentario">
                                    <input type="hidden" name="UserID" value="'.$_SESSION["UserID"].'">
                                    <input type="hidden" class ="mediaID" name="MediaID" value="'.$publicacion->getID().'">
                                    <textarea name="Comentario" class="formulario-textbox nuevoComentario" rows="3" placeholder="Tu comentario" cols="20"  ></textarea>
                                    <input type="submit" class="nuevoComentario btn-guardarComentario" value="Enviar">
                                </form>';
                }
                $post = $post.' <div id="nuevos-comentarios-post'.$publicacion->getID().'" class="comentarios-publicacion">';
                $comentariosPublicacion = $modelo_comentario->getComentariosPublicacion($publicacion->getID());
                if($comentariosPublicacion)
                    foreach($comentariosPublicacion as $comentario){            
                        $post = $post.' <div class="comentario row"> <div class="col-2"><img src="'.(($comentario->getImagenMascota()!="")? __urlFotoGuardada__.$comentario->getImagenMascota(): __urlFotoMascota__ ).'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div>
                                            <div class="col-10">
                                                <div class="row"><label>'.$comentario->getNombreMascota().'</label></div>
                                                <div class="row"><p>'.$comentario->getComentario().'</p></div>
                                            </div>
                                        </div>';
                    }                  
                    
                $posts = $posts.$post.'</div></div></div></div>';
            }
            return $posts;
        }

        public function publicacion_controller($comentario, $hashtag){
            $modelo_media = new Media_Model();
            $publicaciones_encontradas = $modelo_media->busquedaParcialPublicacion($comentario, $hashtag);
            $posts  = "";

            if($publicaciones_encontradas){
                $posts = $this->getVistaPublicaciones($publicaciones_encontradas);
            }
            return $posts;
        }

        public function obtenerTodasPublicaciones(){
            $modelo_media = new Media_Model();

            $ultimasPublicaciones = $modelo_media->obtenerTodasPublicaciones($this->actualPage);
            $posts  = "";

            if($ultimasPublicaciones){
                $posts = $this->getVistaPublicaciones($ultimasPublicaciones);
            }
            return $posts;
        } 

        public function getUltimasPublicaciones(){
            $modelo_media = new Media_Model();
            $modelo_woofs = new Woof_Model();
            $modelo_comentario = new Comentario_Model();
            $modelo_amigos = new Amigos_Model();

            if(isset($_SESSION['IDPerfilActivo']) )
                $tieneAmigos = $modelo_amigos->tieneAmigos($_SESSION['IDPerfilActivo']);

            $posts  = "";
            if(isset($_SESSION['IDPerfilActivo']) && $tieneAmigos > 0)
                $ultimasPublicaciones = $modelo_media->getUltimasNPublicaciones($this->actualPage);
            else
                $ultimasPublicaciones = $modelo_media->obtenerTodasPublicaciones($this->actualPage);

            if($ultimasPublicaciones){
                $posts = $this->getVistaPublicaciones($ultimasPublicaciones);
            }
            return $posts;
        }

        private function getWoofsMascota($numWoofs){
            $woofsIcons = "<div class='woof-icons'>";
            for($i=0; $i<$numWoofs;$i++){
                $woofsIcons = $woofsIcons ."<i class='fas fa-paw woofed'></i>";
            }
            
            return $woofsIcons.'</div>';
        }

        public function cargaNuevaPagina(){
            $this->actualPage++;
            $this->getUltimasPublicaciones();
        }

        private function displayWoofsForm($mediaID){
            $btnWoofs = "";
            if(isset($_SESSION["UserID"])){
                $btnWoofs = '<form class="form-woof">
                            <input type="hidden" name="UserID" value="'.$_SESSION["UserID"].'">
                            <input type="hidden" class ="mediaID" name="MediaID" value="'.$mediaID.'">
                            <button type="submit" name="Puntos" class="btn-woof puntos-1 media-'.$mediaID.'" value="1"><i class="fas fa-paw"></i></button>
                            <button type="submit" name="Puntos" class="btn-woof puntos-2 media-'.$mediaID.'" value="2"><i class="fas fa-paw"></i></button>
                            <button type="submit" name="Puntos" class="btn-woof puntos-3 media-'.$mediaID.'" value="3"><i class="fas fa-paw"></i></button>
                            <button type="submit" name="Puntos" class="btn-woof puntos-4 media-'.$mediaID.'" value="4"><i class="fas fa-paw"></i></button>
                            <button type="submit" name="Puntos" class="btn-woof puntos-5 media-'.$mediaID.'" value="5"><i class="fas fa-paw"></i></button>
                        </form>';
            }
            return $btnWoofs;
            
        }

        private function showAvgWoofs($numWoofs){
            $woofs = "";
            for($i = 0; $i < $numWoofs; $i++){
                $woofs = "<i class='fas fa-paw woofed'></i>";
            }
            for($i = $numWoofs ; $i < 5; $i++){
                $woofs = "<i class='fas fa-paw'></i>";
            }
        }
    }
?>



