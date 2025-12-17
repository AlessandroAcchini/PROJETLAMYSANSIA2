<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Config\Database;



function afficherConnexion(Request $request, Response $response): void
{
    $data = [
        'error' => null,
    ];

    if ($request->isPost()) {
        $email    = trim($request->post('email'));
        $data['email']  = $email;
    }

    // Si déjà connecté → redirection
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        $response->redirect('index.php?action=dashboard');
        return;
    }

    if ($request->isPost()) {
        $email    = trim($request->post('email'));
        $password = $request->post('password');

        if ($email === '' || $password === '') {
            $data['error'] = 'Veuillez saisir votre email et votre mot de passe.';
        } else {
            try {
                $pdo = Database::getConnection();

                $stmt = $pdo->prepare(
                    'SELECT id, nom, prenom, email, password_hash
                     FROM users
                     WHERE email = :email'
                );
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password_hash'])) {
                    $_SESSION['login']   = true;
                    $_SESSION['user_id'] = $user['id'];

                    $response->redirect('index.php?action=dashboard');
                    return;
                } else {
                    $data['error'] = 'Email ou mot de passe incorrect.';
                }
            } catch (PDOException $e) {
                $data['error'] = 'Erreur base de données : ' . $e->getMessage();
            }
        }
    }


    $response->view(__DIR__ . '/../../templates/pages/login.php', $data);
}

function deconnecter(Request $request, Response $response): void
{
    
    $_SESSION = []; // remet session vide


    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // On détruit la session
    session_destroy();

    // On redirige vers l’accueil ou la page de login
    $response->redirect('index.php?action=accueil');
}