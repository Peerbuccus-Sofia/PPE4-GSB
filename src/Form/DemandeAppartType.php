<?php

namespace App\Form;

use App\Entity\Appartement;;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DemandeAppartType extends AbstractType
{
    const prix = [300, 500, 700, 900, 1000, 1500];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('visiteur', HiddenType::class)
            ->add('typeappart', ChoiceType::class, [
                'choices' => [
                    'Appartement' => [
                        'F2' => 'F2',
                        'F3' => 'F3',
                        'F4' => 'F4',
                        'F5' => 'F5',
                        'F6' => 'F6',
                    ],
                   ],
            ])
            ->add('ville', ChoiceType::class, [
                'choices' => [
                    'Ville' => [
                        'Paris' => 'Paris',
                        'Montpellier' => 'Montpellier',
                        'Nice' => 'Nice',
                        'Lille' => 'Lille',
                        'Lyon' => 'Lyon',
                        'Marseille' => 'Marseille'
                    ],
                   ],
            ])
            ->add('loyer', ChoiceType::class, [
                'choices' => array_combine(self::prix, self::prix)
            ])
            ->add('loyer', ChoiceType::class, [
                'choices' => array_combine(self::prix, self::prix)
            ])
            ->add('Recherche', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appartement::class,
        ]);
    }
}
