<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


class UserType extends AbstractType {

    private $em;
    private $ts;

    public function __construct(EntityManager $em, TokenStorage $ts) {
        $this->em = $em;
        $this->ts = $ts;
        
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $user = $this->ts->getToken()->getUser();
        
       // dump($user);        die();

        $builder
                ->add('username', TextType::class, [
                    'label' => 'имя',
                    'data' => $user->getUsername(),
                    'mapped' => false,
                ])
                ->add('sername', TextType::class, [
                    'label' => 'фамилия',
                    'data' => $user->getSername(),
                    'mapped' => false,
                ])
                ->add('email', EmailType::class, [
                    'label' => 'электронная почта',
                    'data' => $user->getEmail(),
                    'mapped' => false,
                ])
                ->add('phone', TextType::class, [
                    'label' => 'телефон',
                     'data' => $user->getPhone(),
                    'mapped' => false,
                ])
                ->add('skype', TextType::class, [
                    'label' => 'скайп',
                   'data' => $user->getSkype(),
                    'mapped' => false,
                ])
                ->add('viber', TextType::class, [
                    'label' => 'вайбер',
                    'data' => $user->getViber(),
                    'mapped' => false,
                ])
        ;
    }

    public function getParent() {
        return FormType::class;
    }

}
