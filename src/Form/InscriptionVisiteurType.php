<?php

namespace App\Form;

use App\Entity\Visiteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionVisiteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('adr')
            ->add('ville')
            ->add('cp')
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('username')
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Visiteur::class,
        ]);
    }
}
