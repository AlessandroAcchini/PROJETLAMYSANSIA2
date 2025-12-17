<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException; // important

function voirClasses(Request $request, Response $response): void
{

    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    // Connexion BDD (une seule fois)
    $pdo = Database::getConnection();

    // Données envoyées à la vue
    $data = [
        'classes' => [],
    ];


    $stmt = $pdo->query(
        'SELECT e.id_classe, e.nomClasse, e.niveauClasse, e.created_at
         FROM classes e
         ORDER BY e.nomClasse'
    );
    $data['classes'] = $stmt->fetchAll();

 
    $response->view(__DIR__ . '/../../templates/pages/voirClasses.php', $data);
}