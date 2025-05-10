<?php
session_start();
require_once 'connectDB.php';
require_once "./functions/createUserSession.php";


$errors = [];


if (isset($_POST["email"], $_POST["pass"])) {

    $email = $_POST['email'];
    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors[] = "Format de messagerie non valide.";
    }

    $password = $_POST['pass'] ?? '';
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/", $password)) {
        $errors[] = "Le mot de passe doit être de 8 à 20 caractères, avec au moins un majuscules, des minuscules et un chiffre.";
    }

    // ok
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT clientId, email, password FROM client WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $client = $result->fetch_assoc();
            if ($client["password"] !== $password) {
                $errors[] = "Mot de passe incorrect.";
            } else {
                createUserSession($client["email"], $_POST["stayLoged"] ? 30 : 1);
                header("Location: ../pages/profile.php");
            }
        } else {
            $errors[] = "Aucun utilisateur trouvé avec cet e-mail.";
        }
    }
}


if (!empty($errors)) {
    print_r($errors);
    exit();
}
