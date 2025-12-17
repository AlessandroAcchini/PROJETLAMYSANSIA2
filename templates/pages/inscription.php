<!DOCTYPE html>
<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Créer un compte - Gestion des Sanctions</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#2563eb",
            "background-light": "#f8fafc",
            "background-dark": "#0f172a",
          },
          fontFamily: {
            display: ["Roboto", "sans-serif"],
          },
          borderRadius: {
            DEFAULT: "0.5rem",
          },
        },
      },
    };
  </script>
<style>
    body {
      font-family: 'Roboto', sans-serif;
    }
  </style>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-gray-700 dark:text-gray-300">
<div class="flex flex-col min-h-screen">
<?php require_once __DIR__ . '/header.php' ?>
<?php require_once __DIR__ . '/navbar.php' ?>
<nav class="bg-white dark:bg-slate-800 shadow-sm">
<div class="container mx-auto px-6 py-2">
</div>
</nav>
<main class="flex-grow container mx-auto px-6 py-12">
<div class="max-w-4xl mx-auto">
<div class="bg-emerald-600 text-white p-8 rounded-lg mb-8">
<h2 class="text-4xl font-bold flex items-center mb-2">
<span class="material-icons-outlined text-4xl mr-3">edit_note</span>
            Créer un compte
          </h2>
<p class="text-emerald-100">Inscrivez-vous pour accéder au système de gestion</p>
</div>

<div class="bg-white dark:bg-slate-800 p-8 rounded-lg shadow-md w-full">
<p class="flex justify-center gap-2 mb-5">Tous les champs suivis de<span class="text-red-600">*</span> sont obligatoires</p>

<form action="#" method="POST">
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
<div>
<label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="nom" >
<span class="material-icons-outlined text-base mr-2 text-gray-400 dark:text-gray-500">person_outline</span>
                  Nom <span class="text-red-600 ml-1">*</span>
                </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" value="<?= htmlspecialchars($nom ?? '', ENT_QUOTES, 'UTF-8') ?>" id="nom" name="nom" placeholder="Votre nom" required type="text"/>
</div>
<div>
<label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="prenom" >
<span class="material-icons-outlined text-base mr-2 text-gray-400 dark:text-gray-500">person_outline</span>
                  Prénom <span class="text-red-600 ml-1">*</span>
                </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" value="<?= htmlspecialchars($prenom ?? '', ENT_QUOTES, 'UTF-8') ?>" id="prenom" name="prenom" placeholder="Votre prénom" required type="text"/>
</div>
</div>
<div class="mb-6">
<label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="email" required>
<span class="material-icons-outlined text-base mr-2 text-gray-400 dark:text-gray-500">email</span>
                Adresse email <span class="text-red-600 ml-1">*</span>
              </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" value="<?= htmlspecialchars($email ?? '', ENT_QUOTES, 'UTF-8') ?>" id="email" name="email" placeholder="votre.email@example.com" required type="email"/>
</div>
<div class="mb-6">
<label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="password" required>
<span class="material-icons-outlined text-base mr-2 text-gray-400 dark:text-gray-500">lock_open</span>
                Mot de passe <span class="text-red-600 ml-1">*</span>
              </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" minlength="6" id="password" name="password" placeholder="Votre mot de passe" required type="password"/>
<p class="ml-4 text-gray-400">Au moins 6 caractères, une majuscule, et un caractère spécial</p>
</div>
<div class="mb-8">
<label class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 mb-2" for="password_confirmation" required>
<span class="material-icons-outlined text-base mr-2 text-gray-400 dark:text-gray-500">lock</span>
                Confirmer le mot de passe <span class="text-red-600 ml-1">*</span>
              </label>
<input class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-primary focus:border-primary bg-background-light dark:bg-background-dark text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500" minlength="6" id="password_confirmation" name="password_confirmation" placeholder="Répétez votre mot de passe" required type="password"/>
</div>
<button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-4 rounded-md flex items-center justify-center text-lg" type="submit">
<span class="material-icons-outlined mr-2">add_circle_outline</span>
              Créer mon compte
            </button>
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

<div class="text-center mt-6">
<p class="text-sm text-gray-600 dark:text-gray-400">
              Déjà un compte ? <a class="font-medium text-emerald-600 hover:text-emerald-500" href="index.php?action=login">Se connecter</a>
</p>
<a class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 mt-4" href="index.php?action=accueil">
<span class="material-icons-outlined text-base mr-1">arrow_back</span>
              Retour à l'accueil
            </a>
</div>
</div>
</div>
</main>
<?php
require_once __DIR__ . '/footer.php'
?>
</div>

</body></html>