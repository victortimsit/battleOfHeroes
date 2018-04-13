<?php

// Connexion variables
// define('DB_HOST', 'localhost');
// define('DB_PORT', '8889');
// define('DB_NAME', 'battleOfHeroes');
// define('DB_USER', 'root');
// define('DB_PASS', 'root');
define('DB_HOST', '51.254.118.218');
define('DB_PORT', '3306');
define('DB_NAME', 'marvel');
define('DB_USER', 'marvel');
define('DB_PASS', 'clio3');

try {
    // Try to connect to database
    $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT, DB_USER, DB_PASS);

    // Set fetch mode to object
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch (Exception $e) {
    // Failed to connect
    die('Could not connect');
}
