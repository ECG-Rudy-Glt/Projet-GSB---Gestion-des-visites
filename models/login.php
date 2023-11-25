<?php
require_once '../config.php'; // Assurez-vous que le chemin est correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez l'email et le mot de passe du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Préparez la requête SQL pour trouver l'utilisateur par email
        $query = $dbConnection->prepare("
            SELECT visiteur.password, visiteur.sel 
            FROM visiteur 
            JOIN personne ON visiteur.idpersonne = personne.id 
            WHERE personne.email = :email
        ");
        $query->execute(['email' => $email]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Vérifiez si les données de l'utilisateur sont récupérées correctement
        if ($user) {
            // Mot de passe saisi par l'utilisateur
            $userPassword = $password . $user['sel'];
            // Mot de passe haché stocké dans la base de données
            $hashedPassword = $user['password'];
        
            // Vérification du mot de passe en utilisant password_verify
            if (password_verify($userPassword, $hashedPassword)) {
                // Authentification réussie, redirigez l'utilisateur vers une page sécurisée
                header("Location: ../views/login.html");
                exit;
            } else {
                // Mot de passe incorrect
                echo "Mot de passe incorrect.";
            }
        } else {
            // Utilisateur non trouvé
            echo "Utilisateur non trouvé.";
        }
        
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données: " . $e->getMessage();
    }
} else {
    // Redirigez vers la page de connexion si la méthode n'est pas POST
    header("Location: ../views/login.html");
    exit;
}
?>




