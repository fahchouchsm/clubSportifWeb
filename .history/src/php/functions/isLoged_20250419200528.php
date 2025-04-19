<?php
function isLoged(): bool
{
    $key = $_COOKIE['loginToken'] ?? null;
    if ($key) {
        print_r($_SESSION);
    } else {
        header('Location: ../../pages/login.php');
    }
    return true;
}