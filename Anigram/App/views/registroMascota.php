
    <h2>Este es el espacio para mascota</h2>

    <form method="post" id="Reg_mascota" action="../controllers/registroMascota_controller.php">
	
        <div class="col-md-2"  >
            <label for="fotoPerfilMascota">
                <div id="perfil-mascota" class="foto-perfil perfil-md subir-foto-md" style="background-image:url('/Anigram/Desarrollo/img/IMG_0547.jpg')"></div>
			</label>
			<input id="fotoPerfilMascota" class="input-perfil" name="fotoPerfilMascota" type="file"/>
		</div>
		
		<div class="mascota-nombre-raza">
			<input type="text" class="formulario-textbox-mascota" name="nombre" placeholder="Su nombre" required /> 
			<input type="text" class="formulario-textbox-mascota" name="raza" placeholder="Su raza" />
		</div>
        <br>


		<div class="tipomascota">
			Perro<input type="radio" name="tipo" value="1" checked>
			Gato<input type="radio" name="tipo" value="2">			
			Conejo<input type="radio" name="tipo" value="3">
			Hamster<input type="radio" name="tipo" value="4">
			Ave<input type="radio" name="tipo" value="5">
			Cobaya<input type="radio" name="tipo" value="6">

        </div>
        
		<div class="biomascota">
			<textarea name="bio" class="formulario-textbox-mascota" rows="4" cols="30" > Descripción </textarea>
		</div>
        <div id="boton_enviar">
            <input id="submitMascota" type="submit" name="submit" class="submitHueso" value="Añadir"/>	
        </div>

	</form>
