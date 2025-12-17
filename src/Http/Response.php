<?php

namespace App\Http;
class Response
{


    // Propriétés de la réponse
    private int $statusCode = 200;
    private array $headers = [];
    private string $body = '';
    private string $contentType = 'text/html';
    private string $charset = 'UTF-8';

    public function __construct()
    {
        // Initialisation si nécessaire
    }

    // Setteurs pour configurer la réponse
    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function setHeader(string $name, string $value): void
    {
        $this->headers[$name] = $value;
    }

    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
    }

    // Getteurs pour récupérer les informations de la réponse
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getHeader(string $name): mixed
    {
        return $this->headers[$name] ?? null;
    }

    // Méthodes spécialisées

    public function redirect(string $url, int $statusCode = 302): Response
    {
        $this->setStatusCode($statusCode);
        header("Location: {$url}");
        return $this;
    }

    public function view(string $templatePath, array $data = [], int $statusCode = 200): Response
    {
        $this->setStatusCode($statusCode);

        // Vérifier que le fichier de template existe
        if (!file_exists($templatePath)) {
            $this->setStatusCode(500);
            $this->setBody("Template introuvable: {$templatePath}");
            $this->setContentType('text/plain');
            return $this;
        }

// Rendre la template avec les données fournies
        extract($data, EXTR_SKIP);
        ob_start();
        include $templatePath;
        $content = ob_get_clean();

        $this->setBody($content);
        $this->setContentType('text/html');
        return $this;
    }


    public function error($message, int $statusCode = 500): Response
    {
        $this->setStatusCode($statusCode);
        $this->setBody("<h1>Error {$statusCode}</h1><p>{$message}</p>");
        $this->setContentType('text/html');
        return $this;
    }

    public function success($message, int $statusCode = 200): Response
    {
        $this->setStatusCode($statusCode);
        $this->setBody("<h1>Success</h1><p>{$message}</p>");
        $this->setContentType('text/html');
        return $this;
    }

    // Méthode pour envoyer la réponse au client
    public function send(): void
    {
        // Envoyer le code de statut
        http_response_code($this->statusCode);

        // Envoyer les en-têtes
        foreach ($this->headers as $name => $value) {
            header("{$name}: {$value}");
        }

        // Envoyer le type de contenu
        header("Content-Type: {$this->contentType}; charset={$this->charset}");

        // Envoyer le corps de la réponse
        echo $this->body;
    }
}
