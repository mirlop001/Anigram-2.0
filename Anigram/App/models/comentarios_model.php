<?php
namespace es\ucm\fdi\aw;

class Comentario_Model{
    private $db; 
    private $Comentario; 
    private $IDMedia; 
    private $IDUsuario; 
    private $ImagenUsuario; 
    private $NombreUsuario; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoComentarioObject($IDMedia, $IDUsuario, $Comentario, $ImagenUsuario, $NombreUsuario){
        $this->IDMedia = $IDMedia;
        $this->IDUsuario = $IDUsuario;
        $this->Comentario = $Comentario;
        $this->ImagenUsuario = $ImagenUsuario;
        $this->NombreUsuario = $NombreUsuario;
    }
    
    public function getIDMedia(){
        return $this->IDMedia;
    }

    public function getIDUsuario(){
        return $this->IDUsuario;
    }

    public function getComentario(){
        return $this->Comentario;
    }
    public function getImagenUsuario(){
        return $this->ImagenUsuario;
    }
    public function getNombreUsuario(){
        return $this->NombreUsuario;
    }

    
    function getComentariosPublicacion($IDPublicacion){
        $result = mysqli_query($this->db,  "SELECT u.ID as UserID, URLFoto, NombreCompleto, Comentario FROM comentario c inner join usuario u on c.IDUsuario = u.ID where IDMedia = ".$IDPublicacion." order by fecha desc");
        $comentariosPublicacion = null;
        if($result && $result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $comentarioObject = new self();
                    $comentarioObject->nuevoComentarioObject($IDPublicacion, $row['UserID'], $row['Comentario'], $row['URLFoto'], $row['NombreCompleto']);
                    $comentariosPublicacion[$i] = $comentarioObject;
                }
            }
        }
        return $comentariosPublicacion;
    }

    function getComentarioByID($IDComentario){
        $result = mysqli_query($this->db,  "SELECT u.ID as UserID, URLFoto, NombreCompleto, Comentario FROM comentario c inner join usuario u on c.IDUsuario = u.ID where c.ID = ".$IDComentario." order by fecha desc");
        $comentariosPublicacion = null;
        if($result && $result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $comentarioObject = new self();
                    $comentarioObject->nuevoComentarioObject($IDComentario, $row['UserID'], $row['Comentario'], $row['URLFoto'], $row['NombreCompleto']);
                    $comentariosPublicacion[$i] = $comentarioObject;
                }
            }
        }
        return $comentariosPublicacion;
    }

    function nuevoComentario($comentario, $userID, $mediaID ){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO comentario (IDMedia, IDUsuario, Comentario) VALUES ('".$mediaID."', '".$userID."', '".$comentario."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

}
?>