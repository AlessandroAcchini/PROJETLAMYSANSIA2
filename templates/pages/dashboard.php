<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Http\Request;
use App\Http\Response;
use App\Config\Database;

require_once __DIR__ . '/../../src/controllers/controller_dashboard.php';

$pdo = Database::getConnection();
?>

<!DOCTYPE html>
<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Tableau de Bord - Gestion des Sanctions</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<script>
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            primary: "#3B82F6", // blue-500
            "background-light": "#F3F4F6", // gray-100
            "background-dark": "#111827",  // gray-900
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
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-gray-700 dark:text-gray-300">
<div class="flex flex-col min-h-screen" id="root">
<header class="bg-white dark:bg-gray-800 shadow-sm">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between items-center py-3">
<div class="flex items-center space-x-2">
<span class="material-icons text-primary text-2xl">grid_view</span>
<span class="text-lg font-bold text-gray-800 dark:text-white">Gestion des Sanctions</span>
</div>
<div class="text-sm text-gray-500 dark:text-gray-400">
            Application Vie Scolaire
          </div>
</div>
</div>
<?php require_once __DIR__ . '/navbar.php' ?>
</header>
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
<div class="space-y-8">
<div class="bg-gradient-to-r from-blue-600 to-blue-500 p-8 rounded-lg text-white shadow-lg">
<div class="flex items-center space-x-4">
<span class="material-icons text-5xl text-yellow-300">school</span>
<div>
<h1 class="text-3xl font-bold">
    Bienvenue, <?= htmlspecialchars(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? ''), ENT_QUOTES, 'UTF-8') ?> !
</h1>
<p class="text-blue-200 mt-1">Tableau de bord de gestion des sanctions scolaires</p>
</div>
</div>
<div class="mt-6 flex flex-wrap gap-4">
<button class="bg-white text-blue-600 font-semibold py-2 px-4 rounded-lg flex items-center space-x-2 hover:bg-gray-100">
<span class="material-icons">settings</span>
<span>Gérer les Sanctions</span>
</button>
<a href="index.php?action=voirEleves" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg flex items-center space-x-2 border border-blue-400 hover:bg-blue-600">
<span class="material-icons">visibility</span>
<span>Voir les Élèves</span>
</a>
<button class="bg-purple-500 text-white font-semibold py-2 px-4 rounded-lg flex items-center space-x-2 hover:bg-purple-600" href="index.php?action=createClasse">
<span class="material-icons">add_circle</span>
<span>Gérer les Classes</span>
</button>
<a class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg flex items-center space-x-2 hover:bg-red-800" href="index.php?action=logout">
<span class="material-icons text-base mr-2">logout</span>Déconnexion
              </a>
</div>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
<div class="p-3 bg-blue-100 dark:bg-blue-900 rounded-full">
<span class="material-icons text-blue-500 dark:text-blue-400">balance</span>
</div>
<div>
<p class="text-sm text-gray-500 dark:text-gray-400">Total Sanctions</p>
<p class="text-2xl font-bold text-gray-800 dark:text-white">0</p>
</div>
</div>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
<div class="p-3 bg-green-100 dark:bg-green-900 rounded-full">
<span class="material-icons text-green-500 dark:text-green-400">groups</span>
</div>
<div>
<p class="text-sm text-gray-500 dark:text-gray-400">Total Élèves</p>
<p class="text-2xl font-bold text-gray-800 dark:text-white">
    <?= htmlspecialchars((string)($totalEleves ?? 0), ENT_QUOTES, 'UTF-8') ?>
</p>
</div>
</div>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
<div class="p-3 bg-yellow-100 dark:bg-yellow-900 rounded-full">
<span class="material-icons text-yellow-500 dark:text-yellow-400">school</span>
</div>
<div>
<p class="text-sm text-gray-500 dark:text-gray-400">Total Professeurs</p>
<p class="text-2xl font-bold text-gray-800 dark:text-white">
    <?= htmlspecialchars((string)($totalProfesseurs ?? 0), ENT_QUOTES, 'UTF-8') ?>
</div>
</div>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md flex items-center space-x-4">
<div class="p-3 bg-orange-100 dark:bg-orange-900 rounded-full">
<span class="material-icons text-orange-500 dark:text-orange-400">collections_bookmark</span>
</div>
<div>
<p class="text-sm text-gray-500 dark:text-gray-400">Total Classes</p>
<p class="text-2xl font-bold text-gray-800 dark:text-white">
    <?= htmlspecialchars((string)($totalClasses ?? 0), ENT_QUOTES, 'UTF-8') ?>
</p>
</div>
</div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
<h2 class="text-lg font-semibold flex items-center text-gray-800 dark:text-white mb-4">
<span class="material-icons text-yellow-500 mr-2">flash_on</span>Accès Rapide
            </h2>
