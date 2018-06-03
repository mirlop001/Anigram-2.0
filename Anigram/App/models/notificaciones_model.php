<?php
namespace es\ucm\fdi\aw;

class Notificaciones_Model{
    private $db; 
    private $ID; //Se relaciona con el usuario que posee la mascota
    private $IDEmisor; 
    private $NombreEmisor; 
    private $URLImagen; 
    private $IDElem; 
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

    public function getIDElem(){
        return $this->IDElem;
    }

    private function generaObjeto($IDEmisor,$URLImagen,  $NombreEmisor, $Mensaje, $IDElem){
        $this->IDEmisor = $IDEmisor;
        $this->URLImagen = $URLImagen;
        $this->NombreEmisor = $NombreEmisor;
        $this->Mensaje = $Mensaje;
        $this->IDElem = $IDElem;
    }

    function insertaNotificacion($IDEmisor, $IDReceptor, $Tipo){
        $result = null;
        if (mysqli_query($this->db, "INSERT INTO notificaciones (IDEmisor, IDReceptor, Tipo) VALUES ('".$IDEmisor."', '".$IDReceptor."', '".$Tipo."')")) 
            $result = mysqli_insert_id ($this->db);

        return $result;
    }

    function buscaNotificacionesFoto($idUsuario){
        $result = mysqli_query($this->db, "SELECT m1.ID, m2.ID as idImagen, m2.URLImagen as imagen, m1.Nombre as nombre, tn.Mensaje as mensaje from notificaciones n inner join tipo_notificacion tn on n.Tipo = tn.ID inner join mascota m1 on n.IDEmisor = m1.ID inner join media m2 on n.IDReceptor = m2.Mascota where IDReceptor =".$idUsuario." and n.tipo = 1 order by ID desc" );
        $notificaciones = null;
        if($result){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $notificacion = new self();
                    $notificacion->generaObjeto($row['ID'], $row['imagen'], $row['nombre'], $row['mensaje'], $row['idImagen']);
                    $notificaciones[$i] = $notificacion;
                }
            }
        }
        return $notificaciones;
    }
    
    function buscaNotificacionesUsuario($idUsuario){
        $result = mysqli_query($this->db, "SELECT m1.ID as idMascota, m1.URLFoto as idImagen,  m1.Nombre, tn.Mensaje from notificaciones n inner join tipo_notificacion tn on n.Tipo = tn.ID inner join mascota m1 on n.IDEmisor = m1.ID inner join amigos a on n.IDReceptor = a.IDSeguidor where IDReceptor = $idUsuario and n.Tipo <> 1 order by m1.ID desc" );
        $notificaciones = null;
        if($result){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc()){
                    $notificacion = new self();
                    $notificacion->generaObjeto($row['idMascota'], $row['idImagen'], $row['Nombre'], $row['Mensaje'], $row['idMascota']);
                    $notificaciones[$i] = $notificacion;
                }
            }
        }
        return $notificaciones;
    }
}
?>