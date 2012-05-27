<?php

namespace Core\TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Core\TicketsBundle\Entity\Programmation
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class Programmation
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    protected $date;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var integer $stock
     *
     * @ORM\Column(name="stock", type="integer")
     */
    protected $stock;
    
    /**
     * @ORM\ManyToMany(targetEntity="\Core\TicketsBundle\Entity\Artist", mappedBy="programmations")
     */
    protected $artists;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\TicketsBundle\Entity\Tickets", mappedBy="programmations")
     */
    protected $tickets;


    public function __toString() {
        return (string) $this->getDate()->format('d/m/Y');
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
    public function __construct()
    {
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
     * Add artists
     *
     * @param Core\TicketsBundle\Entity\Artist $artists
     */
    public function addArtist(\Core\TicketsBundle\Entity\Artist $artists)
    {
        $this->artists[] = $artists;
    }

    /**
     * Get artists
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Add tickets
     *
     * @param Core\TicketsBundle\Entity\Tickets $tickets
     */
    public function addTickets(\Core\TicketsBundle\Entity\Tickets $tickets)
    {
        $this->tickets[] = $tickets;
    }

    /**
     * Get tickets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}