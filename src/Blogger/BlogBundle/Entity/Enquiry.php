<?php

// src/Blogger/BlogBundle/Entity/Enquiry.php

namespace Blogger\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Enquiry {

    /**
     * @Assert\NotBlank()
     */
    protected $name;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    protected $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    protected $subject;
    
    
    /**   
          * @Assert\Length(
     *      min = 10,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     * )
     * 
     */
    protected $body;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
    }

    public function getBody() {
        return $this->body;
    }

    public function setBody($body) {
        $this->body = $body;
    }

}
