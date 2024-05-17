<?php

$host = 'localhost';
$dbname = 'myfirstdatabase';
$dbusername = 'root';
$dbpassword = '';

try {
    $pdo = new PDO('mysql:host=$host;dbname=$dbname', $dbusername, $dbpassword); // initialize pdo object
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    die('Error, connection failed: ' . $th->getMessage());
}