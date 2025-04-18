<?php

$conn = new mysqli("localhost", "root", "", "clubsportif", 3306);

if ($conn->connect_error) {
    die("❌ Connexion échouée: " . $conn->connect_error);
}
