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
  					<option value="Gato">Gato</option>
  					<option value="Conejo">Conejo</option>
					</select>
			</div>
			<div class="col-4 col-md-3">
			<input type="text" class="formulario-texbox2" name="nombreMascota" placeholder = "Nombre mascota"  required/>
			</div>
			<div class="col-4 col-md-3">
			<input type="text" class="formulario-textbox2" name="nombreDueño"  placeholder = "Nombre dueño" required />
			</div>

			<div class="col-4 col-md-2">
			<button type="submit" class="buscar" name="buscar">Buscar</button>
			</div>

			<div class="col-6">
			<?php 	
				$actualUser = $_SESSION['IDPerfilActivo'];//Mascota seguida
			 	if(isset($_SESSION['conFiltro']) && $_SESSION['conFiltro']==true){

  					
			 		$amigos_controller = new es\ucm\fdi\aw\Amigos_Controller();
					echo $amigos_controller->getSeguidosFiltro($actualUser);
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