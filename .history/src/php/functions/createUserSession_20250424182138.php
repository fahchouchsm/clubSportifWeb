<?php
function createUserSession(string $email, int $days)
{
    session_start();
    $key = random_bytes(length: 32);
    $hexKey = bin2hex($key);
    setcookie('loginToken', $hexKey, time() + 86400 * $days);
    $_SESSION['loginToken'] = [
        'email' => $email,
        'key' => $hexKey,
    ];
}
