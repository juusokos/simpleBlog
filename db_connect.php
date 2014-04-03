
<?php
include_once 'psl-config.php';   // As functions.php is not included
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

$host = HOST;
$dbname = DATABASE;
$user = USER;
$pass = PASSWORD;

try {
	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query("SET NAMES utf8");
}
catch(PDOException $e) {
	echo "Could not connect to database.";
	//file_put_contents('../../loki/PDOErrors.txt', $e->getMessage() . "\n", FILE_APPEND);
}
?>


  
