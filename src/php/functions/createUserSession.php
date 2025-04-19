<?php
function createUserSession(string $email)
{
    $key = random_bytes(length: 32);
    $hexKey = bin2hex($key);
    setcookie('userToken', $hexKey, time() + 2592000);

    $_SESSION['user'] = [
        'email' => $email,
        'key' => $hexKey,
    ];
}