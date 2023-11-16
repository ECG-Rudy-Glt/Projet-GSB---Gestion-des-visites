<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:35:07
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:35:07
 */
 class MedicamentModel {
	 private $db;
 
	 public function __construct($dbConnection) {
		 $this->db = $dbConnection;
	 }
 
	 // Méthode pour récupérer tous les médicaments
	 public function getAllMedicaments() {
		 $stmt = $this->db->prepare("SELECT * FROM medicament");
		 $stmt->execute();
		 return $stmt->fetchAll(PDO::FETCH_ASSOC);
	 }
	 
	 // Ajoutez d'autres méthodes si nécessaire
 }
?>
 