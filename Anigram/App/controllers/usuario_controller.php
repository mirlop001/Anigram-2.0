<?php
    namespace es\ucm\fdi\aw;
    require_once '../configuracion/config.php';
    require_once "../models/usuario_model.php";

    class Usuario_Controller{
        private $Nombre;
        private $Email;
        private $Clave;
        private $URLFoto;
        private $bio;

        function __Construct(){}
            
        function getUserByEmail($email){
           $usuarioModel = new Usuario_Model();
           return $usuarioModel->buscaUsuarioPorEmail($email);
        }

        function getDatosLogin($email){
            $usuarioModel = new Usuario_Model();
            return $usuarioModel->getDatosLogin($email); 
        }

    }
?>
