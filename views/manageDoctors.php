<?php
include_once '../models/DoctorModel.php';

$doctorModel = new DoctorModel($dbConnection);

// Vérifie si le bouton "Afficher tous les médecins" a été cliqué
if (isset($_GET['showAll']) && $_GET['showAll'] === 'true') {
    // Récupérez tous les médecins
    isset($_GET['showAll']) && $_GET['showAll'] === 'flase';
    $allDoctors = $doctorModel->getAllDoctors();
}

// Initialise une variable pour savoir si des résultats de recherche existent
$searchResultsExist = false;

// Si une recherche a été effectuée
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];

    // Vérifie si la barre de recherche n'est pas vide
    if (!empty($searchTerm)) {
        // Utilisez $searchTerm dans votre requête SQL pour filtrer les résultats
        $results = $doctorModel->getReportDetails($searchTerm);

        // Vérifie s'il y a des résultats
        if (!empty($results)) {
            // Affichez les résultats
            echo '<h2>Résultats de la recherche :</h2>';
            foreach ($results as $result) {
                echo "Médecin: " . $result['medecinName'] . " " . $result['medecinSurname'] . ", Spécialité: " . $result['specialite'] . ", Visiteur: " . $result['visiteurName'] . " " . $result['visiteurSurname'] . ", Motif: " . $result['motif'] . ", Bilan: " . $result['bilan'] . ", Date: " . $result['date'] . "<br>";
            }
            // Indique que des résultats de recherche existent
            $searchResultsExist = true;
        }
    }
}

// La boucle pour afficher tous les médecins, mais seulement si aucun résultat de recherche n'existe
if (!$searchResultsExist) {
    echo '<h2>Tous les médecins :</h2>';
    $allDoctors = $doctorModel->getAllDoctors();
    foreach ($allDoctors as $doctor) {
        // Affichage des détails du médecin
        echo '<p>' . $doctor['name'] . ' ' . $doctor['surname'] . '</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GSB - Gestion des Médecins</title>
    <link rel="stylesheet" href="./Doctors.css">
    <!-- Liens vers vos fichiers CSS et autres ressources si nécessaire -->
</head>
<body>
    <h1>Gestion des Médecins</h1>

    <!-- Formulaire de recherche -->
<form action="" method="get">
    <label for="search">Rechercher un médecin :</label>
    <input type="text" id="search" name="search" placeholder="Nom du médecin">
    <button type="submit">Rechercher</button>
    
    <!-- Bouton pour afficher tous les médecins -->
    <a href="?showAll=true"><button type="button">Afficher tous les médecins</button></a>
</form>
</body>
</html>