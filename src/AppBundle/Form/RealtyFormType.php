<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use AppBundle\Form\Type\AddressType;
use AppBundle\Form\Type\RealtymainType;
use AppBundle\Form\Type\UserType;
use AppBundle\Form\Type\RoomType;
use AppBundle\Entity\Room;

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
                ->add('save', SubmitType::class, array(
                    'attr' => array('class' => 'save qqqq'),
                ))
                ->addEventListener(
                        FormEvents::PRE_SET_DATA, array($this, 'onPreSetData')
                )
                ->addEventListener(
                        FormEvents::PRE_SUBMIT, array($this, 'onPostSubmitData')
        );
    }

    public function onPreSetData(FormEvent $event) {
        $form = $event->getForm();

        switch ($this->realtyType) {

            case'SellFlatType':
                $form->add('address', AddressType::class, array(
                    'mapped' => false,
                    'label' => 'Адрес',
                ));

                $form->add('realtymain', RealtymainType::class, array(
                    'mapped' => false,
                    'label' => 'Main',
                ));

                $form->add('user', UserType::class, array(
                    'mapped' => false,
                    'label' => false,
                ));

                $form->add('rooms', CollectionType::class, array(
                    // each entry in the array will be an "email" field
                    'entry_type' => RoomType::class,
                    'mapped' => false,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ));
                break;
        }
    }

    public function onPostSubmitData(FormEvent $event) {
        $input = $event->getData();
        $form = $event->getForm();
        $user = $this->ts->getToken()->getUser();
        
       

        dump($input, $user); die();
        
        if (array_key_exists('rooms', $input)) { // && is_array($input['rooms'])){
            foreach ($input['rooms'] as $key => $value) {

                $room = new Room();
                $room->setName($input['rooms'][$key]['name']);
                $room->setRoomSq($input['rooms'][$key]['room_sq']);
                $room->setRealty($form->getData());
                $form->getData()->addRoom($room);
            }
        }
        
  
//
       dump($form->getData());
//        //      die();
    }

}
