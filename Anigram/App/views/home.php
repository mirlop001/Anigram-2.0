<?php
    include_once '../configuracion/config.php';
    include 'Comun/cabecera.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <title>Home</title>
</head>
<body>
    <?php
        include 'Comun/menu.php';
    ?> 
	<div class="container container-anigram">
        
        
        <h2>Bienvenido al home <?php if (isset($_SESSION["Nombre_Mascota"])){ echo $_SESSION["Nombre_Mascota"]; }else echo 'invitado'; ?>!!</h2>
    </div>
</body>
</html>