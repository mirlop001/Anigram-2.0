<?php

require_once '../configuracion/config.php';
require_once "../models/comentarios_model.php";  

$modeloComentario = new es\ucm\fdi\aw\Comentario_Model();

$result = false;

$IDPerfilActivo = $_SESSION['IDPerfilActivo'];
$MediaID = $_POST['MediaID'];
$Comentario = $_POST['Comentario'];

if(preg_match('/\S+/',$Comentario)){
	preg_match_all('/#\w+/',$Comentario, $hashtagsComentarios);

    foreach($hashtagsComentarios[0] as $hashtag) {
		$regex = '/'.$hashtag.'/';
        
        $Comentario = preg_replace($regex, '<span class="hashtag">'.$hashtag.'</span>', $Comentario);
    };

	
	$idNuevoComentario = $modeloComentario->nuevoComentario($Comentario, $IDPerfilActivo, $MediaID);
	$datosComentario = $modeloComentario->getComentarioByID($idNuevoComentario);

	$result['IDMedia'] = $MediaID;
	$result['Comentario'] = $datosComentario[0]->getComentario();
	$result['ImagenMascota'] = $datosComentario[0]->getImagenMascota();
	$result['NombreMascota'] = $datosComentario[0]->getNombreMascota();

	$result = json_encode((object)$result);
}

echo $result;

?>
