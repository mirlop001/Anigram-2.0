
    <div class="image-upload">
        <label for="fotoPerfilUsuario">
            <div id="foto-usuario" class="foto-perfil perfil-gr subir-foto-gr"></div>
            Selecciona tu foto de perfil
        </label>
        <input id="fotoPerfilUsuario" class="input-perfil" name="perfilUsuario" type="file"/>
    </div>
   
    <input type="text" class="formulario-textbox" id="nombreCompleto" name="nombreCompleto" placeholder="Tu nombre completo" required>
    <input type="email" class="formulario-textbox emailRegistro" id="email-registro" name="email" placeholder="Tu Email" required>
    <label class='error-form usuarioExiste'>Ya existe un usuario con ese email</label>

    <input type="password" class="formulario-textbox" id="clave1" name="clave1" placeholder="Tu contraseña" required>
    <label class='error-form tipoClave1'>La contraseña debe tener más de dos dígitos y al menos un número</label>

    <input type="password" class="formulario-textbox" id="clave2" name="clave2" placeholder="Repite tu contraseña" required>
    <label class='error-form clavesNoCoinciden'>Las claves no coinciden</label>
    
    <input type="hidden" class="formulario-textbox" id="rol" name="rol" value="1">
    
 