<?php


require_once '../models/DoctorModel.php';
require_once '../models/MedicamentModel.php';
require_once '../models/RapportModel.php';

$doctorModel = new DoctorModel($dbConnection);
$doctors = $doctorModel->getAllDoctors();
$rapportModel = new RapportModel($dbConnection);

$medicamentModel = new MedicamentModel($dbConnection);
$medicaments = $medicamentModel->getAllMedicaments();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Créer un Rapport de Visite</title>
    <!-- Inclure le CSS ici si nécessaire -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Créer un Nouveau Rapport de Visite</h2>
    <form action="../controllers/saveReport.php" method="post">
        <!-- Sélection du médecin -->
        <label for="doctor">Médecin :</label>
        <select name="doctor" id="doctor">
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
