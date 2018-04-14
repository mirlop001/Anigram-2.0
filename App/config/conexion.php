
<?php  
// define('DB_SERVER','localhost');
// define('DB_NAME','Anigram');
// define('DB_USER','root');
// define('DB_PASS','');

class Conexion
{ 
    protected $db; 

   public static function conec(){ 

 		$db = new mysqli('localhost','root','', 'Anigram'); 

        if ($db->connect_errno) {
       
           echo "Error de conexión a la BD: ". $db->connect_error; 
			exit();
        } 

		return $db; 
    } 
} 
?> 
