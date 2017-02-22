<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class RealtymainType extends AbstractType {
    
 
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
         $builder
                ->add('price', IntegerType::class, [
                    'label' => 'цена',
                    'attr' => ['data-id' => 'price'],
                    'data' => '1',
                ])
                ->add('rooms', IntegerType::class, [
                    'label' => 'л-во',
                    'attr' => ['data-id' => 'rooms'],
                    'data' => '1',
                ])
                ->add('sqTotal', IntegerType::class, [
                    'label' => 'общая площадь',
                    'attr' => ['data-id' => 'sqTotal'],
                    'data' => '1',
                ])
                ->add('sqLife', IntegerType::class, [
                    'label' => 'жилая площадь',
                    'attr' => ['data-id' => 'sqLife'],
                    'data' => '1',
                ])
                ->add('sqKitchen', IntegerType::class, [
                    'label' => 'площадь кухни',
                    'attr' => ['data-id' => 'sqKitchen'],
                    'data' => '1',
                ])
                ->add('level', IntegerType::class, [
                    'label' => 'этаж',
                    'attr' => ['data-id' => 'level'],
                    'data' => '1',
                ])
                 ->add('levels', IntegerType::class, [
                    'label' => 'этажность',
                    'attr' => ['data-id' => 'levels'],
                     'data' => '1',
                ])

            ;
    }
    
    public function getParent()
    {
        return FormType::class;
    }

}