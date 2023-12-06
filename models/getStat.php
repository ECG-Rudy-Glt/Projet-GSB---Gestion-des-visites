<?php

function getSpecialitesStats($dbConnection)
{
    $query = $dbConnection->prepare("
        SELECT 
            S.libelle AS specialite,
            COUNT(R.id) AS nombre_rapports
        FROM 
            rapport R
        JOIN 
            medecin M ON R.idmedecin = M.id
        JOIN 
            specialite S ON M.specialite = S.id
        GROUP BY 
            S.libelle
        ORDER BY 
            nombre_rapports ASC
    ");

    $query->execute();
    $specialites = $query->fetchAll(PDO::FETCH_ASSOC);

    return $specialites;
}

function getTop10Departements($dbConnection)
{
    $query = $dbConnection->prepare("
    SELECT 
        A.dpartement,
        COUNT(R.id) AS nombre_rapports
    FROM 
        rapport R
    JOIN 
        medecin M ON R.id = M.id
    JOIN 
        adresse A ON M.id = A.id
    GROUP BY 
        A.dpartement
    ORDER BY 
        nombre_rapports DESC
    LIMIT 10
");
    $query->execute();
    $departements = $query->fetchAll(PDO::FETCH_ASSOC);

    return $departements;
}

?>
