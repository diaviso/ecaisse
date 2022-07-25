<?php

namespace App\Form;

use App\Entity\Decadaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DecadaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('debut', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('fin', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('etat', CheckboxType::class, [
                'label'    => 'est ouvert ?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Decadaire::class,
        ]);
    }
}
