<?php
define("DB_HOST", "localhost");

// Nom de la BDD
define("DB_NAME", "portfolio");

// User de la BDD
define("DB_USER", "root");

// Password de la BDD
define("DB_PASSWORD", "");

$pdo = new PDO('mysql:host='. DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

?>