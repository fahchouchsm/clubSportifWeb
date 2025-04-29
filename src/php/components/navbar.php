<?php
require_once  './src/php/functions/isLoged.php';

if (isLoged()) {
  $navbar = "<!DOCTYPE html>
<html lang='fr'>
<head>
  <meta charset='UTF-8' />
  <meta name='viewport' content='width=device-width, initial-scale=1.0'/>
  <title>City Club Fitness</title>
  <script src='https://cdn.tailwindcss.com'></script>
  <script src='https://kit.fontawesome.com/yourkit.js' crossorigin='anonymous'></script> <!-- Mets ton kit fontawesome ici -->
</head>
<body class='font-sans'>

  <nav class='bg-white shadow-md fixed w-full top-0 z-50'>
    <div class='max-w-7xl mx-auto px-4 py-4 flex items-center justify-between'>
      <div class='w-44'>
        <img src='logo.png' alt='City Club Logo' class='w-full h-auto' />
      </div>

      <div class='md:hidden flex flex-col gap-1 cursor-pointer hamburger'>
        <span class='w-6 h-[3px] bg-gray-800'></span>
        <span class='w-6 h-[3px] bg-gray-800'></span>
        <span class='w-6 h-[3px] bg-gray-800'></span>
      </div>

      <ul class='hidden md:flex gap-8 items-center nav-menu'>
        <li><a href='#activites' class='text-gray-800 font-medium hover:text-red-500'>Activités</a></li>
        <li><a href='#coaching' class='text-gray-800 font-medium hover:text-red-500'>Coaching</a></li>
        <li><a href='#bilan' class='text-gray-800 font-medium hover:text-red-500'>Planning</a></li>
      </ul>

      <div class='hidden md:flex'>
        <button class='bg-red-600 text-white font-semibold py-2 px-4 rounded-md hover:bg-red-700 transition'>S'inscrire</button>
      </div>
    </div>

    <!-- Menu mobile -->
    <ul class='md:hidden flex-col items-center bg-white hidden nav-menu-mobile'>
      <li><a href='#activites' class='block py-2 text-center text-gray-800 hover:text-red-500'>Activités</a></li>
      <li><a href='#coaching' class='block py-2 text-center text-gray-800 hover:text-red-500'>Coaching</a></li>
      <li><a href='#bilan' class='block py-2 text-center text-gray-800 hover:text-red-500'>Planning</a></li>
      <li class='py-4'><button class='bg-red-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-red-700 transition'>S'inscrire</button></li>
    </ul>
  </nav>

  <script>
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.nav-menu-mobile');

    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('.nav-menu-mobile li a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  </script>
</body>
</html>
";
} else {
  echo "'<a href='login.php'>Connexion</a>'";
  echo "'<a href='register.php'>Inscription</a>'";
}
