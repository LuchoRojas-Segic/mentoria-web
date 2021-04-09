<?php   

$dbname = "registro";
$dbuser = "registro-user";
$dbpassword = "registro-user";

$dsn =  "mysql:host=localhost;dbname=$dbname";
$db = new PDO($dsn, $dbuser, $dbpassword);

