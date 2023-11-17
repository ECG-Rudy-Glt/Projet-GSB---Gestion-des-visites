<?php

// config.php
define('DB_HOST', 'localhost');
define('DB_NAME', 'GSB');
define('DB_USER', 'root');
define('DB_PASS', 'root');

try {
    // Créez une instance PDO ici
    $dbConnection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER); #Mettre ca pour rudy : , DB_PASS);
    // Définir le mode d'erreur PDO sur Exception
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Définir le mode de récupération par défaut sur FETCH_ASSOC pour récupérer les résultats en tant que tableau associatif
    $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit;
}

?>
