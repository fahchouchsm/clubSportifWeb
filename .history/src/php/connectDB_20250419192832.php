<?php

$conn = new mysqli("localhost", "root", "", "clubsportif", 3306);

if ($conn->connect_error) {
    die("erreur de connection" . $conn->connect_error);
}