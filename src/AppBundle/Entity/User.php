<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\AttributeOverrides({
 *     @ORM\AttributeOverride(name="picture",  column=@ORM\Column(  nullable = true, unique=false ) )
 * })
 */
class User extends BaseUser {

    private $uploadDir = null;

    public function setUploadDir($uploadDir) {

        $this->uploadDir = $uploadDir;

        return $this;
    }

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

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

//    Symfony\Component\HttpFoundation\File\UploadedFile object {
//  test => (bool) false
//  originalName => (string) coffee.jpg
//  mimeType => (string) image/jpeg
//  size => (int) 117713
//  error => (int) 0
//  *SplFileInfo*pathName => (string) /tmp/phpegdxlh
//  *SplFileInfo*fileName => (string) phpegdxlh
//}

    public function setPicture($picture) {

        if (null == $picture) {
            $this->picture = '';
            return $this;
        }

        // dump($this->uploadDir);        die();
        // Generate a unique name for the file before saving it
        $fileName = 'profile-picture' . '.' . $picture->guessExtension();

        // Move the file to the directory where brochures are stored
        $picture->move(
                $this->uploadDir . '/' . $this->getUsername() . '-' . md5($this->getEmail()) . '/', $fileName
        );



        $this->picture = $this->uploadDir . '/' . $this->getUsername() . '-' . md5($this->getEmail()) . '/' . $fileName;

       $this->uploadDir = $this->uploadDir . '/' . $this->getUsername() . '-' . md5($this->getEmail());
        
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

}
