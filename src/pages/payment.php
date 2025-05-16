<?php
require_once "../php/connectDB.php";
require_once "../php/functions/isLoged.php";

session_start();

// Check if user is logged in
$email = isLogged();
if (!$email) {
    die("Erreur : Vous devez être connecté pour payer un abonnement. 😤");
}

// Get clientId from email
$stmt = $conn->prepare("SELECT clientId FROM client WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$client = $result->fetch_assoc();
$stmt->close();

if (!$client) {
    die("Erreur : Utilisateur introuvable. 😡");
}
$clientId = $client['clientId'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Payer Abonnement - Club Sportif</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <?php include_once('../components/navbar.php'); ?>

    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Payer votre abonnement</h1>
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Abonnement Mensuel - 30€</h2>
            <p class="text-gray-600 mb-6">Payez en toute sécurité avec PayPal.</p>
            <!-- PayPal Button Container -->
            <div id="paypal-button-container"></div>
        </div>
    </div>

    <!-- PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_SANDBOX_CLIENT_ID&currency=EUR"></script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '30.00', // Subscription price
                            currency_code: 'EUR'
                        },
                        description: 'Abonnement Mensuel - Club Sportif'
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the payment
                return actions.order.capture().then(function(details) {
                    // Send payment details to server
                    fetch('../php/process_payment.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                clientId: <?php echo $clientId; ?>,
                                orderID: data.orderID,
                                payerID: data.payerID,
                                amount: 30.00,
                                status: 'success'
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Paiement réussi ! Votre abonnement est actif. 🎉');
                                window.location.href = '../pages/profile.php';
                            } else {
                                alert('Erreur lors du traitement du paiement. 😞');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Erreur réseau. Veuillez réessayer. 😤');
                        });
                });
            },
            onError: function(err) {
                console.error('PayPal Error:', err);
                alert('Une erreur s\'est produite avec PayPal. 😡');
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>