<?php
session_start();

print_r($_SESSION);
echo "<br>";
print_r($_COOKIE);
echo "<br>";

require_once("./src/php/functions/isLoged.php");

$mail = isLoged();
if (!$mail) {
    echo "not loged";
} else {
    echo "loged";
    echo $mail;
}
