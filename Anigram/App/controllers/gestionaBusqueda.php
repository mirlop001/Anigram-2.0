<?php
namespace es\ucm\fdi\aw;

require_once '../configuracion/config.php';
require_once "../controllers/mascota_controller.php";
require_once "../controllers/publicacion_controller.php";
require_once "../controllers/busqueda_controller.php";

$busqueda = htmlspecialchars(trim(strip_tags($_REQUEST['buscar'])));
$hashtag = null;
$mascota = null;
$comentario = null;

if(isset($_REQUEST['hashtag'])) $hashtag = htmlspecialchars(trim(strip_tags($_REQUEST['hashtag'])));
if(isset($_REQUEST['mascota'])) $mascota = htmlspecialchars(trim(strip_tags($_REQUEST['mascota'])));
if(isset($_REQUEST['comentario'])) $comentario = htmlspecialchars(trim(strip_tags($_REQUEST['comentario'])));

$busqueda_controller = new Busqueda_Controller;
$publicacion_controller = new Publicacion_Controller;

$publicaciones_encontradas = "";

if(!$hashtag && !$mascota && !$comentario){
    
    $mascotas_encontradas = $busqueda_controller->busquedaParcialMascotas($busqueda);
    $publicaciones = $busqueda_controller->busquedaParcialPublicaciones($busqueda);

    if($mascotas_encontradas){
        $publicaciones_encontradas = $publicaciones_encontradas.'<div class="row search-result offset-1"><h2>Mascotas</h2>';
        foreach($mascotas_encontradas as $mascota){
            $datos_mascota = $busqueda_controller->getBusquedaMascota($mascota);
            $publicaciones_encontradas = $publicaciones_encontradas.$datos_mascota;
        }
        $publicaciones_encontradas = $publicaciones_encontradas.'</div>';
    }

    if($publicaciones){
        $publicaciones_encontradas = $publicaciones_encontradas.'<div class="row search-result offset-1"><h2>Publicaciones</h2>';
        $publicaciones_encontradas = $publicaciones_encontradas.$publicaciones.'</div>';
    }
    
}else{
    $publicaciones_encontradas = $publicacion_controller->busquedaParcialPublicacion($mascota, $comentario, $hashtag);
}

if(!preg_match('/\w+/',$publicaciones_encontradas)){
    $publicaciones_encontradas = "<div class='row search-result offset-1'><h2>No se han encontrado coincidencias</h2></div>";
}
if($busqueda == ""){
    $publicaciones_encontradas = "<div class='row search-result offset-1'><h2>Publicaciones</h2><div class='container-anigram'>".$publicacion_controller->obtenerTodasPublicaciones()."</div></div><div ID='masContenido'>
    <button id='cargaMasContenido' class='btn btn-outline-info'>Cargar más</button></div>";
}

echo $publicaciones_encontradas;

?>

