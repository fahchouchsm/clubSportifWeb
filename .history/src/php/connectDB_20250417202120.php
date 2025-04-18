<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "your_database_name";

$conn = new mysqli($host, $user, $pass, $dbname, 3306);

if ($conn->connect_error) {
    die("❌ Connexion échouée: " . $conn->connect_error);
} else {
    echo "✅ Connexion réussie à la base de données";
}
