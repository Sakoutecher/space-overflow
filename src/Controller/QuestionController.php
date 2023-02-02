<?php

namespace App\Controller;

use App\DTO\Author;
use App\DTO\Question;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController {
    #[Route('/')]
    public function homepage(): Response {
        return new Response("<h1>Hello space-overflow 🌐.</h1>");
    }

    #[Route('/questions/{slug}')]
    public function show(string $slug): Response {
        $author = new Author('Hugo', 'Campos');
        $question = new Question(
            $slug, 
            ucfirst(str_replace('-', ' ', $slug)), 
            $author
        );
        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => [
                'la téléportation.',
                'il faut un turbo propulseur nucléaire.',
                "laisse tomber c'est impossible",
                'je ne sais pas quoi dire',
                'que dire de plus'
            ],
            // 'archived' => true,
        ]);
        // $slug = ucfirst(str_replace('-', ' ', $slug));
    }
}