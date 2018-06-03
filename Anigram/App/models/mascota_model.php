<?php
namespace es\ucm\fdi\aw;

class Mascota_Model{
    private $db; 
    private $ID; 
    private $Amo; //Se relaciona con el usuario que posee la mascota
    private $Tipo;
    private $Nombre; 
    private $Raza; 
    private $URLfoto;
    private $Bio;


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoMediaObject($ID, $Amo, $Tipo, $Nombre, $Raza, $URLFoto, $Bio){
        $this->ID = $ID;
        $this->Amo = $Amo;
        $this->Tipo = $Tipo;
        $this->Nombre = $Nombre;
        $this->Raza = $Raza;
        $this->URLFoto = $URLFoto;
        $this->Bio = $Bio;
    }

    public function getID(){
        return $this->ID;
    }

    public function getAmo(){
        return $this->Amo;
    }
    public function getTipo(){
        return $this->Tipo;
    }

    public function getNombre(){
        return $this->Nombre;
    }

    public function getRaza(){
        return $this->Raza;
    }

    public function getURLFoto(){
        return $this->URLFoto;
    }

    public function getBio(){
        return $this->Bio;
    }

    function existeMascotaPrincipal($Amo){
        $esPrincipal = 0;
        $result = mysqli_query($this->db, "SELECT * FROM mascota where Amo = $Amo and Principal = '1'");
        if($result){
            $esPrincipal = ($result->num_rows == 0);
        }
        return $esPrincipal;
    }

