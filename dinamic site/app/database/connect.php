<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'site';
$db_user = 'root';
$db_pass = 'mysql';
$charset = 'utf8';
$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
           PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
try{
  $pdo = new PDO(
    "$driver:host=$host;dbname=$db_name;charset=$charset",
    $db_user, $db_pass, $option
  );
}catch (PDOException $e){
  die("Помилка при підключенні до бази даних");
}