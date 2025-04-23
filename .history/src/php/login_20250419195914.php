<?php
session_start();
require_once './connectDB.php';
require_once './functions/getclientinfo.php';
require_once './functions/createUserSession.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stayLoged = $_POST['stayLoged'];
    $email = trim($email);
    $password = trim($password) ?? false;
    $client =  getClientByEmail($conn, $email);
    if ($client) {
        $row = mysqli_fetch_assoc($client);
        echo $row['password'];
        createUserSession($email, $stayLoged ? 30 : 1);
    }
} else {
    echo "Méthode non autorisée.";
}