<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RealtyFormType extends AbstractType {

    private $em;
    private $ts;
    private $realtyType;

    public function __construct(EntityManager $em, TokenStorage $ts) {
        $this->em = $em;
        $this->ts = $ts;
    }

    public function getRealtyType() {
        return $this->realtyType;
    }

    public function setRealtyType($type) {

        $this->realtyType = $type;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', null, [
                    'attr' => ['autofocus' => true, 'disabled' => true],
                    'label' => 'label.title',
                ])
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
                ->add('save', SubmitType::class, array(
                    'attr' => array('class' => 'save qqqq'),
                ))
                ->addEventListener(
                        FormEvents::PRE_SET_DATA, array($this, 'onPreSetData')
                )
                ->addEventListener(
                        FormEvents::PRE_SUBMIT, array($this, 'onPostSubmitData')
                )



        // ...
//                ->add('picture', FileType::class, array(
//                    'label' => 'Profile picture (image file)',
//                    'required' => false,
//                    'empty_data' => null
//                ))
        // ...
        ;
    }

    public function onPreSetData(FormEvent $event) {
        $form = $event->getForm();

        switch ($this->realtyType) {

            case'SellFlatType':
                $form->add('picture', FileType::class, array(
                    'label' => 'Profile picture (image file)',
                    'required' => false,
                    'empty_data' => null
                ));
                break;
        }
    }

    public function onPostSubmitData(FormEvent $event) {
        $input = $event->getData();
        // dump($input);        die();
    }

}
