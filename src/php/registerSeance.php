<?php
require_once "./connectDB.php";
require_once "./functions/isLoged.php";

session_start();


$email = isLogged();
if (!$email) {
    die("Erreur : Vous devez être connecté pour vous inscrire.");
}


$stmt = $conn->prepare("SELECT clientId FROM client WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();
$stmt->close();

if (!$client) {
    die("Erreur : Utilisateur introuvable.");
}
$clientId = $client['clientId'];


$seanceId = filter_input(INPUT_GET, 'seanceId', FILTER_VALIDATE_INT);
if (!$seanceId) {
    die("Erreur : Identifiant de séance invalide.");
}


$stmt = $conn->prepare("
    SELECT s.max, COUNT(cs.clientId) AS subscribed_count 
    FROM seance s
    LEFT JOIN clientSeance cs ON s.seanceId = cs.seanceId
    WHERE s.seanceId = ?
    GROUP BY s.seanceId
");
$stmt->bind_param("i", $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$seance = $result->fetch_assoc();
$stmt->close();

if (!$seance) {
    die("Erreur : Séance introuvable.");
}

$remaining_spots = $seance['max'] - $seance['subscribed_count'];
if ($remaining_spots <= 0) {
    die("Erreur : Cette séance est complète.");
}


$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM clientSeance WHERE clientId = ? AND seanceId = ?");
$stmt->bind_param("ii", $clientId, $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$isRegistered = $result->fetch_assoc()['count'] > 0;
$stmt->close();

if ($isRegistered) {
    die("Erreur : Vous êtes déjà inscrit à cette séance.");
}


$stmt = $conn->prepare("INSERT INTO clientSeance (clientId, seanceId) VALUES (?, ?)");
$stmt->bind_param("ii", $clientId, $seanceId);

if ($stmt->execute()) {
    header("Location: ../pages/cours.php");
} else {
    die("Erreur : Erreur lors de l'inscription. Veuillez réessayer.");
}

$stmt->close();
$conn->close();
