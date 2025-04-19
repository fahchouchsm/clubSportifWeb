<?php
function isLoged(): bool
{
    $key = $_COOKIE['loginToken'] ?? null;
    if ($key) {
        if ($key == $_SESSION['loginToken']['key']) {
        }
    } else {
        header('Location: ../../pages/login.php');
    }
    return true;
}