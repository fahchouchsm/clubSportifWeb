<?php
require_once "../php/connectDB.php";
require_once "../php/functions/isLoged.php";

session_start();

// Check if user is logged in
$email = isLogged();
if (!$email) {
  header("Location: ./login.php");
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
  die("Erreur : Utilisateur introuvable. 😡");
}
$clientId = $client['clientId'];
?>

<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Abonnements Gym</title>
</head>

<body class="bg-gray-50">
  <?php include "../components/navbar.php"; ?>
  <div class="flex justify-center mt-40">
    <div class="w-full max-w-7xl px-4 py-8">
      <h2 class="mb-8 text-center text-3xl font-bold">Choisissez Votre Abonnement</h2>
      <div class="flex flex-col gap-8 lg:flex-row">
        <!-- Abonnement 3 Mois -->
        <div
          class="flex flex-1 flex-col rounded-lg bg-white p-6 shadow-md transition-transform duration-300 hover:scale-105">
          <h3 class="mb-4 text-xl font-semibold">3 Mois</h3>
          <p class="mb-4 text-gray-600">Parfait pour essayer notre salle</p>
          <p class="mb-6 text-4xl font-bold">300 DH<span class="text-xl font-normal text-gray-600">/3
              mois</span></p>
          <p class="mb-2 text-sm text-gray-500">Soit 100 DH/mois</p>
          <ul class="mb-6 flex-grow">
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès illimité
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Cours collectifs inclus
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès 7j/7
            </li>
          </ul>
          <a href="../php/functions/payment/paySubscription.php?plan=3months&amount=300"
            class="w-full rounded-lg bg-gray-700 py-3 font-medium text-white text-center transition hover:bg-gray-800">Choisir
            cet abonnement</a>
        </div>

        <!-- Abonnement 6 Mois -->
        <div
          class="relative flex flex-1 flex-col rounded-lg border-2 border-indigo-600 bg-white p-6 shadow-lg transition-transform duration-300 hover:scale-105">
          <div class="absolute -top-3 left-1/2 -translate-x-1/2 transform">
            <span
              class="rounded-full bg-indigo-600 px-4 py-1 text-xs font-semibold text-white uppercase">Économisez
              17%</span>
          </div>
          <div class="flex justify-between">
            <h3 class="mb-4 text-xl font-semibold">6 Mois</h3>
            <div class="mb-2">
              <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-semibold text-indigo-700">Le
                plus populaire</span>
            </div>
          </div>
          <p class="mb-4 text-gray-600">Idéal pour des résultats visibles</p>
          <div class="mb-2">
            <p class="text-4xl font-bold">500 DH<span class="text-xl font-normal text-gray-600">/6
                mois</span></p>
            <p class="text-sm text-gray-500">Soit 83.33 DH/mois</p>
          </div>
          <div class="mb-2">
            <p class="text-sm text-gray-400 line-through">600 DH</p>
            <p class="text-sm font-medium text-indigo-600">Économisez 100 DH</p>
          </div>
          <ul class="mb-6 flex-grow">
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès illimité
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Cours collectifs inclus
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès 7j/7
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> 1 séance coaching offerte
            </li>
          </ul>
          <a href="../php/functions/payment/paySubscription.php?plan=6months&amount=500"
            class="w-full rounded-lg bg-indigo-600 py-3 font-medium text-white text-center transition hover:bg-indigo-700">Choisir
            cet abonnement</a>
        </div>

        <!-- Abonnement 1 An -->
        <div
          class="relative flex flex-1 flex-col rounded-lg bg-white p-6 shadow-md transition-transform duration-300 hover:scale-105">
          <div class="absolute -top-3 left-1/2 -translate-x-1/2 transform">
            <span
              class="rounded-full bg-green-600 px-4 py-1 text-xs font-semibold text-white uppercase">Économisez
              25%</span>
          </div>
          <h3 class="mb-4 text-xl font-semibold">1 An</h3>
          <p class="mb-4 text-gray-600">Le meilleur rapport qualité-prix</p>
          <div class="mb-2">
            <p class="text-4xl font-bold">900 DH<span class="text-xl font-normal text-gray-600">/an</span>
            </p>
            <p class="text-sm text-gray-500">Soit 75 DH/mois</p>
          </div>
          <div class="mb-2">
            <p class="text-sm text-gray-400 line-through">1200 DH</p>
            <p class="text-sm font-medium text-green-600">Économisez 300 DH</p>
          </div>
          <ul class="mb-6 flex-grow">
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès illimité
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Cours collectifs inclus
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès 7j/7
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> 3 séances coaching offertes
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Évaluation gratuite
            </li>
            <li class="mb-2 flex items-center">
              <svg class="mr-2 h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"></path>
              </svg> Accès à la piscine
            </li>
          </ul>
          <a href="../php/functions/payment/paySubscription.php?plan=1year&amount=900"
            class="w-full rounded-lg bg-green-600 py-3 font-medium text-white text-center transition hover:bg-green-700">Choisir
            cet abonnement</a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>