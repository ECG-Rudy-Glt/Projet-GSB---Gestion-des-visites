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
            // Afficher l'erreur SQL
            echo "Erreur lors de la création de l'adresse: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    public function register($name, $surname, $tel, $rue, $codepostal, $ville, $dpartement, $pays, $password) {
        try {
            $this->db->beginTransaction();

            // Créer l'adresse
            $idadresse = $this->createAddress($rue, $codepostal, $ville, $dpartement, $pays);
            if ($idadresse === false) {
                throw new Exception("Erreur lors de la création de l'adresse.");
            }

            // Créer la personne
            $stmtPersonne = $this->db->prepare("INSERT INTO personne (name, surname, tel, idadresse) VALUES (?, ?, ?, ?)");
            if (!$stmtPersonne->execute([$name, $surname, $tel, $idadresse])) {
                throw new Exception("Erreur lors de la création de la personne.");
            }
            $idpersonne = $this->db->lastInsertId();

            // Créer le visiteur
            $stmtVisiteur = $this->db->prepare("INSERT INTO visiteur (idpersonne, password, sel) VALUES (?, ?, ?)");
            if (!$stmtVisiteur->execute([$idpersonne, $password, 'unSelUnique'])) {
                throw new Exception("Erreur lors de la création du visiteur.");
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

