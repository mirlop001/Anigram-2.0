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
  
        public static function getSeguidosPorTipo($tipo,$actualUser){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {

                 if($peticiones->getIDSeguido() == $actualUser) $mascotaBuscada = $peticiones->getIDSeguidor();
                else $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotaByTipo($tipo);
                    if($datosMascota){
               
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo()){
                            $lista =   $lista . '<div class="panel panel-default">
                            <div class="panel-body">
                            <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
			 		        </div>';
                        }
                    
                    }
                }
                    else {
                        $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos de ese tipo
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>';
                    }   
            }
           
            
            return $lista;
        }
        public static function getSeguidosPorTipoNombreM($tipo,$actualUser,$nombreMascota){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {

                 if($peticiones->getIDSeguido() == $actualUser) $mascotaBuscada = $peticiones->getIDSeguidor();
                else $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByTipoNombre($tipo,$nombreMascota);
                if($datosMascota){
                    foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $nombreMascota == $mascota->getNombre() ){
                                $lista =   $lista . '<div class="panel panel-default">
                                <div class="panel-body">
                                <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
			 		            </div>';
                            }
                   
                    }
                }
                else {
                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos de ese tipo o nombre mascota.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>';
            }   
        }
            return $lista;
        }
        public static function getSeguidosPorTipoAmo($tipo,$actualUser,$IDAmo){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {

                 if($peticiones->getIDSeguido() == $actualUser) $mascotaBuscada = $peticiones->getIDSeguidor();
                else $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByTipoAmo($tipo,$IDAmo);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $IDAmo = $mascota->getAmo()){
                                $lista =   $lista . '<div class="panel panel-default">
                                <div class="panel-body">
                                <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
			 		            </div>';
                            }
                   
                    }
                }
                else {
                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos con ese tipo de mascota o con el nombre de mascota.
                            button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>';
                }   
            }
            return $lista;
        }
        public static function getSeguidosAllFiltros($tipo, $nombreMascota, $IDAmo, $actualUser){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {

                 if($peticiones->getIDSeguido() == $actualUser) $mascotaBuscada = $peticiones->getIDSeguidor();
                else $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascota($tipo,$nombreMascota,$IDAmo);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $nombreMascota = $mascota->getNombre() && $IDAmo = $mascota->getAmo()){
                                $lista =   $lista . '<div class="panel panel-default">
                                <div class="panel-body">
                                <label><img src="../../public/img/saved/'.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
			 		            </div>';
                            }
                   
                    }
                }
                else {
                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos con ese tipo de mascota, con el nombre de mascota o con el nombre del dueño.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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