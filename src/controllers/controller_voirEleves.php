<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException; // important

function voirEleves(Request $request, Response $response): void
{

    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    // Connexion BDD (une seule fois)
    $pdo = Database::getConnection();

    // Données envoyées à la vue
    $data = [
        'eleves' => [],
    ];

    // 1) RÉCUPÉRER LES ÉLÈVES AVEC LEURS CLASSES
    $stmt = $pdo->query(
        'SELECT e.id_eleve, e.nomEleve, e.prenomEleve, c.nomClasse, c.niveauClasse, e.created_at
         FROM eleves e
         JOIN classes c ON e.id_classe = c.id_classe
         ORDER BY c.nomClasse'
    );
    $data['eleves'] = $stmt->fetchAll();

    // 2) AFFICHER LA PAGE
    $response->view(__DIR__ . '/../../templates/pages/voirEleves.php', $data);
}