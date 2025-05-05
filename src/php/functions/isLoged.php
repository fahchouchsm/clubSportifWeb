<?php
function isLoged(): false | string
{
    if (isset($_COOKIE['loginToken'], $_SESSION['loginToken'])) {
        if ($_COOKIE['loginToken'] === $_SESSION['loginToken']['key']) {
            return $_SESSION['loginToken']['email'];
        } else {
            setcookie('loginToken', '', time());
            return false;
        }
    } else {
        return false;
    }
}
