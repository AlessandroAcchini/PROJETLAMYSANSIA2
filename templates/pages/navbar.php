<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
 <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>


<nav class="bg-primary text-white">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center">

      <?php if (!empty($_SESSION['login']) && $_SESSION['login'] === true): ?>
        <!-- connecté -->
        <div class="flex items-center space-x-4">
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="index.php?action=dashboard">
            <span class="material-icons text-base mr-2">dashboard</span>Tableau de Bord
          </a>
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="index.php?action=dashboard">
            <span class="material-icons text-base mr-2">gavel</span>Sanctions
          </a>
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="index.php?action=voirEleves">
            <span class="material-icons text-base mr-2">school</span>Élèves
          </a>
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="index.php?action=voirProfesseurs">
            <span class="material-icons text-base mr-2">person</span>Professeurs
          </a>
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="index.php?action=voirClasses">
            <span class="material-icons text-base mr-2">class</span>Classes
          </a>
          <a class="flex items-center px-3 py-4 text-sm font-medium hover:bg-blue-700" href="#">
            <span class="material-icons text-base mr-2">group</span>Utilisateurs
          </a>
        </div>

        <div class="flex items-center space-x-4">
          <span class="text-sm">
            <?= isset($prenom) ? htmlspecialchars("Bonjour, " . $prenom, ENT_QUOTES, 'UTF-8') : '' ?>
          </span>
          <a class="flex items-center px-3 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700 rounded"
             href="index.php?action=logout">
            <span class="material-icons text-base mr-2">logout</span>Déconnexion
          </a>
        </div>

      <?php else: ?>
        <!-- pas co -->
        <div class="flex items-center space-x-4">
          <a class="flex items-center px-3 py-4 text-sm font-medium bg-blue-700"
             href="index.php?action=accueil">
            <span class="material-icons text-base mr-2">home</span>Accueil
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</nav>