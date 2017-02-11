<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class RoomType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', ChoiceType::class, array(
                    'label' => 'тип',
                    'choices' => array(
                        'санузел' => 'closet',
                        'ванная' => 'bath',
                        'кухня' => 'kitchen',
                    ))
                )
                ->add('room_sq', IntegerType::class, array(
                    'label' => 'площадь',
                ))
                ->add('room_photo', FileType::class, array(
                    'label' => 'фото',
                    'multiple'=> true,
                     'mapped' => false,
                ))


        ;
    }

    public function getParent() {
        return FormType::class;
    }

}
