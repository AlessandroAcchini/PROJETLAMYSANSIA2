<?php

namespace App\Routing;

use App\Http\Request;
use App\Http\Response;
class Router
{
    private array $routes = [];
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    // Ajoute une route au tableau de routage
    public function addRoute(String $action, String $fonction, array $methodes = ['GET'])
    {
        $this->routes[$action] = [
            'fonction' => $fonction,
            'methodes' => $methodes
        ];
        return $this;
    }


    // Gère la requête entrante et appelle la fonction associée
    public function handleRequest()
    {
        // Récupération de la méthode et l'action
        $method = $this->request->getMethod();
        $action = $this->request->getAction();

        // Vérifier que la route existe
        if ($this->hasRoute($action)) {
            $route = $this->routes[$action];

            // Vérifier que la méthode est autorisée
            if (in_array($method, $route['methodes'])) {
                // Vérifier que la fonction existe
                if (function_exists($route['fonction'])) {
                    // Exécuter la fonction correspondante
                    call_user_func($route['fonction'], $this->request, $this->response);
                    $this->response->send();
                    return;
                } else {
                    $this->handleFunctionNotFound();
                    return;
                }
            } else {


                $this->handleMethodNotAllowed();
                return;
            }
        } else {
            $this->handleNotFound();
            return;
        }
    }

    // Méthodes de gestion des erreurs
    private function handleNotFound()
    {
        $this->response->setStatusCode(404);
        $this->response->redirect(__DIR__ . "/index.php?action=index");
    }

    private function handleMethodNotAllowed()
    {
        $this->response->setStatusCode(405);
        $this->response->setBody("Méthode non autorisée pour cette action.");
        $this->response->send();
    }

    private function handleFunctionNotFound()
    {
        $this->response->setStatusCode(500);
        $this->response->redirect(__DIR__ . "/index.php?action=index");
    }

    // Méthode utilitaite

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function hasRoute(String $action): bool
    {
        return isset($this->routes[$action]);
    }
}
