<?php
require_once  './src/php/functions/isLoged.php';

if (isLoged()) {
    header("location:../pages/profile.html");
} else {
    echo '<a href='login.php'>Connexion</a>';
    echo '<a href='register.php'>Inscription</a>';
}






?>