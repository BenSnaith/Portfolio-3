<?php

$host = "localhost";
$dbname = "u_230106507_db";
$dbusername = "u-230106507";
$dbpassword = "wHquJO1ShzVAkEC";

try
{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    echo "Database could not load: ".$e->getMessage();
}