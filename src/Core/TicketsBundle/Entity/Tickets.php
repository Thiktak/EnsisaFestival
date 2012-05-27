<?php

namespace Core\TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Core\TicketsBundle\Entity\Tickets
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tickets
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string $price
     *
     * @ORM\Column(name="price", type="decimal", scale=2)
     */
    protected $price;
    
    /**
     * @ORM\ManyToMany(targetEntity="\Core\TicketsBundle\Entity\Programmation", inversedBy="tickets")
     * @ORM\JoinTable(name="tickets_programmation")
     */
    protected $programmations;

    /**
     * @ORM\OneToMany(targetEntity="\Core\TicketsBundle\Entity\ShoppedTickets", mappedBy="tickets")
     */
    protected $shopped;


    public function __construct()
    {
        $this->programmations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->getTitle();
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
     * Add programmations
     *
     * @param Core\TicketsBundle\Entity\Programmation $programmations
     */
    public function addProgrammation(\Core\TicketsBundle\Entity\Programmation $programmations)
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


    public function getNbTickets()
    {
        return count($this->shopped);
    }

    public function getNbTotalTickets()
    {
        $total = array();
        foreach( $this->programmations as $prog )
            foreach( $prog->getTickets() as $ticket )
                $total[$ticket->getId()] = $ticket->getNbTickets();

        return array_sum($total);
    }

    public function getStock()
    {
        $total = array();
        foreach( $this->programmations as $prog )
            $total[] = $prog->getStock() - $this->getNbTotalTickets();

        return min($total);
    }

    /**
     * Add shopped
     *
     * @param Core\TicketsBundle\Entity\ShoppedTickets $shopped
     */
    public function addShoppedTickets(\Core\TicketsBundle\Entity\ShoppedTickets $shopped)
    {
        $this->shopped[] = $shopped;
    }

    /**
     * Get shopped
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getShopped()
    {
        return $this->shopped;
    }

    /**
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }
}