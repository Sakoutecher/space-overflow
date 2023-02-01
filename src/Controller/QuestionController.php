<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController {
    #[Route('/')]
    public function homepage(): Response {
        return new Response("<h1>Hello classroom 🌐.</h1>");
    }

    #[Route('/questions/comment-sortir-dun-trou-noir')]
    public function trounoir(): Response {
        return new Response("<h1>Comment sortir d'un trou noir ?</h1>");
    }
}
