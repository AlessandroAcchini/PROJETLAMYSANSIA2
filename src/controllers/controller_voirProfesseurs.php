<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException; // important

function voirProfesseurs(Request $request, Response $response): void
{

    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    // Connexion BDD (une seule fois)
    $pdo = Database::getConnection();

    // Données envoyées à la vue
    $data = [
        'professeurs' => [],
    ];

    // 1) RÉCUPÉRER LES ÉLÈVES AVEC LEURS CLASSES
    $stmt = $pdo->query(
        'SELECT f.idProfesseur, f.nomProfesseur, f.prenomProfesseur, f.matiereProfesseur, f.created_at
         FROM professeurs f
         ORDER BY f.matiereProfesseur'
    );
    $data['professeurs'] = $stmt->fetchAll();

    // 2) AFFICHER LA PAGE
    $response->view(__DIR__ . '/../../templates/pages/voirProfesseurs.php', $data);
}