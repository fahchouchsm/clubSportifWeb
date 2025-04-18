<?php
function insertClient(mysqli $mysqli, string $nom, string $prenom, string $dateNais, string $email, string $password)
{
    $st = $mysqli->prepare("INSERT INTO client (nom, prenom, date_naissance, email, motdepasse) VALUES (?, ?, ?, ?, ?)");
    $st->bind_param("sssss", $nom, $prenom, $dateNais, $email, $password);
    return $st->execute();
}
