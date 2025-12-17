<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException; // important

function creerEleve(Request $request, Response $response): void
{

    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    // Connexion BDD (une seule fois)
    $pdo = Database::getConnection();

    // Données envoyées à la vue
    $data = [
        'error'        => null,
        'success'      => null,
        'nomEleve'     => '',
        'prenomEleve'  => '',
        'classeEleve'  => '',
        'datenaissance'=> '',
        'classes'      => [],
    ];

    // 1) RÉCUPÉRER LES CLASSES EXISTANTES POUR LE <select>
    $stmt = $pdo->query('SELECT id_classe, nomClasse FROM classes ORDER BY nomClasse');
    $data['classes'] = $stmt->fetchAll();

    // 2) TRAITER LE FORMULAIRE SI POST
    if ($request->isPost()) {

        $nomEleve      = trim((string) $request->post('nomEleve', ''));
        $prenomEleve   = trim((string) $request->post('prenomEleve', ''));
        $classeEleve   = trim((string) $request->post('classeEleve', '')); // ici on attend l'id_classe
        $datenaissance = trim((string) $request->post('datenaissance', ''));

        // Pour que le formulaire garde les valeurs saisies
        $data['nomEleve']      = $nomEleve;
        $data['prenomEleve']   = $prenomEleve;
        $data['classeEleve']   = $classeEleve;
        $data['datenaissance'] = $datenaissance;

        // VALIDATIONS
        if ($nomEleve === '') {
            $data['error'] = "Le nom de l'élève est obligatoire !";
        } elseif ($prenomEleve === '') {
            $data['error'] = "Le prénom de l'élève est obligatoire !";
        } elseif ($classeEleve === '') {
            $data['error'] = "La classe de l'élève est obligatoire !";
        } elseif ($datenaissance === '') {
            $data['error'] = "La date de naissance de l'élève est obligatoire !";
        }

        // 3) SI PAS D'ERREUR, ON VA EN BDD
        if ($data['error'] === null) {
            try {
                // Vérifier si l'élève existe déjà

                $stmt = $pdo->prepare(
                    'SELECT id_eleve
                     FROM eleves
                     WHERE nomEleve = :nomEleve
                       AND prenomEleve = :prenomEleve
                       AND id_classe = :id_classe'
                );
                $stmt->execute([
                    ':nomEleve'  => $nomEleve,
                    ':prenomEleve' => $prenomEleve,
                    ':id_classe' => $classeEleve,
                ]);
                $existing = $stmt->fetch();

                if ($existing) {
                    $data['error'] = "Un élève avec ce nom, ce prénom et cette classe existe déjà.";
                } else {
                    // Insérer l'élève
                    $stmt = $pdo->prepare(
                        'INSERT INTO eleves (nomEleve, prenomEleve, id_classe, datenaissance)
                         VALUES (:nomEleve, :prenomEleve, :id_classe, :datenaissance)'
                    );
                    $stmt->execute([
                        ':nomEleve'     => $nomEleve,
                        ':prenomEleve'  => $prenomEleve,
                        ':id_classe'    => $classeEleve,   // id de la classe choisie
                        ':datenaissance'=> $datenaissance,
                    ]);

                    // Redirection après succès
                    $response->redirect('index.php?action=dashboard');
                    return;
                }
            } catch (PDOException $e) {
                $data['error'] = 'Erreur base de données : ' . $e->getMessage();
            }
        }
    }


    $response->view(__DIR__ . '/../../templates/pages/createEleve.php', $data);
}