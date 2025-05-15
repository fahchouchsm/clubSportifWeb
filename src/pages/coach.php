<?php

/**
 * Fonction qui lit et retourne les données des coachs depuis le fichier texte
 * Cette fonction est responsable de la lecture et du traitement des données des coachs
 */
function lireCoaches()
{
    // Initialisation d'un tableau vide qui va contenir toutes les informations des coachs
    $coaches = [];

    // Chemin vers le fichier texte qui contient les données des coachs
    $fichier = './coaches.txt';

    // Vérification de l'existence du fichier avant de le lire
    if (file_exists($fichier)) {
        // Lecture du fichier ligne par ligne
        // FILE_IGNORE_NEW_LINES : supprime les retours à la ligne
        // FILE_SKIP_EMPTY_LINES : ignore les lignes vides
        $lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Parcours de chaque ligne du fichier
        foreach ($lignes as $ligne) {
            // Séparation de la ligne en tableau en utilisant le caractère '|' comme séparateur
            // Format attendu : nom|specialite|description|experience|whatsapp
            $donnees = explode('|', $ligne);

            // Vérification qu'il y a bien 5 éléments (toutes les informations nécessaires)
            if (count($donnees) === 5) {
                // Ajout d'un nouveau coach au tableau avec ses informations
                // trim() supprime les espaces au début et à la fin de chaque valeur
                $coaches[] = [
                    'nom' => trim($donnees[0]),         // Nom du coach
                    'specialite' => trim($donnees[1]),  // Spécialité du coach
                    'description' => trim($donnees[2]), // Description détaillée
                    'experience' => trim($donnees[3]),  // Expérience et qualifications
                    'whatsapp' => trim($donnees[4])     // Numéro WhatsApp pour contact
                ];
            }
        }
    }

    // Retourne le tableau contenant tous les coachs
    return $coaches;
}

// Appel de la fonction pour récupérer les données des coachs
$coaches = lireCoaches();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Configuration de base de la page -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Coachs - FitLife</title>

    <!-- Inclusion des ressources CSS et JavaScript -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="profile.css">
</head>

<body class="bg-gray-100">
    <!-- Barre de navigation -->
    <?php include_once('../components/navbar.php'); ?>

    <!-- Contenu principal -->
    <div class="w-[90%] mx-auto px-4 pt-24 pb-12">
        <!-- En-tête de la page -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Nos Coachs Experts</h1>
            <p class="text-gray-600 text-lg">Des professionnels qualifiés pour vous accompagner</p>
        </div>

        <!-- Grille des coachs -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <?php foreach ($coaches as $coach): ?>
                <!-- Carte individuelle de chaque coach -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                        <!-- Nom et spécialité du coach -->
                        <h3 class="text-2xl font-bold text-gray-800 mb-2"><?php echo htmlspecialchars($coach['nom']); ?>
                        </h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($coach['specialite']); ?></p>

                        <!-- Section "À propos" cliquable -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-6 cursor-pointer hover:bg-gray-100 transition-colors coach-card"
                            data-nom="<?php echo htmlspecialchars($coach['nom']); ?>"
                            data-specialite="<?php echo htmlspecialchars($coach['specialite']); ?>"
                            data-description="<?php echo htmlspecialchars($coach['description']); ?>"
                            data-experience="<?php echo htmlspecialchars($coach['experience']); ?>">
                            <h4 class="font-semibold text-gray-800 mb-2">À propos</h4>
                            <p class="text-gray-600 text-sm">
                                <?php echo htmlspecialchars(substr($coach['description'], 0, 100)) . '...'; ?>
                            </p>
                            <p class="text-red-500 text-sm mt-2">Cliquez pour en savoir plus</p>
                        </div>

                        <!-- Bouton de réservation WhatsApp -->
                        <div class="flex gap-4">
                            <a href="https://wa.me/<?php echo htmlspecialchars($coach['whatsapp']); ?>?text=Bonjour%20<?php echo urlencode($coach['nom']); ?>%2C%20je%20souhaite%20r%C3%A9server%20une%20s%C3%A9ance%20de%20coaching%20avec%20vous."
                                target="_blank"
                                class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition-colors text-center">
                                <i class="fab fa-whatsapp mr-2"></i>Réserver
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Section des avantages -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Pourquoi choisir un coach personnel ?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <!-- Avantage 1 -->
                <div class="p-6">
                    <i class="fas fa-bullseye text-4xl text-red-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Objectifs Personnalisés</h3>
                    <p class="text-gray-600">Un programme adapté à vos besoins et à votre niveau</p>
                </div>
                <!-- Avantage 2 -->
                <div class="p-6">
                    <i class="fas fa-chart-line text-4xl text-red-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Suivi Régulier</h3>
                    <p class="text-gray-600">Un accompagnement constant pour maximiser vos résultats</p>
                </div>
                <!-- Avantage 3 -->
                <div class="p-6">
                    <i class="fas fa-heart text-4xl text-red-500 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Motivation Garantie</h3>
                    <p class="text-gray-600">Un coach à vos côtés pour vous pousser à donner le meilleur</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour afficher les détails du coach -->
    <div id="coachModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-2xl w-full mx-4 relative">
            <!-- Bouton de fermeture -->
            <button onclick="closeCoachModal()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>

            <!-- En-tête du modal -->
            <div class="flex flex-col items-center mb-6">
                <h2 id="coachName" class="text-2xl font-bold text-gray-800 mb-2"></h2>
                <p id="coachTitle" class="text-xl text-gray-600"></p>
            </div>

            <!-- Contenu du modal -->
            <div class="space-y-6">
                <!-- Section présentation -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-4">Présentation</h3>
                    <p id="coachDescription" class="text-gray-600"></p>
                </div>

                <!-- Section expérience -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-gray-800 mb-4">Expérience & Qualifications</h3>
                    <div id="coachExperience" class="text-gray-600 whitespace-pre-line"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script JavaScript pour gérer le modal -->
    <script>
        // Attendre que le DOM soit complètement chargé
        document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner toutes les cartes de coach
            const coachCards = document.querySelectorAll('.coach-card');

            // Ajouter un écouteur d'événements sur chaque carte
            coachCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Récupérer les données du coach depuis les attributs data-*
                    const nom = this.getAttribute('data-nom');
                    const specialite = this.getAttribute('data-specialite');
                    const description = this.getAttribute('data-description');
                    const experience = this.getAttribute('data-experience');

                    // Mettre à jour le contenu du modal
                    document.getElementById('coachName').textContent = nom;
                    document.getElementById('coachTitle').textContent = specialite;
                    document.getElementById('coachDescription').textContent = description;
                    document.getElementById('coachExperience').textContent = experience;

                    // Afficher le modal
                    document.getElementById('coachModal').classList.remove('hidden');
                    document.getElementById('coachModal').classList.add('flex');
                });
            });
        });

        // Fonction pour fermer le modal
        function closeCoachModal() {
            document.getElementById('coachModal').classList.add('hidden');
            document.getElementById('coachModal').classList.remove('flex');
        }
    </script>
</body>

</html>