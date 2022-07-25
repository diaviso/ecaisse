<?php

namespace App\Form;

use App\Entity\Decadaire;
use App\Entity\Fiche;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FicheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('decadaire', EntityType::class, [
                'choices' => $options['decadaires'],
                'class' => Decadaire::class,
                'attr' => [
                    'class' => 'select',
                    'data-live-search' => 'true',
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('type')
            ->add('nombre');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fiche::class,
            'decadaires' => array()
        ]);
    }
}
