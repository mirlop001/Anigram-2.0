<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/notificaciones_controller.php';
    include 'Comun/cabecera.php';
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
        include 'Comun/menu.php';
    ?> 
	<div class="container-anigram ">
        <div class="col-11 offset-1">
             <div class="row notificaciones">
                <h2>NOTIFICACIONES</h2>
                <?php
                    $notificaciones_controller = new es\ucm\fdi\aw\Notificaciones_Controller();
                    echo $notificaciones_controller->obtenerNotificaciones();
                ?>
            </div>
        </div>
    </div>
</body>
</html>