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
        private $MascotaPrincipal;
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

        function nuevoUsuarioObject($ID, $Rol, $Email, $NombreCompleto, $Clave, $URLFoto, $MascotaPrincipal){
            $this->ID = $ID;
            $this->Rol = $Rol;
            $this->Email = $Email;
            $this->NombreCompleto = $NombreCompleto;
            $this->Clave = $Clave;
            $this->URLFoto = $URLFoto;
            $this->MascotaPrincipal = $MascotaPrincipal;
        }
    
        public function getID(){
            return $this->ID;
        }
    
        public function getRol(){
            return $this->Rol;
        }
        public function getEmail(){
            return $this->Email;
        }
    
        public function getNombreCompleto(){
            return $this->NombreCompleto;
        }
    
        public function getClave(){
            return $this->Clave;
        }
    
        public function getURLFoto(){
            return $this->URLFoto;
        }
    
        public function getMascotaPrincipal(){
            return $this->MascotaPrincipal;
        }
    

        function getDatosLogin($email){
            $usuario = null;
            if ($result = mysqli_query($this->db, "SELECT * from usuario where Email = '$email' ")) 
           
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $ID = $row['ID'];
                    $NombreCompleto = $row['NombreCompleto'];
                    $Rol = $row['Rol'];
                    $Email = $row['Email'];
                    $Clave = $row['Clave'];
                    $URLFoto = $row['URLFoto'];
                    $MascotaPrincipal = $row['IDMascotaPrincipal'];
                    $usuarioObject = new self();
                    $usuarioObject->nuevoUsuarioObject($ID, $Rol, $Email, $NombreCompleto, $Clave, $URLFoto, $MascotaPrincipal);
                }
            }
            return $usuarioObject;
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