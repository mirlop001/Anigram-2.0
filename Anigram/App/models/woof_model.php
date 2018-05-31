<?php
namespace es\ucm\fdi\aw;

class Woof_Model{
    private $db; 
    private $IDPublicacion; 
    private $IDMascota; 
    private $ImagenMascota; 
    private $NombreMascota; 
    private $Puntos; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoWoofObject($IDPublicacion, $IDMascota, $ImagenMascota, $NombreMascota, $Puntos){
        $this->IDMascota = $IDMascota;
        $this->IDPublicacion = $IDPublicacion;
        $this->ImagenMascota = $ImagenMascota;
        $this->NombreMascota = $NombreMascota;
        $this->Puntos = $Puntos;
    }
    
    public function getIDPublicacion(){
        return $this->IDPublicacion;
    }

    public function getImagenMascota(){
        return $this->ImagenMascota;
    }

    public function getNombreMascota(){
        return $this->NombreMascota;
    }

    public function getPuntos(){
        return $this->Puntos;
    }
    
    function getWoofsPublicacion($IDPublicacion){
        $result = mysqli_query($this->db,  "SELECT u.ID as IDMascota, URLFoto, Nombre, Puntos FROM woofs w inner join mascota u on w.IDMascota = u.ID where IDMedia = ".$IDPublicacion." order by fecha desc");
        $woofsPublicacion = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $woofObject = new self();
                        $woofObject->nuevoWoofObject($IDPublicacion, $row['IDMascota'],  $row['URLFoto'], $row['Nombre'], $row['Puntos']);
                        $woofsPublicacion[$i] = $woofObject;
                    }
                }
            }
        }
        return $woofsPublicacion;
    }

    function compruebaWoof($IDMascota, $mediaID){
        $result = mysqli_query($this->db,  "SELECT * FROM woofs w where IDMedia = ".$mediaID." and IDMascota =".$IDMascota);

        return $result->num_rows;
        
    }

    function nuevoWoof($puntos, $IDMascota, $mediaID ){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO woofs (IDMedia, IDMascota, Puntos) VALUES ('".$mediaID."', '".$IDMascota."', '".$puntos."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function actualizaWoof($puntos, $IDMascota, $mediaID ){
        return mysqli_query($this->db, "UPDATE woofs SET Puntos = ".$puntos.", fecha = CURRENT_TIMESTAMP WHERE IDMedia =".$mediaID." and IDMascota = ".$IDMascota);
    }

}
?>