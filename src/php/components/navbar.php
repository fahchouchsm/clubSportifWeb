<?php
require_once  "../php/functions/isLoged.php";

if (isLoged()) {
    session_start();
    header("location:../pages/profile.html");
} else {
    echo '<a href='.login.php.'>Connexion</a>';
    echo '<a href='.register.php.'>Inscription</a>';
}






?>