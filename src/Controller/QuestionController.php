<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController {
    #[Route('/')]
    public function homepage(): Response {
        return new Response("<h1>Hello classroom 🌐.</h1>");
    }

    #[Route('/questions/{slug}')]
    public function show(string $slug): Response {
        return new Response(sprintf("<h1>%s ?</h1>", ucfirst(str_replace('-', ' ', $slug))));
    }
}