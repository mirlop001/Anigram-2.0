
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        include 'Templates/cabecera.php';
    ?>
    <title>Home</title>
</head>
<body>

<h1>Bienvenido al home
<? 
    if(isset($_SESSION['LoginSuccess']))
        ($_SESSION['LoginSuccess'])? $_SESSION['Nombre']:' invitado ';
?>
!!</h1>
</body>
</html>