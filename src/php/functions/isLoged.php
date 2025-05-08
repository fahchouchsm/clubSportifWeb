<?php
function isLogged(): false | string
{
    if (!isset($_COOKIE['loginToken'], $_SESSION['loginToken'])) {
        return false;
    }

    $cookieToken = $_COOKIE['loginToken'];
    $sessionToken = $_SESSION['loginToken'];

    if (!is_array($sessionToken) || !isset($sessionToken['key'], $sessionToken['email'])) {
        return false;
    }

    if ($cookieToken === $sessionToken['key']) {
        return $sessionToken['email'];
    }
    setcookie('loginToken', '', time() - 3600, '/');
    return false;
}
