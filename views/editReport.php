<?php
// Inclure DoctorModel et d'autres fichiers nécessaires
include_once '../models/DoctorModel.php';

$doctorModel = new DoctorModel($dbConnection);

$report = null;
$reportId = null;

// Récupérer le rapport à modifier
if (isset($_GET['reportId'])) {
    $reportId = $_GET['reportId'];
    $report = $doctorModel->getReportById($reportId);
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reportId'])) {
    // Récupérer les données de formulaire
    $reportId = $_POST['reportId'];
    $motif = $_POST['motif'];
    $bilan = $_POST['bilan'];
    $date = $_POST['date'];

    // Appeler la méthode pour mettre à jour le rapport
    $updateResult = $doctorModel->updateReport($reportId, $motif, $bilan, $date);

    if ($updateResult) {
        echo "Rapport mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du rapport.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier Rapport</title>
<body>
    <h1>Modifier Rapport</h1>
    <?php if ($report): ?>
        <form action="../views/editReport.php.php?reportId=<?php echo $reportId; ?>" method="post">
            <input type="hidden" name="reportId" value="<?php echo $reportId; ?>">

            <label for="motif">Motif:</label>
            <input type="text" id="motif" name="motif" value="<?php echo htmlspecialchars($report['motif']); ?>">

            <label for="bilan">Bilan:</label>
            <textarea id="bilan" name="bilan"><?php echo htmlspecialchars($report['bilan']); ?></textarea>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($report['date']); ?>">

            <input type="submit" value="Mettre à jour">
        </form>
    <?php else: ?>
        <p>Rapport introuvable.</p>
    <?php endif; ?>
</body>
</html>
