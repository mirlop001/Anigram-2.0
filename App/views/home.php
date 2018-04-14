
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        include 'Templates/cabecera.php';
        session_start();
    ?>
    <title>Home</title>
</head>
<body>

<h1>Bienvenido al home
<? 
    if(isset($_SESSION['Nombre']))  echo $_SESSION['Nombre'];
    else echo 'invitado';
?>
!!</h1>
</body>
</html>