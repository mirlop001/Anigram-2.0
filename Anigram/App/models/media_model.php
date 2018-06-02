<?php
namespace es\ucm\fdi\aw;
require_once '../models/woof_model.php';

class Media_Model{
    private $db; 
    private $ID; 
    private $IDMascota;
    private $NombreMascota; 
    private $URLImagenMascota; 
    private $URLImagen; 
    private $woofs; 
    private $descripcion;


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoMediaObject($ID, $IDMascota, $NombreMascota, $URLImagenMascota,  $URLImagen, $descripcion){
        $modelo_woofs = new Woof_Model();
        $woofsPublicacion = $modelo_woofs->getWoofsPublicacion($ID);

        $this->ID = $ID;
        $this->IDMascota = $IDMascota;
        $this->NombreMascota = $NombreMascota;
        $this->URLImagenMascota = $URLImagenMascota;
        $this->URLImagen = $URLImagen;
        $this->woofs = $woofsPublicacion;
        $this->descripcion = $descripcion;
    }
    
    public function getID(){
        return $this->ID;
    }

    public function getIDMascota(){
        return $this->IDMascota;
    }

    public function getNombreMascota(){
        return $this->NombreMascota;
    }

    public function getURLImagenMascota(){
        return $this->URLImagenMascota;
    }

    public function getURLImagen(){
        return $this->URLImagen;
    }

    public function getWoofs(){
        return $this->woofs;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }
    
    function insertaNuevaImagen($IDMascota, $URLImagen, $tipo=1){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO media (Mascota, URLImagen, Tipo) VALUES ('".$IDMascota."', '".$URLImagen."', '".$tipo."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }
    
    function obtenerTodasPublicaciones($page = 0, $top = __maxPublicacionesPaginador__){
        $offset =  $top * ($page);
        $query = "SELECT media.ID as IDImagen, media.URLImagen, media.Descripcion, mascota.ID as idMascota,mascota.Nombre, mascota.URLFoto, fecha 
        from media inner join mascota on mascota.ID = media.Mascota ORDER BY fecha desc  limit ".$top." offset ".$offset;
        $result = mysqli_query($this->db, $query);
        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['idMascota'], $row['Nombre'], $row['URLFoto'], $row['URLImagen'], $row['Descripcion']);
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }
        }
        return $ultimasPublicaciones;
    }

    function getUltimasNPublicaciones($page = 0, $top = __maxPublicacionesPaginador__){
        $offset =  $top * ($page);
        $query = "SELECT media.ID as IDImagen, media.URLImagen, media.Descripcion, mascota.ID as idMascota,mascota.Nombre, mascota.URLFoto, fecha from media inner join mascota on mascota.ID = media.Mascota inner join amigos on mascota.ID = amigos.IDSeguido where amigos.IDSeguidor = ".$_SESSION['IDPerfilActivo']."
        union 
        SELECT media.ID as IDImagen, media.URLImagen, media.Descripcion, mascota.ID as idMascota,mascota.Nombre, mascota.URLFoto, fecha from media inner join mascota on mascota.ID = media.Mascota where mascota.ID = ".$_SESSION['IDPerfilActivo']."
        ORDER BY fecha desc  limit ".$top." offset ".$offset;
        
        $result = mysqli_query($this->db, $query);
        
        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['idMascota'], $row['Nombre'], $row['URLFoto'], $row['URLImagen'], $row['Descripcion']);;
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }else{
                $ultimasPublicaciones = $this->obtenerTodasPublicaciones($page, $top);
            }
        }
        return $ultimasPublicaciones;
    }

    function getImagenesMascota($IDMascota){
        $query = "SELECT media.ID as IDImagen, media.URLImagen, media.Descripcion, mascota.ID as idMascota, mascota.Nombre, mascota.URLFoto, fecha 
        from media inner join mascota on mascota.ID = media.Mascota where mascota.ID = ".$IDMascota." ORDER BY fecha desc ";
        $result = mysqli_query($this->db, $query);

        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['idMascota'], $row['Nombre'], $row['URLFoto'], $row['URLImagen'], $row['Descripcion']);;
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }
        }
        return $ultimasPublicaciones;
    }

    function busquedaParcialPublicacion($mascota, $comentario, $hashtag){
        $query = "SELECT media.ID as IDImagen, media.URLImagen, media.Descripcion, mascota.ID as idMascota, mascota.Nombre, mascota.URLFoto, fecha 
        from media inner join mascota on mascota.ID = media.Mascota 
        inner join comentario c on c.IDMedia = media.ID where mascota.ID = ".$IDMascota;

        if($mascota) $query = $query." AND mascota.Nombre like '%".$mascota."%'";
        if($comentario) $query = $query." AND c.Comentario like '%".$comentario."%'";
        if($hashtag) $query = $query." AND c.Comentario like '%#".$hashtag."%'";
        
        $result = mysqli_query($this->db, $query);

        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['idMascota'], $row['Nombre'], $row['URLFoto'], $row['URLImagen'], $row['Descripcion']);;
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }
        }
        return $ultimasPublicaciones;
    }

}
?>
