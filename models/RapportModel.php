<?php

class RapportModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Méthode pour ajouter un nouveau rapport
    public function create($idVisiteur, $idMedecin, $date, $motif, $bilan) {
        $stmt = $this->db->prepare("INSERT INTO rapport (idvisiteur, idmedecin, date, motif, bilan) VALUES (?, ?, ?, ?, ?)");

        // Lier les valeurs
        $stmt->bindValue(1, $idVisiteur, PDO::PARAM_INT);
        $stmt->bindValue(2, $idMedecin, PDO::PARAM_INT);
        $stmt->bindValue(3, $date, PDO::PARAM_STR);
        $stmt->bindValue(4, $motif, PDO::PARAM_STR);
        $stmt->bindValue(5, $bilan, PDO::PARAM_STR);
        

        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // Retourne l'ID du rapport créé
        } else {
            return false;
        }
    }

    // Ajoutez d'autres méthodes si nécessaire
}
?>
