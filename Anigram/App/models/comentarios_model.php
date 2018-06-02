<?php
namespace es\ucm\fdi\aw;

class Comentario_Model{
    private $db; 
    private $Comentario; 
    private $IDMedia; 
    private $IDMascota; 
    private $ImagenMascota; 
    private $NombreMascota; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoComentarioObject($IDMedia, $IDMascota, $Comentario, $ImagenMascota, $NombreMascota){
        $this->IDMedia = $IDMedia;
        $this->IDMascota = $IDMascota;
        $this->Comentario = $Comentario;
        $this->ImagenMascota = $ImagenMascota;
        $this->NombreMascota = $NombreMascota;
    }
    
    public function getIDMedia(){
        return $this->IDMedia;
    }

    public function getIDMascota(){
        return $this->IDMascota;
    }

    public function getComentario(){
        return $this->Comentario;
    }
    public function getImagenMascota(){
        return $this->ImagenMascota;
    }
    public function getNombreMascota(){
        return $this->NombreMascota;
    }

    function busquedaParcialComentarios($palabraClave){
        $result = mysqli_query($this->db,  "SELECT c.IDMedia, u.ID as IDMascota, URLFoto, Nombre, Comentario FROM comentario c inner join mascota u on c.IDMascota = u.ID where Comentario like '%".$palabraClave."%'");
        $comentariosPublicacion = null;
        if($result && $result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $comentarioObject = new self();
                    $comentarioObject->nuevoComentarioObject($row['IDMedia'], $row['IDMascota'], $row['Comentario'], $row['URLFoto'], $row['Nombre']);
                    $comentariosPublicacion[$i] = $comentarioObject;
                }
            }
        }
        return $comentariosPublicacion;
    }

    function getComentariosPublicacion($IDPublicacion){
        $result = mysqli_query($this->db,  "SELECT u.ID as IDMascota, URLFoto, Nombre, Comentario FROM comentario c inner join mascota u on c.IDMascota = u.ID where IDMedia = ".$IDPublicacion." order by fecha desc");
        $comentariosPublicacion = null;
        if($result && $result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $comentarioObject = new self();
                    $comentarioObject->nuevoComentarioObject($IDPublicacion, $row['IDMascota'], $row['Comentario'], $row['URLFoto'], $row['Nombre']);
                    $comentariosPublicacion[$i] = $comentarioObject;
                }
            }
        }
        return $comentariosPublicacion;
    }

    function getComentarioByID($IDComentario){
        $result = mysqli_query($this->db,  "SELECT u.ID as MascotaID, URLFoto, Nombre, Comentario FROM comentario c inner join mascota u on c.IDMascota = u.ID where c.ID = ".$IDComentario." order by fecha desc");
        $comentariosPublicacion = null;
        if($result && $result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $comentarioObject = new self();
                    $comentarioObject->nuevoComentarioObject($IDComentario, $row['MascotaID'], $row['Comentario'], $row['URLFoto'], $row['Nombre']);
                    $comentariosPublicacion[$i] = $comentarioObject;
                }
            }
        }
        return $comentariosPublicacion;
    }

    function nuevoComentario($comentario, $MascotaID, $mediaID ){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO comentario (IDMedia, IDMascota, Comentario) VALUES ('".$mediaID."', '".$MascotaID."', '".$comentario."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

}
?>