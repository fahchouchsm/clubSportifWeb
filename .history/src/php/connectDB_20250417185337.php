<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "your_database_name"; // 💡 change this!

$conn = new mysqli($host, $user, $pass, $dbname);

// 💀 Check for connection error
if ($conn->connect_error) {
    die("❌ Connexion échouée: " . $conn->connect_error);
}
