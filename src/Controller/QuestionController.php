<?php

namespace App\Controller;

use App\DTO\Author;
use App\DTO\Question;
use Knp\Bundle\MarkdownBundle\MarkdownParserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController {
    #[Route('/', name: 'app_question_homepage')]
    public function homepage(Environment $twig): Response {
        return new Response($twig->render('question/homepage.html.twig'));
        // return $this->render('question/homepage.html.twig');
    }

    #[Route('/questions/{slug}', name: 'app_question_show')]
    public function show(string $slug, MarkdownParserInterface $markdown): Response {
        $author = new Author('Hugo', 'Campos');
        $content = "Je suis tombé ***sans faire exprès*** dans un trou noir, pourriez-vous m'indiquer comment sortir de là `svp` ?";
        $content = $markdown->transformMarkdown($content);
        $question = new Question(
            $slug,
            $content,
            //ucfirst(str_replace('-', ' ', $slug)), 
            $author
        );
        return $this->render('question/show.html.twig', [
            'question' => $question,
            'answers' => [
                'la téléportation.',
                'il faut un turbo propulseur nucléaire.',
                "laisse tomber c'est impossible",
                'je ne sais pas quoi dire',
                'que dire de plus',
                'bonjour le monde'
            ],
            // 'archived' => true,
        ]);
        // $slug = ucfirst(str_replace('-', ' ', $slug));
    }
}