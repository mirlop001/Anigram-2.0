<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
    include_once '../controllers/mascota_controller.php';
    include_once 'Comun/cabecera.php';
?>
<!DOCTYPE html>
<html lang="es">
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

   

</body>
</html>