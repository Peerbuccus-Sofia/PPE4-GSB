<?php

namespace App\Form;

use App\Entity\Admin;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            // ->add('nom', StringType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new NotBlank([
            //             'message' => 'Veillez renseigner ce champs'
            //         ]),
            //         new Length([
            //             'min' => 1,
            //             'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractère',
            //             // max length allowed by Symfony for security reasons
            //             'max' => 4096,
            //         ]),

                    
            //     ]
            // ])
            ->add('prenom')
            ->add('tel')
            ->add('username')
            // ->add('agreeTerms', CheckboxType::class, [
            //     'mapped' => false,
            //     'constraints' => [
            //         new IsTrue([
            //             'message' => 'Vous devez accepter nos conditions.',
            //         ]),
            //     ],
            // ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractère',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
