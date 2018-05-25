<?php
namespace es\ucm\fdi\aw;
include '../models/media_model.php';
include '../models/woof_model.php';
include '../models/comentarios_model.php';

    class Publicacion_Controller{
        private $actualPage;

        function __Construct(){
            $this->actualPage = 0;
        }
        
        public function getUltimasPublicaciones(){
            $modelo_media = new Media_Model();
            $modelo_woofs = new Woof_Model();
            $modelo_comentario = new Comentario_Model();
            $posts  = "";
            $ultimasPublicaciones = $modelo_media->getUltimasNPublicaciones($this->actualPage);
            
            if($ultimasPublicaciones)
                foreach( $ultimasPublicaciones as $publicacion ){
                    $post = '<div class="row"><div class="publicacion offset-md-1 col-md-6 col-sm-12">
                                <label><img ';
                    if($publicacion->getURLImagenMascota() != ""){
                        $post = $post.' src="../../public/img/saved/'.$publicacion->getURLImagenMascota().'"';
                    } 
                    else   
                        $post = $post."src='../../".__urlFotoMascota__."'";

                    $post = $post.' class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$publicacion->getNombreMascota().'</label>
                                <div class="foto-publicada">
                                <img  src="../../public/img/saved/'.$publicacion->getURLImagen().'" alt="foto-publicada"/>
                                </div>
                            </div>
                            <div class="publicacion comentarios  offset-md-1 col-md-4 col-sm-12">
                                '.$this->displayWoofsForm($publicacion->getID()).'
                                <label >Ultimos woofs</label>
                                <div class="div-comentarios woofs">';
                    
                    $woofsPublicacion = $publicacion->getWoofs();
                    if($woofsPublicacion)
                        foreach($woofsPublicacion as $woof){            
                            $post = $post.'<div class="row"> <div class="col-2"><img src="../../'.(($woof->getImagenUsuario()!="")? __urlFotoGuardada__.$woof->getImagenUsuario(): __urlFotoUsuario__ ).'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div><div class="col-3"><h5 class="nombre-usuario-post">'.$woof->getNombreUsuario().'</h5></div><div class="woof-icons col-6">'.$this->getWoofsUsuario($woof->getPuntos()).'</div></div>';
                            
                        }

                    $post =  $post.'</div><div class="div-comentarios"><label >Ultimos comentarios</label>';
                    if(isset($_SESSION["UserID"])){
                    $post =  $post. '<form method="POST"  class="form-comentario publica-comentario">
                                        <input type="hidden" name="UserID" value="'.$_SESSION["UserID"].'">
                                        <input type="hidden" class ="mediaID" name="MediaID" value="'.$publicacion->getID().'">
                                        <textarea name="Comentario" class="formulario-textbox nuevoComentario" rows="3" placeholder="Tu comentario" cols="20"  ></textarea>
                                        <input type="submit" class="nuevoComentario btn-guardarComentario" value="Enviar">
                                    </form>
                                    <div id="nuevos-comentarios-post'.$publicacion->getID().'" class="comentarios-publicacion">';
                    }
                    $comentariosPublicacion = $modelo_comentario->getComentariosPublicacion($publicacion->getID());
                    if($comentariosPublicacion)
                        foreach($comentariosPublicacion as $comentario){            
                            $post = $post.' <div class="comentario row"> <div class="col-2"><img src="../../'.(($comentario->getImagenUsuario()!="")? __urlFotoGuardada__.$comentario->getImagenUsuario(): __urlFotoUsuario__ ).'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div>
                                                <div class="col-10">
                                                    <div class="row"><label>'.$comentario->getNombreUsuario().'</label></div>
                                                    <div class="row"><p>'.$comentario->getComentario().'</p></div>
                                                </div>
                                            </div>';
                        }                  
                        
                    $posts = $posts.$post.'</div></div></div></div>';
                }
            return $posts;
        }

        private function getWoofsUsuario($numWoofs){
            $woofsIcons = "<div class='woof-icons'>";
            for($i=0; $i<$numWoofs;$i++){
                $woofsIcons = $woofsIcons ."<img src='../../public/img/woofed-icon.png' />";
            }
            for($i=$numWoofs; $i<5;$i++){
                $woofsIcons = $woofsIcons ."<img src='../../public/img/woof-icon.png' />";
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
                            <input type="submit" name="Puntos" class="btn-woof 1 '.$mediaID.'" value="1"/>
                            <input type="submit" name="Puntos" class="btn-woof 2 '.$mediaID.'" value="2"/>
                            <input type="submit" name="Puntos" class="btn-woof 3 '.$mediaID.'" value="3"/>
                            <input type="submit" name="Puntos" class="btn-woof 4 '.$mediaID.'" value="4"/>
                            <input type="submit" name="Puntos" class="btn-woof 5 '.$mediaID.'" value="5"/>
                        </form>';
            }
            return $btnWoofs;
            
        }
    }
?>



