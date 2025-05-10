<?php
session_start();

function isLogged(): false | string
{
    if (!isset($_COOKIE['loginToken']) && !isset($_SESSION['loginToken'])) {
        echo "No cookie or session token found.";
        return false;
    }

    $cookieToken = $_COOKIE['loginToken'];
    $userSession = $_SESSION['loginToken'];

    if ($userSession['key'] == $cookieToken) {
        return $userSession["email"];
    }

    return false;
}
