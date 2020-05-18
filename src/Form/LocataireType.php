<?php

namespace App\Form;

use App\Entity\Appartement;
use App\Entity\Locataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datenaissance')
            ->add('rib')
            ->add('telbanque')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('appartement', EntityType::class, [
                'class' => Appartement::class,
                'choice_label' => 'adr'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
