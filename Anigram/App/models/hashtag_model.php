<?php
namespace es\ucm\fdi\aw;

class Hashtag_Model{
    private $db; 
    private $ID; 
    private $IDMedia; 
    private $Nombre; 

    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function getID(){
        return $this->ID;
    }

    function getIDMedia(){
        return $this->IDMedia;
    }

    function getNombre(){
        return $this->Nombre;
    }

    private function creaObjetoHashtag($ID, $IDMedia, $Nombre){
        $this->ID = $ID;
        $this->IDMedia = $IDMedia;
        $this->Nombre = $Nombre;
    }

    public function buscaHashtagExactoPorNombre($Nombre){
        $result = mysqli_query($this->db, "SELECT * from hashtag where Nombre = '".$Nombre."'");
        if($result){
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $hashtagObject = new self();
                    $hashtagObject->creaObjetoHashtag($row['ID'], $row['IDMedia'], $row['Nombre']);
                    return $hashtagObject;
                }
            }
        }
        return $result;
    }

    public function busquedaParcialHashtag($Nombre){
        $result = mysqli_query($this->db, "SELECT * from hashtag where Nombre like '%".$Nombre."%'");
        if($result){
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $hashtagObject = new self();
                    $hashtagObject->creaObjetoHashtag($row['ID'], $row['IDMedia'], $row['Nombre']);
                    return $hashtagObject;
                }
            }
        }
        return $result;
    }

    public function buscaHashtagPorID($IDHashtag, $Nombre){
        $result = mysqli_query($this->db, "SELECT * from hashtag where ID =".$IDHashtag);
        if($result->num_rows > 0){
            if($row = $result->fetch_assoc()){
                $hashtagObject = new self();
                $hashtagObject->creaObjetoHashtag($row['ID'], $row['IDMedia'], $row['Nombre']);
                return $hashtagObject;
            }
        }
    }

    public function insertaHashtag($IDMedia, $Nombre){
        $result = false;

        if (mysqli_query($this->db, "INSERT INTO hashtag (Comentario, Nombre) VALUES ('$IDMedia', '$Nombre')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    public function actualizaHashtag($ID, $IDMedia, $Nombre){
        $result = false;
        $result = mysqli_query($this->db, "UPDATE hashtag SET Nombre = ".$Nombre." WHERE ID=".$ID." AND Comentario = ".$IDMedia);

        return $result;
    }
}
?>