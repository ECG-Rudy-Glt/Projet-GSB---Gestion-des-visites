<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config.php'; // Assurez-vous d'inclure votre fichier de configuration de base de données
require_once '../models/RapportModel.php';
// Incluez d'autres modèles si nécessaire
require_once '../views/createReport.php';
require_once '../views/style.css';


$rapportModel = new RapportModel($dbConnection);

// Récupérer les données du formulaire
$idVisiteur = $_POST['idVisiteur'];
$medecinId = $_POST['doctor'];
$date = $_POST['date'];
$motif = $_POST['motif'];
$bilan = $_POST['bilan'];
$selectedMedicaments = $_POST['selectedMedicaments'] ?? [];
$quantities = $_POST['quantities'] ?? [];

if (empty($idVisiteur)) {
    // Gérer le cas où l'ID du visiteur n'est pas défini ou est vide
    echo "ID du visiteur manquant.";
    exit;
}

// Valider les données (à compléter selon vos besoins)

// Enregistrer le rapport
$rapportId = $rapportModel->create($idVisiteur, $medecinId, $date, $motif, $bilan);
if ($rapportId) {
    // Enregistrer les médicaments offerts si nécessaire
    foreach ($selectedMedicaments as $medicamentId) {
        $quantite = $quantities[$medicamentId] ?? 0;
        // Enregistrez la quantité pour chaque médicament sélectionné
        // Utilisez un modèle approprié pour enregistrer les données dans la table 'ordonnance'
    }

    // Redirection ou affichage d'un message de succès
    header('Location: index.php');
} else {
    // Gérer l'échec de l'enregistrement
    echo "Erreur lors de l'enregistrement du rapport.";
}
?>
