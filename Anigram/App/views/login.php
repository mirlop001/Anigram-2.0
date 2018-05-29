<?php
	include '../configuracion/config.php';
	include '../controllers/usuario_controller.php';
	include 'Comun/cabecera.php';

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<title>Login</title>
</head>

<body>
	<a href="../../index.php"><img id="logo-grande" src="<?= __urlFotoIcono__?>Logo-Nombre.png" alt=""></a>
	<div class="container-login">
		<!-- <div class="col align-self-center col-lg-8 offset-lg-2"> -->
		<h1>Login</h1>
		<form id="form-login" class="centered" method="POST" action='../controllers/gestionaUsuario.php'>
			<div class="alert alert-danger error-form usuarioNoExiste" role="alert">Usuario o contraseña erróneos</div>
			
			<label  >Email</label>
			<input id="email-login" type="email" name="user" class="formulario-textbox"/>
			<label for="Clave">Contraseña</label>
			<input id="Clave-login" type="password" name="password" class="formulario-textbox"/>
			<div id="boton_enviar">
				<input id="submit" type="submit" name="submit" class="submitHueso" value="Entrar"/>
			</div>
		</form>
		<div class="references">
			<span ><a href="registro.php">Registrarme</a></span>
			<span id="vertical-separator">|</span>
			<span ><a href="home.php">Entrar como invitado</a></span>
		</div>
		<!-- </div> -->
	</div>
</body>
</html>
