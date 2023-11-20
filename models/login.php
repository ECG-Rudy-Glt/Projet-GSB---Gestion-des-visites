<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-20 09:54:16
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-20 09:54:16
 */
require_once '../config.php'; // Inclure le fichier de configuration pour la connexion à la base de données

session_start(); // Commencez la session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Préparez la requête pour obtenir les informations de l'utilisateur depuis la base de données
        $query = $dbConnection->prepare("SELECT * FROM visiteur WHERE username = ?");
        $query->execute([$username]);
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Si la vérification est réussie, stockez les informations de l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id']; // Ou un autre identifiant unique de l'utilisateur
            header("Location: welcome.php"); // Redirigez vers une page de bienvenue
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
}
?>

 