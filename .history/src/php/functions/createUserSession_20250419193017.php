<?php
function createUserSession(string $email, int $days)
{
    $key = random_bytes(length: 32);
    $hexKey = bin2hex($key);
    setcookie('loginToken', $hexKey, time() + 2592000);

    $_SESSION['userLogin'] = [
        'email' => $email,
        'key' => $hexKey,
    ];
}