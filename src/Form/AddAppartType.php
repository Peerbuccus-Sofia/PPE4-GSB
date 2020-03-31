<?php

namespace App\Form;

use App\Entity\Appartement;
use App\Entity\Proprietaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AddAppartType extends AbstractType
{
    public function getproprio(Proprietaire $proprio){
        return $proprio;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $proprio = $this->getproprio;
        $currentdate = new \DateTime('now');
        
        $builder
        ->add('proprietaire', HiddenType::class, [
                        'empty_data' => $proprio
                     ])
                     ->add('adr')
                     ->add('ville')
                     ->add('cp')
                     ->add('etage')
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
                     ->add('loyer')
                     ->add('charge')
                     ->add('ascenseur')
                     ->add('preavis')
                     ->add('datelibre')
                     ->add('tauxcotisation') 
                     ->add('taille')
                     ->add('imageFile', FileType::class, [
                         'required' =>false
                     ])
                     ->add('updated_at', HiddenType::class, [
                         'empty_data' => $currentdate
                     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appartement::class,
        ]);
    }
}
