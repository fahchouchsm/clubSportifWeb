<?php
session_start();
require_once './connectDB.php';
require_once './functions/getclientinfo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Sécurité de base
    $email = trim($email);
    $password = trim($password);

    // Vérifie que les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    // Récupérer les infos du client
    $client = getClientByEmail($conn, $email);

    if (is_array($client)) {
        // Comparaison des mots de passe (en clair ici — à remplacer avec password_hash plus tard !)
        if ($client['password'] == $password) {
            // Connexion réussie
            $_SESSION['clientId'] = $client['clientId'];
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['email'] = $client['email'];

            // Redirection vers tableau de bord ou page d'accueil
            header("Location: ../pages/dashboard.php");
            exit;
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Aucun compte trouvé avec cet email.";
    }
} else {
    echo "Méthode non autorisée.";
}