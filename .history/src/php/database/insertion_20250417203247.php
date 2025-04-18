<?php
function insertClient(mysqli $mysqli, string $nom, string $prenom, string $email, string $password)
{
    $mysqli->prepare("INSERT INTO Client (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
}
