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
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use AppBundle\Form\Type\AddressType;
use AppBundle\Form\Type\RealtymainType;
use AppBundle\Form\Type\UserType;
use AppBundle\Form\Type\RoomType;
use AppBundle\Entity\Room;
use AppBundle\Entity\Town;

class RealtyFormType extends AbstractType {

    private $dr;
    private $ts;
    private $realtyType;
    private $root;

    public function __construct(Registry $dr, TokenStorage $ts, $root) {
        $this->dr = $dr;
        $this->ts = $ts;
        $this->root = $root;

        // dump($dr);        die();
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

        $user_upload_dir = explode('/', trim($user->getPicture(), '/'))[0] . '/' . $form->getData()->getUuid();


        //     dump($input);        die();

        $model = $form->getData();

        $model->setType($this->realtyType);

        if (array_key_exists('address', $input)) {

            $model->setLatitude($input['address']['latitude']);
            $model->setLongitude($input['address']['longitude']);
            $model->setCountry($input['address']['country']);
            $model->setRegion($input['address']['region']);

            $repository = $this->dr->getRepository('AppBundle:Town');

            $town = $repository->getTownByNameAndRegion($input['address']['town'], $input['address']['region']);


            if (!$town) {
                $town = new Town();
                $town->setName($input['address']['town']);
                $town->setRegion($input['address']['region']);
            }

            //dump( $town);          //  die();
            $model->setTown($town);

            $model->setDistrict($input['address']['district']);
            $model->setStreet($input['address']['street']);
            $model->setStNumber($input['address']['st_number']);
        }

        if (array_key_exists('realtymain', $input)) {

            $model->setSqTotal($input['realtymain']['sqTotal']);
            $model->setSqLife($input['realtymain']['sqLife']);
            $model->setSqKitchen($input['realtymain']['sqKitchen']);
            $model->setLevel($input['realtymain']['level']);
            $model->setLevels($input['realtymain']['levels']);
            $model->setPrice($input['realtymain']['price']);
            //         $model->setPrice($input['realtymain']['price']);
        }


        if (array_key_exists('rooms', $input)) {

            foreach ($input['rooms'] as $key => $value) {


                $room = new Room();
                $room->setName($value['name']);
                $room->setRoomSq($value['room_sq']);
                $room->setRealty($form->getData());
                $form->getData()->addRoom($room);

                if (array_key_exists('room_photo', $value)) {
                    foreach ($value['room_photo'] as $int => $photo) {

                        $input_ext = $photo->getClientOriginalExtension();

                        $photo->move($this->root . '/' . $user_upload_dir . '/', $value['name'] . '-' . $int . '.' . $input_ext);

                        $room->addRoomPhoto('/' . $user_upload_dir . '/' . $value['name'] . '-' . $int . '.' . $input_ext);
                        // dump($photo); 
                    }
                }
            }
        }
        // die();


        $model->setAgent($user);


        //dump($form->getData());     die();
    }

}
