<?php

namespace Core\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Entity(repositoryClass="Core\UserBundle\Entity\UserRepository")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}