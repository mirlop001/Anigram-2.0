<?php
namespace es\ucm\fdi\aw;
include_once '../models/notificaciones_model.php';

    class Notificaciones_Controller{
        private $actualPage;

        function __Construct($page = 0){
            $this->actualPage = $page;
        }

        function obtenerNotificaciones(){
            $idUsuario = $_SESSION['IDPerfilActivo'];
            $notificaciones_model = new Notificaciones_Model;

            $notificacionesPendientes = $notificaciones_model->buscaNotificacionesFoto($idUsuario);
            $vistaNotificaciones = "";

            if($notificacionesPendientes){
                foreach($notificacionesPendientes as $notificacion){
                    $vistaNotificaciones = $vistaNotificaciones.'<div class="panel panel-default col-md-6 col-xs-12 col-lg-4">
                        <div class="panel-body notificacion">
                            <button class="word-square" value="'.$notificacion->getIDElem().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                <label><img src="'.__urlFotoGuardada__.$notificacion->getURLImagen().'" class="imagen-publicacion"  alt="foto-perfil-publicación">'.$notificacion->getNombreEmisor().'</label><h3>'.$notificacion->getMensaje().'</h3>
                            </button> 
                        </div>
                    </div>';
                }
            }

            $notificacionesPendientes = $notificaciones_model->buscaNotificacionesUsuario($idUsuario);

            if($notificacionesPendientes)
                foreach($notificacionesPendientes as $notificacion){
                    $vistaNotificaciones = $vistaNotificaciones.'<div class="panel panel-default col-md-6 col-xs-12 col-lg-4">
                        <div class="panel-body">
                            <button class="btn-perfil" value="'.$notificacion->getIDElem().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                <label><img src="'.__urlFotoGuardada__.$notificacion->getURLImagen().'" class="imagen-publicacion"  alt="foto-perfil-publicación">'.$notificacion->getNombreEmisor().'</label><h3>'.$notificacion->getMensaje().'</h3>
                            </button> 
                        </div>
                    </div>';
                }
            return $vistaNotificaciones;
        }


    }
?>



