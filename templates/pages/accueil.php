<!DOCTYPE html>
<html lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Application de Gestion des Sanctions</title>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#2563EB",
            "background-light": "#F3F4F6",
            "background-dark": "#111827",
          },
          fontFamily: {
            display: ["Poppins", "sans-serif"],
          },
          borderRadius: {
            DEFAULT: "0.75rem",
          },
        },
      },
    };
  </script>
<style>
    .material-symbols-outlined {
      font-variation-settings:
      'FILL' 1,
      'wght' 400,
      'GRAD' 0,
      'opsz' 24
    }
  </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200">
<div id="root">

<?php
require_once __DIR__ . '/header.php';
?>

<main class="container mx-auto px-6 py-12 md:py-16">
<div class="bg-blue-600 text-white rounded-lg p-8 md:p-12 text-center shadow-lg mb-12 md:mb-16">
<div class="flex justify-center items-center gap-4 mb-4">
<span class="material-symbols-outlined text-5xl">school</span>
<h2 class="text-3xl md:text-5xl font-bold">Application de Gestion des Sanctions</h2>
</div>
<p class="text-lg md:text-xl text-blue-100">Système de gestion de la vie scolaire pour le lycée</p>
</div>
<div class="grid md:grid-cols-2 gap-8 mb-12 md:mb-20">
<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md flex flex-col items-center text-center">
<div class="bg-blue-100 dark:bg-blue-900/50 p-4 rounded-full mb-6">
<span class="material-symbols-outlined text-primary text-4xl">lock</span>
</div>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Connexion</h3>
<p class="text-gray-600 dark:text-gray-400 mb-6 max-w-xs">Accédez à votre espace personnel pour gérer les sanctions</p>
<a class="w-full sm:w-auto bg-primary text-white font-semibold py-3 px-8 rounded-lg flex items-center justify-center gap-2 hover:bg-blue-700 transition-colors" href="index.php?action=login">
<span class="material-symbols-outlined">rocket_launch</span>
            Se connecter
          </a>
</div>
<div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-md flex flex-col items-center text-center">
<div class="bg-green-100 dark:bg-green-900/50 p-4 rounded-full mb-6">
<span class="material-symbols-outlined text-green-500 text-4xl">edit_note</span>
</div>
<h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Créer un compte</h3>
<p class="text-gray-600 dark:text-gray-400 mb-6 max-w-xs">Inscrivez-vous pour accéder au système de gestion</p>
<a class="w-full sm:w-auto bg-green-500 text-white font-semibold py-3 px-8 rounded-lg flex items-center justify-center gap-2 hover:bg-green-600 transition-colors" href="index.php?action=inscription">
<span class="material-symbols-outlined">school</span>
            S'inscrire
          </a>
</div>
</div>
<section class="bg-white/50 dark:bg-gray-800/50 p-8 md:p-12 rounded-lg">
<h2 class="text-2xl md:text-3xl font-bold text-center text-gray-900 dark:text-white mb-10 md:mb-12 flex items-center justify-center gap-3">
<span class="material-symbols-outlined text-primary">rocket</span>
          À propos de l'application
        </h2>
<div class="grid md:grid-cols-3 gap-8 text-center">
<div class="flex flex-col items-center">
<div class="bg-blue-100 dark:bg-blue-900/50 p-4 rounded-full mb-4">
<span class="material-symbols-outlined text-blue-500 text-3xl">gavel</span>
</div>
<h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Gestion des Sanctions</h4>
<p class="text-gray-600 dark:text-gray-400">Enregistrez et suivez les sanctions des élèves de manière efficace</p>
</div>
<div class="flex flex-col items-center">
<div class="bg-blue-100 dark:bg-blue-900/50 p-4 rounded-full mb-4">
<span class="material-symbols-outlined text-blue-500 text-3xl">groups</span>
</div>
<h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Gestion des Élèves</h4>
<p class="text-gray-600 dark:text-gray-400">Centralisez les informations des élèves et leurs classes</p>
</div>
<div class="flex flex-col items-center">
<div class="bg-blue-100 dark:bg-blue-900/50 p-4 rounded-full mb-4">
<span class="material-symbols-outlined text-blue-500 text-3xl">bar_chart</span>
</div>
<h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tableau de Bord</h4>
<p class="text-gray-600 dark:text-gray-400">Visualisez les statistiques et l'activité récente</p>
</div>
</div>
</section>
</main>

<?php
// fichier : templates/pages/accueil.php
require_once __DIR__ . '/footer.php';
?> 

</div>

</body></html>