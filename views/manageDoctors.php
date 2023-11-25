<?php
include_once '../models/DoctorModel.php';


$doctorModel = new DoctorModel($dbConnection);

function displaySearchResults($results, $searchResultsExist) {
    echo '<h2>Résultats de la recherche :</h2>';
    if ($searchResultsExist) {
        echo '<table>';
        echo '<tr><th>Médecin</th><th>Spécialité</th><th>Visiteur</th><th>Motif</th><th>Bilan</th><th>Date</th></tr>';
        foreach ($results as $result) {
            echo "<tr>";
            echo "<td>{$result['medecinName']} {$result['medecinSurname']}</td>";
            echo "<td>{$result['specialite']}</td>";
            echo "<td>{$result['visiteurName']} {$result['visiteurSurname']}</td>";
            echo "<td>{$result['motif']}</td>";
            echo "<td>{$result['bilan']}</td>";
            echo "<td>{$result['date']}</td>";
            echo "</tr>";

            // Vérifiez si la clé 'reports' est définie
            if (isset($result['reports']) && is_array($result['reports'])) {
                // Affichez tous les rapports du médecin
                if (count($result['reports']) > 0) {
                    echo '<tr><td colspan="6"><h3>Rapports du médecin :</h3></td></tr>';
                    foreach ($result['reports'] as $report) {
                        echo "<tr>";
                        echo "<td>Rapport ID: {$report['id']}</td>";
                        echo "<td>Motif: {$report['motif']}</td>";
                        echo "<td>Bilan: {$report['bilan']}</td>";
                        echo "<td>Date: {$report['date']}</td>";
                        echo "</tr>";
                    }
                }
            }
        }
        echo '</table>';
    } else {
        echo "Aucun rapport disponible pour ce médecin.";
    }
}

// Initialise une variable pour savoir si des résultats de recherche existent
$searchResultsExist = false;
$results = array(); // Initialisez le tableau des résultats

// Si une recherche a été effectuée
if (isset($_GET['search'])) {
    $selectedDoctor = $_GET['search'];

    // Vérifie si le médecin sélectionné n'est pas vide
    if (!empty($selectedDoctor)) {
        // Utilisez $selectedDoctor dans votre requête SQL pour filtrer les résultats
        // Divisez le prénom et le nom
        $nameParts = explode(' ', $selectedDoctor);
        $prenom = $nameParts[0];
        $nom = $nameParts[1];

        $results = $doctorModel->getReportDetailsById($prenom, $nom);

        // Vérifie s'il y a des résultats
        $searchResultsExist = !empty($results);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GSB - Gestion des Médecins</title>
    <link rel="stylesheet" href="./Doctors.css">
    <link rel="stylesheet" type="text/css" href="./rapport.css">
    <!-- Liens vers vos fichiers CSS et autres ressources si nécessaire -->
</head>
<body>
    <h1>Gestion des Médecins</h1>

    <!-- Formulaire de recherche -->
    <form action="" method="get">
        <!-- Utilisez la liste déroulante pour sélectionner le médecin -->
        <label for="doctor">Sélectionner un médecin :</label>
        <select id="doctor" name="search">
            <?php
            // Obtenez la liste de tous les médecins
            $allDoctors = $doctorModel->getAllDoctors();

            // Obtenez le médecin sélectionné, s'il y en a un
            $selectedDoctor = isset($_GET['search']) ? $_GET['search'] : '';

            // Affichez chaque médecin comme une option dans la liste déroulante
            foreach ($allDoctors as $doctor) {
                $fullName = $doctor['name'] . ' ' . $doctor['surname'];
                $isSelected = ($fullName === $selectedDoctor) ? 'selected' : '';

                echo '<option value="' . $fullName . '" ' . $isSelected . '>' . $fullName . '</option>';
            }
            ?>
        </select>

        <!-- Bouton de recherche -->
        <button type="submit">Rechercher</button>
    </form>

    <!-- Appel de la fonction d'affichage des résultats de recherche -->
    <?php
    if (isset($_GET['search'])) {
        displaySearchResults($results, $searchResultsExist);
    }
    ?>
</body>
</html>