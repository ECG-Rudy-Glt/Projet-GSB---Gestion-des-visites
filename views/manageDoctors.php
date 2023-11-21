<?php
include_once '../models/DoctorModel.php';

$doctorModel = new DoctorModel($dbConnection);

// Récupération des médecins pour la liste déroulante
$allDoctors = $doctorModel->getAllDoctors();

$searchResultsExist = false;
$selectedDoctorReports = [];

// Si une recherche a été effectuée
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    if (!empty($searchTerm)) {
        $results = $doctorModel->getReportDetails($searchTerm);
        if (!empty($results)) {
            $searchResultsExist = true;
        }
    }
}

// Si un médecin est sélectionné dans la liste déroulante
if (isset($_GET['doctorSelect']) && $_GET['doctorSelect'] != '') {
    $selectedDoctorId = $_GET['doctorSelect'];
    $selectedDoctorReports = $doctorModel->getReportDetailsById($selectedDoctorId);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GSB - Gestion des Médecins</title>
    <link rel="stylesheet" href="./Doctors.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header, footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Gestion des Médecins</h1>

    <form action="" method="get">
        <label for="search">Rechercher un médecin :</label>
        <input type="text" id="search" name="search" placeholder="Nom du médecin">
        <button type="submit">Rechercher</button>

        <label for="doctorSelect">Ou sélectionnez un médecin :</label>
        <select id="doctorSelect" name="doctorSelect">
            <option value="">Choisissez un médecin</option>
            <?php foreach ($allDoctors as $doctor): ?>
                <option value="<?php echo $doctor['id']; ?>">
                    <?php echo $doctor['name'].' '.$doctor['surname']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Afficher Rapports</button>
    </form>

    <?php if ($searchResultsExist): ?>
        <h2>Résultats de la recherche :</h2>
        <?php foreach ($results as $result): ?>
            <p>
                Médecin: <?php echo $result['medecinName'] . " " . $result['medecinSurname'] . ", Spécialité: " . $result['specialite'] . ", Visiteur: " . $result['visiteurName'] . " " . $result['visiteurSurname'] . ", Motif: " . $result['motif'] . ", Bilan: " . $result['bilan'] . ", Date: " . $result['date']; ?>
                <a href="../views/editReport.php?reportId=<?php echo $result['id']; ?>">Modifier</a>
            </p>
        <?php endforeach; ?>
    <?php elseif (!empty($selectedDoctorReports)): ?>
        <h2>Rapports pour le médecin sélectionné :</h2>
        <?php foreach ($selectedDoctorReports as $report): ?>
            <p>
                Médecin: <?php echo $report['medecinName'] . " " . $report['medecinSurname'] . ", Spécialité: " . $report['specialite'] . ", Visiteur: " . $report['visiteurName'] . " " . $report['visiteurSurname'] . ", Motif: " . $report['motif'] . ", Bilan: " . $report['bilan'] . ", Date: " . $report['date']; ?>
                <a href="../views/editReport.php?reportId=<?php echo $report['id']; ?>">Modifier</a>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>

    <footer>
        <p>GSB © 2023</p>
    </footer>
</body>
</html>
