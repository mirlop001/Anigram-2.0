<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
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
    <div class="row">
        <div class="col-9 offset-2">
            <div id="input-busqueda" class="input-group">
                <input type="text" class="form-control" placeholder="Buscar..." aria-describedby="basic-addon2">
                <!-- <span class="input-group-addon" id="basic-addon2"><i class="material-icons">search</i></span> -->
            </div>
        </div>
    </div>
    <div  class="row">
        <div id="resultados" >
            <div class="container-anigram search-result">
                <h2>Todas las publicaciones</h2>
                <?php
                    $media_controller = new es\ucm\fdi\aw\Publicacion_Controller();
                    echo $media_controller->obtenerTodasPublicaciones();
                ?>
            </div>
            <div ID="masContenido">
                <button id="cargaMasContenido" class="btn btn-outline-info">Cargar más</button>
            </div>
        </div>
    </div>
</body>
</html>