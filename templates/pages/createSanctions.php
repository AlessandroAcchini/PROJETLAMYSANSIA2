<!DOCTYPE html>
<html class="scroll-smooth" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Création de Sanction</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    
</head>

<body class="bg-slate-50 text-slate-800 font-sans flex flex-col min-h-screen">
<?php include 'navbar.php'; ?>
<main class="flex-grow container mx-auto px-4 py-8">
    
    <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-xl shadow-lg p-6 text-center mb-8 text-white">
        <h2 class="text-3xl font-bold flex items-center justify-center gap-3">
            <span class="material-icons-round">gavel</span> Nouvelle Sanction
        </h2>
    </div>

    <div class="max-w-3xl mx-auto">
        <form method="post" action="index.php?action=creerSanctions" class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
            
            <div class="px-8 py-6 space-y-6">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1" for="id_eleve">
                        Élève concerné <span class="text-red-500">*</span>
                    </label>
                    <select id="id_eleve" name="id_eleve" required class="w-full rounded-md border-slate-300 shadow-sm focus:border-red-500 py-2.5">
                        <option value="" disabled <?= empty($selectedEleve) ? 'selected' : '' ?>>-- Sélectionnez un élève --</option>
                        <?php foreach ($eleves as $eleve): ?>
                            <option value="<?= htmlspecialchars($eleve['id_eleve']) ?>" <?= ($selectedEleve == $eleve['id_eleve']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($eleve['nomEleve'] . ' ' . $eleve['prenomEleve']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1" for="idProfesseur">
                        Professeur déclarant <span class="text-red-500">*</span>
                    </label>
                    <select id="idProfesseur" name="idProfesseur" required class="w-full rounded-md border-slate-300 shadow-sm focus:border-red-500 py-2.5">
                        <option value="" disabled <?= empty($selectedProf) ? 'selected' : '' ?>>-- Sélectionnez un professeur --</option>
                        <?php foreach ($professeurs as $prof): ?>
                            <option value="<?= htmlspecialchars($prof['idProfesseur']) ?>" <?= ($selectedProf == $prof['idProfesseur']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prof['nomProfesseur'] . ' ' . $prof['prenomProfesseur']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1" for="type_sanction">
                        Type de Sanction <span class="text-red-500">*</span>
                    </label>
                    <select id="type_sanction" name="type_sanction" required class="w-full rounded-md border-slate-300 shadow-sm focus:border-red-500 py-2.5">
                        <option value="" disabled selected>-- Sélectionnez un type de sanction --</option>
                        <option value="avertissement">Avertissement</option>
                        <option value="retenue">Retenue</option>
                        <option value="exclusion_temporaire">Exclusion Temporaire</option>
                        <option value="exclusion_definitive">Exclusion Définitive</option>
                        <option value="blame">Blâme</option>
                    </select>
                </div>

                <!-- DATE -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1" for="date_sanction">
                        Date de la sanction <span class="text-red-500">*</span>
                    </label>
                    <input class="w-full rounded-md border-slate-300 shadow-sm focus:border-red-500 py-2.5" 
                           id="date_sanction" name="date_sanction" type="date" required 
                           value="<?= htmlspecialchars($dateSanction) ?>" />
                </div>

                <!-- MOTIF -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1" for="motif">
                        Motif de la sanction <span class="text-red-500">*</span>
                    </label>
                    <textarea class="w-full rounded-md border-slate-300 shadow-sm focus:border-red-500 py-2.5" 
                              id="motif" name="motif" rows="4" required placeholder="Raison de la sanction..."><?= htmlspecialchars($motif) ?></textarea>
                </div>

            </div>

            <!-- BOUTONS -->
            <div class="px-8 py-6 bg-slate-50 border-t border-slate-200 flex justify-end gap-4">
                <a href="index.php?action=dashboard" class="px-4 py-2 border border-slate-300 rounded-md text-slate-700 bg-white hover:bg-slate-50">
                    Annuler
                </a>
                <button type="submit" class="px-6 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 font-medium shadow-sm">
                    Enregistrer
                </button>
            </div>
        </form>

        <!-- DEBUG ERREURS -->
        <?php if (!empty($error)) : ?>
            <div class="mt-4 p-4 bg-red-100 text-red-700 rounded-md border border-red-200">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)) : ?>
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-md border border-green-200">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php
require_once __DIR__ . '/footer.php';
?> 
</body>
</html>