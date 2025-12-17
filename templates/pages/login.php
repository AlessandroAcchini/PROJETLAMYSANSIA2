<!DOCTYPE html>
<html lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Connexion - Gestion des Sanctions</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#3b82f6", // blue-500
              "background-light": "#f3f4f6", // gray-100
              "background-dark": "#111827", // gray-900
            },
            fontFamily: {
              display: ["Poppins", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "0.5rem", // 8px
            },
          },
        },
      };
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-800 dark:text-gray-200 flex flex-col min-h-screen">
<header class="bg-white dark:bg-gray-800 shadow-sm">
<div class="container mx-auto px-6 py-4">
<div class="flex justify-between items-center">
<div class="flex items-center gap-3">
<span class="material-symbols-outlined text-primary text-3xl">assignment</span>
<h1 class="text-2xl font-bold text-gray-900 dark:text-white">Gestion des Sanctions</h1>
</div>
<div class="text-sm text-gray-600 dark:text-gray-400">
                    Application Vie Scolaire
                </div>
</div>
</div>
</header>
<nav class="bg-primary">
<div class="container mx-auto px-6">
<div class="flex items-center">
<a class="flex items-center gap-2 px-4 py-2 text-white font-medium bg-black bg-opacity-10" href="index.php?action=accueil">
<span class="material-symbols-outlined text-xl">home</span>
                    Accueil
                </a>
</div>
</div>
</nav>
<main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
<div class="w-full max-w-lg space-y-8">
<div class="bg-primary text-white rounded-lg p-8 text-center shadow-lg">
<div class="flex justify-center items-center gap-4">
<span class="material-symbols-outlined text-4xl" style="font-size: 40px;">lock_open</span>
<h2 class="text-4xl font-bold">Connexion</h2>
</div>
<p class="mt-2">Accédez à votre espace personnel</p>
</div>
<div class="bg-white dark:bg-gray-800 p-8 sm:p-10 rounded-lg shadow-lg">
<form action="#" class="space-y-6" method="POST">
<div>
<label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="email">
<span class="material-symbols-outlined text-lg">mail</span>
                            Adresse email
                        </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>" id="email" name="email" placeholder="votre.email@example.com" required type="email"/>
</div>
<div>
<label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="password">
<span class="material-symbols-outlined text-lg">lock</span>
                            Mot de passe
                        </label>
<input autocomplete="current-password" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-primary focus:border-primary bg-background-light dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500" id="password" name="password" placeholder="Votre mot de passe" required="" type="password"/>
</div>
<div>
<button class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
<span class="material-symbols-outlined">login</span>
                            Se connecter
                        </button>
</div>
</form>

<?php if (!empty($error)) : ?>
    <div class="mt-4 text-red-600">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)) : ?>
    <div class="mt-4 text-green-600">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<div class="mt-8 text-center text-sm">
<p class="text-gray-600 dark:text-gray-400">
                        Pas encore de compte ?
                        <a class="font-medium text-primary hover:text-blue-600" href="index.php?action=inscription">
                            Créer un compte
                        </a>
</p>
</div>
<div class="mt-4 text-center">
<a class="flex items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200" href="index.php?action=accueil">
<span class="material-symbols-outlined">arrow_back</span>
                        Retour à l'accueil
                    </a>
</div>
</div>
</div>
</main>

<?php
require_once __DIR__ . '/footer.php';
?> 

</body></html>