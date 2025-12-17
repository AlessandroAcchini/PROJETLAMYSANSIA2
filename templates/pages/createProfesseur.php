<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Création Professeur - Gestion des Sanctions</title>
    <!-- (Vos liens CSS/Fonts inchangés ici...) -->
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
                    borderRadius: { DEFAULT: "0.375rem" },
                },
            },
        };
    </script>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-800 dark:text-slate-200 font-sans flex flex-col min-h-screen">

<!-- Inclusion du header (vérifiez le chemin) -->
<?php require_once __DIR__ . '/header.php'; ?>
<?php require_once __DIR__ . '/navbar.php'; ?>

<main class="flex-grow container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 text-center mb-8 text-white">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/20 mb-4 backdrop-blur-sm">
            <span class="material-icons-round text-4xl">school</span>
        </div>
        <h2 class="text-3xl font-bold mb-2">Créer un Professeur</h2>
        <p class="text-blue-100 text-lg font-light">Ajoutez un nouveau professeur à l'équipe pédagogique</p>
    </div>

    <div class="max-w-3xl mx-auto">
        <!-- ACTION modifiée pour appeler la bonne route -->
        <form
            method="post"
            action="index.php?action=creerProfesseur"
            class="bg-surface-light dark:bg-surface-dark rounded-xl shadow-md border border-slate-100 dark:border-slate-700 overflow-hidden"
        >
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-700">
                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Informations du Professeur</h3>
                <p class="text-slate-500 dark:text-slate-400 mt-1 text-sm">
                    Renseignez les informations professionnelles.
                </p>
                <p class="flex justify-center item-center">Tous les champs suivis de <span class="text-red-500 ml-1 mr-1">* </span> sont obligatoires</p>
            </div>

            <div class="px-8 py-6 space-y-6">
                <!-- Ligne Nom / Prénom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="nomProfesseur">
                            Nom <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
                            id="nomProfesseur"
                            name="nomProfesseur"
                            type="text"
                            placeholder="Ex: Dupont"
                            value="<?= htmlspecialchars($nomProfesseur ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        />
                    </div>

                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="prenomProfesseur">
                            Prénom <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
                            id="prenomProfesseur"
                            name="prenomProfesseur"
                            type="text"
                            placeholder="Ex: Marie"
                            value="<?= htmlspecialchars($prenomProfesseur ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        />
                    </div>
                </div>

                <!-- Ligne Matière -->
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300" for="matiereProfesseur">
                        Matière enseignée <span class="text-red-500">*</span>
                    </label>
                    <input
                        class="w-full rounded-md border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white shadow-sm focus:border-primary focus:ring-primary dark:focus:ring-primary sm:text-sm py-2.5"
                        id="matiereProfesseur"
                        name="matiereProfesseur"
                        type="text"
                        placeholder="Ex: Mathématiques"
                        value="<?= htmlspecialchars($matiereProfesseur ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    />
                </div>
            </div>
   <?php if (!empty($error)) : ?>
            <div class="flex justify-center font-bold mt-4 p-4 text-red-500">
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['success'])) : ?>
            <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                <p class="font-bold">Succès</p>
                <p><?= htmlspecialchars($_SESSION['success'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (!empty($success)) : ?>
            <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                <p class="font-bold">Succès</p>
                <p><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?></p>
            </div>
        <?php endif; ?>
            <!-- Boutons -->
            <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-700 flex flex-col sm:flex-row justify-between items-center gap-4">
                <a href="index.php?action=dashboard">    
                    <button class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2.5 border border-slate-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded-md text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-700 hover:bg-slate-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="button">
                        <span class="material-icons-round text-sm mr-2">arrow_back</span>
                        Retour
                    </button>
                </a>
                <button class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors" type="submit">
                    <span class="material-icons-round text-sm mr-2">save</span>
                    Créer le Professeur 🧙‍♂️
                </button>
            </div>

            
        </form>
    </div>
</main>

<?php require_once __DIR__ . '/footer.php' ?>

</body>
</html>