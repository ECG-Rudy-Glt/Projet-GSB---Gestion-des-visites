<?php

/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-27 16:35:36
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-27 16:35:36
 */
require_once '../models/RapportModel.php';
require_once '../config.php';

$rapportModel = new RapportModel($dbConnection);

 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	 // Récupérer les données du formulaire
	 $id = $_POST['id'];
	 $motif = $_POST['motif'];
	 $bilan = $_POST['bilan'];
 
	 // Mettre à jour le rapport
	 $success = $rapportModel->updateReport($id, $motif, $bilan);
 
	 if ($success) {
		 // Rediriger vers la liste des rapports avec un message de succès
		 header('Location: ../views/selectReportDate.php');
	 } else {
		 // Gérer l'erreur
		 echo "Une erreur est survenue lors de la mise à jour du rapport.";
	 }
 }
 