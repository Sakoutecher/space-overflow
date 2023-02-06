<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:random-security-alert',
    description: 'Generate a random security alert',
)]
class RandomSecurityAlertCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Nom de la personne')
            ->addOption('yield', null, InputOption::VALUE_NONE, "Option qui permet de mettre en majuscule le message d'erreur")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $alerts = [
            'Surchauffe des propulseurs.',
            'Dépressurisations de la cabine.',
            'Poubelle de la cuisine qui est pleine.'
        ];

        $io = new SymfonyStyle($input, $output);
        $name = $input->getArgument('name');
        $yield = $input->getOption('yield');
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion('Voulez vous vraiment criez ?', false);

        if ($name) {
            $io->info('Hello ' . $name . ' !');
        }

        if ($yield) {
            if ($helper->ask($input, $output, $question)) {
                $io->warning(strtoupper(array_rand(array_flip($alerts))));
            } else {
                $io->warning(array_rand(array_flip($alerts)));
            }
        }

        return Command::SUCCESS;
    }
}
