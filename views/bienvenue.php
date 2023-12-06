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

 $role = $_SESSION['userRole'] ?? 'Inconnu';

 ?>
 
 <!DOCTYPE html>
 <html>
 <head>
	 <title>Bienvenue</title>
	 <link rel="stylesheet" href="style css/Bienvenue.css">
	 <a href="../index.php" class="btn-home">Retour à l'accueil</a>

 </head>
 <body>
	 <h1>Bienvenue <?php echo $prenom . " " . $nom; ?></h1>
	 <!-- Bouton pour créer un rapport -->
	 <form action="createReport.php" method="post">
		 <input type="submit" value="Créer un Rapport">
	 </form>
	 
	<!-- Bouton pour modifier un rapport -->
	<form action="selectReportDate.php" method="post">
		<input type="submit" value="Modifier un Rapport">
	</form>




	<!-- Condition pour afficher le bouton Statistiques -->
	<?php if ($role === 'Service Commercial'): ?>
			<form action="statistiques.php" method="post">
				<input type="submit" value="Statistiques">
			</form>
		<?php endif; ?>



</body>
</html>