<?php

$dsn = "mysql:host=localhost;dbname=registro";
$username = "admin";
$password = "user1";
$pdo = new \PDO($dsn, $username, $password);

$sql = "SELECT * FROM users";
$statement = $pdo->prepare($sql);
$statement->execute();

$rows = $statement->fetchAll(\PDO::FETCH_ASSOC);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($rows);