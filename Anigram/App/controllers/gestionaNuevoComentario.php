<?php

require_once '../configuracion/config.php';
require_once "../models/comentarios_model.php";  
require_once "../models/hashtag_model.php";  
require_once "../models/notificaciones_model.php";  
require_once "../models/media_model.php";  

$modeloComentario = new es\ucm\fdi\aw\Comentario_Model();
$modeloHashtag = new es\ucm\fdi\aw\Hashtag_Model();
$notificacionesModel = new es\ucm\fdi\aw\Notificaciones_Model();
$mediaModel = new es\ucm\fdi\aw\Media_Model();

$result = false;

$IDPerfilActivo = $_SESSION['IDPerfilActivo'];
$MediaID = $_POST['MediaID'];
$Comentario = $_POST['Comentario'];

if(preg_match('/\S+/',$Comentario)){
	preg_match_all('/#\w+/',$Comentario, $hashtagsComentarios);

    foreach($hashtagsComentarios[0] as $hashtag) {
		$regex = '/'.$hashtag.'/';
        
		$Comentario = preg_replace($regex, '<span class="hashtag">'.$hashtag.'</span>', $Comentario);
		$ht = $modeloHashtag->buscaHashtagExactoPorNombre($hashtag);
		if($ht){
			$modeloHashtag->insertaHashtag($MediaID, $hashtag);
		}
	};
	
	
	$idNuevoComentario = $modeloComentario->nuevoComentario($Comentario, $IDPerfilActivo, $MediaID);
	$datosComentario = $modeloComentario->getComentarioByID($idNuevoComentario);
	$publicacion = $mediaModel->getDatosPublicacion($MediaID);

	$notificacionesModel->insertaNotificacion($publicacion->getIDMascota(),$IDPerfilActivo,__tipo_comentario__, $MediaID);

	$result['IDMedia'] = $MediaID;
	$result['Comentario'] = $datosComentario[0]->getComentario();
	$result['ImagenMascota'] = $datosComentario[0]->getImagenMascota();
	$result['NombreMascota'] = $datosComentario[0]->getNombreMascota();

	$result = json_encode((object)$result);
}

echo $result;

?>
