<?php
/**
 * Contrôleur pour gérer les opérations liées aux visiteurs.
 *
 * @school ENSITECH
 * @company H2V Solutions
 * @created_at 2023-11-13 16:18:48
 * @updated_by Rudy GAULT
 * @updated_at 2023-12-06 16:18:48
 */
// VisiteurController.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclusion des fichiers nécessaires.
require_once '../config.php';
require_once '../models/VisiteurModel.php';
require_once '../models/dirigeantModel.php';

class VisiteurController {
    private $visiteurModel;
    private $dirigeantModel;

    public function __construct() {
        global $dbConnection;
        $this->visiteurModel = new VisiteurModel($dbConnection);
        $this->dirigeantModel = new DirigeantModel($dbConnection);
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération et traitement des données du formulaire d'inscription.
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $tel = $_POST['tel'];
            $email = $_POST['email'];
            $password = $_POST['password']; // Ici, vous pouvez envisager de hasher le mot de passe.
            $rue = $_POST['rue'];
            $codepostal = $_POST['codepostal'];
            $ville = $_POST['ville'];
            $dpartement = $_POST['dpartement'];
            $pays = $_POST['pays'];
    
            // Effectuer l'inscription
            $registrationResult = $this->model->register($name, $surname, $tel, $email, $rue, $codepostal, $ville, $dpartement, $pays, $password);
            var_dump($registrationResult); // Vérifie le résultat de l'inscription
    
            if ($registrationResult) {
                header("Location: ../views/login.html");
                exit;
            } else {
                echo "Erreur lors de l'inscription";
            }
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifie d'abord si l'utilisateur est un dirigeant.
            $dirigeant = $this->dirigeantModel->getDirigeantByEmailAndPassword($email, $password);
            if ($dirigeant) {
                header("Location: ../views/dirigeantlogin.php?name={$dirigeant['name']}&surname={$dirigeant['surname']}");
                exit;
            }

            // Ensuite, vérifie si c'est un visiteur.
            $visiteur = $this->visiteurModel->getVisiteurByEmailAndPassword($email, $password);
            if ($visiteur) {
                header("Location: ../views/bienvenue.php");
                exit;
            } else {
                echo "Identifiants incorrects";
            }
        }
    }
}

$controller = new VisiteurController();
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'register') {
        $controller->register();
    } elseif ($_POST['action'] === 'login') {
        $controller->login();
    }
}
?>
