<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-26 11:36:46
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-26 11:36:46
 */

 session_start();

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
	 <title>Bienvenue</title>
	 <!-- Inclure le CSS ici si nécessaire -->
	 <link rel="stylesheet" href="style.css">
 </head>
 <body>
	 <h1>Bienvenue <?php echo $nom . " " . $prenom; ?></h1>
	 
	 <!-- Bouton pour créer un rapport -->
	 <form action="createReport.php" method="post">
		 <input type="submit" value="Créer un Rapport">
	 </form>
	 
	<!-- Bouton pour modifier un rapport -->
	<form action="selectReportDate.php" method="post">
		<input type="submit" value="Modifier un Rapport">
	</form>

 </body>
 </html>