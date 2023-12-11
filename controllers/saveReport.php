<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
require_once '../models/RapportModel.php';

$rapportModel = new RapportModel($dbConnection);

$idVisiteur = $_POST['idVisiteur'];
$idMedecin = $_POST['idMedecin'];
$date = $_POST['date'];
$motif = $_POST['motif'];
$bilan = $_POST['bilan'];
$selectedMedicaments = $_POST['selectedMedicaments'] ?? [];
$quantities = $_POST['quantities'] ?? [];

if (empty($idVisiteur)) {
    echo "ID du visiteur manquant.";
    exit;
}

$rapportId = $rapportModel->create($idVisiteur, $idMedecin, $date, $motif, $bilan);

if ($rapportId) {
    foreach ($selectedMedicaments as $medicamentId) {
        $quantity = $quantities[$medicamentId] ?? 0;
        $rapportModel->saveOrdonnance($rapportId, $medicamentId, $quantity);
    }

    header('Location: ../views/reussite.php');
} else {
    echo "Erreur lors de l'enregistrement du rapport.";
}
?>