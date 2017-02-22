<?php

// src/AppBundle/Form/RegistrationType.php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

class RegistrationType extends AbstractType {

    private $root;
    private $uploads;
    private $fs;

    public function __construct($root, $uploads, $fs) {
        $this->root = $root;
        $this->uploads = $uploads;
        $this->fs = $fs;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('sername', TextType::class, array(
                    'label' => 'Sername',
                    'required' => false,
                  
                    
                ))
               ->add('phone', TextType::class, array(
                    'label' => 'Phone',
                    'required' => true,
                  
                    
                ))
                ->add('skype', TextType::class, array(
                    'label' => 'Phone',
                    'required' => false,
                  
                    
                ))
                ->add('viber', TextType::class, array(
                    'label' => 'Viber',
                    'required' => false,
                  
                    
                ))                
                ->add('picture', FileType::class, array(
                    'label' => 'Profile picture (image file)',
                    'required' => false,
                    'mapped' => false,
                    'empty_data' => null
                ))
                
                
                ->addEventListener(
                        FormEvents::PRE_SUBMIT, array($this, 'onPostSubmitData'))
        // ...
        ;
    }

    public function onPostSubmitData(FormEvent $event) {
        $input = $event->getData();
        $form = $event->getForm();

        $userDir = $input['username'] . '-' . md5($input['email']);

//        dump($input);


        if (array_key_exists('picture', $input) && $input['picture'] instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {

            $fileName = 'profile-picture' . '.' . $input['picture']->guessExtension();

            $input['picture']->move(
                    $this->uploads . '/' . $userDir . '/', $fileName
            );
        
            
        } else {

            $fileName = 'profile-picture' . '.jpg';

            $this->fs->copy($this->root . '/../web/img/facebook-avatar.jpg', $this->uploads . '/' . $userDir . '/' . $fileName);
        }
        
        $form->getData()->setPicture('/' .$userDir . '/' . $fileName);
    }
    
    

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getName() {
        return 'app_user_registration';
    }

}
