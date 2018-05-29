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
	$result['ImagenUsuario'] = $datosComentario[0]->getImagenUsuario();
	$result['NombreUsuario'] = $datosComentario[0]->getNombreUsuario();

	$result = json_encode((object)$result);
}

echo $result;

?>
