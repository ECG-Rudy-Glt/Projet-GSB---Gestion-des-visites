<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:33:54
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:33:54
 */
require_once 'config.php'; // Inclure le fichier de configuration
$doctorModel = new DoctorModel($dbConnection); // Passer la connexion à la base de données

class AdresseModel {
	 private $db;
	 
	 public function __construct($dbConnection) {
		 $this->db = $db;
	 }
 
	 // Create a new address
	 public function create($rue, $codepostal, $ville, $departement, $pays) {
		 $stmt = $this->db->prepare("INSERT INTO adresse (rue, codepostal, ville, departement, pays) VALUES (?, ?, ?, ?, ?)");
		 $stmt->bind_param("sssss", $rue, $codepostal, $ville, $departement, $pays);
		 $stmt->execute();
		 
		 if ($stmt->affected_rows > 0) {
			 return $this->db->insert_id;  // Return the id of the new address
		 } else {
			 return false;
		 }
	 }
 
	 // Read an address by id
	 public function read($id) {
		 $stmt = $this->db->prepare("SELECT * FROM adresse WHERE id = ?");
		 $stmt->bind_param("i", $id);
		 $stmt->execute();
		 $result = $stmt->get_result();
		 
		 if ($result->num_rows > 0) {
			 return $result->fetch_assoc();  // Return the address data
		 } else {
			 return null;
		 }
	 }
 
	 // Update an existing address
	 public function update($id, $rue, $codepostal, $ville, $departement, $pays) {
		 $stmt = $this->db->prepare("UPDATE adresse SET rue = ?, codepostal = ?, ville = ?, departement = ?, pays = ? WHERE id = ?");
		 $stmt->bind_param("sssssi", $rue, $codepostal, $ville, $departement, $pays, $id);
		 $stmt->execute();
		 
		 if ($stmt->affected_rows > 0) {
			 return true;
		 } else {
			 return false;
		 }
	 }
 
	 // Delete an address
	 public function delete($id) {
		 $stmt = $this->db->prepare("DELETE FROM adresse WHERE id = ?");
		 $stmt->bind_param("i", $id);
		 $stmt->execute();
		 
		 if ($stmt->affected_rows > 0) {
			 return true;
		 } else {
			 return false;
		 }
	 }
 }
 ?>