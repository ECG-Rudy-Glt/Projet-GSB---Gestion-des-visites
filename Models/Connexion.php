<?php

##CHANGER LE ROOT


try {
    $host = 'localhost'; // Adresse du serveur MySQL
    $dbname = 'GSB'; // Nom de la base de données GSB
    $user = 'root'; // Nom d'utilisateur MySQL

    // Crée une nouvelle instance PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user);

    // Définit le mode d'erreur PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Le reste de votre code pour interagir avec la base de données va ici

} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>