<?php
namespace es\ucm\fdi\aw;
class Amigos_Model{
    private $db; 
    private $idSeguidor; //Usuario que sigue a mascota
    private $idSeguido;  //mascota que recibe la notificacion de peticion de amistad
    private $Aceptado; //booleano para saber si ha aceptado la peticion de amistad


  
    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function amigos($idSeguidor, $idSeguido, $Aceptado){
        $this->idSeguidor = $idSeguidor;
        $this->idSeguido = $idSeguido;
        $this->Aceptado = $Aceptado;
       
    }
    public function getIDSeguidor(){
        return $this->idSeguidor;
    }
    public function getIDSeguido(){
        return $this->idSeguido;
    }
    public function getAceptado(){
        return $this->Aceptado;
    }

    public function compruebaAmistad($idSeguidor, $idSeguido){
        $result = mysqli_query($this->db, "SELECT * FROM amigos WHERE  idSeguidor = '$idSeguidor' and idSeguido = '$idSeguido'");
        $amistad = 'no_seguido';
        if($result){
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $amistad =  ($row['Aceptado'] == 1)? 'aceptado': 'no_aceptado';
                }
            }
        }
        return $amistad;
    }

    public function tieneAmigos($idMascota){
        $result = null;
        $result = mysqli_query($this->db, "select * from amigos where Aceptado = 1 and IDSeguidor = ".$idMascota);
        return mysqli_num_rows($result);
    }

    public function nuevaPeticion($idSeguidor, $idSeguido){
        $result = null;
        if(mysqli_query($this->db, "INSERT INTO amigos (idSeguidor, idSeguido, Aceptado) VALUES ('$idSeguidor', '$idSeguido', '0')")) 
            $result = mysqli_insert_id ($this->db);
        return $result;
    }
    public function añadirPeticion($idSeguidor, $idSeguido){
      
       if(mysqli_query($this->db, "INSERT INTO amigos (idSeguido, idSeguidor, Aceptado) VALUES ('$idSeguidor', '$idSeguido', '0')")) return true;
    }
    public function pendienteDeAceptar($idSeguidor, $idSeguido){
        $result = mysqli_query($this->db, "SELECT * FROM amigos WHERE  idSeguidor = '$idSeguidor' and idSeguido = '$idSeguido' and Aceptado ='0'");
        return mysqli_num_rows($result);
    }

    public function aceptarPeticion($idSeguidor, $idSeguido){
        $result = mysqli_query($this->db, "UPDATE amigos SET Aceptado = '1' WHERE  idSeguidor = '$idSeguidor' and idSeguido = '$idSeguido' and Aceptado ='0'");

    }
    public function rechazarPeticion($idSeguidor,$idSeguido){
        $result = mysqli_query($this->db, "DELETE FROM amigos  WHERE  idSeguidor = '$idSeguidor' and idSeguido = '$idSeguido' and Aceptado ='0'");
    }
        public function peticionesAceptadas($idSeguido, $idSeguidor){
        $result = mysqli_query($this->db, "SELECT * FROM amigos WHERE  IDSeguido = '$idSeguido' or IDSeguidor = '$idSeguidor' and Aceptado ='1'");
        return  mysqli_fetch_array($result);

    
    }
    public function getAllPeticionesAceptadas($idSeguidor) {
        $result = mysqli_query($this->db, "SELECT * FROM amigos WHERE  IDSeguidor= '$idSeguidor' and Aceptado ='1'");
        $newAmigos = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                    $amigos = new self();
                    $amigos->amigos($row['IDSeguidor'], $row['IDSeguido'], $row['Aceptado']);
                    $newAmigos[$i] = $amigos;
                }
            }
        }
        }
        return $newAmigos;

    }
    public function getAllPeticionesPendientes($idSeguido){
        $result = mysqli_query($this->db, "SELECT * FROM amigos WHERE IDSeguido= '$idSeguido' and Aceptado ='0'");
        $newAmigos = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                     if($row = $result->fetch_assoc()){
                    $amigos = new self();
                    $amigos->amigos($row['IDSeguidor'], $row['IDSeguido'], $row['Aceptado']);
                    $newAmigos[$i] = $amigos;
                }
            }
        }
    }
        return $newAmigos;
        
    }
}
        
    
