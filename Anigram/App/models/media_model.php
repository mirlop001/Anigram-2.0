<?php
namespace es\ucm\fdi\aw;

class Media_Model{
    private $db; 
    private $ID; 
    private $NombreMascota; 
    private $URLImagenMascota; 
    private $URLImagen; 
    private $woofs; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoMediaObject($ID, $NombreMascota, $URLImagenMascota,  $URLImagen){
        $modelo_woofs = new Woof_Model();
        $woofsPublicacion = $modelo_woofs->getWoofsPublicacion($ID);

        $this->ID = $ID;
        $this->NombreMascota = $NombreMascota;
        $this->URLImagenMascota = $URLImagenMascota;
        $this->URLImagen = $URLImagen;
        $this->woofs = $woofsPublicacion;
    }
    
    public function getID(){
        return $this->ID;
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
    
    function insertaNuevaImagen($IDMascota, $URLImagen, $tipo=1){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO media (Mascota, URLImagen, Tipo) VALUES ('".$IDMascota."', '".$URLImagen."', '".$tipo."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function obtenerTodasPublicaciones($page = 0, $top = __maxPublicacionesPaginador__){
        $offset =  $top * ($page);
        $query = "SELECT media.ID as IDImagen, media.URLImagen, mascota.Nombre, Mascota.URLFoto, fecha 
        from media inner join mascota on mascota.ID = media.Mascota ORDER BY fecha desc  limit ".$top." offset ".$offset;
        $result = mysqli_query($this->db, $query);
        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['Nombre'], $row['URLFoto'], $row['URLImagen']);
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }
        }
        return $ultimasPublicaciones;
    }

    function getUltimasNPublicaciones($page = 0, $top = __maxPublicacionesPaginador__){
        $query = "SELECT media.ID as IDImagen, media.URLImagen, mascota.Nombre, Mascota.URLFoto, fecha 
        from media inner join mascota on mascota.ID = media.Mascota
                    inner JOIN amigos on amigos.IDSeguido = mascota.ID
        where amigos.IDSeguidor =".$_SESSION['IDPerfilActivo'].
        " UNION SELECT  media.ID as IDImagen, media.URLImagen, mascota.Nombre, Mascota.URLFoto, fecha from media inner join mascota on mascota.ID = media.Mascota where media.Mascota =".$_SESSION['IDPerfilActivo']." ORDER BY fecha desc  limit ".$top." offset ".($top * $page );

        $result = mysqli_query($this->db, $query);
        
        $ultimasPublicaciones = null;
        if($result){
            if($result->num_rows > 0){
                for($i=0; $i < $result->num_rows ; $i++){
                    if($row = $result->fetch_assoc()){
                        $mediaObject = new self();
                        $mediaObject->nuevoMediaObject($row['IDImagen'], $row['Nombre'], $row['URLFoto'], $row['URLImagen']);
                        $ultimasPublicaciones[$i] = $mediaObject;
                    }
                }
            }else{
                $ultimasPublicaciones = $this->obtenerTodasPublicaciones($page, $top);
            }
        }
        return $ultimasPublicaciones;
    }

}
?>
