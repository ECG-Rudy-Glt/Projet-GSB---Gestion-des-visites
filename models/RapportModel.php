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

    public function getReportsByDate($userId, $date) {
        $stmt = $this->db->prepare("
            SELECT rapport.id, rapport.date, rapport.motif, rapport.bilan, personne.name, personne.surname 
            FROM rapport 
            JOIN medecin ON rapport.idmedecin = medecin.id 
            JOIN personne ON medecin.idpersonne = personne.id 
            WHERE rapport.idvisiteur = ? AND rapport.date = ?");
        $stmt->execute([$userId, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getDoctorById($id) {
        $stmt = $this->db->prepare("SELECT medecin.id, personne.name, personne.surname FROM medecin JOIN personne ON medecin.idpersonne = personne.id WHERE medecin.id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne le médecin trouvé
        } else {
            return null; // Ou gérer l'erreur comme nécessaire
        }
    }
    public function getReportById($id) {
        $stmt = $this->db->prepare("SELECT * FROM rapport WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    
    
}
?>

