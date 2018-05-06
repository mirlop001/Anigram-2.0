<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
    include 'Comun/cabecera.php';
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
        include 'Comun/menu.php';
    ?> 
	<div class="container-anigram ">
        <div class="row">
            <?php 
                $media_controller = new es\ucm\fdi\aw\Publicacion_Controller();
                echo $media_controller->getUltimasPublicaciones();
            ?>
        </div>
    </div>
</body>
</html>