<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $date_naissance = trim($_POST['date_naissance'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $motdepasse = trim($_POST['motdepasse'] ?? '');

    $errors = [];

    // Nom 
    if (empty($nom)) {
        $errors['nom'] = "Le nom est obligatoire.";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}$/", $nom)) {
        $errors['nom'] = "Le nom ne doit contenir que des lettres (3-30 caractères).";
    }

    // Prenom 
    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est obligatoire.";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}$/", $prenom)) {
        $errors['prenom'] = "Le prénom ne doit contenir que des lettres (3-30 caractères).";
    }

    // Email 
    if (empty($email)) {
        $errors['email'] = "L'adresse email est obligatoire.";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors['email'] = "Format d'email invalide.";
    }

    // Password 
    if (empty($motdepasse)) {
        $errors['motdepasse'] = "Le mot de passe est obligatoire.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,10}$/", $motdepasse)) {
        $errors['motdepasse'] = "Le mot de passe doit contenir entre 8 et 10 caractères, avec au moins une lettre minuscule, une majuscule et un chiffre.";
    }

    // Date de naissance
    if (empty($date_naissance)) {
        $errors['date_naissance'] = "La date de naissance est obligatoire.";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_naissance)) {
        $errors['date_naissance'] = "Format invalide. Utilisez AAAA-MM-JJ.";
    } elseif (strtotime($date_naissance) > time()) {
        $errors['date_naissance'] = "Tu viens du futur ? 💀 La date ne peut pas être dans le futur.";
    }

    // Result
    if (empty($errors)) {
        echo "✅ Tous les champs sont valides !";
        // here: insert into DB
    } else {
        echo "❌ Des erreurs ont été trouvées :<br>";
        foreach ($errors as $field => $msg) {
            echo "⚠️ [$field] $msg <br>";
        }
    }
} else {
    header('Location: inscription.html');
    exit();
}