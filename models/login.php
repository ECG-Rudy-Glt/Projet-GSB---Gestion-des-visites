<?php
session_start(); // Démarrage de la session
require_once '../config.php'; // Assurez-vous que le chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $query = $dbConnection->prepare("SELECT visiteur.id, personne.name, personne.surname, visiteur.password, role.role 
                                        FROM visiteur 
                                        JOIN personne ON visiteur.idpersonne = personne.id 
                                        LEFT JOIN role ON personne.id = role.idpersonne
                                        WHERE personne.email = :email");

        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userName'] = $user['name']; // Ajouter le nom de l'utilisateur
            $_SESSION['userSurname'] = $user['surname']; // Ajouter le prénom de l'utilisateur
            $_SESSION['userRole'] = $user['role']; // Ajouter le rôle de l'utilisateur
            header("Location: ../views/bienvenue.php");
            exit;
        } else {
            echo "Mot de passe incorrect ou utilisateur non trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
} else {
    header("Location: ../views/login.html");
    exit;
}

?>


