<?php

require_once __DIR__.'/Aplicacion.php';
require_once __DIR__.'/constants.php';
// constantes para la conexión con la base de datos


define('DB_SERVER','localhost');
define('DB_NAME','anigram');
define('DB_USER','root');
define('DB_PASS','');

ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'es_ES.UTF.8');

date_default_timezone_set('Europe/Madrid');


/**
 * Función para autocargar clases PHP.
 *
 * @see http://www.php-fig.org/psr/psr-4/
 */
spl_autoload_register(function ($class) {
    
    // project-specific namespace prefix
    $prefix = 'es\\ucm\\fdi\\aw\\';

    
    // base directory for the namespace prefix
    $base_dir = __DIR__ . '/';
    
    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // get the relative class name
    $relative_class = substr($class, $len);
    
    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Inicializa la aplicación
$app = es\ucm\fdi\aw\Aplicacion::getSingleton();
$app->init(array('host'=>DB_SERVER, 'bd'=>DB_NAME, 'user'=>DB_USER, 'pass'=>DB_PASS));

register_shutdown_function(array($app, 'shutdown'));