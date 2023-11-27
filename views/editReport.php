<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclure DoctorModel et d'autres fichiers nécessaires
include_once '../models/DoctorModel.php';
require_once '../config.php';

// Vérifiez que l'ID du rapport a été envoyé.
if (!isset($_POST['reportId'])) {
    // Si l'ID n'est pas fourni, redirigez l'utilisateur vers la liste des rapports.
    header('Location: listReports.php');
    exit;
}

// Créez une instance de votre modèle.
$doctorModel = new DoctorModel();
$reportId = $_POST['reportId'];

// Utilisez la méthode getReportById pour récupérer les données du rapport.
$report = $doctorModel->getReportById($reportId);

// Vérifiez que le rapport a bien été récupéré.
if (!$report) {
    echo "Le rapport demandé n'a pas pu être trouvé.";
    exit;
}

// Si tout est bon, affichez le formulaire avec les données du rapport.
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Rapport</title>
    <!-- Incluez votre CSS ici. -->
</head>
<body>
    <h1>Modifier le Rapport</h1>
    <form action="updateReport.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($report['id']); ?>">

        <label for="motif">Motif:</label>
        <input type="text" id="motif" name="motif" value="<?php echo htmlspecialchars($report['motif']); ?>" required>

        <label for="bilan">Bilan:</label>
        <textarea id="bilan" name="bilan" required><?php echo htmlspecialchars($report['bilan']); ?></textarea>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($report['date']); ?>" required>

        <!-- Ajoutez tous les champs supplémentaires que vous pourriez avoir. -->

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>