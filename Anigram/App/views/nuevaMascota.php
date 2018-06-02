<div class="row">
		<div class="col-md-5">
		<label for="fotoPerfilMascotaNuevo" class="fotoPerfilMascotaNuevo">
				<div id="perfil-mascota-nuevo" class="foto-perfil-mascota foto-perfil perfil-md subir-foto-md"></div>
				Foto mascota
			</label>
			<input id="fotoPerfilMascotaNuevo" class="input-perfil" name="nuevafotoPerfilMascota" type="file" accept=".jpg, .jpeg, .png"/>
		</div>

		<div class="col-md-6">
			<input type="text" class="formulario-textbox required" name="nuevoNombre"  placeholder = "Nombre" />
			<input type="text" class="formulario-textbox required" name="nuevaRaza"  placeholder = "Raza" />
			<input type="hidden" class="formulario-textbox required" name="nuevoTipo" id="input-tipo-mascota-nuevo"/>

						
			<button class="btn btn-secondary dropdown-toggle dropdownTipoMascota" id="dropdownTipoNuevo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<label>Cambiar tipo de mascota:</label>
				<i class="material-icons">arrow_drop_down</i>
			</button>
			<div id="tipos-mascota-nuevo" class="dropdown-menu" aria-labelledby="dropdownTipo">
				<?php 
					$mascotas_controller = new es\ucm\fdi\aw\Mascota_Controller();
					echo $mascotas_controller->getTiposMascota();
				?>
			</div>
		</div>	
		</div>
	<div class="col-md-12 row">
	<textarea name="nuevaBio" class="formulario-textbox bio-mascota" rows="6" placeholder="Descripción" cols="20"  ><?= (isset($_SESSION["Bio_Mascota"]))? $_SESSION["Bio_Mascota"]:"" ?></textarea>
</div>	