<div class="space-y-4">
<a class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="index.php?action=creerSanctions">
<div class="p-2 bg-red-100 dark:bg-red-900 rounded-full mr-4">
<span class="material-icons text-red-500 dark:text-red-400">add</span>
</div>
<div>
<p class="font-semibold text-gray-800 dark:text-gray-100">Nouvelle Sanction</p>
<p class="text-sm text-gray-500 dark:text-gray-400">Enregistrer un nouvel incident</p>
</div>
</a>
<a class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="index.php?action=creerEleve">
<div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-full mr-4">
<span class="material-icons text-blue-500 dark:text-blue-400">person_add</span>
</div>
<div>
<p class="font-semibold text-gray-800 dark:text-gray-100">Nouvel Élève</p>
<p class="text-sm text-gray-500 dark:text-gray-400">Ajouter un élève au système</p>
</div>
</a>
<a class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="index.php?action=creerProfesseur">
<div class="p-2 bg-green-100 dark:bg-green-900 rounded-full mr-4">
<span class="material-icons text-green-500 dark:text-green-400">co_present</span>
</div>
<div>
<p class="font-semibold text-gray-800 dark:text-gray-100">Nouveau Professeur</p>
<p class="text-sm text-gray-500 dark:text-gray-400">Enregistrer un enseignant</p>
</div>
</a>
<a class="flex items-center p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors" href="index.php?action=creerClasse">
<div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-full mr-4">
<span class="material-icons text-purple-500 dark:text-purple-400">edit_note</span>
</div>
<div>
<p class="font-semibold text-gray-800 dark:text-gray-100">Nouvelle Classe</p>
<p class="text-sm text-gray-500 dark:text-gray-400">Créer une nouvelle classe</p>
</div>
</a>
</div>
</div>
<div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
<h2 class="text-lg font-semibold flex items-center text-gray-800 dark:text-white mb-4">
<span class="material-icons text-blue-500 mr-2">person_pin</span>Informations Utilisateur
            </h2>
<div class="space-y-4">
<div class="flex items-center p-3">
<div class="p-2 rounded-full mr-4">
<span class="material-icons text-gray-400 dark:text-gray-500">account_circle</span>
</div>
<div class="flex-grow flex justify-between items-center">
<span class="text-gray-500 dark:text-gray-400">Nom complet</span>
<span class="font-medium text-gray-800 dark:text-gray-200"><?= htmlspecialchars(($user['prenom'] ?? '') . ' ' . ($user['nom'] ?? ''), ENT_QUOTES, 'UTF-8') ?></span>
</div>
</div>
<div class="flex items-center p-3">
<div class="p-2 rounded-full mr-4">
<span class="material-icons text-gray-400 dark:text-gray-500">email</span>
</div>
<div class="flex-grow flex justify-between items-center">
<span class="text-gray-500 dark:text-gray-400">Email</span>
<span class="font-medium text-gray-800 dark:text-gray-200"><?= htmlspecialchars(($user['email'] ?? ''),ENT_QUOTES, 'UTF-8') ?></span>
</div>
</div>
<div class="flex items-center p-3">
<div class="p-2 rounded-full mr-4">
<span class="material-icons text-gray-400 dark:text-gray-500">work</span>
</div>
<div class="flex-grow flex justify-between items-center">
<span class="text-gray-500 dark:text-gray-400">Service</span>
<span class="font-medium text-purple-600 dark:text-purple-400">Vie Scolaire</span>
</div>
</div>
</div>
</div>
</div>
<div class="bg-blue-50 dark:bg-gray-800/50 p-8 rounded-lg">
<h2 class="text-xl font-bold text-center text-gray-800 dark:text-white mb-6 flex items-center justify-center">
<span class="material-icons text-yellow-500 mr-2">rocket_launch</span>Guide de Démarrage Rapide
          </h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
<div>
<div class="mx-auto bg-blue-100 dark:bg-blue-900/50 w-16 h-16 rounded-full flex items-center justify-center mb-4">
<span class="text-2xl font-bold text-primary dark:text-blue-400">1</span>
</div>
<h3 class="font-semibold text-gray-800 dark:text-gray-100">Configurez les Classes</h3>
<p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Créez les classes de votre établissement pour organiser les élèves</p>
</div>
<div>
<div class="mx-auto bg-blue-100 dark:bg-blue-900/50 w-16 h-16 rounded-full flex items-center justify-center mb-4">
<span class="text-2xl font-bold text-primary dark:text-blue-400">2</span>
</div>
<h3 class="font-semibold text-gray-800 dark:text-gray-100">Ajoutez les Élèves</h3>
<p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Enregistrez les élèves et associez-les à leurs classes respectives</p>
</div>
<div>
<div class="mx-auto bg-blue-100 dark:bg-blue-900/50 w-16 h-16 rounded-full flex items-center justify-center mb-4">
<span class="text-2xl font-bold text-primary dark:text-blue-400">3</span>
</div>
<h3 class="font-semibold text-gray-800 dark:text-gray-100">Gérez les Sanctions</h3>
<p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Enregistrez et suivez les sanctions des élèves de manière efficace</p>
</div>
</div>
</div>
</div>
</main>
<footer class="bg-gray-800 dark:bg-black text-gray-300 dark:text-gray-400 mt-auto">
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
<div>
<h3 class="font-bold text-white flex items-center mb-3 text-lg">
<span class="material-icons mr-2">grid_view</span>Gestion des Sanctions
            </h3>
<p class="text-sm text-gray-400">Application de gestion de la vie scolaire pour le suivi des sanctions et incidents.</p>
</div>
<div>
<h3 class="font-bold text-white flex items-center mb-3 text-lg">
<span class="material-icons mr-2">link</span>Liens utiles
            </h3>
<ul class="space-y-2 text-sm">
<li><a class="hover:text-white" href="#">Documentation</a></li>
<li><a class="hover:text-white" href="#">Support</a></li>
<li><a class="hover:text-white" href="#">Contact</a></li>
</ul>
</div>
<div>
<h3 class="font-bold text-white flex items-center mb-3 text-lg">
<span class="material-icons mr-2">info</span>Informations
            </h3>
<p class="text-sm text-gray-400">Développé dans le cadre du BTS SIO - Projet CCF 2025</p>
</div>
</div>
<div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm">
<p>© 2025 Application de Gestion des Sanctions. Tous droits réservés.</p>
</div>
</div>
</footer>
</div>

</body></html>