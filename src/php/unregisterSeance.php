<?php
require_once "./connectDB.php";
require_once "./functions/isLoged.php";

session_start();

// Vérifier si l'utilisateur est connecté
$email = isLogged();
if (!$email) {
    die("Erreur : Vous devez être connecté pour vous désinscrire.");
}

// Récupérer clientId à partir de l'email
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

// Valider seanceId
$seanceId = filter_input(INPUT_GET, 'seanceId', FILTER_VALIDATE_INT);
if (!$seanceId) {
    die("Erreur : Identifiant de séance invalide.");
}

// Vérifier si la séance existe
$stmt = $conn->prepare("SELECT 1 FROM seance WHERE seanceId = ?");
$stmt->bind_param("i", $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$seanceExists = $result->num_rows > 0;
$stmt->close();

if (!$seanceExists) {
    die("Erreur : Séance introuvable.");
}

// Vérifier si le client est inscrit
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM clientSeance WHERE clientId = ? AND seanceId = ?");
$stmt->bind_param("ii", $clientId, $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$isRegistered = $result->fetch_assoc()['count'] > 0;
$stmt->close();

if (!$isRegistered) {
    die("Erreur : Vous n'êtes pas inscrit à cette séance.");
}

// Désinscrire le client
$stmt = $conn->prepare("DELETE FROM clientSeance WHERE clientId = ? AND seanceId = ?");
$stmt->bind_param("ii", $clientId, $seanceId);

if ($stmt->execute()) {
    header("Location: ../pages/seances.php");
} else {
    die("Erreur : Erreur lors de la désinscription. Veuillez réessayer.");
}

$stmt->close();
$conn->close();
