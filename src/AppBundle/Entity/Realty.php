<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="realties")
 */

class Realty {
    
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
    private $title;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $price;
    
    /**
     * @var string
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    
    private $latitude;
    
    /**
     * @var string
     *
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     */
    private $longitude;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    
    private $country;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    
    private $region;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    
    private $district;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    
    private $street;
    
     /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    
    private $st_number;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Town", inversedBy="realties")
     * @ORM\JoinColumn(name="town_id", referencedColumnName="id")
     */
    private $town;
    
     /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="realties")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $agent;
    

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
     * Set name
     *
     * @param string $name
     *
     * @return Realty
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set town
     *
     * @param \AppBundle\Entity\Town $town
     *
     * @return Realty
     */
    public function setTown(\AppBundle\Entity\Town $town = null)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return \AppBundle\Entity\Town
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set agent
     *
     * @param \AppBundle\Entity\User $agent
     *
     * @return Realty
     */
    public function setAgent(\AppBundle\Entity\User $agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return \AppBundle\Entity\User
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Realty
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Realty
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Realty
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Realty
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Realty
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Realty
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set district
     *
     * @param string $district
     *
     * @return Realty
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Realty
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set stNumber
     *
     * @param string $stNumber
     *
     * @return Realty
     */
    public function setStNumber($stNumber)
    {
        $this->st_number = $stNumber;

        return $this;
    }

    /**
     * Get stNumber
     *
     * @return string
     */
    public function getStNumber()
    {
        return $this->st_number;
    }
}
