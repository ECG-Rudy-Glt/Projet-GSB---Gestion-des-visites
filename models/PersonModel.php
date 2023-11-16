<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:19:50
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:19:50
 */
class PersonModel {
  private $db;
  private $id;
  private $name;
  private $surname;
  private $tel;
  private $adresseId;

  public function __construct($db) {
	  $this->db = $db;
  }

  // Method to set the properties of the person
  public function setProperties($id, $name, $surname, $tel, $adresseId) {
	  $this->id = $id;
	  $this->name = $name;
	  $this->surname = $surname;
	  $this->tel = $tel;
	  $this->adresseId = $adresseId;
  }

  // CRUD Methods
  public function create() {
    // Inserting into 'personne' table
    $stmt = $this->db->prepare("INSERT INTO personne (name, surname, tel, idadresse) VALUES (?, ?, ?, ?)");
    $stmt->execute([$this->name, $this->surname, $this->tel, $this->adresseId]);
  }

  public function read($id) {
    // Reading a single person entry
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

  public function update($id, $name, $surname, $tel, $adresseId) {
    // Updating a person entry
    $stmt = $this->db->prepare("UPDATE personne SET name = ?, surname = ?, tel = ?, idadresse = ? WHERE id = ?");
    $stmt->execute([$name, $surname, $tel, $adresseId, $id]);

    return $stmt->rowCount() > 0;
  }

  public function delete($id) {
    // Deleting a person entry
    $stmt = $this->db->prepare("DELETE FROM personne WHERE id = ?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->rowCount() > 0;
  }
}
?>
