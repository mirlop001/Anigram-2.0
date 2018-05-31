<?php
namespace es\ucm\fdi\aw;

class Hashtag_Model{
    private $db; 
    private $ID; 
    private $IDComentario; 
    private $Nombre; 

    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    private function creaObjetoHashtag($ID, $IDComentario, $Nombre){
        $this->ID = $ID;
        $this->IDComentario = $IDComentario;
        $this->Nombre = $Nombre;
    }

    public function buscaHashtagExactoPorNombre($Nombre){
        $result = mysqli_query($this->db, "SELECT * from hashtag where Nombre = '".$Nombre."'");
        if($result){
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $hashtagObject = new self();
                    $hashtagObject->nuevoMediaObject($row['ID'], $row['IDComentario'], $row['Nombre']);
                    return $hashtagObject;
                }
            }
        }
        return $result;
    }

    public function buscaHashtagParecidoPorNombre($Nombre){
        $result = mysqli_query($this->db, "SELECT * from hashtag where Nombre like '%".$Nombre."%'");
        if($result){
            if($result->num_rows > 0){
                if($row = $result->fetch_assoc()){
                    $hashtagObject = new self();
                    $hashtagObject->nuevoMediaObject($row['ID'], $row['IDComentario'], $row['Nombre']);
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
                $hashtagObject->nuevoMediaObject($row['ID'], $row['IDComentario'], $row['Nombre']);
                return $hashtagObject;
            }
        }
    }

    public function insertaHashtag($IDComentario, $Nombre){
        $result = false;

        if (mysqli_query($this->db, "INSERT INTO hashtag (Comentario, Nombre) VALUES ('$IDComentario', '$Nombre')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    public function actualizaHashtag($ID, $IDComentario, $Nombre){
        $result = false;
        $result = mysqli_query($this->db, "UPDATE hashtag SET Nombre = ".$Nombre." WHERE ID=".$ID." AND Comentario = ".$IDComentario);

        return $result;
    }
}
?>