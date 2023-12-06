<?php

// Inclure le fichier de configuration de la base de données
require_once '../config.php';
require_once '../models/getStat.php';

$specialites = getSpecialitesStats($dbConnection);
$departements = getTop10Departements($dbConnection);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <link rel="stylesheet" type="text/css" href="../views/style css/stat.css">
    <meta charset="UTF-8">
    <title>Statistiques</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Top 10 des Départements par Nombre de Rapports de Visite (Ordre Décroissant)</h1>

    <!-- Tableau pour afficher la liste des départements -->
    <table>
        <thead>
            <tr>
                <th>Département</th>
                <th>Nombre de Rapports</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($departements as $departement): ?>
                <tr>
                    <td><?php echo $departement['dpartement']; ?></td>
                    <td><?php echo $departement['nombre_rapports']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h1>Statistiques sur les Spécialités par Nombre de Rapports de Visite (Ordre Croissant)</h1>

    <!-- Tableau pour afficher la liste des spécialités -->
    <table>
        <thead>
            <tr>
                <th>Rang</th>
                <th>Spécialité</th>
                <th>Nombre de Rapports</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $rang = 1; // Initialiser le compteur de rang
            foreach ($specialites as $specialite): ?>
                <tr>
                    <td><?php echo $rang++; ?></td>
                    <td><?php echo $specialite['specialite']; ?></td>
                    <td><?php echo $specialite['nombre_rapports']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>