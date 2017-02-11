<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Realtyembed
 *
 * @author vova
 */
class Realtyembed {

    protected $description;
    protected $rooms;
    protected $emails;

    public function __construct() {
        $this->rooms = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getEmails() {
        return $this->emails;
    }

    public function setEmails($emails) {
        $this->emails = $emails;
    }

    public function getRooms() {
        return $this->rooms;
    }

}
