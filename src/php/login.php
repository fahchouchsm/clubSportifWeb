<?php
session_start();
require_once './connectDB.php';
require_once './functions/getclientinfo.php';



if (isset($_POST['pass']) && isset($_POST['email'])) {
    $email = $_POST['email'] ;
    $password = $_POST['pass'];

    $email = trim($email);

    if (empty($email) || empty($password)) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    $client = getClientByEmail($conn, $email);
    echo "hamada";
    if ($client != null) {
        if ($client['password'] == $password) {
            $_SESSION['clientId'] = $client['clientId'];
            $_SESSION['nom'] = $client['nom'];
            $_SESSION['email'] = $client['email'];

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