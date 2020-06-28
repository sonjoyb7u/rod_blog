<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$RootDir = "http://localhost/rod-blog";

$ServerName = "localhost";
$UserName = "root";
$PassWord = "";
$DbName = "db_rod_blog";

//$ServerName = "sql203.epizy.com";
//$UserName = "epiz_24593485";
//$PassWord = "SBJ291119826145";
//$DbName = "epiz_24593485_db_rod_blog";

try {

	$conn = new PDO("mysql:host=$ServerName;dbname=$DbName", $UserName, $PassWord, array(
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
	));
	
	// $conn->exec("set names utf8");
	// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     echo "Connected successfully";
	
} catch (PDOException $e) {

	echo "Connection Failed : " . $e->getMessage();
}


?>