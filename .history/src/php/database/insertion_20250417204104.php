<?php
function insertClient(mysqli $mysqli, string $nom, string $prenom, string $dateNais, string $email, string $password)
{
    $mysqli->prepare("INSERT INTO client (nom, prenom, date_naissance, email, motdepasse) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nom, $prenom, $dateNais, $email, $password);
    $stmt->execute();
    $stmt->close();
}
