<?php
    require_once './configuracion/config.php';
	require_once "./models/mascota_model.php";  

$modeloMascota = new es\ucm\fdi\aw\Mascota_Model();
$urlFoto = NULL;

//Obtener datos de la mascota
if($_GET['urlFoto']) $urlFoto = __urlFotoGuardada__.$_GET['urlFoto'];
$amo = $_GET['id_amo'];
$nombre = htmlspecialchars(trim(strip_tags($_GET['nombre'])));
$raza = htmlspecialchars(trim(strip_tags($_GET['raza'])));
$tipo = htmlspecialchars(trim(strip_tags($_GET['tipo'])));
$bio = htmlspecialchars(trim(strip_tags($_GET['bio'])));

if($registrado = $modeloMascota->registraMascota($amo, $tipo, $nombre, $raza, $bio, $urlFoto) == true){
	
	if(isset($_FILES['fotoPerfilMascota'])){
		$nombre_imagen = $_FILES['fotoPerfilMascota']['name'];
		$imagen_tmp =$_FILES['fotoPerfilMascota']['tmp_name'];
		
		move_uploaded_file($imagen_tmp,"../public/img/saved/" . '-' .$urlFoto);
	}
	$_SESSION['Nombre_Mascota'] = $nombre;
	$_SESSION['Raza_Mascota'] = $raza;
	$_SESSION['Tipo_Mascota'] = $tipo;
	$_SESSION['Bio_Mascota'] = $bio;
	if($urlFoto) 
		$_SESSION['fotoPerfilMascota'] = $urlFoto;
	
	header('Location: ./views/home.php');
}
else {
	header('Location: ./views/registro.php');
}


?>