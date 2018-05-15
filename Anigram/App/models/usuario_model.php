<?php
namespace es\ucm\fdi\aw;

    class Usuario_Model{
        private $db;
        private $ID;
        private $Rol;
        private $NombreCompleto;
        private $Email;
        private $Clave;
        private $URLFoto;
        private $Bio;
        private $Bloqueado;

        function __construct()
        {
            try {
                $app = Aplicacion::getSingleton();
                $this->db= $app->conexionBd();
                
            } catch (PDOException $e) {
                exit('No se ha podido conectar con la base de datos.');
            }
        }

        function getDatosLogin($email){
            $usuario = null;
            if ($result = mysqli_query($this->db, "SELECT * from usuario where Email = '$email' ")) 
           
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $usuario['ID'] = $row['ID'];
                    $usuario['Nombre'] = $row['NombreCompleto'];
                    $usuario['Rol'] = $row['Rol'];
                    $usuario['Clave'] = $row['Clave'];
                }
            }
            return $usuario;
        }

        function buscaUsuarioPorEmail($email){
            $result = mysqli_query($this->db, "SELECT * FROM `usuario` WHERE Email = '$email' ");
            return mysqli_num_rows($result);
        } 
        function registraUsuario( $nombreCompleto, $email, $clave, $rol, $urlfoto){
            $result = false;

            if (mysqli_query($this->db, "INSERT INTO Usuario (NombreCompleto, Email, Clave, Rol, URLFoto) VALUES ('$nombreCompleto', '$email', '$clave', '$rol', '$urlfoto')")) 
                $result = mysqli_insert_id ($this->db);

            return $result;
        }    
        
        public static function login($email, $password, $user)
        {
            $cifrada = md5($password);
    
            if (md5($password) == $user['Clave']) {
                return true;
            }
            return true;
        }

        private static function hashPassword($password)
        {
            return hash('sha512', $password); 
        }

        public static function compruebaPassword($password, $clave)
        {        
            $cifrada = hash('sha512', $password) ; 
           
            if($cifrada == $clave){
                return true; 
            }
            else return false; 
    
        }
    }
?>