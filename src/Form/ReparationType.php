<?php

namespace App\Form;

use App\Entity\Reparation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReparationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeReparation', TextType::class, [
                'label' => 'Type de réparation',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'form-control', 'rows' => 4],
            ])
            ->add('dateDepot', DateType::class, [
                'label' => 'Date de dépôt',
                'widget' => 'single_text',
                'input' => 'datetime_immutable',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'en attente',
                    'En cours' => 'en cours',
                    'Terminée' => 'terminée',
                ],
                'attr' => ['class' => 'form-select'],
            ])
            ->add('enregistrer', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary mt-3'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reparation::class,
        ]);
    }
}
