<?php
	include_once '../configuracion/config.php';
	include_once '../controllers/mascota_controller.php';

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu-lateral">
    <a class="navbar-item" id="selector-mascota-icon"><img class="perfil-pe " src="<?php  if(isset($_SESSION['fotoPerfilActivo'])){ echo $_SESSION['fotoPerfilActivo']; } else{ echo __urlFotoMascota__;} ?>" alt="Haga click para cambiar de mascota" /></a>
    <a class="navbar-item" href="./home.php"><i id="home-icon" class="material-icons">home</i></a>
    <?php 
       if(isset($_SESSION['UserID'])) 
          echo '<a class="navbar-item" href="./notificaciones.php"><img  class="menu-icon " src="'.__urlFotoIcono__.'notificaciones-icon.png" alt="Ir a notificaciones"></a>
                <a class="navbar-item" href="./busqueda.php"><img  class="menu-icon " src="'.__urlFotoIcono__.'search-icon.png" alt="Ir a búsqueda"></a>
                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subirFotoMascota">
                  <img src="'.__urlFotoIcono__.'PataFondo.png">
                </button> 
                
                <a class="navbar-item" href="./amigos.php"><img  class="menu-icon " src="'.__urlFotoIcono__.'friends-icon.png" alt="Ir a amigos"></a>
                <a class="navbar-item" href="./configuracion.php"><img  class="menu-icon " src="'.__urlFotoIcono__.'config-icon.png" alt="Ir a configuración"></a>';
    ?>

    <a class="navbar-item" href="../controllers/logout_controller.php"><img  class="menu-icon " src="<?= __urlFotoIcono__?>logout-icon.png" alt="Ir a Login"></a>

</nav>

<?php if(isset($_SESSION['LoginSuccess'] ) && $_SESSION['LoginSuccess'] ) { ?>
  <div id="menu-secundario" class="bounceOutLeft">
      <form action="../controllers/gestionaCambioMascota.php" method="post">
        <?php  
            $mascotas_controller = new es\ucm\fdi\aw\Mascota_Controller();
            echo $mascotas_controller->getMascotasUsuario($_SESSION['UserID']);
        ?>
      </form>
  </div>
<?php  } ?>

<div id="subirFotoMascota" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Selecciona Mascota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../controllers/gestionaSubirFoto.php" method="post" enctype="multipart/form-data">
           
            <input name="fotoMascota" type="file" accept=".jpg, .jpeg, .png" required />
            <input type="submit" class="btn btn-info"  value="Subir">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
     
      </div>
    </div>
  </div>
</div>

 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content" id="perfil-mascota-modal">
              <div id="perfil-mascota-content"></div>
          </div>
      </div>
  </div>