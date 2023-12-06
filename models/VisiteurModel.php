<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:36:22
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:36:22
 */

class VisiteurModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function createAddress($rue, $codepostal, $ville, $dpartement, $pays) {
        try {
            $stmt = $this->db->prepare("INSERT INTO adresse (rue, codepostal, ville, dpartement, pays) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$rue, $codepostal, $ville, $dpartement, $pays]);
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "Erreur lors de la création de l'adresse: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    public function register($name, $surname, $tel, $email, $rue, $codepostal, $ville, $dpartement, $pays, $password, $role) {
        try {
            $this->db->beginTransaction();
    
            // Créer l'adresse
            $idadresse = $this->createAddress($rue, $codepostal, $ville, $dpartement, $pays);
            if ($idadresse === false) {
                throw new Exception("Erreur lors de la création de l'adresse.");
            }
    
            // Créer la personne avec email
            $stmtPersonne = $this->db->prepare("INSERT INTO personne (name, surname, tel, email, idadresse) VALUES (?, ?, ?, ?, ?)");
            if (!$stmtPersonne->execute([$name, $surname, $tel, $email, $idadresse])) {
                throw new Exception("Erreur lors de la création de la personne.");
            }
    
            $idpersonne = $this->db->lastInsertId();
    
            // Insérer le mot de passe directement sans hachage
            $stmtVisiteur = $this->db->prepare("INSERT INTO visiteur (idpersonne, password) VALUES (?, ?)");
            if (!$stmtVisiteur->execute([$idpersonne, $password])) {
                throw new Exception("Erreur lors de la création du visiteur.");
            }
    



            $stmtRole = $this->db->prepare("INSERT INTO role (idpersonne, role) VALUES (?, ?)");
        if (!$stmtRole->execute([$idpersonne, $role])) {
            throw new Exception("Erreur lors de l'attribution du rôle.");
        }


            $this->db->commit();
            return true;
        } catch (Exception $e) {
            echo "Erreur lors de l'inscription: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }
    
}
?>
