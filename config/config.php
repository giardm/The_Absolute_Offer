<?php

/**
 * CONFIG GLOBAL 
 */

//Chemin absolu de l'application :
define('BASE_PATH', dirname(__DIR__)); 
define('APP_PATH', BASE_PATH . '/app');
define('CONTROLLERS_PATH', APP_PATH . '/controllers');
define('MODELS_PATH', APP_PATH . '/models');
define('VIEWS_PATH', APP_PATH . '/views');


define('DB_HOST', 'localhost');  // Adresse du serveur MySQL
define('DB_NAME', 'tao_bd');
define('DB_USER', 'root');       // Ton utilisateur MySQL
define('DB_PASS', '');  // Change le mot de passe en production !


try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}


?>
