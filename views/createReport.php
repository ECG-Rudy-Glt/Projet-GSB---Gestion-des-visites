<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['userId'])) {
    // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: ../models/login.php");
    exit;
}

require_once '../models/DoctorModel.php';
require_once '../models/MedicamentModel.php';
require_once '../models/RapportModel.php';

$doctorModel = new DoctorModel($dbConnection);
$doctors = $doctorModel->getAllDoctors();
$medicamentModel = new MedicamentModel($dbConnection);
$medicaments = $medicamentModel->getAllMedicaments();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer un Rapport de Visite</title>
    <link rel="stylesheet" href="style css/createReport.css">
    <link rel="stylesheet" href="style.css">
    <a href="../index.php" class="btn-home">Retour à l'accueil</a>
    <a href="./bienvenue.php" class="btn-home">Revenir en arrière</a>
</head>
<body>
    <h2>Créer un Nouveau Rapport de Visite</h2>

    <form action="../controllers/saveReport.php" method="post">
        <input type="hidden" name="idVisiteur" value="<?php echo $_SESSION['userId']; ?>">

        <!-- Sélection du médecin -->
        <label for="doctor">Médecin :</label>
            <select name="idMedecin" id="doctor"> <!-- Changez 'doctor' en 'idmedecin' ici -->
                <?php foreach ($doctors as $doctor): ?>
                    <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['name'] . " " . $doctor['surname']; ?></option>
                <?php endforeach; ?>
            </select>
        <br>

        <!-- Sélection de la date -->
        <label for="date">Date :</label>
        <input type="date" name="date" id="date" required>
        <br>

        <!-- Entrée des détails du rapport -->  
        <label for="motif">Motif :</label>
        <input type="text" name="motif" id="motif" required>
        <br>

        <label for="bilan">Bilan :</label>
        <textarea name="bilan" id="bilan" required></textarea>
        <br>


        <!-- Sélection des médicaments -->
        <h3>Médicaments</h3>
        <?php foreach ($medicaments as $medicament): ?>
            <div class="medicament-item">
                <div class="checkbox-container">
                    <input type="checkbox" name="selectedMedicaments[]" value="<?php echo $medicament['id']; ?>" id="med-<?php echo $medicament['id']; ?>">
                    <label for="med-<?php echo $medicament['id']; ?>"><?php echo $medicament['nomcommercial']; ?></label>&nbsp;&nbsp;&nbsp;
                    <label class="quantity-label">Quantité :</label>
                    <input type="number" name="quantities[<?php echo $medicament['id']; ?>]" min="0">
                </div>
            </div>
        <?php endforeach; ?>


        <!-- Bouton de soumission -->
        <input type="submit" value="Enregistrer le Rapport">
    </form>
</body>
</html>
