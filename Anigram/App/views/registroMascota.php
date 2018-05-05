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
					<li class="dropdown-item tipo-mascota-drp" href="#" value="1" > <img src="../../public/img/perro-icon.png" alt="perro-icon"><h2>Perro</h2></li>
					<li class="dropdown-item tipo-mascota-drp" href="#" value="2"><img src="../../public/img/gato-icon.png" alt="gato-icon"><h2>Gato</h2></li>
					<li class="dropdown-item tipo-mascota-drp" href="#" value="6"><img src="../../public/img/cobaya-icon.png" alt="Cobaya-icon"><h2>Cobaya</h2></li>
				</div>
			</div>	
		</div>
		<div class="col-md-12 row">
			<textarea name="bio" class="formulario-textbox bio-mascota" rows="6" placeholder="Descripción" cols="20"  ><?= (isset($_SESSION["Bio_Mascota"]))? $_SESSION["Bio_Mascota"]:"" ?></textarea>
		</div>


