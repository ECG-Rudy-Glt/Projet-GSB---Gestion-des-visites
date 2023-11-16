<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:18:11
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:18:11
 */
require_once '../config.php'; // Inclure le fichier de configuration
$doctorModel = new DoctorModel($dbConnection); // Passer la connexion à la base de données

class DoctorModel {
    private $db;
    
    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Méthode pour ajouter un nouveau médecin
    public function create($idPersonne, $specialiteId) {
        $stmt = $this->db->prepare("INSERT INTO medecin (idpersonne, specialite) VALUES (?, ?)");
        
        // Bind les paramètres et exécute la requête
        $stmt->bindParam(1, $idPersonne, PDO::PARAM_INT);
        $stmt->bindParam(2, $specialiteId, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // Retourne l'ID du médecin créé
        } else {
            return false; // Ou gérer l'erreur comme nécessaire
        }
    }
    

    // Méthode pour obtenir les informations d'un médecin
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM medecin WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            return $result->fetch_assoc(); // Retourne le médecin trouvé
        } else {
            return null; // Ou gérer l'erreur comme nécessaire
        }
    }

    // Méthode pour mettre à jour les informations d'un médecin
    public function update($id, $idPersonne, $specialiteId) {
        $stmt = $this->db->prepare("UPDATE medecin SET idpersonne = ?, specialite = ? WHERE id = ?");
        $stmt->bind_param("iii", $idPersonne, $specialiteId, $id);
        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        } else {
            return false; // Ou gérer l'erreur comme nécessaire
        }
    }
    // Méthode pour supprimer un mé
    public function getAllDoctors() {
        $stmt = $this->db->prepare("SELECT personne.name, personne.surname FROM medecin JOIN personne ON medecin.idpersonne = personne.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Retourne tous les médecins avec noms et prénoms
    }    
    
}
?>