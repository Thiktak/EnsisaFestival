<?php

namespace Core\TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Core\TicketsBundle\Entity\ShoppedTickets
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifeCycleCallbacks
 */
class ShoppedTickets
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="datetime")
     */
    protected $date;

    /**
     * @var integer $paid
     *
     * @ORM\Column(name="paid", type="boolean", nullable="true")
     */
    protected $paid;

    /**
     * @var integer $token
     *
     * @ORM\Column(name="token", type="string", length="30", nullable="true")
     */
    protected $token;

    /**
     * @var integer $salt
     *
     * @ORM\Column(name="salt", type="string", length="32")
     */
    protected $salt;

    /**
     * @ORM\ManyToOne(targetEntity="\Core\TicketsBundle\Entity\Tickets", inversedBy="shopped")
     */
    protected $tickets;

    /**
     * @ORM\ManyToOne(targetEntity="\Core\UserBundle\Entity\User")
     */
    protected $user;


    /**
     * @ORM\PrePersist
     */
    function PrePersist() {
        // set default date
        $this->date = new \DateTime('now');
        $this->salt = md5($this->date->format('U'));
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
     * Set tickets
     *
     * @param Core\TicketsBundle\Entity\Tickets $tickets
     */
    public function setTickets(\Core\TicketsBundle\Entity\Tickets $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * Get tickets
     *
     * @return Core\TicketsBundle\Entity\Tickets 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set user
     *
     * @param Core\UserBundle\Entity\User $user
     */
    public function setUser(\Core\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Core\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set paid
     *
     * @param integer $paid
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    }

    /**
     * Get paid
     *
     * @return integer 
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set token
     *
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set salt
     *
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }
}