<?php

function getClientByEmail($conn, $email)
{

    $query = $conn->prepare("SELECT * FROM client WHERE email = ?");


    if ($query === false) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }


    $query->bind_param("s", $email);


    $query->execute();


    $resultSet = $query->get_result();

    return $resultSet->fetch_assoc();
}
?>