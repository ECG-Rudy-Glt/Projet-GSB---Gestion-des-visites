<?php
/**
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:18:48
 * @updated_by Rudy GAULT
 * @updated_at 2023-11-13 16:18:48
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config.php';
require_once '../models/VisiteurModel.php';

class VisiteurController {
    private $model;

    public function __construct() {
        global $dbConnection; // Assurez-vous d'avoir accès à cette variable
        $this->model = new VisiteurModel($dbConnection);
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Afficher les données du formulaire pour le débogage
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
    
            // Récupération des données du formulaire
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Assigner directement sans hachage
    
            // Récupération des détails de l'adresse
            $rue = $_POST['rue'];
            $codepostal = $_POST['codepostal'];
            $ville = $_POST['ville'];
            $dpartement = $_POST['dpartement'];
            $pays = $_POST['pays'];
    
            // Effectuer l'inscription
            $registrationResult = $this->model->register($name, $surname, $tel, $email, $rue, $codepostal, $ville, $dpartement, $pays, $password);
            var_dump($registrationResult); // Vérifie le résultat de l'inscription
    
            if ($registrationResult) {
                // Rediriger vers la page de connexion
                header("Location: ../views/login.html");
                exit;
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
    }
    
}

$controller = new VisiteurController();
$controller->register();
?>