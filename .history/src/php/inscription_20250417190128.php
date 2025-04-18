<?php
session_start();
if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = trim($_POST['date_naissance']);
    $email = trim($_POST['email']);
    $motdepasse = trim($_POST['motdepasse']);
    $error = [];
    if (empty($nom)) {
        $error[$nom] = "Le nom est onccorect";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}/", $nom)) {
        $error[$nom] = "Le nom ne doit contenir que des lettres";
    }
    if (empty($prenom)) {
        $error[$prenom] = "Le prenom est onccorect";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}/", $nom)) {
        $error[$prenom] = "Le nom ne doit contenir que des lettres";
    }

    if (empty($email)) {
        $error['email'] = "L'adresse email est obligatoire";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors['email'] = "Format d'email invalide";
    }
    echo $date_naissance;

    if (empty($motdepasse)) {
        echo $motdepasse;
        $errors['motdepasse'] = "Password est incorrect.";
    } elseif (strlen($motdepasse) < 8 || strlen($motdepasse) > 20) {
        $errors['motdepasse'] = "Password doit contenir au moins 6 caractères.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,20}$/", $motdepasse)) {
        $errors['motdepasse'] = "Le mot de passe doit contenir entre 8 et 10 caractères, avec au moins une lettre minuscule, une lettre majuscule et un chiffre.";
    }
    if (empty($date_naissance)) {
        $error[$date_naissance] = "La date de naissance est obligatoire";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_naissance)) {
        $error['date_naissance'] = "Le format de la date est invalide. (AAAA-MM-JJ)";
    } elseif (strtotime($date_naissance) > time()) {
        $error['date_naissance'] = "La date de naissance ne peut pas être dans le futur.";
    }
    if (empty($errors)) {
        // require_once '../php/db.php';
        echo "✅ All inputs are valid!";
    } else {
        echo "❌ Form has errors:";
        print_r($errors);
    }
} else {
    header('Location: inscription.html');
    exit();
}
