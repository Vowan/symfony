<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="realties")
 */
class Room {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $room_sq;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $room_photo;

    /**
     * @ORM\ManyToOne(targetEntity="Realty", inversedBy="rooms")
     * @ORM\JoinColumn(name="realty_id", referencedColumnName="id")
     */
    private $realty;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function toString() {
        return $this->name;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set roomSq
     *
     * @param string $roomSq
     *
     * @return Room
     */
    public function setRoomSq($roomSq)
    {
        $this->room_sq = $roomSq;

        return $this;
    }

    /**
     * Get roomSq
     *
     * @return string
     */
    public function getRoomSq()
    {
        return $this->room_sq;
    }

    /**
     * Set roomPhoto
     *
     * @param string $roomPhoto
     *
     * @return Room
     */
    public function setRoomPhoto($roomPhoto)
    {
        $this->room_photo = $roomPhoto;

        return $this;
    }

    /**
     * Get roomPhoto
     *
     * @return string
     */
    public function getRoomPhoto()
    {
        return $this->room_photo;
    }

    /**
     * Set realty
     *
     * @param \AppBundle\Entity\Realty $realty
     *
     * @return Room
     */
    public function setRealty(\AppBundle\Entity\Realty $realty = null)
    {
        $this->realty = $realty;

        return $this;
    }

    /**
     * Get realty
     *
     * @return \AppBundle\Entity\Realty
     */
    public function getRealty()
    {
        return $this->realty;
    }
}
