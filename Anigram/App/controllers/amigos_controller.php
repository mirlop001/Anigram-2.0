<?php
namespace es\ucm\fdi\aw;
include_once '../models/mascota_model.php';
include_once '../models/amigos_model.php';


    class Amigos_Controller{
        function __Construct(){}

        public static function getSeguidos($actualUser){ 
                //$idSeguidor = $_SESSION['UserID'];
                $mascota_model= new Mascota_Model();
                $amigos_model = new Amigos_Model();
           
            $peticionesAceptadas= $amigos_model->getAllPeticionesAceptadas($actualUser);
            
            $lista="";
            if($peticionesAceptadas){
                
                    foreach( $peticionesAceptadas as $peticiones ){
                        if($actualUser == $peticiones->getIDSeguido())$datosMascota = $mascota_model->getDatosMascota($peticiones->getIDSeguidor());
                        else $datosMascota = $mascota_model->getDatosMascota($peticiones->getIDSeguido());
                        foreach($datosMascota as $mascota){
                        $lista = $lista.
                        '<div class="panel panel-default">
                        <div class="panel-body">
                        <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label>
                        
                        </div>
                        </div>';
                    }
                }
             }
            return $lista;
        }
        public static function getSeguidosFiltro($idSeguido){
            $amigos_model = new Amigos_Model();
            $mascota_model= new Mascota_Model();
            
            $mascotasUser = $mascota_model->getDatosMascota($_SESSION['IDAmoBuscado']);
            $lista="";
            foreach($mascotasUser as $pet){
            $peticionesAceptadasFiltro= $amigos_model->peticionesAceptadas($pet->getID(), $idSeguido);
            if($peticionesAceptadasFiltro['IDSeguidor']== $idSeguido)$datosMascota= $mascota_model->getDatosMascota($peticionesAceptadasFiltro['IDSeguido']);
            else $datosMascota = $mascota_model->getDatosMascota($peticionesAceptadasFiltro['IDSeguidor']);
            foreach($datosMascota as $mascota){
            $lista =   $lista . '<div class="panel panel-default">
                         <div class="panel-body">
                         <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
			 		    </div>';
           }
        }
            return $lista;
        }

        public static function getPeticionesAmistad($idSeguido){
            $amigos_model = new Amigos_Model();
            $mascota_model= new Mascota_Model();
            $peticionesPendientes = $amigos_model->getAllPeticionesPendientes($idSeguido);
           $lista ="";
            if($peticionesPendientes){
            foreach($peticionesPendientes as $peticiones){
                $datosMascotas = $mascota_model->getDatosMascota($peticiones->getIDSeguidor());
                foreach($datosMascotas as $mascota){

                $lista = $lista .  '<div class="panel1 panel-default" id="peticiones-amigos">
                             <div class="panel-body1">
                             <form method="post" name="Aceptar" action="../controllers/gestionaPeticionesPendientes.php">
                             <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'
                            <div id= "boton-rechazar">
                            <button type="submit" class="buscar" name="Rechazar" >Rechazar</button>
                            </div>
                            <div id="boton-aceptar">
                            <button type="submit" class="botonAceptar" name="Aceptar">Aceptar</button>
                            </div>
                            <input type="hidden" id="mascota" name="mascotaID" value="'.$mascota->getID().'">
                             </label>
                            </form>
                          
                            </div>
                            </div>';
                            
                }

               }
                

        }
        return $lista;
    }

    }
?>