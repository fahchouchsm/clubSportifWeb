<?php
function createUserSession(string $email)
{
    $key = random_bytes(32);
    setcookie('user_token', $key, time() + (86400 * 30), "/", "", true, true);
}
