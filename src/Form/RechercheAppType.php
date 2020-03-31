<?php

namespace App\Form;

use App\Entity\Recherches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheAppType extends AbstractType
{
    const prix = [300, 500, 700, 900, 1000, 1500];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('minprix', IntegerType::class, [
               'required' => false,
               'label' => false,
               'attr' => [
                   'placeholder' => 'Minimale'
               ]
           ])
           ->add('maxprix', IntegerType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Maximun'
            ]
        ])
        ->add('typeappart', ChoiceType::class, [
            'required' => false,
            'label' => false,
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
        ->add('taille', IntegerType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Taille'
            ]
        ])
        ->add('ville', ChoiceType::class, [
            'required' => false,
            'label' => false,
            'attr' => [
                'placeholder' => 'Ville'
            ],
            'choices' => [
                'Ville' => [
                    'Paris' => 'Paris',
                    'Pantin' => 'Pantin',
                    'Noisy-le-Grand' => 'Noisy-le-grand',
                    'Bry-sur-Marne' => 'Bry-sur-Marne',
                    'Garenne-Colome' => 'Garenne-Colome',
                    'Nogent-sur-Marne' => 'Nogent-sur-Marne'
                ],
               ],
        ])
        // ->add('arrondissement', ChoiceType::class, [
        //     'required' => false,
        //     'label' => false,
        //     'attr' => [
        //         'placeholder' => 'Arrondissement Paris'
        //     ],
        //     'choices' => [
        //         'Paris' => [
        //             '75001' => '75001',
        //             '75002' => '75002',
        //             '75003' => '75003',
        //             '75004' => '75004',
        //             '75005' => '75005',
        //             '75006' => '75006',
        //             '75007' => '75007',
        //             '75008' => '75008',
        //             '75009' => '75009',
        //             '75010' => '75010',
        //             '75011' => '75011',
        //             '75012' => '75012',
        //             '75013' => '75013',
        //             '75014' => '75014',
        //             '75015' => '75015',
        //             '75016' => '75016',
        //             '75017' => '75017',
        //             '75018' => '75018',
        //             '75019' => '75019'
        //         ]
                    

        //        ],
        // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recherches::class,
            'method' => 'get',
            'csrf_protection' => false 
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
