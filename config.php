<?php

// config.php

// Définition des constantes pour les paramètres de connexion à la base de données.
define('DB_HOST', 'localhost'); // Hôte de la base de données, généralement 'localhost' pour un serveur local.
define('DB_NAME', 'GSB');       // Nom de la base de données à laquelle se connecter.
define('DB_USER', 'root');      // Nom d'utilisateur pour se connecter à la base de données.
define('DB_PASS', 'root');      // Mot de passe associé à l'utilisateur de la base de données.

try {
    // Tentative de connexion à la base de données en utilisant PDO.
    $dbConnection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    // Définition des options de PDO.
    $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active le lancement d'exceptions en cas d'erreurs.
    $dbConnection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Configure PDO pour retourner les données en tant que tableau associatif.
} catch (PDOException $e) {
    // Gestion des erreurs en cas de problème de connexion à la base de données.
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    exit; // Arrête l'exécution du script si une erreur survient.
}

?>
