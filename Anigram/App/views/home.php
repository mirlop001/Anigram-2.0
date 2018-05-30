<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
    include_once '../controllers/mascota_controller.php';
    include_once 'Comun/cabecera.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Home</title>
</head>
<body>
    <?php
        include_once 'Comun/menu.php';
    ?> 
	<div class="container-anigram ">
        
        <?php 
            $media_controller = new es\ucm\fdi\aw\Publicacion_Controller();
            echo $media_controller->getUltimasPublicaciones();
        ?>
    </div>
    <div ID="masContenido">
        <button id="cargaMasContenido" class="btn btn-outline-info">Cargar más</button>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="perfil-mascota-modal">
                <div id="perfil-mascota-content"></div>
            </div>
        </div>
    </div>

</body>
</html>