<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController {
    #[Route('/answers/{id<\d+>}/vote/{direction<up|down>}', name: 'app_answers_vote', methods: ['POST'])]
    public function vote(string $direction): Response {
        if ($direction === 'up') {
            $value = random_int(0, 100);
        } else if ($direction === 'down') {
            $value = random_int(-100, 0);
        }
        return $this->json(['votes' => $value]);
    }
}