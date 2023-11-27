<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
require_once '../models/RapportModel.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['userId'])) {
    header("Location: ../models/login.php");
    exit;
}

$userId = $_SESSION['userId'];
$date = $_POST['date'];

$rapportModel = new RapportModel($dbConnection);
$reports = $rapportModel->getReportsByDate($userId, $date);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports du <?php echo htmlspecialchars($date); ?></title>
    <link rel="stylesheet" href="style css/listReports.css">
</head>
<body>
    <div class="container">
        <h1>Rapports du <?php echo htmlspecialchars($date); ?></h1>

        <?php foreach ($reports as $report): ?>
            <div class="report">
                <p>Médecin: <?php echo htmlspecialchars($report['name']) . " " . htmlspecialchars($report['surname']); ?></p>
                <form action="editReport.php" method="post">
                    <input type="hidden" name="reportId" value="<?php echo htmlspecialchars($report['id']); ?>">
                    <input type="submit" value="Modifier ce Rapport">
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>