<?php
    include '../configuracion/mensajes.php';
    
    class Mensajes_Controller{
        function mostrarMensaje($tipoMensaje){
            $mensaje = "";
            switch($tipoMensaje){
                case 'loginError':
                    $mensaje = Mensajes::loginError;
                    break;
                    
                case 'registroError_nick':
                    $mensaje = Mensajes::registroError_nick;
                    break;

                case 'registroError_email':
                    $mensaje = Mensajes::registroError_email;
                    break;

                case 'registroError_claves':
                    $mensaje = Mensajes::registroError_claves;
                    break;
                default:
                    $mensaje = "Se ha producido un error";
                    break;
            }

            echo '<div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"><img src="../../public/img/ic_pets_white_24px.svg"></span>
                    <span class="bold">Wooops!</span>
                    <h6>'.$mensaje.'</h6>
                </div>';
        }
    }
?>