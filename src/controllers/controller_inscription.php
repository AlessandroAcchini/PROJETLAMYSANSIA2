<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;


function afficherInscription(Request $request, Response $response): void
{
    $data = [
        'error'   => null,
        'success' => null,
    ];

    if ($request->isPost()) {
        $nom      = trim($request->post('nom'));
        $prenom   = trim($request->post('prenom'));
        $email    = trim($request->post('email'));

        $data['nom']    = $nom;
        $data['prenom'] = $prenom;
        $data['email']  = $email;

        $password = $request->post('password');
        $passwordConfirmation = $request->post('password_confirmation'); 

        
        if ($nom === '') {
            $data['error'] = 'Le nom est obligatoire !';
        } elseif ($prenom === '') {
            $data['error'] = 'Le prénom est obligatoire !';
        } elseif ($email === '') {
            $data['error'] = 'Le mail est obligatoire !';
        } elseif ($password === '') {
            $data['error'] = 'Le mot de passe est obligatoire !';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['error'] = 'Email invalide.';
        } elseif ($password !== $passwordConfirmation) {       
            $data['error'] = 'Erreur lors de la confirmation de mot de passe !';
        }

        // S’il y a une erreur de validation, on NE VA PAS en BDD
        if ($data['error'] === null) {
            try {
                $pdo = Database::getConnection();

                // Vérifier si l’email existe déjà
                $stmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
                $stmt->execute([':email' => $email]);
                $existing = $stmt->fetch();

                if ($existing) {
                    $data['error'] = 'Un compte existe déjà avec cet email.';
                } else {
                    // Hasher le mot de passe
                    $hash = password_hash($password, PASSWORD_DEFAULT);

                    // Insérer l’utilisateur
                    $stmt = $pdo->prepare(
                        'INSERT INTO users (nom, prenom, email, password_hash)
                         VALUES (:nom, :prenom, :email, :hash)'
                    );
                    $stmt->execute([
                        ':nom'    => $nom,
                        ':prenom' => $prenom,
                        ':email'  => $email,
                        ':hash'   => $hash,
                    ]);

                    // Connexion directe après inscription
                    $_SESSION['login']   = true;
                    $_SESSION['user_id'] = $pdo->lastInsertId();

                    // Redirection
                    $response->redirect('index.php?action=dashboard');
                    return;
                }
            } catch (PDOException $e) {
                $data['error'] = 'Erreur base de données : ' . $e->getMessage();
            }
        }
    }

    // Affiche la page d’inscription (GET ou POST invalide / erreurs)
    $response->view(__DIR__ . '/../../templates/pages/inscription.php', $data);
}