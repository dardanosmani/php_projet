<?php

$bdd = 'tp_mysql';
$host = 'localhost';
$user = 'root';
$pwd = '';
$port = 3306;
try {
    return $cnx = new PDO(
        "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $bdd . ";charset=utf8",
        $user,
        $pwd,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    ); // Erreur mode = Description Exception (Debug)
} catch (exception $ex) {
    die("Erreur -> " . $ex->getMessage());
}