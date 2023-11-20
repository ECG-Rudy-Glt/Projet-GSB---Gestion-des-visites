<?php

include_once '../models/DoctorModel.php';
$dbConnexion = '..';
$allDoctors = $doctorModel->getAllDoctors(); // Appeler la méthode getAllDoctors

// Afficher les résultats
foreach ($allDoctors as $doctor) {
    echo "Nom: " . $doctor['name'] . ", Prénom: " . $doctor['surname'] . "<br>";
}


$doctorsWithFiches = $doctorModel->getDoctorsWithFiches();

foreach ($doctorsWithFiches as $doctor) {
    echo "ID: " . $doctor['id'] . ", Nom: " . $doctor['name'] . ", Prénom: " . $doctor['surname'] . ", Fiche: " . $doctor['details'] . "<br>";
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GSB - Gestion des Médecins</title>
    <!-- Liens vers vos fichiers CSS et autres ressources si nécessaire -->
</head>
<body>
    <h1>Gestion des Médecins</h1>

    <!-- Formulaire de recherche -->
    <form action="" method="get">
        <label for="search">Rechercher un médecin :</label>
        <input type="text" id="search" name="search" placeholder="Nom du médecin">
        <button type="submit">Rechercher</button>
    </form>

    <!-- Affichage des médecins -->
    <div class="doctors-list">
        <?php
        // Votre logique PHP pour se connecter à la base de données

        // Vérifie si une recherche a été effectuée
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];
            // Utilisez $searchTerm dans votre requête SQL pour filtrer les résultats
            // Exemple de requête :
            // SELECT personne.name, personne.surname
            // FROM medecin
            // INNER JOIN personne ON medecin.idpersonne = personne.id
            // WHERE (personne.name LIKE '$searchTerm%' OR personne.surname LIKE '$searchTerm%')
            //   AND (personne.name IS NOT NULL AND personne.surname IS NOT NULL)
            // Executez la requête et récupérez les résultats
            $results = []; // Remplacez ceci avec les résultats réels de votre requête SQL
        } else {
            // Si aucune recherche n'a été effectuée, récupérez tous les médecins
            // Exemple de requête :
            // SELECT personne.name, personne.surname
            // FROM personne
            // WHERE personne.name IS NOT NULL AND personne.surname IS NOT NULL
            // Executez la requête et récupérez les résultats
            $results = []; // Remplacez ceci avec les résultats réels de votre requête SQL
        }

        // La boucle pour afficher les médecins
        foreach ($results as $result) {
            // Affichage des détails du médecin
            echo '<p>' . $result['name'] . ' ' . $result['surname'] . '</p>';
        }
        ?>
    </div>
</body>
</html>
<?php
// Assurez-vous de fermer votre connexion à la base de données après avoir récupéré les résultats
?>