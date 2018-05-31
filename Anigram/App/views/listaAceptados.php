<?php
//namespace es\ucm\fdi\aw;
  include_once '../models/mascota_model.php';
  //include_once '../models/amigos_model.php';
  include_once '../controllers/amigos_controller.php';
  include_once '../controllers/mascota_controller.php';
 
  ?>
<div class="row">
	<div class="col align-self-center col-lg-10">
		<div class="row" id="row-filtros">
			<label class="filtro">Filtros:</label>
			<div class="col-3">
				<input type="hidden" class="formulario-textbox required" name="tipo" id="input-tipo-mascota"  required />
				
				<button id="dropdownTipo" class="dropdown-toggle dropdown-basic " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<label>Tipo de mascota:</label>
				</button>
				<div id="tipos-mascota" class="dropdown-menu basic" aria-labelledby="dropdownTipoMascota">
				
					<?php 
						$mascotas_controller = new es\ucm\fdi\aw\Mascota_Controller();
						echo $mascotas_controller->getTiposMascotaBasic();
					?>
				</div>
			</div>
			<div class="col-3"><input type="text" class="formulario-texbox2" name="nombreMascota" placeholder = "Nombre mascota"/></div>
			<div class="col-3"><input type="text" class="formulario-textbox2" name="nombreDueño"  placeholder = "Nombre dueño" /></div>
			<div class="col-3 "><button type="submit" class="buscar" name="buscar">Buscar</button></div>
		</div>
			<div class="row">
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