<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Http\Request;
use App\Http\Response;
use App\Config\Database;

require_once __DIR__ . '/../../src/controllers/controller_createClasse.php';

$pdo = Database::getConnection();
?>

<!DOCTYPE html>
<html lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Page de création de classe</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet"/>
<script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#3b82f6",
              "background-light": "#f8fafc",
              "background-dark": "#0f172a",
            },
            fontFamily: {
              display: ["Poppins", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "0.5rem",
            },
          },
        },
      };
    </script>
<style>
      .material-icons-outlined {
        font-size: inherit;
      }
    </style>
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200">
<div class="flex flex-col min-h-screen">
<header class="bg-white dark:bg-slate-900 shadow-sm">
<div class="container mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between items-center py-3">
<div class="flex items-center space-x-2">
<span class="material-icons-outlined text-primary text-2xl">school</span>
<h1 class="text-xl font-bold text-slate-900 dark:text-white">Gestion des Sanctions</h1>
</div>
<div class="text-sm text-slate-500 dark:text-slate-400">
                        Application Vie Scolaire
                    </div>
</div>
</div>
</header>
<?php require_once __DIR__ . '/navbar.php' ?>
<main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
<div class="bg-primary rounded-lg p-8 md:p-12 text-center mb-8">
<div class="flex items-center justify-center text-white mb-4">
<span class="material-icons-outlined text-4xl mr-3" style="font-size: 2.5rem; transform: scale(1.2);">add</span>
<h2 class="text-4xl font-bold">Créer une classe</h2>
</div>
<p class="text-lg text-blue-200">Ajoutez une nouvelle classe à votre établissement</p>
</div>
<div class="max-w-3xl mx-auto">
<div class="bg-white dark:bg-slate-800 shadow-lg rounded-lg p-6 sm:p-8">
<div class="mb-6">
<h3 class="text-xl font-semibold text-slate-900 dark:text-white">Informations de la classe</h3>
<p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Renseignez les informations nécessaires pour créer la classe</p>
</div>
<form method="post" action="index.php?action=creerClasse">
<p class="flex justify-center gap-2">Tous les champs suivis de <span class="text-red-600">*</span>sont obligatoires</p>
<div class="space-y-6">
<div>
<label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="class-name">Nom de la classe <span class="text-red-500">*</span></label>
<input class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring-primary dark:bg-slate-700 dark:text-white sm:text-sm" value="<?= htmlspecialchars($nomClasse ?? '', ENT_QUOTES, 'UTF-8') ?>"  id="nomClasse" name="nomClasse" placeholder="Ex: Terminale S1, Première ES2, Seconde A" type="text"/>
<p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Exemples : Terminale S1, Première ES2, Seconde A</p>
</div>
<div>
<label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="level">Niveau <span class="text-red-500">*</span></label>
<select
    id="niveauClasse"
    name="niveauClasse"
    class="mt-1 block w-full rounded-md border-slate-300 dark:border-slate-600 shadow-sm focus:border-primary focus:ring-primary dark:bg-slate-700 dark:text-white sm:text-sm"
>
    <option value="">Sélectionnez un niveau</option>
    <?php foreach ($niveaux as $niveau): ?>

        <option
            value="<?= htmlspecialchars($niveau, ENT_QUOTES, 'UTF-8') ?>"
            <?= (!empty($niveauClasse) && $niveauClasse === $niveau) ? 'selected' : '' ?>
        >
            <?= htmlspecialchars($niveau, ENT_QUOTES, 'UTF-8') ?>
        </option>
    <?php endforeach; ?>
</select>
</div>
</div>
<div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-3">
 <a href="index.php?action=voirClasses">
 <button class="inline-flex justify-center items-center py-2 px-4 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-md text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="button">
 <span class="material-icons-outlined mr-2 text-base">arrow_back</span> Retour à la liste
 </button>
 </a>
 <button class="inline-flex justify-center items-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary" type="submit">
 <span class="material-icons-outlined mr-2 text-base">add_circle_outline</span>
                                Créer la classe
                            </button>
</div>



<?php if (!empty($error)) : ?>
    <div class="mt-4 text-red-600">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>
</form>
</div>
<div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-400 dark:border-blue-600 p-4 rounded-r-lg">
<div class="flex">
<div class="flex-shrink-0">
<span class="material-icons-outlined text-blue-500 dark:text-blue-400">info</span>
</div>
<div class="ml-3">
<p class="text-sm font-medium text-blue-800 dark:text-blue-300">Conseil</p>
<p class="text-sm text-blue-700 dark:text-blue-400 mt-1">
                                Une fois la classe créée, vous pourrez y associer des élèves et gérer leurs sanctions.
                            </p>
</div>
</div>
</div>
</div>
</main>




<?php 

require_once __DIR__ . '/footer.php'; 

?>
</div>

</body></html>