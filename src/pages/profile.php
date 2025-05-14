<?php
require_once "../php/functions/isLoged.php";
require_once "../php/connectDB.php";
require_once "../php/database/getclientinfo.php";

$email = isLogged();

if ($email) {
  $client = getClientByEmail($conn, $email)->fetch_assoc();
} else {
  header("Location: ./login.php");
}
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/output.css">
  <title>Mon Espace Sport</title>
</head>

<body class="bg-gray-100 font-sans text-gray-800">
  <?php include_once('../components/navbar.php'); ?>

  <main class="px-6 pt-24 pb-10">

    <!-- Welcome Section -->
    <section class="mb-8">
      <h1 class="text-2xl font-semibold">Bonjour, <?php echo $client['nom'] . " " . $client['prenom']; ?></h1>
      <p class="font-medium text-gray-500">
        Abonnement Valide jusqu'au 31/12/2024
      </p>
    </section>

    <!-- Ma Progression comes FIRST now -->
    <section class="mb-10 rounded-lg bg-white p-6 shadow">
      <h2 class="mb-4 text-xl font-semibold">Ma Progression</h2>
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="rounded bg-gray-100 p-4">
          <h3 class="mb-2 font-medium">Objectif Mensuel</h3>
          <div class="mb-2 h-2 w-full rounded bg-gray-300">
            <div class="h-full rounded bg-red-500" style="width: 75%"></div>
          </div>
          <p>15/20 séances</p>
        </div>
        <div class="rounded bg-gray-100 p-4">
          <h3 class="mb-2 font-medium">Calories</h3>
          <div class="mb-2 h-2 w-full rounded bg-gray-300">
            <div class="h-full rounded bg-red-500" style="width: 95%"></div>
          </div>
          <p>12,000/20,000 kcal</p>
        </div>
      </div>
    </section>

    <!-- Prochaines Séances -->
    <section class="mb-10 rounded-lg bg-white p-6 shadow">
      <h2 class="mb-4 text-xl font-semibold">Prochaines Séances</h2>
      <div class="grid gap-6 md:grid-cols-2">
        <?php
        require_once "../php/database/getSceance.php";
        $seance = getSeance($conn, 2); // get 2 upcoming sessions

        if ($seance && $seance->num_rows > 0) {
          while ($row = $seance->fetch_assoc()) {
            echo "<div class='rounded border border-gray-200 bg-gray-100 p-4'>
              <div class='mb-2 flex items-center justify-between'>
                <h3 class='font-semibold'>" . htmlspecialchars($row['description']) . "</h3>
                <p class='flex items-center gap-2 text-gray-600'>
                  <i class='fas fa-clock'></i> " . $row['dateSeance'] . " (" . $row['tempDebut'] . " - " . $row['tempFin'] . ")
                </p>
              </div>
              <p class='flex items-center gap-2 text-gray-600'>
                <i class='fas fa-user'></i> Coach " . htmlspecialchars($row['coach_prenom']) . " " . htmlspecialchars($row['coach_nom']) . "
              </p>
              <p class='flex items-center gap-2 text-gray-600'>
                <i class='fas fa-users'></i> Inscrits: " . $row['subscribed_count'] . "/" . $row['max'] . "
              </p>
            </div>";
          }
        } else {
          echo "<p class='text-gray-600'>Aucune séance à venir trouvée.</p>";
        }
        ?>
      </div>
    </section>

    <section class="mb-10 rounded-lg bg-white p-6 shadow w-1/2">
      <h2 class="mb-4 text-xl font-semibold">Donnez Votre Avis</h2>

      <form action="../php/feedback/submit.php" method="POST" class="flex flex-col gap-4">
        <label for="feedback" class="text-sm font-medium text-gray-700">Votre message :</label>
        <textarea id="feedback" name="feedback" rows="5" placeholder="Dites-nous ce que vous pensez..."
          class="p-2 w-full resize-none rounded border border-gray-300 focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500 text-gray-700"
          required></textarea>

        <div class="flex justify-end">
          <button type="submit"
            class="rounded bg-green-500 px-4 py-2 text-white font-semibold hover:bg-green-600 transition">
            Envoyer
          </button>
        </div>
      </form>
    </section>



  </main>
</body>

</html>