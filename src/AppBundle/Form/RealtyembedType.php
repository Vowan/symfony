<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form;

use AppBundle\Entity\Realtyembed;
use AppBundle\Form\RoomType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

/**
 * Description of RealtyembedType
 *
 * @author vova
 */
class RealtyembedType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('description');

        $builder->add('emails', CollectionType::class, array(
            // each entry in the array will be an "email" field
            'entry_type' => EmailType::class,
            // these options are passed to each "email" type
            'entry_options' => array(
                'attr' => array('class' => 'email-box')
            ),
        ));

        $builder->add('rooms', CollectionType::class, array(
            'entry_type' => RoomType::class,
            'allow_add' => true,
        ));
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Realtyembed::class,
        ));
    }

}
