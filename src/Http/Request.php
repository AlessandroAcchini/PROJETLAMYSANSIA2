<?php

namespace App\Http;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private string $method;
    private string $action;

    private string $defaultAction = 'accueil';

    // Initialisation des propriétés à partir des superglobales
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;

        // (petite sécurité en plus) si REQUEST_METHOD n'existe pas, on considère GET
        $this->method = $this->server['REQUEST_METHOD'] ?? 'GET';

        // MODIF 2 :
        // Avant : $this->action = $this->get['action'] ?? 'index';
        // Maintenant : si aucun paramètre ?action=... n'est passé,
        // on utilise l'action par défaut "accueil".
        $this->action = $this->get['action'] ?? $this->defaultAction;
    }

    // Récupère une valeur de GET ou POST avec une valeur par défaut
    public function get(string $key, $default = null): mixed
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, $default = null): mixed
    {
        return $this->post[$key] ?? $default;
    }

    // Récupère toutes les données GET ou POST
    public function allPost(): array
    {
        return $this->post;
    }

    public function allGet(): array
    {
        return $this->get;
    }

    // Vérifie le type de requête
    public function isPost(): bool
    {
        return $this->method === 'POST';
    }

    public function isGet(): bool
    {
        return $this->method === 'GET';
    }

    // Récupère des informations sur la requête
    public function getMethod(): string
    {
        return $this->method;
    }

    // MODIF 3 :
    // On renvoie toujours une action non vide ; si pour une raison quelconque
    // $this->action est vide, on retombe sur l'action par défaut "accueil".
    public function getAction(): string
    {
        return $this->action !== '' ? $this->action : $this->defaultAction;
    }

    // Vérifie si une clé existe dans GET ou POST
    public function has(string $key): bool
    {
        return isset($this->get[$key]) || isset($this->post[$key]);
    }

    // Récupère des informations supplémentaires sur la requête
    public function getUrl(): string
    {
        $protocol = isset($this->server['HTTPS']) && $this->server['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $this->server['HTTP_HOST'];
        $uri = $this->server['REQUEST_URI'];
        return $protocol . $host . $uri;
    }

    public function getClientIp(): string
    {
        return $this->server['REMOTE_ADDR'];
    }
}