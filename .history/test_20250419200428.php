<?php
session_start();
if (isset($_SESSION['loginToken'])) {
    echo "Session is created! <br>";
    print_r($_SESSION);
} else {
    echo "Session not created yet! <br>";
}