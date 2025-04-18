<?php
session_start();
if (isset($_POST['nom'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = trim($_POST['date_naissance']);
    $email = trim($_POST['email']);
    $motdepasse = trim($_POST['motdepasse']);
    $errors = []; // ✅ Consistent naming

    if (empty($nom)) {
        $errors['nom'] = "Le nom est incorrect";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}$/", $nom)) {
        $errors['nom'] = "Le nom ne doit contenir que des lettres";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est incorrect";
    } elseif (!preg_match("/^[a-zA-Z ]{3,30}$/", $prenom)) { // 🛑 You were checking $nom again
        $errors['prenom'] = "Le prénom ne doit contenir que des lettres";
    }

    if (empty($email)) {
        $errors['email'] = "L'adresse email est obligatoire";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $errors['email'] = "Format d'email invalide";
    }

    if (empty($motdepasse)) {
        $errors['motdepasse'] = "Password est incorrect.";
    } elseif (strlen($motdepasse) < 8 || strlen($motdepasse) > 20) {
        $errors['motdepasse'] = "Password doit contenir entre 8 et 20 caractères.";
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$/", $motdepasse)) {
        $errors['motdepasse'] = "Le mot de passe doit contenir au moins une minuscule, une majuscule et un chiffre.";
    }

    if (empty($date_naissance)) {
        $errors['date_naissance'] = "La date de naissance est obligatoire";
    } elseif (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date_naissance)) {
        $errors['date_naissance'] = "Le format de la date est invalide. (AAAA-MM-JJ)";
    } elseif (strtotime($date_naissance) > time()) {
        $errors['date_naissance'] = "La date de naissance ne peut pas être dans le futur.";
    }

    if (empty($errors)) {
        echo "✅ All inputs are valid!";
    } else {
        echo "❌ Form has errors:";
        print_r($errors);
    }
}
