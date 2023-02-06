<?php

namespace App\Controller;

use App\DTO\Author;
use App\DTO\Question as QuestionDTO;
use App\Entity\Question;
use App\Services\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController {
    #[Route('/', name: 'app_question_homepage')]
    public function homepage(EntityManagerInterface $entityManager): Response {
        //return new Response($twig->render('question/homepage.html.twig'));
        $questions = $entityManager->getRepository(Question::class)->findBy([], ['id' => 'DESC']);
        return $this->render('question/homepage.html.twig', [
            'questions' => $questions,
        ]);
    }

    #[Route('/questions/{slug}', name: 'app_question_show')]
    public function show(string $slug, /*MarkdownParserInterface $markdown, CacheInterface $cache*/MarkdownHelper $markdownParser, EntityManagerInterface $entityManager): Response {
        //$author = new Author('Hugo', 'Campos');
        //$content = "Je suis tombé ***sans faire trop vraiment exprès*** dans un trou noir, pourriez-vous m'indiquer comment sortir de là svp ?";
        // $question = new QuestionDTO(
        //     $slug,
        //     $markdownParser->parse($content),
        //     //ucfirst(str_replace('-', ' ', $slug)), 
        //     $author
        // );
        $question = $entityManager->getRepository(Question::class)
            ->findOneBy(['slug' => $slug])
        ;
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

    #[Route('/questions/new', name: 'app_question_new', methods: ['GET', 'POST'], priority: 10)]
    public function new(EntityManagerInterface $entityManager): Response {
        $question = (new Question()) //Paranthèses permettent d'utiliser les méthodes d'objets directement.
            ->setTitle("Comment manger un burger dans l'espace")
            ->setSlug("comment-manger--un-burgder-dans-l-espace".uniqid())
            ->setContent("Bonjour je cherche à s'avoir comment faire pour manger un burger dans l'espace.");
        $entityManager->persist($question);
        $entityManager->flush();
        return new Response("<html><body>Nouvelle question id {$question->getId()}</body></html>");
    }
}