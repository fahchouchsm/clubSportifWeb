<?php
function isLoged(): bool
{
    $key = $_COOKIE['loginToken'] ?? null;
    if ($key && $key == $_SESSION['loginToken']['key']) {
        return true;
    } else {
        header('Location: ../../pages/login.php');
    }
}