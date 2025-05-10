<?php
require_once "../php/functions/isLoged.php";
require_once "../php/connectDB.php";



$email = isLogged();

if ($email) {
  echo "welcome " . $email;
} else {
  header("Location: ./login.php");
}
