<?php
  
    include_once '../configuracion/config.php';
    include_once '../controllers/publicacion_controller.php';
    include 'Comun/cabecera.php';
  
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Amigos</title>
   
</head>
<body>
<?php
        include 'Comun/menu.php';
    ?> 
    
    <div class="container-anigram ">
    <div class="center">
         <h1>Amigos</h1>
    </div>
     
       
            <div class="row">
                <div class="col align-self-center col-lg-10 offset-lg-1">
                
                    <ul class="nav nav-tabs select-tabs1">
                        <li class="nav-item">
                            <a id="Aceptados" name ="Aceptados" value="1" class="menu-tabs nav-link active" aria-label="div-aceptados" onclick="selectTabAmigos('Aceptados');">Aceptados</a>
                        </li>
                        <li class="nav-item">
                            <a id="Peticiones" name ="Peticiones" value="2" class="menu-tabs nav-link" aria-label="div-peticiones" onclick="selectTabAmigos('Peticiones');">Peticiones</a>
                        </li>
                    </ul>
                    <form action="../controllers/gestionaListaAceptados.php" method="post">
                    <div id="div-Aceptados" class="tab-content1 active">
                      <?php include 'listaAceptados.php';?>
                      
                    </div>
                    </form>

                    <div id="div-Peticiones" class="tab-content1">
                        <?php include 'peticionesPendientes.php'; ?>
                    </div>

                </div>
            </div>
         
        
    </div>
</body>
</html>