<?php
function isLoged(): bool
{
    $key = $_COOKIE['loginToken'] ?? null;
    echo "key : " . $key;
    if ($key && $key == $_SESSION['loginToken']['key']) {
        return true;
    } else {
        // header('Location: ../../pages/login.php');
        return false;
    }
}