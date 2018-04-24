	<h2>Este es el espacio para mascota</h2>

    <form method="post" id="Reg_mascota" action="../controllers/registroMascota_controller.php"  enctype="multipart/form-data">
	
        <div class="col-md-2"  >
            <label for="fotoPerfilMascota">
                <div id="perfil-mascota" class="foto-perfil-mascota perfil-md subir-foto-md"></div>
			</label>
			<input id="fotoPerfilMascota" class="input-perfil" name="fotoPerfilMascota" type="file"/>
		</div>
		
		<div class="mascota-nombre-raza">
			<input type="text" class="formulario-textbox-mascota" name="nombre" placeholder="Su nombre" required /> 
			<input type="text" class="formulario-textbox-mascota" name="raza" placeholder="Su raza" required />
		</div>
		<br>
		<div class="fotomascota">
			<h2>Foto perfil mascota</h2>
		</div>

		<!-- <div class="tipomascota">
			Perro <input type="radio" name="tipo" value="1" checked>
			Gato <input type="radio" name="tipo" value="2">			
			Conejo <input type="radio" name="tipo" value="3">
			Hamster <input type="radio" name="tipo" value="4">
			Ave <input type="radio" name="tipo" value="5">
			Cobaya <input type="radio" name="tipo" value="6">		 
        </div> -->

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Dropdown button
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">Action</a>
				<a class="dropdown-item" href="#">Another action</a>
				<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</div>
        
		<!-- <div class="biomascota">
			<textarea name="bio" class="formulario-textbox-mascota" rows="5" placeholder="Descripción" cols="30" ></textarea>
		</div> -->
        <div id="boton_enviar">
            <input id="submitMascota" type="submit" name="submit" class="submitHueso" value="Añadir"/>	
        </div>

	</form>
