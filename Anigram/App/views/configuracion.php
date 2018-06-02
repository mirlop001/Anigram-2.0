<?php
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
    include 'Comun/cabecera.php';
    include_once '../controllers/mascota_controller.php';

    $mascota = new es\ucm\fdi\aw\Mascota_Controller(); 
    $datos = $mascota->getMPrincipal($_SESSION['IDPerfilActivo']); 
    $nombre = $datos->getNombre();

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
        <div class="row">
         <h2>CONFIGURACIÓN</h2>
        </div>
    </div>

        <div class="container-anigram ">
        <div id="modificacion-correcta" class="alert alert-success" role="alert">Cambios realizados con éxito!</div>
        <div class="row registro">
            <form id="form-update"  method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="contenedor contedor-izquierdo col-md-12 col-lg-5">
                        <?php include 'updateUsuario.php' ?>
                    </div>
                    
                    <div class="contenedor contedor-derecho separador col-md-12 col-lg-6 offset-lg-1">
                        <ul class="nav nav-tabs select-tabs">
                            <li class="nav-item">
                                <a id="Mascota" class="menu-tabs nav-link active" aria-label="div-mascota" onclick="selectTab('Mascota');"><?php echo $nombre;  ?></a>
                            </li>
                            <li class="nav-item">
                                <a id="Comercio" class="menu-tabs nav-link" aria-label="div-comercio" onclick="selectTab('Comercio');">+</a>
                            </li>
                        </ul>

                        <div id="div-Mascota" class="tab-content active">
                            <?php include 'updateMascota.php' ?>
                        </div>
                        
                        <div id="div-Comercio" class="tab-content">
                            <?php include 'nuevaMascota.php' ;
                            ?>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div id="boton_enviar" >
                        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                        <input id="submit" type="submit" name="submit"  onchange="muestraImagen" class="submitHueso" value="Guardar"/>	
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>

