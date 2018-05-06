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
    
    function getUltimasNPublicaciones($page = 0, $top = 10){
        $result = mysqli_query($this->db, 
                "SELECT med.ID as IDImagen, URLImagen, Nombre, URLFoto, (select count(*) from woofs where IDMedia = med.id) as woofs from media med inner join mascota mas on med.Mascota = mas.ID 
                limit ".$top." offset ".$page );
        
        $ultimasPublicaciones = null;

        if($result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $mediaObject = new self();
                    $mediaObject->nuevoMediaObject($row['IDImagen'], $row['Nombre'], $row['URLFoto'], $row['URLImagen']);
                    $ultimasPublicaciones[$i] = $mediaObject;
                }
            }
        }
        return $ultimasPublicaciones;
    }

}
?>