<?php

namespace App\Controller;

use App\DTO\Author;
use App\DTO\Question as QuestionDTO;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use App\Services\MailHelper;
use App\Services\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class QuestionController extends AbstractController {
    #[Route('/', name: 'app_question_homepage')]
    public function homepage(QuestionRepository $repository): Response {
        //return new Response($twig->render('question/homepage.html.twig'));
        $questions = $repository->findAllAskedOrderByNewest();
        return $this->render('question/homepage.html.twig', [
            'questions' => $questions,
        ]);
    }

    #[Route('/questions/{slug}', name: 'app_question_show')]
    public function show(Question $question): Response {
        //$author = new Author('Hugo', 'Campos');
        //$content = "Je suis tombé ***sans faire trop vraiment exprès*** dans un trou noir, pourriez-vous m'indiquer comment sortir de là svp ?";
        // $question = new QuestionDTO(
        //     $slug,
        //     $markdownParser->parse($content),
        //     //ucfirst(str_replace('-', ' ', $slug)), 
        //     $author
        // );
        // $question = $entityManager->getRepository(Question::class)
        //     ->findOneBy(['slug' => $slug])
        // ;
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
    public function new(EntityManagerInterface $entityManager, Request $request, MailHelper $mailer): Response {
        $form = $this->createForm(QuestionType::class);
        $form->handleRequest($request);
        //Si le formulaire est envoyer et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // $question = (new Question()) //Paranthèses permettent d'utiliser les méthodes d'objets directement.
            //     ->setTitle("Comment manger un burger dans l'espace".uniqid())
            //     ->setSlug("comment-manger-un-burgder-dans-l-espace".uniqid())
            //     ->setContent("Bonjour je cherche à s'avoir comment faire pour manger un burger dans l'espace.".uniqid())
            //     ->setAskedAt(new \DateTime(random_int(0, 10). ' hour ago'))
            // ;
            $question = $form->getData();
            $favorite = $form->get('favorite')->getData();
            $entityManager->persist($question);
            $entityManager->flush();
            //Envoie du mail à l'aide du MailHelper
            $mailer->sendMail($question);
            return $this->redirectToRoute('app_question_show', ['slug' => $question->getSlug()]);
        }
        //Si le formulaire n'est pas envoyer et pas valide
        return $this->render('question/add.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/questions/{slug}/vote', name: 'app_question_vote', methods: ['POST'])]
    public function vote(Question $question, Request $request, EntityManagerInterface $entityManager): Response {
        $direction = $request->request->get('direction');
        if ($direction === 'up') {
            $question->upVote();
        } else if ($direction === 'down') {
            $question->downVote();
        }
        $entityManager->persist($question);
        $entityManager->flush();
        return $this->redirectToRoute('app_question_show', ['slug' => $question->getSlug()]);
    }
}