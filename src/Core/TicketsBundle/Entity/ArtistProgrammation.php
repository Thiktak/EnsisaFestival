<?php

namespace Core\TicketsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Core\TicketsBundle\Entity\ArtistProgrammation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ArtistProgrammation
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
     * @var integer $artist_id
     *
     * @ORM\Column(name="artist_id", type="integer")
     */
    private $artist_id;

    /**
     * @var integer $programmation_id
     *
     * @ORM\Column(name="programmation_id", type="integer")
     */
    private $programmation_id;

    /**
     * @ORM\OneToOne(targetEntity="\Core\TicketsBundle\Entity\Artist", mappedBy="id")
     */

    private $artist;
    /**
     * @ORM\OneToOne(targetEntity="\Core\TicketsBundle\Entity\Programmation", mappedBy="id")
     */

    private $programmation;


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
     * Set artist_id
     *
     * @param integer $artistId
     */
    public function setArtistId($artistId)
    {
        $this->artist_id = $artistId;
    }

    /**
     * Get artist_id
     *
     * @return integer 
     */
    public function getArtistId()
    {
        return $this->artist_id;
    }

    /**
     * Set programmation_id
     *
     * @param integer $programmationId
     */
    public function setProgrammationId($programmationId)
    {
        $this->programmation_id = $programmationId;
    }

    /**
     * Get programmation_id
     *
     * @return integer 
     */
    public function getProgrammationId()
    {
        return $this->programmation_id;
    }


    /**
     * Set artist
     *
     * @param Core\TicketsBundle\Entity\Artist $artist
     */
    public function setArtist(\Core\TicketsBundle\Entity\Artist $artist)
    {
        $this->artist = $artist;
    }

    /**
     * Get artist
     *
     * @return Core\TicketsBundle\Entity\Artist 
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set programmation
     *
     * @param Core\TicketsBundle\Entity\Programmation $programmation
     */
    public function setProgrammation(\Core\TicketsBundle\Entity\Programmation $programmation)
    {
        $this->programmation = $programmation;
    }

    /**
     * Get programmation
     *
     * @return Core\TicketsBundle\Entity\Programmation 
     */
    public function getProgrammation()
    {
        return $this->programmation;
    }
}