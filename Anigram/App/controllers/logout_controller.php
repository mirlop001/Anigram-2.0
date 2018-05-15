<?php
    require_once '../configuracion/config.php';

    // Destruir todas las variables de sesión.
    $_SESSION = array();
    session_destroy();
    header('Location: ../views/login.php');        
?>