<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use UserBundle\Entity\User;

/**
 * Group
 *
 * @ORM\Entity
 * @UniqueEntity("name")
 * @ORM\Table(name="cheerup_group")
 */
class Group
{
    const GROUP    = 'GROUP';
    const OFFSHOOT = 'OFFSHOOT';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="Picture",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    private $offshoot = false;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="offshootOfOrigin")
     */
    private $members;

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
     * @return Group
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
     * Set description
     *
     * @param string $description
     *
     * @return Group
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param Picture $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getGroupType()
    {
        if ($this->isOffshoot()) {
            return $this::OFFSHOOT;
        }

        return $this::GROUP;
    }

    /**
     * @return User
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param User $members
     */
    public function setMembers($members)
    {
        $this->members = $members;
    }

    /**
     * @return boolean
     */
    public function isOffshoot()
    {
        return $this->offshoot;
    }

    /**
     * @param boolean $offshoot
     */
    public function setOffshoot($offshoot)
    {
        $this->offshoot = $offshoot;
    }
}
