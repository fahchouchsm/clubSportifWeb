<?php
require_once "../php/functions/isLoged.php";
$isLoged = isLogged();
?>

<nav class="fixed top-0 right-0 left-0 z-50 flex items-center justify-between bg-white px-8 py-4 shadow">
    <img src="../public/logo/png/logo-no-background.png" alt="Logo" class="h-8" />
    <ul class="hidden list-none gap-8 md:flex">
        <li class="rounded hover:bg-orange-500 px-4 py-2 text-black hover:text-white">
            <a href="../pages/profile.php" class="flex items-center gap-2 font-semibold"><i class="fas fa-home"></i>
                Accueil</a>
        </li>
        <li>
            <a href="cours.php"
                class="flex items-center gap-2 text-black hover:bg-orange-500 hover:text-white px-4 py-2 rounded"><i
                    class="fas fa-calendar"></i> Les Séances</a>
        </li>
        <li>
            <a href="../pages/showPricing.html"
                class="flex items-center gap-2 text-black hover:bg-orange-500 hover:text-white px-4 py-2 rounded"><i
                    class="fas fa-ticket-alt"></i> Mon Abonnement</a>
        </li>
        <li>
            <a href="../pages/coach.php"
                class="flex items-center gap-2 text-black hover:bg-orange-500 hover:text-white px-4 py-2 rounded"><i
                    class="fas fa-user-friends"></i> Coach</a>
        </li>
    </ul>
    <div class="flex items-center gap-2">
        <a href="client-profile.html"
            class="flex items-center gap-2 text-black hover:bg-orange-500 hover:text-white px-4 py-2 rounded"></a>
        <span>Mon Compte</span>
        </a>
    </div>
</nav>