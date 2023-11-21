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
    // Méthode pour afficher les médecins
    public function getAllDoctors() {
        $stmt = $this->db->prepare("SELECT DISTINCT name, surname FROM medecin JOIN personne ON medecin.idpersonne = personne.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }  
    // Méthode requete pour afficher tous les rapports du médecin demandé
    public function getReportDetails($searchTerm = null)
    {
        // Construction de la requête SQL de base
        $query = "SELECT m.id as medecinId, p.name as medecinName, p.surname as medecinSurname, s.libelle as specialite, r.motif, r.bilan, r.date, pv.name as visiteurName, pv.surname as visiteurSurname 
                FROM rapport r 
                JOIN medecin m ON r.idmedecin = m.id 
                JOIN personne p ON m.idpersonne = p.id 
                JOIN specialite s ON m.specialite = s.id 
                JOIN visiteur v ON r.idvisiteur = v.id 
                JOIN personne pv ON v.idpersonne = pv.id";

        // Si un terme de recherche est fourni, ajoutez une clause WHERE à la requête
        if ($searchTerm !== null) {
            $query .= " WHERE p.name LIKE '%$searchTerm%' OR p.surname LIKE '%$searchTerm%'";
        }

        // Préparez et exécutez la requête
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        // Récupérez les résultats
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retournez directement le tableau associatif
        return $results;
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

    public function getReportDetailsById($searchTerm = null, $doctorId = null)
{
    $query = "SELECT r.id, m.id as medecinId, p.name as medecinName, p.surname as medecinSurname, s.libelle as specialite, r.motif, r.bilan, r.date, pv.name as visiteurName, pv.surname as visiteurSurname 
              FROM rapport r 
              JOIN medecin m ON r.idmedecin = m.id 
              JOIN personne p ON m.idpersonne = p.id 
              JOIN specialite s ON m.specialite = s.id 
              JOIN visiteur v ON r.idvisiteur = v.id 
              JOIN personne pv ON v.idpersonne = pv.id";

    if ($searchTerm !== null) {
        $query .= " WHERE p.name LIKE '%$searchTerm%' OR p.surname LIKE '%$searchTerm%'";
    } elseif ($doctorId !== null) {
        $query .= " WHERE m.id = $doctorId";
    }

    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    public function searchDoctorsByTerm($searchTerm)
    {
    $query = "SELECT medecin.*
              FROM medecin
              JOIN personne ON medecin.idpersonne = personne.id
              WHERE personne.name LIKE '%$searchTerm%'
                 OR personne.surname LIKE '%$searchTerm%'";
    
    // Exécutez la requête et récupérez les résultats
    $results = $this->db->query($query)->fetchAll(PDO::FETCH_ASSOC);

    return $results;
    
}}
    
?>