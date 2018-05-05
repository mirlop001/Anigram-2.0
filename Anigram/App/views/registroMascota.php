
		<div class="row">
			<div class="col-md-5">
				<label for="fotoPerfilMascota" class="fotoPerfilMascota">
					<div id="perfil-mascota" class="foto-perfil-mascota foto-perfil perfil-md subir-foto-md"></div>
					Foto mascota
				</label>
				<input id="fotoPerfilMascota" class="input-perfil" name="fotoPerfilMascota" type="file" accept=".jpg, .jpeg, .png"/>
			</div>

			<div class="col-md-6">
				<input type="text" class="formulario-textbox" name="nombre" value='<?= (isset($_SESSION["Nombre_Mascota"]))? $_SESSION["Nombre_Mascota"]:"" ?>' placeholder = "Nombre"  required/>
				<input type="text" class="formulario-textbox" name="raza" value='<?= (isset($_SESSION["Raza_Mascota"]))? $_SESSION["Raza_Mascota"]:"" ?>' placeholder = "Raza" required />
				<input type="text" class="formulario-textbox" name="tipo" id="input-tipo-mascota" value='<?= (isset($_SESSION["Tipo_Mascota"]))? $_SESSION["Tipo_Mascota"]:null ?>' required />
			
				<button class="btn btn-secondary dropdown-toggle" id="dropdownTipoMascota" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<label>Tipo de mascota:</label>
					<i class="material-icons">arrow_drop_down</i>
				</button>
				<div id="tipos-mascota" class="dropdown-menu" aria-labelledby="dropdownTipoMascota">
					<?php 
						$mascotas_controller = new es\ucm\fdi\aw\Mascota_Controller();
						echo $mascotas_controller->getTiposMascota();
					?>
				</div>
			</div>	
		</div>
		<div class="col-md-12 row">
			<textarea name="bio" class="formulario-textbox bio-mascota" rows="6" placeholder="Descripción" cols="20"  ><?= (isset($_SESSION["Bio_Mascota"]))? $_SESSION["Bio_Mascota"]:"" ?></textarea>
		</div>
		


