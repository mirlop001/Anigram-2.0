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
    $comentarios_encontrados = $busqueda_controller->busquedaParcialComentarios($busqueda);

    if($mascotas_encontradas){
        $publicaciones_encontradas = $publicaciones_encontradas.'<div class="row search-result"><h2>Mascotas</h2>';
        foreach($mascotas_encontradas as $mascota){
            $datos_mascota = $busqueda_controller->getBusquedaMascota($mascota);
            $publicaciones_encontradas = $publicaciones_encontradas.$datos_mascota;
        }
        $publicaciones_encontradas = $publicaciones_encontradas.'</div>';
    }

    if($comentarios_encontrados){
        $publicaciones_encontradas = $publicaciones_encontradas.'<div class="row search-result"><h2>Comentarios</h2>';
        foreach($comentarios_encontrados as $comentario){
            $datos_comentario = $busqueda_controller->getBusquedaComentarios($comentario);
            $publicaciones_encontradas = $publicaciones_encontradas.$datos_comentario;
        }
        $publicaciones_encontradas = $publicaciones_encontradas.'</div>';
    }
    
}else{
    $publicaciones_encontradas = $publicacion_controller->busquedaParcialPublicacion($mascota, $comentario, $hashtag);
    echo 'publicaciones_encontradas: '.$publicaciones_encontradas;
    
}
if(!preg_match('/\w+/',$publicaciones_encontradas)){
    $publicaciones_encontradas = "<h3>No se han encontrado coincidencias</h3>";
}

echo $publicaciones_encontradas;

?>