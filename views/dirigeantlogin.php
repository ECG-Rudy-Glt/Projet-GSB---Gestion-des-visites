<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-12-06 14:31:47
 * @updated_by Rudy GAULT
 * @updated_at 2023-12-06 14:31:47
 */

 
 // dirigeantlogin.php
 session_start();
 var_dump($_SESSION);

 // Vérifier si l'utilisateur est connecté
 if (!isset($_SESSION['userId'])) {
	 header("Location: ../models/login.php");
	 exit;
 }
 
 // Récupérer le nom et le prénom de l'utilisateur depuis la session
 $nom = $_SESSION['userName'] ?? 'Inconnu';
 $prenom = $_SESSION['userSurname'] ?? 'Inconnu';
 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
	 <title>Page de Connexion du Dirigeant</title>
 </head>
 <body>
	 <h1>Bienvenue, <?php echo htmlspecialchars($nom) . ' ' . htmlspecialchars($prenom); ?></h1>
 </body>
 </html>
 