<?php
//namespace es\ucm\fdi\aw;
  include_once '../models/mascota_model.php';
  //include_once '../models/amigos_model.php';
  include_once '../controllers/amigos_controller.php';
 
  ?>
<div class="row">
	<div class="col align-self-center col-lg-20">
		<div class="row" id="row-filtros">
			<label class="filtro">Filtros:</label>
  				<div class="col-4 col-md-2">
					<select name="tipo" type="tipo">
  					<option value="Perro">Perro</option>
  					<option value="gato">gato</option>
  					<option value="conejo">conejo</option>
					</select>
				</div>

				<div class="col-4 col-md-3"><input type="text" class="formulario-texbox2" name="nombreMascota" placeholder = "Nombre mascota"/></div>
				<div class="col-4 col-md-3"><input type="text" class="formulario-textbox2" name="nombreDueño"  placeholder = "Nombre dueño" /></div>
				<div class="col-4 col-md-2"><button type="submit" class="buscar" name="buscar">Buscar</button></div>

				<div class="col-6">
					<?php 	
						$amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();
						$actualUser = $_SESSION['IDPerfilActivo'];//Mascota seguida

			 			if(isset($_SESSION['conFiltro']) && $_SESSION['conFiltro']==true){
					 	
								if(isset($_SESSION['mascotaByTipo']) && $_SESSION['mascotaByTipo']== true){ 
								echo $amigos_controller->getSeguidosPorTipo($_SESSION['busquedaTipo'],$actualUser);
								unset($_SESSION['mascotaByTipo']);
									
								}
								else if(isset($_SESSION['mascotaByNombreTipo']) && $_SESSION['mascotaByNombreTipo']== true){
								echo $amigos_controller->getSeguidosPorTipoNombreM($_SESSION['busquedaTipo'],$actualUser,$_SESSION['busquedaNombreMascota']);
								unset($_SESSION['mascotaByNombreTipo']);
								}
								else if(isset( $_SESSION['mascotaByDueñoTipo'])&& $_SESSION['mascotaByDueñoTipo'] == true){
								echo $amigos_controller->getSeguidosPorTipoAmo($_SESSION['busquedaTipo'],$actualUser,$_SESSION['busquedaNombreDueño']);
								unset($_SESSION['mascotaByDueñoTipo']);
								}
								else{
								echo $amigos_controller->getSeguidosAllFiltros($_SESSION['busquedaTipo'],$_SESSION['busquedaNombreMascota'],$_SESSION['busquedaNombreDueño'],$actualUser);
								}
						
								unset($_SESSION['conFiltro']);
										
			 			}
						else{
				   		$amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();
				   		echo $amigos_controller->getSeguidos($actualUser);
						}
				
					?>
				</div>
		</div>	
	</div>
</div>