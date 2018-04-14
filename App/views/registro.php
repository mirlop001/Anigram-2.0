<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <?php
        include 'Templates/cabecera.php';
    ?>
</head>
<body>
    <form action="../controllers/registroUsuario_controller.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fotoPerfilUsuario" id="fotoPerfilUsuario">
        <input type="text" id="nickname" name="nickname" placeholder="Nickname" required>
        <input type="text" id="nombreCompleto" name="nombreCompleto" placeholder="Tu nombre completo" required>
        <input type="email" id="email" name="email" placeholder="Tu Email" required>
        <input type="password" id="clave1" name="clave1" placeholder="Tu contraseña" required>
        <input type="password" id="clave2" name="clave2" placeholder="Repite tu contraseña" required>
        <input type="hidden" id="rol" name="rol" value="4">
        <input type="submit" value="registrar">
    </form>
</body>
</html>