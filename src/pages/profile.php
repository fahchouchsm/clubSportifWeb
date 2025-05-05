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
      <h1 class="text-2xl font-semibold">Bonjour, Jean Dupont</h1>
      <p class="font-medium text-red-500">
        Abonnement Premium - Valide jusqu'au 31/12/2024
      </p>
    </section>

    <!-- Stats Grid -->
    <section class="mb-10 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <div class="flex items-center gap-4 rounded-lg bg-white p-6 shadow transition hover:-translate-y-1">
        <i class="fas fa-fire text-3xl text-red-500"></i>
        <div>
          <h3 class="text-sm text-gray-500">Jours Consécutifs</h3>
          <p class="text-xl font-bold">5 jours</p>
        </div>
      </div>
      <div class="flex items-center gap-4 rounded-lg bg-white p-6 shadow transition hover:-translate-y-1">
        <i class="fas fa-dumbbell text-3xl text-red-500"></i>
        <div>
          <h3 class="text-sm text-gray-500">Séances Cette Semaine</h3>
          <p class="text-xl font-bold">3/5</p>
        </div>
      </div>
      <div class="flex items-center gap-4 rounded-lg bg-white p-6 shadow transition hover:-translate-y-1">
        <i class="fas fa-history text-3xl text-red-500"></i>
        <div>
          <h3 class="text-sm text-gray-500">Total Séances</h3>
          <p class="text-xl font-bold">45 séances</p>
        </div>
      </div>
    </section>

    <section class="mb-10 rounded-lg bg-white p-6 shadow">
      <h2 class="mb-4 text-xl font-semibold">Mes Prochaines Séances</h2>
      <div class="grid gap-6 md:grid-cols-2">
        <div class="rounded border border-gray-200 bg-gray-100 p-4">
          <div class="mb-2 flex items-center justify-between">
            <h3 class="font-semibold">Yoga Flow</h3>
            <span class="rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">Aujourd'hui</span>
          </div>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-clock"></i> 18:00 - 19:00
          </p>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-user"></i> Coach Marie
          </p>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-map-marker-alt"></i> Salle 3
          </p>
          <div class="mt-4 flex justify-between">
            <button class="rounded bg-red-600 px-4 py-1 text-white">
              Annuler
            </button>
            <button class="rounded bg-green-600 px-4 py-1 text-white">
              Rappel
            </button>
          </div>
        </div>

        <div class="rounded border border-gray-200 bg-gray-100 p-4">
          <div class="mb-2 flex items-center justify-between">
            <h3 class="font-semibold">CrossFit</h3>
            <span class="rounded-full bg-blue-100 px-3 py-1 text-sm text-blue-700">Demain</span>
          </div>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-clock"></i> 19:30 - 20:30
          </p>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-user"></i> Coach Pierre
          </p>
          <p class="flex items-center gap-2 text-gray-600">
            <i class="fas fa-map-marker-alt"></i> Salle 1
          </p>
          <div class="mt-4 flex justify-between">
            <button class="rounded bg-red-600 px-4 py-1 text-white">
              Annuler
            </button>
            <button class="rounded bg-green-600 px-4 py-1 text-white">
              Rappel
            </button>
          </div>
        </div>
      </div>
    </section>

    <section class="mb-10">
      <h2 class="mb-4 text-xl font-semibold">Actions Rapides</h2>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <button
          class="flex flex-col items-center gap-2 rounded bg-white p-4 shadow transition hover:bg-red-500 hover:text-white">
          <i class="fas fa-calendar-plus text-xl"></i>
          Réserver une Séance
        </button>
        <button
          class="flex flex-col items-center gap-2 rounded bg-white p-4 shadow transition hover:bg-red-500 hover:text-white">
          <i class="fas fa-user-plus text-xl"></i>
          Prendre RDV Coach
        </button>
        <button
          class="flex flex-col items-center gap-2 rounded bg-white p-4 shadow transition hover:bg-red-500 hover:text-white">
          <i class="fas fa-heartbeat text-xl"></i>
          Voir Mes Statistiques
        </button>
        <button
          class="flex flex-col items-center gap-2 rounded bg-white p-4 shadow transition hover:bg-red-500 hover:text-white">
          <i class="fas fa-shopping-cart text-xl"></i>
          Boutique
        </button>
      </div>
    </section>

    <section class="rounded-lg bg-white p-6 shadow">
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
            <div class="h-full rounded bg-red-500" style="width: 60%"></div>
          </div>
          <p>12,000/20,000 kcal</p>
        </div>
      </div>
    </section>
  </main>
</body>

</html>