<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/controllers/controller_accueil.php';
require_once __DIR__ . '/../src/controllers/controller_connexion.php';
require_once __DIR__ . '/../src/controllers/controller_inscription.php';
require_once __DIR__ . '/../src/controllers/controller_dashboard.php';
require_once __DIR__ . '/../src/controllers/controller_createClasse.php';
require_once __DIR__ . '/../src/controllers/controller_createEleve.php';
require_once __DIR__ . '/../src/controllers/controller_voirEleves.php';
require_once __DIR__ . '/../src/controllers/controller_voirClasses.php';
require_once __DIR__ . '/../src/controllers/controller_createProfesseur.php';
require_once __DIR__ . '/../src/controllers/controller_voirProfesseurs.php';
require_once __DIR__ . '/../src/controllers/controller_createSanctions.php';

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;

$request  = new Request();
$response = new Response();
$router   = new Router($request, $response);


$router->addRoute('accueil', 'afficherAccueil', ['GET']);
$router->addRoute('login', 'afficherConnexion', ['GET', 'POST']);
$router->addRoute('inscription', 'afficherInscription', ['GET', 'POST']);
$router->addRoute('dashboard', 'afficherDashboard', ['GET']);
$router->addRoute('logout', 'deconnecter', ['GET']);
$router->addRoute('creerClasse', 'creerClasse', ['GET', 'POST']);
$router->addRoute('creerEleve', 'creerEleve', ['GET', 'POST']);
$router->addRoute('voirEleves', 'voirEleves', ['GET']);
$router->addRoute('voirClasses', 'voirClasses', ['GET']);
$router->addRoute('creerProfesseur', 'creerProfesseur', ['GET', 'POST']);
$router->addRoute('voirProfesseurs', 'voirProfesseurs', ['GET']);
$router->addRoute('creerSanctions', 'creerSanctions', ['GET', 'POST']);

$router->handleRequest();