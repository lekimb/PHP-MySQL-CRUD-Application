<?php

$host = "localhost:3306";
$user = "root";
$password = "1234";
$dbname = "test";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);