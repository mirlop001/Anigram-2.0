<?php
namespace es\ucm\fdi\aw;

class Comercio_Model{
    private $db; 
    private $Poseedor; //Se relaciona con el usuario que posee la Comercio
    private $nombre; 
    private $correo; 
    private $telefono; 
    private $URLImagen;
    private $descripcion;


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function __Contruct($Poseedor, $nombre, $telefono, $correo, $URLImagen, $descripcion){
        $this->Poseedor = $Poseedor;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->URLImagen = $URLImagen;
        $this->descripcion = $descripcion;
    }

    function registraComercio($Poseedor, $nombre, $telefono, $correo, $URLImagen, $descripcion){
       return mysqli_query($this->db, "INSERT INTO Comercio (Poseedor, Nombre, Correo, Telefono, URLImagen, Descripcion) VALUES ($Poseedor, '$nombre', '$telefono', '$correo', '$URLImagen', '$descripcion')");
    }

    
}
?>