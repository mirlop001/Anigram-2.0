<?php
    require("../connection/conexion.php");

    class Usuario_Model{
        private $db;
        private $ID;
        private $Rol;
        private $Nickname;
        private $NombreCompleto;
        private $Email;
        private $Clave;
        private $URLFoto;
        private $Bio;
        private $Bloqueado;

        function __Construct()
        {
            try {
                $this->db=Conexion::conec();
                
            } catch (PDOException $e) {
                exit('No se ha podido conectar con la base de datos.');
            }
        }

        function __Contruct($ID, $Rol, $Nickname, $NombreCompleto, $Email, $Clave, $URLFoto){
            $this->ID = $ID;
            $this->Rol = $Rol;
            $this->Nickname = $Nickname;
            $this->NombreCompleto = $NombreCompleto;
            $this->Email = $Email;
            $this->Clave = $Clave;
            $this->URLFoto = $URLFoto;
        }

        function getDatosLogin($email, $clave){
            $usuario = null;
            if ($result = mysqli_query($this->db, "SELECT * from Usuario where Email = '$email' AND Clave='$clave'")) 
                printf("La selección devolvió %d filas.\n", mysqli_num_rows($result));
            else    
                printf("No se ha devuelto nada con los valores %s %s", $email, $clave);
            
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $usuario['ID'] = $row['ID'];
                    $usuario['Nombre'] = $row['NombreCompleto'];
                    $usuario['Rol'] = $row['Rol'];
                }
            }
            return $usuario;
        }

        function registraUsuario($nickname, $nombreCompleto, $email, $clave, $rol){
            $ok = false;

            if (mysqli_query($this->db, "INSERT INTO Usuario (Nickname, NombreCompleto, Clave, Email, Rol) VALUES ('$nickname', '$nombreCompleto', '$email', '$clave', '$rol')")) 
                $ok = true;

            return $ok;
        }
    }

?>