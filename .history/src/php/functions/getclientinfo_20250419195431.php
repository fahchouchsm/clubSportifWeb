<?php

function getClientByEmail(mysqli $mysqli, string $email): null| mysqli_result
{
    // Préparation de la requête
    $stmt = $mysqli->prepare("SELECT clientId, nom, prenom, dateNais, email, tel, password FROM client WHERE email = ?");

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } else {
        echo "erreur de preparation de la requete";
        return null;
    }
}