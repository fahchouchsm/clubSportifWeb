<?php
require_once "../../connectDB.php";
require_once "../isLoged.php";

session_start();

// Check if user is logged in
$email = isLogged();
if (!$email) {
    header("Location: ../pages/login.php");
    exit;
}

// Get clientId from email
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

// Validate plan and amount
$plan = filter_input(INPUT_GET, 'plan', FILTER_SANITIZE_SPECIAL_CHARS);
$amount = filter_input(INPUT_GET, 'amount', FILTER_VALIDATE_FLOAT);

$validPlans = [
    '3months' => ['amount' => 300.00, 'duration' => 3, 'label' => '3 Mois'],
    '6months' => ['amount' => 500.00, 'duration' => 6, 'label' => '6 Mois'],
    '1year' => ['amount' => 900.00, 'duration' => 12, 'label' => '1 An']
];

if (!isset($validPlans[$plan]) || $amount !== $validPlans[$plan]['amount']) {
    die("Erreur : Plan ou montant invalide.");
}

$planLabel = $validPlans[$plan]['label'];
$planDuration = $validPlans[$plan]['duration'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/output.css">
    <title>Payer Abonnement - Club Sportif</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <?php include_once('../components/navbar.php'); ?>

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Payer votre abonnement</h1>
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Abonnement <?php echo htmlspecialchars($planLabel); ?> -
                <?php echo $amount; ?> USD</h2>
            <p class="text-gray-600 mb-6">Payez en toute sécurité avec PayPal.</p>
            <div id="paypal-button-container"></div>
            <div id="loading" style="display: none; text-align: center;">Chargement...</div>
        </div>
    </div>

    <script
        src="https://www.paypal.com/sdk/js?client-id=AaB8yR4GWrr2IPiJAoDjfSHPv8p8i07rFNtXYyK2wqhhAKdBX6Rj78TVcoyVRmki_XAXp3KDNSQ6vARZ&currency=USD">
    </script>
    <script>
        console.log('PayPal SDK loaded');
        paypal.Buttons({
            createOrder: function(data, actions) {
                const payload = {
                    amount: <?php echo $amount; ?>,
                    plan: '<?php echo $plan; ?>',
                    description: 'Abonnement <?php echo htmlspecialchars($planLabel); ?> - Club Sportif'
                };
                console.log('Sending to createOrder.php:', payload);
                document.getElementById('loading').style.display = 'block';
                return fetch('./createOrder.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(payload)
                }).then(res => {
                    console.log('createOrder.php status:', res.status);
                    if (!res.ok) {
                        throw new Error('Network response was not ok: ' + res.status);
                    }
                    return res.json();
                }).then(data => {
                    console.log('createOrder.php response:', data);
                    if (!data.id) {
                        throw new Error(data.error || 'No order ID in response');
                    }
                    return data.id;
                }).catch(err => {
                    console.error('Create Order Error:', err);
                    alert('Erreur lors de la création de la commande : ' + err.message);
                    document.getElementById('loading').style.display = 'none';
                    throw err;
                });
            },
            onApprove: function(data, actions) {},
        }).render('#paypal-button-container');
    </script>
</body>

</html>