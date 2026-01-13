<!DOCTYPE html>
<html lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Gestion des Sanctions - Liste des Professeurs</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#2563EB", // Royal Blue
                        secondary: "#1E40AF", // Darker Blue
                        "background-light": "#F3F4F6", // Gray 100
                        "background-dark": "#111827", // Gray 900
                        "surface-light": "#FFFFFF",
                        "surface-dark": "#1F2937", // Gray 800
                    },
                    fontFamily: {
                        display: ["Inter", "sans-serif"],
                        body: ["Inter", "sans-serif"],
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
            font-family: 'Inter', sans-serif;
        }
        .material-icons {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .material-icons.sm {
            font-size: 1rem;
        }
        .material-icons.lg {
            font-size: 1.5rem;
        }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-100 transition-colors duration-200">
<?php require_once __DIR__ . '/header.php'; ?>
<?php require_once __DIR__ . '/navbar.php'; ?>
<main class="container mx-auto px-4 py-8 space-y-8">
<div class="bg-gradient-to-r from-blue-700 to-blue-600 rounded-xl shadow-lg p-10 text-center text-white relative overflow-hidden">
<div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 pointer-events-none" style="background-image: radial-gradient(circle at 20% 50%, white 1%, transparent 10%);"></div>
<div class="relative z-10 flex flex-col items-center justify-center space-y-4">
<div class="flex items-center gap-3 text-3xl font-bold">
<span class="material-icons lg" style="font-size: 2.5rem;">groups</span>
<h2>Gestion des professeurs</h2>
</div>
<p class="text-blue-100 text-lg">Gérez les professeurs de votre établissement</p>
<div class="flex flex-wrap gap-4 mt-4 pt-2">
<a href="index.php?action=creerProfesseur"
   class="bg-white text-primary hover:bg-blue-50 font-semibold py-2 px-6 rounded-lg shadow-sm transition flex items-center gap-2">
    <span class="material-icons sm">add</span> Créer un professeur
</a>
<a href="index.php?action=dashboard"
   class="bg-blue-800/40 hover:bg-blue-800/60 text-white font-medium py-2 px-6 rounded-lg border border-blue-400/30 transition flex items-center gap-2">
    <span class="material-icons sm">dashboard</span> Tableau de bord
</a>
</div>
</div>
</div>
<div class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
<div class="p-6 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
<h3 class="text-lg font-bold text-gray-800 dark:text-white">Liste des professeurs</h3>
<a href="index.php?action=creerEleve" class="bg-primary hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded shadow transition flex items-center gap-1">
<span class="material-icons sm">add</span> Nouveau professeur</a>
</div>
<div class="overflow-x-auto">
<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matière</th>
            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de l'ajout</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
    <?php if (!empty($professeurs)): ?>
        <?php foreach ($professeurs as $professeur): ?>
            <tr>
                <td class="px-4 py-2">
                    <?= htmlspecialchars($professeur['nomProfesseur'], ENT_QUOTES, 'UTF-8') ?>
                    <?= htmlspecialchars($professeur['prenomProfesseur'], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td class="px-4 py-2">
                    <?= htmlspecialchars($professeur['matiereProfesseur'], ENT_QUOTES, 'UTF-8') ?>
                </td>
                <td class="px-4 py-2">
                    <?= htmlspecialchars($professeur['created_at'], ENT_QUOTES, 'UTF-8') ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                Aucun professeur trouvé.
            </td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</div>
<div class="p-4 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 rounded-b-xl">
</div>
</div>
</main>

<?php require_once __DIR__ . '/footer.php'; ?>

</body></html>