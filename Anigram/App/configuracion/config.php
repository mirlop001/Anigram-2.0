<?php

require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/constants.php';
// constantes para la conexión con la base de datos

session_start();

define('DB_SERVER','localhost');
define('DB_NAME','anigram');
define('DB_USER','root');
define('DB_PASS','');

ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'es_ES.UTF.8');

date_default_timezone_set('Europe/Madrid');

$app = Aplicacion::getSingleton();
$app->init(array('host'=>DB_SERVER, 'bd'=>DB_NAME, 'user'=>DB_USER, 'pass'=>DB_PASS));

register_shutdown_function(array($app, 'shutdown'));