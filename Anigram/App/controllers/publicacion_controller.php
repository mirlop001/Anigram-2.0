<?php
namespace es\ucm\fdi\aw;
include '../models/media_model.php';
include '../models/woof_model.php';

    class Publicacion_Controller{
        private $actualPage;

        function __Construct(){
            $this->actualPage = 0;
        }
        
        public function getUltimasPublicaciones(){
            $modelo_media = new Media_Model();
            $modelo_woofs = new Woof_Model();
            $posts  = "";
            $ultimasPublicaciones = $modelo_media->getUltimasNPublicaciones($this->actualPage);
            
            if($ultimasPublicaciones)
                foreach( $ultimasPublicaciones as $publicacion ){
                    $post = '<div class="publicacion offset-md-1 col-md-6 col-sm-12">
                                <label><img src="../../public/img/saved/'.$publicacion->getURLImagenMascota().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$publicacion->getNombreMascota().'</label>
                                <div class="foto-publicada">
                                <img  src="../../public/img/saved/'.$publicacion->getURLImagen().'" alt="foto-publicada"/>
                                </div>
                            </div>
                            <div class="publicacion comentarios  offset-md-1 col-md-4 col-sm-12">
                                '.$this->displayWoofsForm($publicacion->getID()).'
                                
                                <label >Ultimos woofs</label>
                                <div class="woofs">';
                    
                    
                    $woofsPublicacion = $publicacion->getWoofs();
                    if($woofsPublicacion)
                        foreach($woofsPublicacion as $woof){            
                            $post = $post.'<div class="row"> <div class="col-2"><img src="../../public/img/'.(($woof->getImagenUsuario()!="")? "saved/".$woof->getImagenUsuario(): "Juan-Niebla.png" ).'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación"></div><div class="col-3"><h5 class="nombre-usuario-post">'.$woof->getNombreUsuario().'</h5></div><div class="woof-icons col-6">'.$this->getWoofsUsuario($woof->getPuntos()).'</div></div>';
                            
                        }

                    $post =  $post.'</div><label >Ultimos comentarios</label> <div class="comentarios-publicacion">
                                        
                                            <div class="comentario row">
                                                <div class="col-2">
                                                    <img src="../../public/img/Juan-Niebla.png" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">
                                                </div>
                                                <div class="col-10">
                                                    <div class="row"><label>Nombre apellido</label></div>
                                                    <div class="row"><p>Ble ble ble ble bla bli bleblobla</p></div>
                                                </div>
                                            </div>

                                            <div class="comentario row">
                                                <div class="col-2">
                                                    <img src="../../public/img/Juan-Niebla.png" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">
                                                </div>
                                                <div class="col-10">
                                                    <div class="row"><label>Nombre apellido</label></div>
                                                    <div class="row"><p>Ble ble ble ble bla bli bleblobla</p></div>
                                                </div>
                                            </div>
                                    ';

                    $posts = $posts.$post.'</div></div>';
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
                $btnWoofs = '<form action="../gestionaWoof.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="UserID" value="'.$_SESSION["UserID"].'">
                            <input type="hidden" name="MediaID" value="'.$mediaID.'">
                            <input type="submit" name="Puntos" class="btn-woof" value="1"/>
                            <input type="submit" name="Puntos" class="btn-woof" value="2"/>
                            <input type="submit" name="Puntos" class="btn-woof" value="3"/>
                            <input type="submit" name="Puntos" class="btn-woof" value="4"/>
                            <input type="submit" name="Puntos" class="btn-woof" value="5"/>
                        </form>';
            }
            return $btnWoofs;
            
        }
    }
?>



