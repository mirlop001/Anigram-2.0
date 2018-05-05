<?php
namespace es\ucm\fdi\aw;

class Mascota_Model{
    private $db; 
    private $amo; //Se relaciona con el usuario que posee la mascota
    private $tipo;
    private $nombre; 
    private $raza; 
    private $URLfoto;
    private $bio;


    public function __construct(){
        try {
            $app = Aplicacion::getSingleton();
            $this->db=$app->conexionBd();
            
        } catch (PDOException $e) {
            exit('No se ha podido conectar con la base de datos.');
        }
    }

    function __Contruct($Amo, $tipo, $nombre, $raza, $URLFoto, $bio){
        $this->amo = $Amo;
        $this->tipo = $tipo;
        $this->nombre = $nombre;
        $this->raza = $raza;
        $this->URLFoto = $URLFoto;
        $this->bio = $bio;
    }

    function registraMascota($amo, $tipo, $nombre, $raza, $bio, $URLFoto){
       return mysqli_query($this->db, "INSERT INTO mascota (Amo, Tipo, Nombre, Raza, URLFoto, Bio) VALUES ($amo, $tipo, '$nombre', '$raza', '$URLFoto', '$bio')");
    }

  
}
?>