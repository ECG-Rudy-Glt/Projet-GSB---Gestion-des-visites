<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-26 14:43:12
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-26 14:43:12
 */
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['userId'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['userId']; // Récupérer l'ID de l'utilisateur connecté
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sélectionnez une Date</title>
    <link rel="stylesheet" type="text/css" href="./selectReportDate.css"></head>
</head>
<body>
    <h1>Sélectionnez une Date de Rapport</h1>
    <form action="listReports.php" method="post">
        <input type="date" name="date" required>
        <input type="hidden" name="userId" value="<?php echo $userId; ?>">
        <input type="submit" value="Afficher les Rapports">
    </form>
</body>
</html>
