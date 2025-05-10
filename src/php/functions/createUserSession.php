<?php
function createUserSession(string $email, int $days): void
{
    $key = bin2hex(random_bytes(32));
    setcookie(
        'loginToken',
        $key,
        [
            'expires' => time() + 86400 * $days,
            'path' => '/',
            'secure' => isset($_SERVER['HTTPS']),
            'httponly' => true,
            'samesite' => 'Strict'
        ]
    );
    $_SESSION['loginToken'] = [
        'email' => $email,
        'key' => $key,
    ];
    session_regenerate_id(true);
}
