<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;

require_once __DIR__ . '/../../src/controllers/controller_createEleve.php';

$pdo = Database::getConnection();
?>

<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Création d'élève - Gestion des Sanctions</title>

    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#2563eb",
                        "primary-dark": "#1d4ed8",
                        "background-light": "#f8fafc",
                        "background-dark": "#0f172a",
                        "surface-light": "#ffffff",
                        "surface-dark": "#1e293b",
                        "footer-bg": "#1e293b",
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        sans: ["Inter", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.375rem",
                    },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 font-sans flex flex-col min-h-screen">

<?php require_once __DIR__ . '/header.php'; ?>

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 text-center mb-8 text-white">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 mb-4 backdrop-blur-sm">
            <span class="material-icons-round text-4xl">person_add</span>
        </div>
        <h2 class="text-3xl font-bold mb-2">Créer un élève</h2>
        <p class="text-blue-100 text-lg font-light">Ajoutez un nouvel élève à votre établissement</p>
    </div>

    <div class="max-w-3xl mx-auto">
        <!-- IMPORTANT : method + action -->
        <form
            method="post"
            action="index.php?action=creerEleve"
            class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-md border border-slate-100 dark:border-slate-700 overflow-hidden"
        >
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Informations de l'élève</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">
                    Renseignez les informations nécessaires pour créer l'élève
                </p>
            </div>

            <div class="px-8 py-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="nomEleve">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
                            id="nomEleve"
                            name="nomEleve"
                            type="text"
                            required
                            placeholder="Ex: Martin"
                            value="<?= htmlspecialchars($nomEleve ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        />
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="prenomEleve">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
                            id="prenomEleve"
                            name="prenomEleve"
                            type="text"
                            required
                            placeholder="Ex: Jean"
                            value="<?= htmlspecialchars($prenomEleve ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        />
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="datenaissance">
                        Date de naissance <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input
                            class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5 pl-3 pr-10"
                            id="datenaissance"
                            name="datenaissance"
                            type="date"
                            required
                            value="<?= htmlspecialchars($datenaissance ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        />
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Format : JJ/MM/AAAA</p>
                </div>

 <div class="space-y-1">
    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="classeEleve">
        Classe <span class="text-red-500">*</span>
    </label>
   <select
    id="classeEleve"
    name="classeEleve"
    required
    class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
>
    <option value="" disabled <?= empty($classeEleve) ? 'selected' : '' ?>>
        Sélectionnez une classe
    </option>

    <?php foreach ($classes as $classe): ?>
        <option
            value="<?= (int) $classe['id_classe'] ?>"
            <?= (isset($classeEleve) && (int)$classeEleve === (int)$classe['id_classe']) ? 'selected' : '' ?>
        >
            <?= htmlspecialchars($classe['nomClasse'], ENT_QUOTES, 'UTF-8') ?>
        </option>
    <?php endforeach; ?>
</select>
</div>
            </div>

            <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
            <a href="index.php?action=voirEleves">    
            <button class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-md text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="button">
                    <span class="material-icons-round text-sm mr-2">arrow_back</span>
                    Retour à la liste
                </button>
</a>
                <button class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="submit">
                    <span class="material-icons-round text-sm mr-2">person_add</span>
                    Créer l'élève
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

        <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-800 rounded-lg p-4 flex items-start gap-3">
            <span class="material-icons-round text-blue-500 dark:text-blue-400 mt-0.5">lightbulb</span>
            <div>
                <h4 class="text-sm font-bold text-blue-800 dark:text-blue-300">Conseil</h4>
                <p class="text-sm text-blue-700 dark:text-blue-400 mt-1 leading-relaxed">
                    Une fois l'élève créé, vous pourrez lui associer des sanctions et suivre son parcours dans l'établissement.
                </p>
            </div>
        </div>
    </div>
</main>

<footer class="bg-surface-dark text-slate-400 text-sm mt-auto border-t border-slate-700">
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
                    <span class="material-icons-round text-amber-500">assignment</span>
                    Gestion des Sanctions
                </h3>
                <p class="text-slate-400 leading-relaxed mb-4">
                    Application de gestion de la vie scolaire pour le suivi des sanctions et incidents.
                </p>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
                    <span class="material-icons-round text-slate-400">link</span>
                    Liens utiles
                </h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Support</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-white font-semibold mb-4 flex items-center gap-2">
                    <span class="material-icons-round text-slate-400">info</span>
                    Informations
                </h3>
                <p class="text-slate-400 leading-relaxed">
                    Développé dans le cadre du BTS SIO - Projet CCF 2025
                </p>
            </div>
        </div>
    </div>
    <div class="border-t border-slate-700/50 py-6 text-center text-xs text-slate-500">
        <p>© 2025 Application de Gestion des Sanctions. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>
```