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
     * @var text $descr
     *
     * @ORM\Column(name="descr", type="text")
     */
    private $descr;

    /**
     * @var text $page
     *
     * @ORM\Column(name="page", type="text")
     */
    private $page;


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
}