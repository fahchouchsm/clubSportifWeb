<?php
require_once "../../connectDB.php";

header('Content-Type: application/json');

// Log errors to a file for debugging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../../logs/php_errors.log'); // Ensure this path exists and is writable

$clientId = 'AaB8yR4GWrr2IPiJAoDjfSHPv8p8i07rFNtXYyK2wqhhAKdBX6Rj78TVcoyVRmki_XAXp3KDNSQ6vARZ';
$secret = 'EDCsP8sVLDVEJYmvYlSApkBdKeP0bB2DJ7QxkXSC8ZMsUOLcAkK7wRB-cHA1TZ7jMZH3m2-MBaUczwgc';

// Get input data
$input = json_decode(file_get_contents('php://input'), true);
$orderID = $_GET['orderID'] ?? null;
$clientIdDb = $input['clientId'] ?? null;
$plan = $input['plan'] ?? null;
$duration = $input['duration'] ?? null;
$amount = $input['amount'] ?? null;

$validPlans = [
    '3months' => ['amount' => 300.00, 'duration' => 3],
    '6months' => ['amount' => 500.00, 'duration' => 6],
    '1year' => ['amount' => 900.00, 'duration' => 12]
];

if (!$orderID || !$clientIdDb || !$plan || !isset($validPlans[$plan]) || $duration !== $validPlans[$plan]['duration'] || $amount !== $validPlans[$plan]['amount']) {
    error_log("Invalid input: orderID=$orderID, clientId=$clientIdDb, plan=$plan, duration=$duration, amount=$amount");
    echo json_encode(['success' => false, 'error' => 'Données invalides']);
    exit;
}

// Get access token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v1/oauth2/token");
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Accept-Language: en_US"
]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    error_log("cURL error getting access token: " . curl_error($ch));
    echo json_encode(['success' => false, 'error' => 'Failed to get access token']);
    exit;
}
$token = json_decode($response)->access_token;
if (!$token) {
    error_log("Failed to parse access token: $response");
    echo json_encode(['success' => false, 'error' => 'Invalid access token response']);
    exit;
}
curl_close($ch);

// Capture order
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders/$orderID/capture");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $token"
]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    error_log("cURL error capturing order: " . curl_error($ch));
    echo json_encode(['success' => false, 'error' => 'Failed to capture order']);
    exit;
}
curl_close($ch);

$order = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("Invalid JSON response from PayPal: $response");
    echo json_encode(['success' => false, 'error' => 'Invalid response from PayPal']);
    exit;
}

if ($order['status'] !== 'COMPLETED') {
    error_log("Payment not completed: $response");
    echo json_encode(['success' => false, 'error' => 'Payment not completed']);
    exit;
}

// Start database transaction
$conn->begin_transaction();

try {
    // Insert into paiment table
    $status = 'success';
    $stmt = $conn->prepare("INSERT INTO paiment (clientId, date, type, montantPaiement) VALUES (?, CURDATE(), ?, ?)");
    $stmt->bind_param("isd", $clientIdDb, $status, $amount);
    if (!$stmt->execute()) {
        throw new Exception('Erreur lors de l\'enregistrement du paiement');
    }
    $paymentId = $conn->insert_id;
    $stmt->close();

    // Update or insert abonnement
    $stmt = $conn->prepare("
        INSERT INTO abonnement (clientId, dateAbo, dateExpiration, paimentId)
        VALUES (?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL ? MONTH), ?)
        ON DUPLICATE KEY UPDATE
            dateExpiration = DATE_ADD(GREATEST(dateExpiration, CURDATE()), INTERVAL ? MONTH),
            paimentId = ?
    ");
    $stmt->bind_param("iiiii", $clientIdDb, $duration, $paymentId, $duration, $paymentId);
    if (!$stmt->execute()) {
        throw new Exception('Erreur lors de la mise à jour de l\'abonnement');
    }
    $stmt->close();

    // Commit transaction
    $conn->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback on error
    $conn->rollback();
    error_log("Database error: " . $e->getMessage());
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}

$conn->close();
