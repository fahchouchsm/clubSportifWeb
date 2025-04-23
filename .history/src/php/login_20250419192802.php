<?php
session_start();
require_once './connectDB.php';
require_once './functions/getclientinfo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $stayLoged = $_POST['stayLoged'];
    $email = trim($email);
    $password = trim($password);
    print_r($_POST);
} else {
    echo "Méthode non autorisée.";
}