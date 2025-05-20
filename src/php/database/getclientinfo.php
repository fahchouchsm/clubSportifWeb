<?php

function getClientByEmail(mysqli $conn, string $email): null| mysqli_result
{
    $stmt = $conn->prepare("SELECT * FROM client WHERE email = ?");

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
