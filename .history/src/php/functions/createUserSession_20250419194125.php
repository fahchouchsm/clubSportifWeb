<?php
session_start();
function createUserSession(string $email, int $days)
{
    $key = random_bytes(length: 32);
    $hexKey = bin2hex($key);
    setcookie('loginToken', $hexKey, time() + 86400 * $days);
    echo "creatint the session";
    $_SESSION['loginToken'] = [
        'email' => $email,
        'key' => $hexKey,
    ];
}