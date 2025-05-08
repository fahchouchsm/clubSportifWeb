<?php

function getClientByEmail(mysqli $mysqli, string $email): null| mysqli_result
{
    $stmt = $mysqli->prepare("SELECT * FROM client WHERE email = ?");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
