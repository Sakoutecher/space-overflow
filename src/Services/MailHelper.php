<?php

namespace App\Services;

use App\Entity\Question;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

final class MailHelper {
    public function __construct(
        private MailerInterface $mailer,
    ) {}

    public function sendMail(Question $question) {
        $email = (new TemplatedEmail)
            ->from('contact@space-overflow.com')
            ->to('hugo@campos.com')
            ->subject('Votre question à été ajouté au site Space Overflow !')
            ->htmlTemplate('email/email.html.twig')
            ->context([
                'question' => $question
            ])
        ;
        $this->mailer->send($email);
    }
}
