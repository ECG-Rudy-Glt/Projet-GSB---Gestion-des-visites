<?php

/**
 * Modèle pour gérer les informations des personnes.
 *
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:19:50
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:19:50
 */
class PersonModel {
    private $db;        // Connexion à la base de données
    private $id;        // ID de la personne
    private $name;      // Nom de la personne
    private $surname;   // Prénom de la personne
    private $tel;       // Numéro de téléphone de la personne
    private $adresseId; // ID de l'adresse de la personne

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($db) {
        $this->db = $db;
    }

    // Méthode pour définir les propriétés de la personne
    public function setProperties($id, $name, $surname, $tel, $adresseId) {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->tel = $tel;
        $this->adresseId = $adresseId;
    }

    // CRUD Methods
    // Créer une nouvelle entrée pour une personne
    public function create() {
        $stmt = $this->db->prepare("INSERT INTO personne (name, surname, tel, idadresse) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->name, $this->surname, $this->tel, $this->adresseId]);
    }

    // Lire les informations d'une personne par son ID
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM personne WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Mettre à jour une entrée pour une personne
    public function update($id, $name, $surname, $tel, $adresseId) {
        $stmt = $this->db->prepare("UPDATE personne SET name = ?, surname = ?, tel = ?, idadresse = ? WHERE id = ?");
        $stmt->execute([$name, $surname, $tel, $adresseId, $id]);

        return $stmt->rowCount() > 0;
    }

    // Supprimer une entrée de personne
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM personne WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }
}
?>
