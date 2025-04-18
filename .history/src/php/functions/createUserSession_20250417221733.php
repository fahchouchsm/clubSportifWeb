<?php
function createUserSession(string $email)
{
    $key = random_bytes(length: 32);
    setcookie('userToken', $key, time() + 2592000);

    $_SESSION['user'] = [
        'email' => $email,
        'key' => $key,
    ];
}
