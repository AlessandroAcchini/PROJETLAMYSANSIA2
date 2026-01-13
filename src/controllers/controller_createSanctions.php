<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;
use PDOException;

function creerSanctions(Request $request, Response $response): void
{
    // Sécurité connexion
    if (empty($_SESSION['user_id'])) {
        $response->redirect('index.php?action=login');
        return;
    }
    
    $pdo = Database::getConnection();

    $data = [
        'error'         => null,
        'success'       => null,
        'selectedEleve' => '', 
        'selectedProf'  => '',
        'dateSanction'  => date('Y-m-d'),
        'motif'         => '',
        'eleves'        => [],
        'professeurs'   => [],
    ];

    // 1. CHARGEMENT DES LISTES POUR LES SELECTS
    try {
        $stmtProf = $pdo->query('SELECT idProfesseur, nomProfesseur, prenomProfesseur FROM professeurs ORDER BY nomProfesseur ASC');
        $data['professeurs'] = $stmtProf->fetchAll();

        $stmtEleve = $pdo->query('SELECT id_eleve, nomEleve, prenomEleve FROM eleves ORDER BY nomEleve ASC');
        $data['eleves'] = $stmtEleve->fetchAll();
    } catch (PDOException $e) {
        $data['error'] = "Erreur chargement listes : " . $e->getMessage();
    }

    // 2. TRAITEMENT DU FORMULAIRE
    if ($request->isPost()) {

        $idEleve      = $request->post('id_eleve');
        $idProfesseur = $request->post('idProfesseur');
        $dateSanction = $request->post('date_sanction');
        $motif        = trim((string)$request->post('motif', ''));

        // Repeupler le formulaire en cas d'erreur
        $data['selectedEleve'] = $idEleve;
        $data['selectedProf']  = $idProfesseur;
        $data['dateSanction']  = $dateSanction;
        $data['motif']         = $motif;

        // Validations
        if (empty($idEleve)) {
            $data['error'] = "Veuillez sélectionner un élève.";
        } elseif (empty($idProfesseur)) {
            $data['error'] = "Veuillez sélectionner un professeur.";
        } elseif (empty($dateSanction)) {
            $data['error'] = "La date est obligatoire.";
        } elseif (empty($motif)) {
            $data['error'] = "Le motif est obligatoire.";
        }

        if ($data['error'] === null) {
            try {
                // --- ICI : ON RÉCUPÈRE NOM ET PRÉNOM ---
                // On va chercher les infos dans la table 'eleves' grâce à l'ID
                $stmtGetInfo = $pdo->prepare("SELECT nomEleve, prenomEleve FROM eleves WHERE id_eleve = :id");
                $stmtGetInfo->execute([':id' => $idEleve]);
                $eleveInfo = $stmtGetInfo->fetch();
                
                // Sécurité : si l'élève n'existe pas (rare ici), on met vide
                $nomRecupere    = $eleveInfo ? $eleveInfo['nomEleve'] : '';
                $prenomRecupere = $eleveInfo ? $eleveInfo['prenomEleve'] : '';

                // --- INSERTION COMPLÈTE ---
                // On ajoute nomEleve et prenomEleve dans la requête
                $sql = "INSERT INTO sanctions (id_eleve, nomEleve, prenomEleve, idProfesseur, dateSanction, motifSanction) 
                        VALUES (:idEleve, :nomEleve, :prenomEleve, :idProfesseur, :dateSanction, :motif)";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':idEleve'      => $idEleve,
                    ':nomEleve'     => $nomRecupere,    // Ajout du nom
                    ':prenomEleve'  => $prenomRecupere, // Ajout du prénom
                    ':idProfesseur' => $idProfesseur,
                    ':dateSanction' => $dateSanction,
                    ':motif'        => $motif
                ]);

                // Succès
                $response->redirect('index.php?action=dashboard');
                return;

            } catch (PDOException $e) {
                $data['error'] = 'Erreur SQL : ' . $e->getMessage();
            }
        }
    }

    $response->view(__DIR__ . '/../../templates/pages/createSanctions.php', $data);
}