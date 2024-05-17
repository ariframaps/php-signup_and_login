<?php

$dsn = 'mysql:host=localhost;dbname=myfirstdatabase';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword); // initialize pdo object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    die('Error, connection failed: ' . $th->getMessage());
}