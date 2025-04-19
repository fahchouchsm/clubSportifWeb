<?php
$key = $_COOKIE['userToken'] ?? null;
if ($key) {
    print_r($_SESSION)
} else {
    header('Location: ../../pages/login.php');
}