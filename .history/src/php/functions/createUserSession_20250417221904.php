<?php
function createUserSession(string $email)
{
    $key = random_bytes(length: 32);
    bin2hex($key);
    setcookie('userToken', $key, time() + 2592000);

    $_SESSION['user'] = [
        'email' => $email,
        'key' => $key,
    ];
}
