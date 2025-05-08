<?php
session_start();
require_once './connectDB.php';
require_once './database/getclientinfo.php';
require_once './functions/createUserSession.php';

print_r($_POST);

if (isset($_POST['pass'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stayLoged = isset($_POST['stayLoged']) ? $_POST['stayLoged'] : false;
    $email = trim($email);
    $password = trim($password) ?? false;
    $client =  getClientByEmail($conn, $email);
    if ($client) {
        echo "in the client";
        $row = mysqli_fetch_assoc($client);
        if ($row['password'] == $password && $row["email"] == $email) {
            createUserSession($email, $stayLoged ? 30 : 1);

            //print_r($_SESSION);
            //print_r($_POST);
            //echo "all good";
            echo ("ok");
            header("Location: ./");
            exit();
        } else {
            header("Location : ../pages/login.php");
        }
    } else {
        header("Location: ../../../pages/showPricing.html");
    }
} else {
    echo "Méthode non autorisée.";
}
