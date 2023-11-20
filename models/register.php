<?php
require_once 'config.php'; // Inclure le fichier de configuration pour la connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des informations de l'utilisateur
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Supposons que vous récupérez également des informations comme le nom, prénom, etc.
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $tel = $_POST['tel'];
    $idadresse = intval($_POST['idadresse']); // Convertir en entier

    try {
        // Commencez une transaction
        $dbConnection->beginTransaction();

        // Insérez d'abord une nouvelle personne dans la table `personne`
        $queryPersonne = $dbConnection->prepare("INSERT INTO personne (name, surname, tel, idadresse) VALUES (?, ?, ?, ?)");
        $queryPersonne->execute([$name, $surname, $tel, $idadresse]);
        $personneId = $dbConnection->lastInsertId();

        // Ensuite, créez un nouveau visiteur lié à cette personne
        $queryVisiteur = $dbConnection->prepare("INSERT INTO visiteur (idpersonne, password, sel) VALUES (?, ?, ?)");
        $queryVisiteur->execute([$personneId, $password, 'unSelUnique']); // Utilisez un sel approprié

        // Validez la transaction
        $dbConnection->commit();

        // Redirection vers la page de connexion après l'inscription réussie
        header("Location: login.html");
        exit;
    } catch (PDOException $e) {
        // En cas d'erreur, annulez la transaction
        $dbConnection->rollBack();
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>

