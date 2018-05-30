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
        $result = mysqli_query($this->db, "INSERT INTO mascota (Amo, Tipo, Nombre, Raza, URLFoto, Bio) VALUES ($Amo, $Tipo, '$Nombre', '$Raza', '$URLFoto', '$Bio')");
        return $result->num_rows == 0;
    }

    function registraMascota($Amo, $Tipo, $Nombre, $Raza, $Bio, $URLFoto){
        $esPrincipal = $this->existeMascotaPrincipal($Amo);
        return mysqli_query($this->db, "INSERT INTO mascota (Amo, Tipo, Nombre, Raza, URLFoto, Bio, Principal) VALUES ($Amo, $Tipo, '$Nombre', '$Raza', '$URLFoto', '$Bio','$esPrincipal')");
    }

    function getMascotasByIDUsuario($IDUsuario){
        $result = mysqli_query($this->db, "SELECT * from mascota where Amo = ".$IDUsuario );

        $mascotasUsuario = null;

        if($result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $mascotaObject = new self();
                    $mascotaObject->nuevoMediaObject($row['ID'], $IDUsuario, $row['Tipo'],$row['Nombre'], $row['Raza'], $row['URLFoto'], $row['Bio']);
                    $mascotasUsuario[$i] = $mascotaObject;
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

    function getIDmascota($nombreMascota){
        $idMascota = null;
        if ($result = mysqli_query($this->db, "SELECT * from mascota where Nombre ='$nombreMascota'")) {
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
                $idMascota['ID'] = $row['ID'];
               
            }
        }
            return $idMascota;
        }
        else    {printf("No se ha devuelto nada con los valores %s %s", $email, $clave);}
        return $idMascota;
        
    }
    //hay que utilizarlo al buscar amigos con filtro!
    function buscarMascota($amo,$tipo, $ID){
        $mascotaID = null;
       if($result = mysqli_query($this->db, "SELECT * from mascota where  Amo ='$amo' and Tipo ='$tipo' and ID ='$ID'")){
        if($result->num_rows > 0){
            $mascota = mysqli_fetch_array($result);
            $mascotaID = $mascota['ID'];
            }
        return $mascotaID;
        
        }
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
}
?>