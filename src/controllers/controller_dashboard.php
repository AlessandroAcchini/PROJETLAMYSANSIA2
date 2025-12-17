<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;

function afficherDashboard(Request $request, Response $response): void
{
    // Si pas connecté → on renvoie au login
    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }

    $pdo = Database::getConnection();

    

    // Récupérer les infos de l'utilisateur connecté
    $stmt = $pdo->prepare('SELECT nom, prenom, email FROM users WHERE id = :id');
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    $stmt = $pdo->query('SELECT COUNT(*) FROM classes');
    $totalClasses = (int) $stmt->fetchColumn();

    $stmt = $pdo->query('SELECT COUNT(*) FROM eleves');
    $totalEleves = (int) $stmt->fetchColumn();

    $stmt = $pdo->query('SELECT COUNT(*) FROM professeurs');
    $totalProfesseurs = (int) $stmt->fetchColumn();


    if (!$user) {
        // Utilisateur introuvable → on déconnecte et on renvoie au login
        session_destroy();
        $response->redirect('index.php?action=login');
        return;
    }



    // On passe les données à la vue
    $response->view(__DIR__ . '/../../templates/pages/dashboard.php', [
        'user'   => $user,
        'prenom' => $user['prenom'],
        'email' => $user['email'],
        'totalClasses' => $totalClasses,
        'totalEleves' => $totalEleves,
        'totalProfesseurs' => $totalProfesseurs,
    ]);
}

