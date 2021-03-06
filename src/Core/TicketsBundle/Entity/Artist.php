<?php

namespace Core\TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Core\TicketsBundle\Entity\Artist
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Core\TicketsBundle\Entity\ArtistRepository")
 */
class Artist
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=50)
     */
    private $gender;

    /**
     * @var string $country
     *
     * @ORM\Column(name="contry", type="string", length=100)
     */
    private $country;

    /**
     * @var text $descr
     *
     * @ORM\Column(name="descr", type="text", nullable="true")
     */
    private $descr;

    /**
     * @var text $page
     *
     * @ORM\Column(name="page", type="text", nullable="true")
     */
    private $page;

    /**
     * @var string $www
     *
     * @ORM\Column(name="www", type="string", length=255, nullable="true")
     */
    private $www;

    /**
     * @var string $youtube
     *
     * @ORM\Column(name="youtube", type="string", length=255, nullable="true")
     */
    private $youtube;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255, nullable="true")
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\TicketsBundle\Entity\Programmation", inversedBy="artists")
     * @ORM\JoinTable(name="artist_programmation")
     */
    protected $programmations;


    public function __toString() {
        return (string) $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
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
     * Set descr
     *
     * @param text $descr
     */
    public function setDescr($descr)
    {
        $this->descr = $descr;
    }

    /**
     * Get descr
     *
     * @return text 
     */
    public function getDescr()
    {
        return $this->descr;
    }

    /**
     * Set page
     *
     * @param text $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * Get page
     *
     * @return text 
     */
    public function getPage()
    {
        return $this->page;
    }
    /**
     * @var string $contry
     */
    private $contry;


    /**
     * Set gender
     *
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set contry
     *
     * @param string $contry
     */
    public function setContry($contry)
    {
        $this->contry = $contry;
    }

    /**
     * Get contry
     *
     * @return string 
     */
    public function getContry()
    {
        return $this->contry;
    }

    /**
     * Set www
     *
     * @param string $www
     */
    public function setWww($www)
    {
        $this->www = $www;
    }

    /**
     * Get www
     *
     * @return string 
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * Set youtube
     *
     * @param string $youtube
     */
    public function setYoutube($youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * Get youtube
     *
     * @return string 
     */
    public function getYoutube()
    {
        return $this->youtube;
    }

    /**
     * Set image
     *
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    public function __construct()
    {
        $this->programmations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     * Add programmations
     *
     * @param Core\TicketsBundle\Entity\Artist $programmations
     */
    public function addArtist(\Core\TicketsBundle\Entity\Artist $programmations)
    {
        $this->programmations[] = $programmations;
    }

    /**
     * Get programmations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getProgrammations()
    {
        return $this->programmations;
    }
}