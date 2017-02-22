<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="picture",  column=@ORM\Column(  nullable = true, unique=false ) )
 * })
 */
class User extends BaseUser {

    
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
     /**
     * @ORM\Column(type="string")
     *
     * 
     */
    private $sername;
    
      /**
     * @ORM\Column(type="string")
     *
     * 
     */
    private $phone;
    
      /**
     * @ORM\Column(type="string")
     *
     * 
     */
    private $skype;
    
       /**
     * @ORM\Column(type="string")
     *
     * 
     */
    private $viber;

    /**
     * @var Comment[]|ArrayCollection
     *
     * @ORM\OneToMany(
     *      targetEntity="AppBundle\Entity\Realty",
     *      mappedBy="agent",
     *      orphanRemoval=true
     * )
     * 
     */
    private $realties;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Town", inversedBy="agents")
     * @ORM\JoinTable(name="agents_towns")
     */
    private $towns;

    public function __construct() {
        parent::__construct();

        $this->realties = new ArrayCollection();
        $this->towns = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string")
     *
     * 
     */
    private $picture;

    public function getPicture() {
        return $this->picture;
    }

    public function setPicture($picture) {

        $this->picture = $picture;

        return $this;
    }

    /**
     * Add realty
     *
     * @param \AppBundle\Entity\Realty $realty
     *
     * @return User
     */
    public function addRealty(\AppBundle\Entity\Realty $realty) {
        $this->realties[] = $realty;

        return $this;
    }

    /**
     * Remove realty
     *
     * @param \AppBundle\Entity\Realty $realty
     */
    public function removeRealty(\AppBundle\Entity\Realty $realty) {
        $this->realties->removeElement($realty);
    }

    /**
     * Get realties
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealties() {
        return $this->realties;
    }

    /**
     * Add town
     *
     * @param \AppBundle\Entity\Town $town
     *
     * @return User
     */
    public function addTown(\AppBundle\Entity\Town $town) {
        $this->towns[] = $town;

        return $this;
    }

    /**
     * Remove town
     *
     * @param \AppBundle\Entity\Town $town
     */
    public function removeTown(\AppBundle\Entity\Town $town) {
        $this->towns->removeElement($town);
    }

    /**
     * Get towns
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTowns() {
        return $this->towns;
    }


    /**
     * Set sername
     *
     * @param string $sername
     *
     * @return User
     */
    public function setSername($sername)
    {
        $this->sername = $sername;

        return $this;
    }

    /**
     * Get sername
     *
     * @return string
     */
    public function getSername()
    {
        return $this->sername;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set skype
     *
     * @param string $skype
     *
     * @return User
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set viber
     *
     * @param string $viber
     *
     * @return User
     */
    public function setViber($viber)
    {
        $this->viber = $viber;

        return $this;
    }

    /**
     * Get viber
     *
     * @return string
     */
    public function getViber()
    {
        return $this->viber;
    }
}
