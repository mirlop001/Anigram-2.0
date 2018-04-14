<?php
	session_start(); 
	include '../controllers/usuario_controller.php';
?>

<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<title>Login</title>
	<?php
        include 'Templates/cabecera.php';
    ?>
</head>

<body>
	<div class="container-anigram container">
        <div class="row">
			<div class="col-lg-8 col-lg-offset-2">
				<form id="form-login" class="centered" method="POST" action='../controllers/login_controller.php'>
					<label for="Email" >Email</label> 
					<input id="Email" type="email" name="user" class="formulario-textbox"/>
					<label for="Clave">Contraseña:</label> 
					<input id="Clave" type="password" name="password" class="formulario-textbox"/>
					<div id="boton_enviar">
						<h5>Enviar</h5>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
