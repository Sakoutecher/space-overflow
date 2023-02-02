<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController {
    #[Route('/')]
    public function homepage(): Response {
        return new Response("<h1>Hello classroom 🌐.</h1>");
    }

    #[Route('/questions/{slug}')]
    public function show(string $slug): Response {
        $slug = ucfirst(str_replace('-', ' ', $slug));
        return $this->render('question/show.html.twig', [
            'question' => $slug,
        ]);
    }
}