<?php

    // Destruir todas las variables de sesión.
    $_SESSION = array();
    header('Location: ../views/login.php');        
?>