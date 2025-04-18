<?php

function getClientByEmail(mysqli $mysqli, string $email)
{
    // Préparation de la requête
    $stmt = $mysqli->prepare("SELECT clientId, nom, prenom, dateNais, email, tel, password FROM client WHERE email = ?");

    if ($stmt) {
        $stmt->bind_param("s", $email); // "s" = string
        $stmt->execute();
        $result = $stmt->get_result();

        echo "hello";
        print_r($result->fetch_assoc());
    } else {
        echo "erreur de preparation de la requete";
        return false;
    }
}



?>