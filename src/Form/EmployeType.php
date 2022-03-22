<?php

namespace App\Form;

use App\Entity\Employe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as SFType;

class EmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('login')
            ->add('mdp')
            ->add('nom')
            ->add('prenom')
            ->add('statut')
            ->add('Engregistrer', SFType\SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
        ]);
    }
}
