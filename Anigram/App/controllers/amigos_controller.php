<?php
namespace es\ucm\fdi\aw;
include_once '../models/mascota_model.php';
include_once '../models/amigos_model.php';
include_once '../models/notificaciones_model.php';


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
                        $datosMascota = $mascota_model->getDatosMascota($peticiones->getIDSeguido());
                  
                    foreach($datosMascota as $mascota){
                        $lista = $lista.
                        '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                            <div class="panel-body">
                                <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                    <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label>
                                </button> 
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

                 $datosMascota = $mascota_model->getDatosMascota($peticiones->getIDSeguido());
                    if($datosMascota){
               
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo()){
                            $lista =   $lista . '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                            <div class="panel-body">
                                <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                    <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                </button> 
                            </div>';
                        }
                        else {
                            $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos de ese tipo
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
        public static function getSeguidosPorNombreMascota($nombreMascota, $actualUser){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {
                $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByNombre($nombreMascota);
                if($datosMascota){
                    foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $nombreMascota == $mascota->getNombre()){
                                $lista =   $lista . '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
                                </div>';
                            }
                   
                    }
                }
                else {
                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos con ese nombre de mascota.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>';
            }   
        }
            return $lista;
        }
        public static function getSeguidosPorDueño($IDAmo,$actualUser){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {
                $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->getMascotasByIDUsuario($IDAmo);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $IDAmo = $mascota->getAmo()){
                                $lista =   $lista . '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
                                </div>';
                            }
                            else {
                                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos asociados a ese nombre de dueño.
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                             </div>';             
                                }   
                           
                   
                    }
                } 
                else {
                   $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos asociados a ese nombre de dueño.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>';             
                                }   
                
            }
            return $lista;
        }
        public static function getSeguidosPorMascotaAmo($IDAmo, $nombreMascota,$actualUser){
            $mascota_model = new Mascota_Model();
            $amigos_model = new Amigos_Model();
            $lista="";
            $peticionesAceptadas = $amigos_model->getAllPeticionesAceptadas($actualUser);
        
            foreach ($peticionesAceptadas as $peticiones) {
                $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByAmoMascota($IDAmo, $nombreMascota);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $IDAmo = $mascota->getAmo() && $nombreMascota = $mascota->getNombre()){
                                $lista =   $lista . '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
                                </div>';
                            }
                            else {
                                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos asociados a ese nombre de dueño y nombre mascota.
                                             <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                             </div>';             
                                }   
                           
                   
                    }
                } 
                else {
                   $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos asociados a ese nombre de dueño y nombre mascota.
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

                 $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByTipoNombre($tipo,$nombreMascota);
                if($datosMascota){
                    foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $nombreMascota == $mascota->getNombre() ){
                                $lista =   $lista . '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
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

                 $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascotasByTipoAmo($tipo,$IDAmo);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $IDAmo = $mascota->getAmo()){
                                $lista =   $lista . '<div class="panel panel-default">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
                                </div>';
                            }
                   
                    }
                }
                else {
                $lista =    '<div class="alert alert-primary lert-dismissible fade show" role="alert">No existen amigos con ese tipo de mascota o con ese dueño.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

                $mascotaBuscada = $peticiones->getIDSeguido();
                $datosMascota = $mascota_model->buscarMascota($tipo,$nombreMascota,$IDAmo);
                    if($datosMascota){
                        foreach ($datosMascota as $mascota) {
                  
                            if($mascotaBuscada == $mascota->getID() && $tipo == $mascota->getTipo() && $nombreMascota = $mascota->getNombre() && $IDAmo = $mascota->getAmo()){
                                $lista =   $lista . '<div class="panel panel-default">
                                <div class="panel-body">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'</label></div>
                                    </button> 
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

                    $lista = $lista .  '<div class="panel panel-default col-md-4 col-xs-12 col-lg-6">
                                <div class="panel-body">
                                <form method="post" name="Aceptar" action="../controllers/gestionaPeticionesPendientes.php">
                                    <button class="btn-perfil" value="'.$mascota->getID().'" type="button" data-target=".bd-example-modal-lg" data-toggle="modal" >
                                        <label><img src="'.__urlFotoGuardada__.$mascota->getURLFoto().'" class="perfil-pe .foto-perfil-mascota"  alt="foto-perfil-publicación">'.$mascota->getNombre().'
                                    </button>
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

        function seguirMascota($idMascota){
            $notificaciones_model = new Notificaciones_Model;
            $idSeguidor = $_SESSION['IDPerfilActivo'];

            $notificaciones_model->insertaNotificacion($idSeguidor, $idMascota, __tipo_peticion__, null);
            $amigos_model= new Amigos_Model();
            $amigos_model->nuevaPeticion($idSeguidor, $idMascota);
            return $idSeguidor.' - '.$idMascota.'-'.__tipo_peticion__;
        } 

        function compruebaAmistad($idMascota){
            $idSeguidor = $_SESSION['IDPerfilActivo'];
            $amigos_model= new Amigos_Model();
            $amigos_model->compruebaAmistad($idSeguidor, $idMascota);
        } 
    }
    
?>