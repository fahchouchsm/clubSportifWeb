<?php
$key = $_COOKIE['userToken'] ?? null;
if ($key) {
} else {
    header('Location: ../../pages/login.php');
}