    function registraMascota($Amo, $Tipo, $Nombre, $Raza, $Bio, $URLFoto){
        $esPrincipal = $this->existeMascotaPrincipal($Amo);
        
        if($result = mysqli_query($this->db, "INSERT INTO mascota (Amo, Tipo, Nombre, Raza, URLFoto, Bio, Principal) VALUES ($Amo, $Tipo, '$Nombre', '$Raza', '$URLFoto', '$Bio','$esPrincipal')"));
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function getMascotasByIDUsuario($IDUsuario){
        $result = mysqli_query($this->db, "SELECT * from mascota where Amo = ".$IDUsuario );

        $mascotasUsuario = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mascotaObject = new self();
                        $mascotaObject->nuevoMediaObject($row['ID'], $IDUsuario, $row['Tipo'],$row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                        $mascotasUsuario[$i] = $mascotaObject;
                    }
                }
            }
        }

        return $mascotasUsuario;
    }
    
    function getMascotasByID($IDMascota){
        $result = mysqli_query($this->db, "SELECT * from mascota where ID = ".$IDMascota );
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
                $mascotaObject = new self();
                $mascotaObject->nuevoMediaObject($IDMascota, $row['Amo'], $row['Tipo'],$row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                return $mascotaObject;
            }
        }
    }

    function getMascotaPrincipalByID($IDUsuario){
        $result = mysqli_query($this->db, "SELECT * from mascota where Amo = '$IDUsuario' and Principal = '1' "  );
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
                $mascotaObject = new self();
                $mascotaObject->nuevoMediaObject($row['ID'], $IDUsuario, $row['Tipo'],$row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                return $mascotaObject;
            }
        }
    }

    function busquedaParcialMascotas($nombre){
        $result = mysqli_query($this->db, "SELECT * from mascota where  Nombre like '%".$nombre."%'");
         $mascotas= null;
         if($result){
             if($result->num_rows > 0){
                 for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($row['ID'], $row['Amo'], $row['Tipo'], $row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascotas[$i] = $mascotaObject;
                     }
                 }
             }
         }
         return $mascotas;
         
     }
    
    function buscarMascota($tipo, $nombre, $amo){
        
        $result = mysqli_query($this->db, "SELECT * from mascota where Tipo ='$tipo' and Amo ='$amo'and Nombre ='$nombre'");
         $mascota= null;
         if($result){
             if($result->num_rows > 0){
                 for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($row['ID'], $amo, $tipo, $nombre, $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascota[$i] = $mascotaObject;
                     }
                 }
             }
         }
         return $mascota;
         
     }

     function getDatosMascota($idMascota){
         $result = mysqli_query($this->db, "SELECT * from mascota where ID = '$idMascota'");
 
         $mascota= null;
 
         if($result->num_rows > 0){
             for($i=0; $i < $result->num_rows ; $i++){
                 if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($idMascota, $row['Amo'], $row['Tipo'],$row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascota[$i] = $mascotaObject;
                 }
             }
         }
         return $mascota;
     }
     function buscarMascotaByTipo($tipo){
         $result = mysqli_query($this->db, "SELECT * from mascota where Tipo = '$tipo'");
         $mascota= null;
         if($result){
             if($result->num_rows > 0){
                 for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($row['ID'], $row['Amo'], $tipo, $row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascota[$i] = $mascotaObject;
                     }
                 }
             }
         }
         return $mascota;
         
     }
     function buscarMascotasByNombre($nombre){
        $result = mysqli_query($this->db, "SELECT * from mascota where Nombre = '$nombre'");
        $mascota= null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                    $mascotaObject = new self();
                    $mascotaObject->nuevoMediaObject($row['ID'], $row['Amo'], $row['tipo'], $nombre, $row['Raza'], $row['URLFoto'], $row['Bio']);
                    $mascota[$i] = $mascotaObject;
                    }
                }
            }
        }
        return $mascota;
        
    }

     function buscarMascotasByTipoNombre($tipo, $nombre){
         $result = mysqli_query($this->db, "SELECT * from mascota where Tipo = '$tipo' and Nombre = '$nombre'");
         $mascota= null;
         if($result){
             if($result->num_rows > 0){
                 for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($row['ID'], $row['Amo'], $tipo, $nombre, $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascota[$i] = $mascotaObject;
                     }
                 }
             }
         }
         return $mascota;
         
     }
     function buscarMascotasByTipoAmo($tipo, $amo){
         $result = mysqli_query($this->db, "SELECT * from mascota where Tipo = '$tipo' and Amo = '$amo'");
         $mascota= null;
         if($result){
             if($result->num_rows > 0){
                 for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                     $mascotaObject = new self();
                     $mascotaObject->nuevoMediaObject($row['ID'], $amo, $tipo, $row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                     $mascota[$i] = $mascotaObject;
                     }
                 }
             }
         }
         return $mascota;
         
     }
     function buscarMascotasByAmoMascota($amo, $nombre){
        $result = mysqli_query($this->db, "SELECT * from mascota where Amo = '$amo' and Nombre = '$nombre'");
        $mascota= null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                    $mascotaObject = new self();
                    $mascotaObject->nuevoMediaObject($row['ID'], $amo, $row['Tipo'], $nombre, $row['Raza'], $row['URLFoto'], $row['Bio']);
                    $mascota[$i] = $mascotaObject;
                    }
                }
            }
        }
        return $mascota;
        
    }

    function updateNombre($nombre, $id){
        mysqli_query($this->db, "UPDATE mascota SET Nombre = '$nombre' WHERE mascota.ID = '$id';");
    } 

    function updateRaza($raza, $id){
        mysqli_query($this->db, "UPDATE mascota SET Raza = '$raza' WHERE mascota.ID = '$id';");
    } 

    function updateTipo($tipo, $id){
        mysqli_query($this->db, "UPDATE mascota SET Tipo = '$tipo' WHERE mascota.ID = '$id';");
    } 

    function updateBio($bio, $id){
        mysqli_query($this->db, "UPDATE mascota SET Bio = '$bio' WHERE mascota.ID = '$id';");
    } 

    function updateURL($url, $id){
        mysqli_query($this->db, "UPDATE mascota SET URLFoto = '$url' WHERE mascota.ID = '$id';"); 
    }
}
?>