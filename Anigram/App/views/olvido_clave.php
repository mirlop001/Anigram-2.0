<?php
	include '../configuracion/config.php';
	include '../controllers/usuario_controller.php';
	include 'Comun/cabecera.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Olvido contraseña</title>
</head>

<body>
	<img id="logo-grande" src="../../public/img/Logo-Nombre.png" alt="">
	<div class="container-login">
		<h1>Olvido contraseña</h1>
		<form id="form-olvido" class="centered" method="POST" action='../controllers/comprobacionForm.php'>
			<div class="alert alert-danger usuarioNoExiste" role="alert">
                <i class="fas fa-paw"></i> No existe ningún usuario con ese email
            </div>
            <div class="alert alert-info enviadoCorreoOlvidado" role="alert">
                <i class="fas fa-paw"></i>Se ha enviado un email a tu cuenta de correo.
            </div>
			<label>Email</label>
			<input id="email-olvido" type="email" name="email-olvido" class="formulario-textbox" required/>
			<a id="emailLnk" href="#">Hola</a>
			<div id="boton_enviar">
				<input id="submit" type="submit" name="submit" class="submitHueso" value="Entrar"/>
			</div>
		</form>
		<div class="references">
			<span ><a href="registro.php">Registrarme</a></span>
			<span id="vertical-separator">|</span>
			<span ><a href="home.php">Entrar como invitado</a></span>
		</div>
		<div class="references">
			<span ><a href="login.php">Volver al login</a></span>
		</div>
	</div>
</body>
</html>
