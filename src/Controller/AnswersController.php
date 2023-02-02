<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController {
    #[Route('/answers/{id}/vote/{direction}', name: 'app_answers_vote')]
    public function vote(int $id, string $direction): JsonResponse {
        if ($direction === 'up') {
            $value = random_int(0, 100);
        } else if ($direction === 'down') {
            $value = random_int(-100, 0);
        } else {
            throw new Exception("La valeur saisie de direction n'est pas correct.");
        }
        return $this->json(['vote' => $value]);
    }
}