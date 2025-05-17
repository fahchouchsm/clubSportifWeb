<?php
header('Content-Type: application/json');

require_once "../../connectDB.php";

// Log errors to a file for debugging
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', '../../logs/php_errors.log');

$clientId = 'AaB8yR4GWrr2IPiJAoDjfSHPv8p8i07rFNtXYyK2wqhhAKdBX6Rj78TVcoyVRmki_XAXp3KDNSQ6vARZ';
$secret = 'EDCsP8sVLDVEJYmvYlSApkBdKeP0bB2DJ7QxkXSC8ZMsUOLcAkK7wRB-cHA1TZ7jMZH3m2-MBaUczwgc';

// Get input data
$input = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'] ?? null;
$plan = $input['plan'] ?? null;
$description = $input['description'] ?? 'Abonnement Club Sportif';

$validPlans = [
    '3months' => 300.00,
    '6months' => 500.00,
    '1year' => 900.00
];

if (!$amount || !$plan || !isset($validPlans[$plan]) || $amount != $validPlans[$plan]) {
    error_log("Invalid plan or amount: plan=$plan, amount=$amount");
    echo json_encode(['error' => 'Invalid plan or amount']);
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
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (curl_errno($ch)) {
    error_log("cURL error getting access token: " . curl_error($ch) . ", HTTP Code: $httpCode");
    echo json_encode(['error' => 'Failed to get access token']);
    exit;
}
curl_close($ch);

$tokenData = json_decode($response, true);
if ($httpCode !== 200 || !$tokenData || !isset($tokenData['access_token'])) {
    error_log("Failed to get access token. HTTP Code: $httpCode, Response: " . json_encode($response));
    echo json_encode(['error' => 'Invalid access token response']);
    exit;
}
$token = $tokenData['access_token'];

// Create order
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api-m.sandbox.paypal.com/v2/checkout/orders");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $token"
]);

$data = [
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "USD",
            "value" => number_format($amount, 2, '.', '')
        ],
        "description" => $description
    ]]
];

$requestBody = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);
error_log("Creating order with payload: $requestBody"); // Log request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (curl_errno($ch)) {
    error_log("cURL error creating order: " . curl_error($ch) . ", HTTP Code: $httpCode");
    echo json_encode(['error' => 'Failed to create order']);
    exit;
}
curl_close($ch);

// Check if response is valid JSON
$order = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("Invalid JSON response from PayPal: HTTP Code: $httpCode, Response: " . json_encode($response));
    echo json_encode(['error' => 'Invalid response from PayPal']);
    exit;
}

if (!isset($order['id'])) {
    error_log("No order ID in PayPal response: HTTP Code: $httpCode, Response: " . json_encode($response));
    echo json_encode(['error' => 'Failed to create order']);
    exit;
}

echo json_encode($order);
