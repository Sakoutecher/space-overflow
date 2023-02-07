<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder , array $options) {
        $builder
            ->add('title')
            ->add('content', null, [
                'label' => 'Détail de votre question'
            ])   
            ->add('askedAt', null, [
                'widget' => 'single_text'
            ])     
            ->add('favorite', ChoiceType::class, [
                'mapped' => false,
                'choices' => [
                    'Pizza' => 'pizza',
                    'Macdo' => 'macdo',
                    'BurgerKing' => 'burgerking',
                ],
                'label' => 'Quelle est votre plat préféré ?'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'method' => 'post',
            'data_class' => Question::class,
        ]);
    }
}
