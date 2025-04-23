<?php
<<<<<<< HEAD
require_once "src/php/functions/getclientinfo.php";
require_once "src/php/connectDB.php";

getClientByEmail($conn, "simo@gmail.com");
=======
require_once "./src/php/functions/isLoged.php";
if (isLoged()) {
    echo "Vous êtes connecté.";
} else {
    echo "Vous n'êtes pas connecté.";
}
>>>>>>> main
