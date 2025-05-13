<?php
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/output.css" />
    <title>Connexion - Club Sportif</title>
</head>

<body>
    <section class="bg-gray-50">
        <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
            <a href="#" class="mb-6 text-2xl font-semibold text-gray-900">
                <img class="max-w-64" src="../public/logo/png/logo-no-background.png" alt="logo" />
            </a>
            <div class="w-full rounded-lg bg-white shadow-2xl sm:max-w-md md:mt-0 xl:p-0">
                <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                    <h1 class="text-xl leading-tight font-bold tracking-tight text-gray-900 md:text-2xl">
                        Connectez-vous à votre compte
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="../php/login.php" method="post">
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900">Votre email</label>
                            <input type="email" name="email" id="email"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900"
                                placeholder="nom@entreprise.com"
                                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required />
                        </div>
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-900">Mot de
                                passe</label>
                            <input type="password" name="pass" id="password" placeholder="••••••••"
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,20}$"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-gray-900"
                                required />
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex h-5 items-center">
                                    <input id="stayLoged" name="stayLoged" type="checkbox"
                                        class="focus:ring-primary-300 h-4 w-4 rounded border border-gray-300 bg-gray-50 focus:ring-3" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="stayLoged" class="text-gray-500">Se souvenir de moi</label>
                                </div>
                            </div>
                            <a href="#" class="text-primary-600 text-sm font-medium hover:underline">Mot de passe oublié
                                ?</a>
                        </div>
                        <button type="submit" class="w-full bg-orange-500 text-lg text-white">
                            Se connecter
                        </button>

                        <p class="text-sm font-light text-gray-500">
                            Vous n'avez pas encore de compte ?
                            <a href="./inscription.html" class="text-primary-600 font-medium hover:underline">Créer un
                                compte</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="../js/style.js"></script>
</body>

</html>