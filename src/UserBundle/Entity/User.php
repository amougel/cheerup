<?php
namespace UserBundle\Entity;

use AppBundle\Entity\Group;
use AppBundle\Entity\UserProfile;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="cheerup_user")
 */
class User extends BaseUser
{
    const NETWORK_VOLUNTEER = 'NETWORK_VOLUNTEER';
    const FORMER_MEMBER     = 'FORMER_MEMBER';

    private static $profileTypes = [
        self::NETWORK_VOLUNTEER => 'user.profile_type.network_volunteer',
        self::FORMER_MEMBER     => 'user.profile_type.former_member'
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="profile_type", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Choice(callback = "getProfileTypes")
     */
    private $profileType;

    /**
     * @ORM\Column(name="firstname", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $firstname;

    /**
     * @ORM\Column(name="lastname", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $lastname;

    /**
     * @var UserProfile
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\UserProfile", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_profile_id", referencedColumnName="id")
     */
    private $userProfile;

    /**
     * @var Group
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="members")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id", nullable=true)
     */
    private $offshootOfOrigin;

    /**
     * @var SecurityGroup
     *
     * @ORM\ManyToMany(targetEntity="UserBundle\Entity\SecurityGroup")
     * @ORM\JoinTable(name="cheerup_user_user_security_group",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="security_group_id", referencedColumnName="id")}
     * )
     *
     * This attribute has to be named $groups and not $securityGroups because it is meant to override its parent
     */
    protected $groups;

    /**
     * @ORM\Column(name="validated", type="boolean", length=255)
     */
    private $validated = false;

    public function __construct()
    {
        parent::__construct();
        $this->userProfile = new UserProfile();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getFullName()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * @return string
     */
    public function getProfileType()
    {
        return $this->profileType;
    }

    /**
     * @param string $profileType
     */
    public function setProfileType($profileType)
    {
        $this->profileType = $profileType;
    }

    /**
     * @return array
     */
    public static function getProfileTypes()
    {
        return array_keys(self::$profileTypes);
    }

    /**
     * @return array
     */
    public static function getProfileTypesChoices()
    {
        return self::$profileTypes;
    }

    /**
     * @return UserProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * @param UserProfile $userProfile
     */
    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;
    }

    /**
     * @return Group
     */
    public function getOffshootOfOrigin()
    {
        return $this->offshootOfOrigin;
    }

    /**
     * @param Group $offshootOfOrigin
     */
    public function setOffshootOfOrigin($offshootOfOrigin)
    {
        $this->offshootOfOrigin = $offshootOfOrigin;
    }

    /**
     * @return boolean
     */
    public function isValidated()
    {
        return $this->validated;
    }

    /**
     * @param boolean $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * Aliases of AbstractUser groups
     */

    /**
     * Gets the groups granted to the user.
     *
     * @return Collection
     */
    public function getSecurityGroups()
    {
        return parent::getGroups();
    }

    public function getSecurityGroupNames()
    {
        return parent::getGroupNames();
    }

    public function hasSecurityGroup($name)
    {
        return parent::hasGroup($name);
    }

    public function addSecurityGroup(GroupInterface $group)
    {
        return parent::addGroup($group);
    }

    public function removeSecurityGroup(GroupInterface $group)
    {
        return parent::removeGroup($group);
    }
}
