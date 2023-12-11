<?php
session_start(); // Démarrage de la session pour stocker les données utilisateur.

require_once '../config.php'; // Inclusion du fichier de configuration de la base de données.

// Vérifie si le formulaire a été soumis par la méthode POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; // Récupère l'email envoyé par le formulaire.
    $password = $_POST['password']; // Récupère le mot de passe envoyé par le formulaire.

    try {
        $query = $dbConnection->prepare("SELECT visiteur.id, personne.name, personne.surname, visiteur.password FROM visiteur JOIN personne ON visiteur.idpersonne = personne.id WHERE personne.email = :email");


        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userName'] = $user['name']; // Ajouter le nom de l'utilisateur
            $_SESSION['userSurname'] = $user['surname']; // Ajouter le prénom de l'utilisateur
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
