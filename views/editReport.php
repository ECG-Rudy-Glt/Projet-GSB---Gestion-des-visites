<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../models/DoctorModel.php';
require_once '../config.php';

// Créez une instance de DoctorModel avec la connexion à la base de données.
$doctorModel = new DoctorModel($dbConnection);

// Vérifiez que l'ID du rapport a été envoyé.
if (!isset($_POST['reportId'])) {
    // Si l'ID n'est pas fourni, redirigez l'utilisateur vers la liste des rapports.
    header('Location: listReports.php');
    exit;
}

$reportId = $_POST['reportId'];

// Utilisez la méthode getReportById pour récupérer les données du rapport.
$report = $doctorModel->getReportById($reportId);

// Vérifiez que le rapport a bien été récupéré.
if (!$report) {
    echo "Le rapport demandé n'a pas pu être trouvé.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Rapport</title>
    <link rel="stylesheet" type="text/css" href="../views/style css/editreport.css">
</head>

<body>
    <h1>Modifier le Rapport</h1>
    <form action="../controllers/updateReport.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($report['id']); ?>">

        <label for="motif">Motif:</label>
        <input type="text" id="motif" name="motif" value="<?php echo htmlspecialchars($report['motif']); ?>" required>

        <label for="bilan">Bilan:</label>
        <textarea id="bilan" name="bilan" required><?php echo htmlspecialchars($report['bilan']); ?></textarea>


        <!-- Ajout de tous les champs supplémentaires -->

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>