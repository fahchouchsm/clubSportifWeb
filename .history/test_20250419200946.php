<?php
require_once "./src/php/functions/isLoged.php";


if (isLoged()) {
    echo "Vous êtes connecté.";
} else {
    echo "Vous n'êtes pas connecté.";
}