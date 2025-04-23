<?php
require_once "src/php/functions/getclientinfo.php";
require_once "src/php/connectDB.php";
// Check if session has been created
if (isset($_SESSION['loginToken'])) {
    echo "Session is created! <br>";
    print_r($_SESSION);  // Print session data
} else {
    echo "Session not created yet! <br>";
}