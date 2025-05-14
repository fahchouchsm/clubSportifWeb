<?php
require_once "../php/connectDB.php";
require_once "../php/database/getSeance.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <title>Séances Club Sportif</title>
</head>

<body class="bg-gray-50 min-h-screen">
    <?php include_once('../components/navbar.php'); ?>

    <div class="container mx-auto px-4 py-8 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Séances à venir</h1>

        <!-- Recherche et Filtre -->
        <div class="mb-8 flex flex-col sm:flex-row gap-4 justify-center">
            <input type="text" id="search" placeholder="Rechercher par nom de séance..."
                class="p-3 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-500 w-full sm:w-64">
            <select id="filterCoach" class="p-3 rounded-lg border border-gray-300 shadow-sm w-full sm:w-64">
                <option value="">Tous les coachs</option>
                <?php
                $coachQuery = "SELECT coachId, CONCAT(prenom, ' ', nom) AS coachName FROM coach";
                $coachResult = $conn->query($coachQuery);
                while ($coach = $coachResult->fetch_assoc()) {
                    echo "<option value='{$coach['coachId']}'>{$coach['coachName']}</option>";
                }
                ?>
            </select>
        </div>

        <!-- Grille des Séances -->
        <div id="sessionGrid" class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php
            $limit = 50;
            $result = getSeance($conn, $limit);

            if ($result && $result->num_rows > 0) {
                while ($seance = $result->fetch_assoc()) {
                    $duration = substr(strval(strtotime($seance['tempFin']) - strtotime($seance['tempDebut'])), 0, 5);
                    $remaining_spots = $seance['max'] - $seance['subscribed_count'];
                    $is_full = $remaining_spots <= 0;
            ?>
                    <div class="session-card bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-200"
                        data-coach-id="<?php echo $seance['coachId']; ?>"
                        data-name="<?php echo htmlspecialchars($seance['description']); ?>">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            <?php echo htmlspecialchars($seance['description']); ?></h3>
                        <p class="text-gray-600 mb-1"><span class="font-medium">Date:</span>
                            <?php echo $seance['dateSeance']; ?></p>
                        <p class="text-gray-600 mb-1"><span class="font-medium">Heure:</span>
                            <?php echo $seance['tempDebut']; ?> - <?php echo $seance['tempFin']; ?></p>
                        <p class="text-gray-600 mb-1"><span class="font-medium">Coach:</span>
                            <?php echo $seance['coach_prenom'] . ' ' . $seance['coach_nom']; ?></p>
                        <p class="text-gray-600 mb-4"><span class="font-medium">Places:</span>
                            <?php echo $seance['subscribed_count']; ?> /
                            <?php echo $seance['max']; ?></p>
                        <div class="flex justify-end items-end">
                            <?php if ($is_full) { ?>
                                <span class="text-red-600 font-medium">Complet</span>
                            <?php } else { ?>
                                <a href="../php/registerSeance.php?seanceId=<?php echo $seance['seanceId']; ?>"
                                    class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors duration-200">S'inscrire</a>
                            <?php } ?>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<p class="text-center text-gray-600 col-span-full">Aucune séance disponible pour le moment.</p>';
            }
            ?>
        </div>
    </div>

    <!-- JavaScript pour Recherche et Filtre -->
    <script>
        const searchInput = document.getElementById('search');
        const filterCoach = document.getElementById('filterCoach');
        const sessionGrid = document.getElementById('sessionGrid');

        function filterSessions() {
            const searchText = searchInput.value.toLowerCase();
            const coachId = filterCoach.value;
            const cards = sessionGrid.getElementsByClassName('session-card');

            for (let card of cards) {
                const name = card.dataset.name.toLowerCase();
                const coachIdCard = card.dataset.coachId;
                const showCard = (!searchText || name.includes(searchText)) &&
                    (!coachId || coachIdCard === coachId);
                card.style.display = showCard ? '' : 'none';
            }
        }

        searchInput.addEventListener('input', filterSessions);
        filterCoach.addEventListener('change', filterSessions);
    </script>
</body>

</html>