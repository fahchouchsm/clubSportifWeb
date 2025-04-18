<?php
function createUserSession(string $email)
{
    $key = random_bytes(32);
    setcookie('userToken', $key, time()+  );
}