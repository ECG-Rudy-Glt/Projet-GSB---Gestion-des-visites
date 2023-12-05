<?php
/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-26 11:57:59
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-26 11:57:59
 */

// Initialiser les variables pour éviter des erreurs si elles ne sont pas définies
$selectedMedicaments = [];
$quantities = [];

// Vérifier si des données ont été soumises via le formulaire précédent
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les médicaments sélectionnés et les quantités associées
    $selectedMedicaments = $_POST["selectedMedicaments"];
    $quantities = $_POST["quantities"];
}

// Fonction fictive pour récupérer le nom du médicament par son ID
// Vous devez remplacer cela par la logique réelle de votre application
function getMedicamentNameById($medicamentId) {
    $medicaments = [
        1 => "Paracétamol",
        2 => "Ibuprofène",
        // ... Ajoutez d'autres médicaments
    ];
    return isset($medicaments[$medicamentId]) ? $medicaments[$medicamentId] : "";
}
?>

<!DOCTYPE html>
<html>
<head>
    
</head>
<body>
    <div class="container">
        <h1>Rapport Enregistré</h1>
        <div class="btn-container">
            <a class="btn" href="bienvenue.php">Retour à l'accueil</a>
        </div>

        <!-- Affichage des médicaments sélectionnés -->
        <?php if (!empty($selectedMedicaments)): ?>
            <h2>Médicaments Sélectionnés :</h2>
            <ul>
                <?php foreach ($selectedMedicaments as $medicamentId): ?>
                    <?php $medicamentName = getMedicamentNameById($medicamentId); ?>
                    <?php $quantity = $quantities[$medicamentId]; ?>
                    <li><?php echo "$medicamentName - Quantité : $quantity"; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun médicament sélectionné.</p>
        <?php endif; ?>
    </div>
</body>
</html>
