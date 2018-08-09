<?php 
ini_set('display_errors', '1');
error_reporting(E_ALL | E_STRICT);


try {
	$dbconn = pg_connect("host=ec2-50-17-250-38.compute-1.amazonaws.com dbname=dagf0bv08qg31m user=bwmefqhjvqwzac password=dac52067712ba647f1fa711e9efcbd5b46db73a7fd1e19a3215bf6136088362f");
	echo 'db is connected';
}
catch (PDOException $e) {
	echo "Error : " . $e->getMessage() . "<br/>";
	die();
}
?>