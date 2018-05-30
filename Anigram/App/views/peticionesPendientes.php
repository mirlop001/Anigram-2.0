<?php

//namespace es\ucm\fdi\aw;
  //include_once '../models/mascota_model.php';
  include_once '../controllers/amigos_controller.php';


?>
<div class="col align-self-center col-lg-20">

	<div class= col-6>
  <div class="row" id="row-filtros">
  
      <?php
   
 
        $idSeguido = $_SESSION['IDPerfilActivo'];
        $amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();
        echo $amigos_controller->getPeticionesAmistad($idSeguido);
        
    ?>
  </div>
  </div>
</div>

