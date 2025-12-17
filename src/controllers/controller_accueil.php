<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;



function afficherAccueil(Request $request, Response $response) {
    $data = [];
    if(isset($_SESSION['connexion'])&&$_SESSION['connexion']==true){
        $response->redirect(url: "index.php?action=dashboard");
        $response->view(__DIR__ . '/../../templates/pages/dashboard.php', $data);
    }
    $response->view(__DIR__ . '/../../templates/pages/accueil.php', $data);
}