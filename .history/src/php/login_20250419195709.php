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
        print_r(mysqli_fetch_row($client));
        createUserSession($email, $stayLoged ? 30 : 1);
    }
} else {
    echo "Méthode non autorisée.";
}