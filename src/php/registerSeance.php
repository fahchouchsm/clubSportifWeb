<?php
require_once "./connectDB.php";
require_once "./functions/isLoged.php";

session_start();

// Vérifier si l'utilisateur est connecté
$email = isLogged();
if (!$email) {
    die("Erreur : Vous devez être connecté pour vous inscrire.");
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

// Vérifier si la séance existe et n'est pas complète
$stmt = $conn->prepare("
    SELECT s.max, COUNT(cs.clientId) AS subscribed_count
    FROM seance s
    LEFT JOIN clientSeance cs ON s.seanceId = cs.seanceId
    WHERE s.seanceId = ?
    GROUP BY s.seanceId, s.max
");
$stmt->bind_param("i", $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$seance = $result->fetch_assoc();
$stmt->close();

if (!$seance) {
    die("Erreur : Séance introuvable.");
}

if ($seance['subscribed_count'] >= $seance['max']) {
    die("Erreur : Cette séance est complète.");
}

// Vérifier si le client est déjà inscrit
$stmt = $conn->prepare("SELECT COUNT(*) AS count FROM clientSeance WHERE clientId = ? AND seanceId = ?");
$stmt->bind_param("ii", $clientId, $seanceId);
$stmt->execute();
$result = $stmt->get_result();
$alreadyRegistered = $result->fetch_assoc()['count'] > 0;
$stmt->close();

if ($alreadyRegistered) {
    die("Erreur : Vous êtes déjà inscrit à cette séance.");
}

// Inscrire le client
$stmt = $conn->prepare("INSERT INTO clientSeance (clientId, seanceId) VALUES (?, ?)");
$stmt->bind_param("ii", $clientId, $seanceId);

if ($stmt->execute()) {
    header("Location: ../pages/cours.php");
} else {
    die("Erreur : Erreur lors de l'inscription. Veuillez réessayer.");
}

$stmt->close();
$conn->close();
