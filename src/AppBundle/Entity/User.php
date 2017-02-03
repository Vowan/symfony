<?php

// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser {
    
    private  $uploadDir = null;
    
    public function setUploadDir($uploadDir) {
        
        $this->uploadDir = $uploadDir;
                
        return $this;
        
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    

    public function __construct() {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Please, upload the your photo as jpg or png file.")
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
        
       // dump($this->uploadDir);        die();
        
        // Generate a unique name for the file before saving it
            $fileName = 'profile-picture'.'.'.$picture->guessExtension();

            // Move the file to the directory where brochures are stored
            $picture->move(
                $this->uploadDir.'/'.$this->getUsername().'-'.md5($this->getEmail()).'/',
                    $fileName
            );

                               
        
        $this->picture =$this->uploadDir.'/'.$this->getUsername().'-'.md5($this->getEmail()).'/'. $fileName;

        return $this;
    }

}
