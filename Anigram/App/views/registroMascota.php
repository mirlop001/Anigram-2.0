
    <form method="post" id="Reg_mascota" action="../controllers/registroMascota_controller.php"  enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-5">
				<label for="fotoPerfilMascota" class="fotoPerfilMascota">
					<div id="perfil-mascota" class="foto-perfil-mascota perfil-md subir-foto-md"></div>
					Foto perfil mascota
				</label>
				<input id="fotoPerfilMascota" class="input-perfil" name="fotoPerfilMascota" type="file"/>
			</div>

			<div class="col-md-6">
				<input type="text" class="formulario-textbox" name="nombre" placeholder="Su nombre" required />
				<input type="text" class="formulario-textbox" name="raza" placeholder="Su raza" required />
			
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownTipoMascota" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<label>Tipo de mascota:</label>
					<i class="material-icons">arrow_drop_down</i>
				</button>
				<div id="tipos-mascota" class="dropdown-menu" aria-labelledby="dropdownTipoMascota">
					<a class="dropdown-item tipo-mascota-drp" href="#"> <img src="../../public/img/perro-icon.png" alt="perro-icon"><h2>Perro</h2></a>
					<a class="dropdown-item tipo-mascota-drp" href="#"><img src="../../public/img/gato-icon.png" alt="gato-icon"><h2>Gato</h2></a>
					<a class="dropdown-item tipo-mascota-drp" href="#"><img src="../../public/img/cobaya-icon.png" alt="Cobaya-icon"><h2>Cobaya</h2></a>
				</div>
			</div>	
		</div>
		<div class="col-md-12 row">
			<textarea name="bio" class="formulario-textbox bio-mascota" rows="5" placeholder="Descripción" cols="30" ></textarea>
		</div> 
        <div id="boton_enviar" class="boton-enviar-mascota">
            <input id="submitMascota" type="submit" name="submit" class="submitHueso " value="Añadir"/>
        </div> 

	</form>
