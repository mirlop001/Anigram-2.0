<?php
	include '../configuracion/config.php';
    include 'Comun/cabecera.php';
    include '../controllers/mascota_controller.php';
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
   
</head>
<body>
    <div class="container-anigram ">
        <div class="row references">
            <h3><a href="login.php">Volver</a></h3>
        </div>
        <div class="row logo"><img src="<?=__urlFotoIcono__?>Logo-Nombre.png" alt="" /></div>
        <div class="row registro">
            <form id="form-registro"  method="post" enctype="multipart/form-data" data-ajax="false">
                <div class="row">
                    <div class="contenedor contedor-izquierdo col-md-12 col-lg-5">
                        <?php include 'registroUsuario.php' ?>
                    </div>
                    <div class="contenedor contedor-derecho separador col-md-12 col-lg-6 offset-lg-1">
                        <ul class="nav nav-tabs select-tabs">
                            <li class="nav-item">
                                <a id="Mascota" class="menu-tabs nav-link active" aria-label="div-mascota" onclick="selectTab('Mascota');">Mascota</a>
                            </li>
                            <li class="nav-item">
                                <a id="Comercio" class="menu-tabs nav-link" aria-label="div-comercio" onclick="selectTab('Comercio');">Comercio</a>
                            </li>
                        </ul>

                        <div id="div-Mascota" class="tab-content active">
                            <?php include 'registroMascota.php' ?>
                        </div>
                        <div id="div-Comercio" class="tab-content">
                            <div class="alert alert-warning" role="alert"><i class="material-icons">build</i><span class="bold">¡En construcción!</span>  Disculpe las molestias.</div>
                            <?php include 'registroComercio.php' ;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="boton_enviar" class="registro" >
                        <input id="submit" type="submit" name="submit"  onchange="muestraImagen" class="submitHueso" value="Guardar"/>	
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>