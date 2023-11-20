<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:18:57
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:18:57
 */
 require_once 'config.php'; // Assurez-vous que ce chemin est correct
 
 // ID de l'utilisateur à rechercher
 $userId = 1; // Remplacez par l'ID réel de l'utilisateur
 
 try {
	 $query = $dbConnection->prepare("
		 SELECT personne.name, personne.surname, visiteur.password
		 FROM personne
		 JOIN visiteur ON personne.id = visiteur.idpersonne
		 WHERE visiteur.id = :userId
	 ");
	 $query->execute(['userId' => $userId]);
	 $user = $query->fetch(PDO::FETCH_ASSOC);
 
	 if ($user) {
		 echo "Nom: " . htmlspecialchars($user['name']) . "<br>";
		 echo "Prénom: " . htmlspecialchars($user['surname']) . "<br>";
		 echo "Mot de passe: " . htmlspecialchars($user['password']) . "<br>";
	 } else {
		 echo "Utilisateur non trouvé.";
	 }
 } catch (PDOException $e) {
	 echo "Erreur de connexion à la base de données: " . $e->getMessage();
 }
 ?>
 