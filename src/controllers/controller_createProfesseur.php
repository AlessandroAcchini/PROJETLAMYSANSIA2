<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException;

function creerProfesseur(Request $request, Response $response): void
{
    // 1. Vérification session
    // Note : Assurez-vous que session_start() est appelé dans votre index.php ou bootstrap
    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    $pdo = Database::getConnection();

    // 2. Initialisation des données pour la vue
    $data = [
        'error'             => null,
        'success'           => null,
        'nomProfesseur'     => '',
        'prenomProfesseur'  => '',
        'matiereProfesseur' => '',
    ];

    // 3. Traitement du formulaire
    if ($request->isPost()) {

        $nomProfesseur      = trim((string) $request->post('nomProfesseur', ''));
        $prenomProfesseur   = trim((string) $request->post('prenomProfesseur', ''));
        $matiereProfesseur  = trim((string) $request->post('matiereProfesseur', '')); 

        // Garder les valeurs saisies
        $data['nomProfesseur']      = $nomProfesseur;
        $data['prenomProfesseur']   = $prenomProfesseur;
        $data['matiereProfesseur']  = $matiereProfesseur;

        // Validations
        if ($nomProfesseur === '') {
            $data['error'] = "⚠️ Le nom du Professeur est obligatoire !";
        } elseif ($prenomProfesseur === '') {
            $data['error'] = "⚠️ Le prénom du Professeur est obligatoire !";
        } elseif ($matiereProfesseur === '') {
            $data['error'] = "⚠️ La matière du Professeur est obligatoire !";
        } 
        
        // Si pas d'erreur, insertion BDD
        if ($data['error'] === null) {
            try {

                $stmt = $pdo->prepare(
                    'SELECT idProfesseur
                     FROM professeurs 
                     WHERE nomProfesseur = :nomProfesseur
                       AND prenomProfesseur = :prenomProfesseur'
                );
                $stmt->execute([
                    ':nomProfesseur'    => $nomProfesseur,
                    ':prenomProfesseur' => $prenomProfesseur,
                ]);
                $existing = $stmt->fetch();

                if ($existing) {
                    $data['error'] = "Un Professeur avec ce nom et ce prénom existe déjà.";
                } else {
                    // INSERTION
                    $stmt = $pdo->prepare(
                        'INSERT INTO professeurs (nomProfesseur, prenomProfesseur, matiereProfesseur)
                         VALUES (:nomProfesseur, :prenomProfesseur, :matiereProfesseur)'
                    );
                    $stmt->execute([
                        ':nomProfesseur'     => $nomProfesseur,
                        ':prenomProfesseur'  => $prenomProfesseur,
                        ':matiereProfesseur' => $matiereProfesseur
                    ]);

                    // Définir un message flash de succès en session puis rediriger
                    $_SESSION['success'] = 'Le professeur a été créé avec succès.';
                    $response->redirect('index.php?action=creerProfesseur');
                    return;
                }
            } catch (PDOException $e) {
                // En prod, évitez d'afficher le message brut SQL, mais utile pour débugger ici
                $data['error'] = 'Erreur technique : ' . $e->getMessage();
            }
        }
    }

    // 4. Affichage de la vue
    // Assurez-vous que le chemin est correct par rapport à l'emplacement de ce fichier
    $response->view(__DIR__ . '/../../templates/pages/createProfesseur.php', $data);
}