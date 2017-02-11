<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressType extends AbstractType {
    
 
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
         $builder
                 ->add('latitude', HiddenType::class, [
                    'attr' => ['data-id' => 'latitude'],
                ])
                ->add('longitude', HiddenType::class, [
                    'attr' => ['data-id' => 'longitude'],
                ])
                ->add('country', TextType::class, [
                    'label' => 'страна',
                    'attr' => ['data-id' => 'country'],
                ])
                ->add('region', TextType::class, [
                    'label' => 'область',
                    'attr' => ['data-id' => 'administrative_area_level_1'],
                ])
                ->add('town', TextType::class, [
                    'label' => 'город',
                    'attr' => ['data-id' => 'locality'],
                ])
                ->add('district', TextType::class, [
                    'label' => 'район',
                    'attr' => ['data-id' => 'sublocality_level_1'],
                ])
                ->add('street', TextType::class, [
                    'label' => 'улица',
                    'attr' => ['data-id' => 'route'],
                ])
                ->add('st_number', TextType::class, [
                    'label' => 'номер дома',
                    'attr' => ['data-id' => 'street_number'],
                ])

            ;
    }
    
    public function getParent()
    {
        return FormType::class;
    }

}

