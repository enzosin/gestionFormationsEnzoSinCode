<?php

namespace App\Form;

use App\Entity\Formation;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as SFType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;   

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut')
            ->add('nbreHeures')
            ->add('departement')
            ->add('Description')
            

            ->add('produit', EntityType::class, array(
                'class' => 'App\Entity\Produit',
                'choice_label' => 'libelle',))
            ->add('Enregistrer', SFType\SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formation::class,
        ]);
    }
}
