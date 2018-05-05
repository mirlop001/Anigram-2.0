<?php
namespace es\ucm\fdi\aw;

class TipoMascota_Model{
    private $db; 
    private $ID; //Se relaciona con el usuario que posee la mascota
    private $Nombre; 
    private $URLIcono; 


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function nuevoTipoMascota_Model($ID, $Nombre, $URLIcono){
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->URLIcono = $URLIcono;
    }
    
    public function getID(){
        return $this->ID;
    }

    public function getNombre(){
        return $this->Nombre;
    }

    public function getURLIcono(){
        return $this->URLIcono;
    }

    
    function getTiposMascota(){
        $result = mysqli_query($this->db, "SELECT * from tipo_mascota ");
        
        if($result->num_rows > 0){
            for($i=0; $i < $result->num_rows ; $i++){
                if($row = $result->fetch_assoc())
                    $tipoMascotaObj = new self();
                    $tipoMascotaObj->nuevoTipoMascota_Model($row['ID'], $row['Nombre'], $row['URLIcono']);
                    $tiposMascota[$i] = $tipoMascotaObj;
            }
        }
        return $tiposMascota;
    }
}
?>