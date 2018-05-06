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
            if ($result = mysqli_query($this->db, "SELECT * from Usuario where Email = '$email' ")) 
                printf("La selección devolvió %d filas.\n", mysqli_num_rows($result));
            else    
                printf("No se ha devuelto nada con los valores %s %s", $email, $clave);
            
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
            $result = mysqli_query($this->db, "SELECT * from Usuario where Email = '$email' ");
            return mysqli_num_rows($result);
        } 
        function registraUsuario( $nombreCompleto, $email, $clave, $rol, $urlfoto){
            $result = false;
            $cifrada= md5($clave);

            if (mysqli_query($this->db, "INSERT INTO Usuario (NombreCompleto, Email, Clave, Rol, URLFoto) VALUES ('$nombreCompleto', '$email', '$cifrada', '$rol', '$urlfoto')")) 
                $result = mysqli_insert_id ($this->db);

            return $result;
        }       
    }

?>