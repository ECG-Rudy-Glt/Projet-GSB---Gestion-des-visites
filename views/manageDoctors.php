<?php
include_once '../models/DoctorModel.php';

$doctorModel = new DoctorModel($dbConnection);

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
        if (!empty($results)) {
            // Indique que des résultats de recherche existent
            $searchResultsExist = true;
        }
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

    <!-- Affichez les résultats de la recherche -->
    <?php
    echo '<h2>Résultats de la recherche :</h2>';
if ($searchResultsExist) {
    foreach ($results as $result) {
        echo "Médecin: " . $result['medecinName'] . " " . $result['medecinSurname'] . ", Spécialité: " . $result['specialite'] . ", Visiteur: " . $result['visiteurName'] . " " . $result['visiteurSurname'] . ", Motif: " . $result['motif'] . ", Bilan: " . $result['bilan'] . ", Date: " . $result['date'] . "<br>";

        // Vérifiez si la clé 'reports' est définie
        if (isset($result['reports']) && is_array($result['reports'])) {
            // Affichez tous les rapports du médecin
            if (count($result['reports']) > 0) {
                echo '<h3>Rapports du médecin :</h3>';
                foreach ($result['reports'] as $report) {
                    echo "Rapport ID: " . $report['id'] . ", Motif: " . $report['motif'] . ", Bilan: " . $report['bilan'] . ", Date: " . $report['date'] . "<br>";
                }
            }
            }
        }
    
} else {
    echo "Aucun rapport disponible pour ce médecin.";}

?>
</body>
</html>