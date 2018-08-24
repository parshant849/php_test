<?php 

ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);

require __DIR__ . '/vendor/autoload.php';
use \Dotenv\Dotenv;

echo"hello";

if(getenv("ENVIRONMENT") !='prod'){
	$dotenv = new Dotenv(__DIR__);
	$dotenv->load();
}

 try{
  $url = parse_url(getenv("DATABASE_URL"));
  $host =  $url["host"];
  $username = $url["user"];
  $password = $url["pass"];
  $port = $url["port"];
  $database = substr($url["path"], 1);
	
   $host        = "host = $host ";
   $port        = "port = $port";
   $dbname      = "dbname = $database";
   $cred = "user = $username password=$password";

   $db = pg_connect( "$host $port $dbname $cred"  );
   if(!$db) {
      echo "Unable to connect with db";
   	  $return = pg_query($db, "CREATE TABLE IF NOT EXISTS test (id INT(11) AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50) NOT NULL);");

   } else {
      echo "Connected with db";

   $return = pg_query($db, "SELECT * from test");
   if(!$return) {
      echo pg_last_error($db);
      exit;
   } 
   while($row = pg_fetch_row($return)) {
     echo"<pre>"; print_r($row[0]);
   }
   echo " query executed successfully<br>";
  }
} catch (PDOException $e) {
	echo "Error : " . $e->getMessage() . "<br/>";
	die();
}

?>

