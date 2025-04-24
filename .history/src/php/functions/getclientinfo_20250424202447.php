<?php

function getClientByEmail(mysqli $mysqli, string $email): null| mysqli_result
{
    $stmt = $mysqli->prepare("SELECT * FROM clients WHERE email = ?");

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } else {
        echo "Erreur de préparation de la requête";
        return null;
    }
}
