<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:19:05
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:19:05
 */
require_once '../models/DoctorModel.php';
$doctorModel = new DoctorModel($dbConnection); // Créez une instance de DoctorModel

// Exemple d'ID pour tester
$idPersonne = 1; // Remplacez par un ID valide de votre table personne
$specialiteId = 2; // Remplacez par un ID valide de votre table specialite

// Appeler la méthode create
$newDoctorId = $doctorModel->create($idPersonne, $specialiteId);

if ($newDoctorId) {
    echo "Nouveau médecin ajouté avec succès. ID : " . $newDoctorId;
} else {
    echo "Échec de l'ajout du médecin.";
}