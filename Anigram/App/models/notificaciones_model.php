<?php
namespace es\ucm\fdi\aw;

class Notificaciones_Model{
    private $db; 
    private $ID; //Se relaciona con el usuario que posee la mascota
    private $IDEmisor; 
    private $NombreEmisor; 
    private $URLImagen; 
    private $IDMascota; 
    private $IDMedia; 
    private $Mensaje; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    public function getID(){
        return $this->ID;
    }

    public function getNombreEmisor(){
        return $this->NombreEmisor;
    }

    public function getURLImagen(){
        return $this->URLImagen;
    }

    public function getMensaje(){
        return $this->Mensaje;
    }

    public function getIDMascota(){
        return $this->IDMascota;
    }

    public function getIDMedia(){
        return $this->IDMedia;
    }

    private function generaObjeto($IDEmisor,$URLImagen,  $NombreEmisor, $Mensaje, $IDMedia, $IDMascota){
        $this->IDEmisor = $IDEmisor;
        $this->URLImagen = $URLImagen;
        $this->NombreEmisor = $NombreEmisor;
        $this->Mensaje = $Mensaje;
        $this->IDMedia = $IDMedia;
        $this->IDMascota = $IDMascota;
    }

    function insertaNotificacion($IDEmisor, $IDReceptor, $Tipo, $idMedia){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO notificaciones (IDEmisor, IDReceptor, Tipo, IDMedia) VALUES ('$IDEmisor', '$IDReceptor', '$Tipo', '$idMedia')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function buscaNotificacionesFoto($idUsuario){
        $result = mysqli_query($this->db, "SELECT m2.ID as IDMedia, m1.ID as idMascota, m2.ID as idImagen, m2.URLImagen as imagen, m1.Nombre as nombre, tn.Mensaje as mensaje from notificaciones n inner join tipo_notificacion tn on n.Tipo = tn.ID inner join mascota m1 on n.IDEmisor = m1.ID inner join media m2 on n.IDMedia = m2.ID where IDReceptor = $idUsuario  order by n.ID desc" );
        $notificaciones = null; 
        if($result){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $notificacion = new self();
                    $notificacion->generaObjeto($row['idMascota'], $row['imagen'], $row['nombre'], $row['mensaje'], $row['IDMedia'], $row['idMascota']);
                    $notificaciones[$i] = $notificacion;
                }
            }
        }
        return $notificaciones;
    }
    
    function buscaNotificacionesUsuario($idUsuario){
        $result = mysqli_query($this->db, "SELECT  m.ID as idMascota, m.URLFoto as imagen,  m.Nombre, tn.Mensaje FROM notificaciones n inner join mascota m on n.IDEmisor = m.ID inner join amigos a on m.ID = a.IDSeguidor inner join tipo_notificacion tn on n.Tipo = tn.ID where a.IDSeguido = $idUsuario  and n.IDReceptor = $idUsuario" );
        $notificaciones = null;
        if($result){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $notificacion = new self();
                    $notificacion->generaObjeto($row['idMascota'], $row['imagen'], $row['Nombre'], $row['Mensaje'], null, $row['idMascota']);
                    $notificaciones[$i] = $notificacion;
                }
            }
        }
        return $notificaciones;
    }
}
?>