<?php
namespace es\ucm\fdi\aw;

class Woof_Model{
    private $db; 
    private $IDPublicacion; 
    private $UserID; 
    private $ImagenUsuario; 
    private $NombreUsuario; 
    private $Puntos; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoWoofObject($IDPublicacion, $UserID, $ImagenUsuario, $NombreUsuario, $Puntos){
        $this->UserID = $UserID;
        $this->IDPublicacion = $IDPublicacion;
        $this->ImagenUsuario = ($ImagenUsuario != "")? $UserID.'-'.$ImagenUsuario: "";
        $this->NombreUsuario = $NombreUsuario;
        $this->Puntos = $Puntos;
    }
    
    public function getIDPublicacion(){
        return $this->IDPublicacion;
    }

    public function getImagenUsuario(){
        return $this->ImagenUsuario;
    }

    public function getNombreUsuario(){
        return $this->NombreUsuario;
    }

    public function getPuntos(){
        return $this->Puntos;
    }
    
    function getWoofsPublicacion($IDPublicacion){
        $result = mysqli_query($this->db,  "SELECT u.ID as UserID, URLFoto, NombreCompleto, Puntos FROM woofs w inner join usuario u on w.IDUsuario = u.ID where IDMedia = ".$IDPublicacion." order by fecha desc");
        $woofsPublicacion = null;
        if($result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $woofObject = new self();
                    $woofObject->nuevoWoofObject($IDPublicacion, $row['UserID'],  $row['URLFoto'], $row['NombreCompleto'], $row['Puntos']);
                    $woofsPublicacion[$i] = $woofObject;
                }
            }
        }
        return $woofsPublicacion;
    }

    function compruebaWoof($userID, $mediaID){
        $result = mysqli_query($this->db,  "SELECT * FROM woofs w where IDMedia = ".$mediaID." and IDUsuario =".$userID);

        return $result->num_rows;
        
    }

    function nuevoWoof($puntos, $userID, $mediaID ){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO Woofs (IDMedia, IDUsuario, Puntos) VALUES ('".$mediaID."', '".$userID."', '".$puntos."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function actualizaWoof($puntos, $userID, $mediaID ){
        return mysqli_query($this->db, "UPDATE Woofs SET Puntos = ".$puntos.", fecha = CURRENT_TIMESTAMP WHERE IDMedia =".$mediaID." and IDUsuario = ".$userID);
    }

}
?>