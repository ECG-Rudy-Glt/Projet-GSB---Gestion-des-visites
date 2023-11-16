<?php

class RapportModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Méthode pour ajouter un nouveau rapport
    public function create($idMedecin, $date, $motif, $bilan) {
        $stmt = $this->db->prepare("INSERT INTO rapport (idmedecin, date, motif, bilan) VALUES (?, ?, ?, ?)");

        // Utilisation de bindValue
        $stmt->bindValue(1, $idMedecin, PDO::PARAM_INT);
        $stmt->bindValue(2, $date, PDO::PARAM_STR);
        $stmt->bindValue(3, $motif, PDO::PARAM_STR);
        $stmt->bindValue(4, $bilan, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // Retourne l'ID du rapport créé
        } else {
            return false;
        }
    }

    // Ajoutez d'autres méthodes si nécessaire
}
?>
