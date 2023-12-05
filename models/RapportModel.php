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

    // Méthode pour ajouter un nouveau rapport et créer une ordonnance
public function createAll($idVisiteur, $idMedecin, $date, $motif, $bilan, $selectedMedicaments, $quantities) {
    $this->db->beginTransaction(); // Commencez une transaction

    try {
        // Insérez le rapport
        $stmt = $this->db->prepare("INSERT INTO rapport (idvisiteur, idmedecin, date, motif, bilan) VALUES (?, ?, ?, ?, ?)");

        // Lier les valeurs
        $stmt->bindValue(1, $idVisiteur, PDO::PARAM_INT);
        $stmt->bindValue(2, $idMedecin, PDO::PARAM_INT);
        $stmt->bindValue(3, $date, PDO::PARAM_STR);
        $stmt->bindValue(4, $motif, PDO::PARAM_STR);
        $stmt->bindValue(5, $bilan, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $idRapport = $this->db->lastInsertId(); // Récupérez l'ID du rapport créé

            // Pour chaque médicament sélectionné, créez une ordonnance
            foreach ($selectedMedicaments as $medicamentId) {
                $quantity = $quantities[$medicamentId];

                // Créez l'ordonnance
                $this->createOrdonnance($idRapport, $medicamentId, $quantity);
            }

            $this->db->commit(); // Validez la transaction
            return $idRapport; // Retournez l'ID du rapport créé
        } else {
            $this->db->rollBack(); // Annulez la transaction en cas d'échec
            return false;
        }
    } catch (Exception $e) {
        $this->db->rollBack(); // En cas d'exception, annulez la transaction
        return false;
    }
}

// Méthode pour ajouter une ordonnance
public function createOrdonnance($idRapport, $idMedicament, $quantity) {
    $stmt = $this->db->prepare("INSERT INTO ordonnance (idrapport, idmedicament, quantite) VALUES (?, ?, ?)");

    // Lier les valeurs
    $stmt->bindValue(1, $idRapport, PDO::PARAM_INT);
    $stmt->bindValue(2, $idMedicament, PDO::PARAM_INT);
    $stmt->bindValue(3, $quantity, PDO::PARAM_INT);

    return $stmt->execute(); // Retourne vrai si l'insertion réussit, sinon faux
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

    public function updateReport($id, $motif, $bilan) {
        $stmt = $this->db->prepare("UPDATE rapport SET motif = ?, bilan = ? WHERE id = ?");
        $stmt->bindParam(1, $motif);
        $stmt->bindParam(2, $bilan);
        $stmt->bindParam(3, $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            die("Erreur SQL : " . $stmt->error);
        }
        return true;
    }
    
}


?>

