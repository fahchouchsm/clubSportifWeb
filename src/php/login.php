<?php
session_start();
require_once './connectDB.php';
require_once './functions/getclientinfo.php';
<<<<<<< HEAD



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
=======
require_once './functions/createUserSession.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stayLoged = $_POST['stayLoged'] || false;
    $email = trim($email);
    $password = trim($password) ?? false;
    $client =  getClientByEmail($conn, $email);
    if ($client) {
        $row = mysqli_fetch_assoc($client);
        if ($row['password'] == $password && $row["email"] == $email) {
            createUserSession($email, $stayLoged ? 30 : 1);
            // TODO -
            print_r($_SESSION);
            print_r($_POST);
            echo "all good";
>>>>>>> main
        } else {
            header("Location : ../pages/login.php");
        }
    }
} else {
    echo "Méthode non autorisée.";
}
