<?php
	include_once '../configuracion/config.php';
	include_once '../controllers/mascota_controller.php';

?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" id="menu-lateral">
    <a class="navbar-item" href="./home.php"><img class="perfil-pe " src=<?php  if(isset($_SESSION['fotoPerfilUsuario'])) { echo '../../public/img/saved/'.$_SESSION['fotoPerfilUsuario']; }else{echo '../../public/img/Juan-Niebla.png';} ?> /></a>
    <a class="navbar-item" href="./notificaciones.php"><img  class="menu-icon " src="../../public/img/notificaciones-icon.png" alt="Ir a notificaciones"></a>
    <a class="navbar-item" href="./busqueda.php"><img  class="menu-icon " src="../../public/img/search-icon.png" alt="Ir a búsqueda"></a>
    <?php 
       if(isset($_SESSION['UserID'])) echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subirFotoMascota">
            <img src="../../public/img/pataFondo.png">
        </button> ';
    ?>
    <a class="navbar-item" href="./amigos.php"><img  class="menu-icon " src="../../public/img/friends-icon.png" alt="Ir a amigos"></a>
    <a class="navbar-item" href="./config.php"><img  class="menu-icon " src="../../public/img/config-icon.png" alt="Ir a configuración"></a>
    <a class="navbar-item" href="../controllers/logout_controller.php"><img  class="menu-icon " src="../../public/img/logout-icon.png" alt="Ir a Login"></a>

</nav>

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
            <?php  
                $mascotas_controller = new es\ucm\fdi\aw\Mascota_Controller();
                echo $mascotas_controller->getMascotaUsuario($_SESSION['UserID']);
            ?>
            <input type="hidden" name="UserID" value='<?php if(isset($_SESSION['UserID'])) echo $_SESSION['UserID']; ?>'>
            <input name="fotoMascota" type="file" accept=".jpg, .jpeg, .png" required />
            <input type="submit" class="btn btn-info"  value="Subir">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
     
      </div>
    </div>
  </div>
</div>