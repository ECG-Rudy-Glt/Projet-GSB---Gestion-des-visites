<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-12-06 14:31:25
 * @updated_by Rudy GAULT
 * @updated_at 2023-12-06 14:31:25
 */

 class DirigeantModel {
	 private $db;
 
	 public function __construct($dbConnection) {
		 $this->db = $dbConnection;
	 }
 
	 public function getDirigeantByEmailAndPassword($email, $password) {
		 // Requête pour trouver le dirigeant par email et mot de passe.
		 $query = $this->db->prepare("SELECT personne.id, personne.name, personne.surname FROM dirigeant JOIN personne ON dirigeant.idpersonne = personne.id WHERE personne.email = :email AND dirigeant.password = :password");
		 
		 $query->execute(['email' => $email, 'password' => $password]);
		 return $query->fetch(PDO::FETCH_ASSOC);
	 }
 }
 ?>
 