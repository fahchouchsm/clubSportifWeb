<?php
$key = $_COOKIE['userToken'] ?? null;
if ($key) {
    echo $_SESSION;
} else {
    header('Location: ../../pages/login.php');
}