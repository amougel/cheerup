<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserProfile
 *
 * @ORM\Entity
 * @ORM\Table(name="cheerup_user_profile")
 */
class UserProfile
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="first_year_contact", type="integer", nullable=true)
     */
    private $firstYearContact;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_address_details", type="string", length=255, nullable=true)
     */
    private $additionalAddressDetails;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=20, nullable=true)
     */
    private $zipCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook_profile", type="string", length=255, nullable=true)
     */
    private $facebookProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="twitter_profile", type="string", length=255, nullable=true)
     */
    private $twitterProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="linked_in_profile", type="string", length=255, nullable=true)
     */
    private $linkedInProfile;

    /**
     * @var string
     *
     * @ORM\Column(name="personal_website", type="string", length=255, nullable=true)
     */
    private $personalWebsite;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone_number", type="integer", nullable=true)
     */
    private $phoneNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="cellphone_number", type="integer", nullable=true)
     */
    private $cellphoneNumber;

    /**
     * @var Picture
     *
     * @ORM\OneToOne(targetEntity="Picture",  cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="picture_id", referencedColumnName="id", nullable=true)
     */
    private $picture;

    public function __construct()
    {
        $this->picture = new Picture();
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
     * Set firstYearContact
     *
     * @param integer $firstYearContact
     * @return UserProfile
     */
    public function setFirstYearContact($firstYearContact)
    {
        $this->firstYearContact = $firstYearContact;

        return $this;
    }

    /**
     * Get firstYearContact
     *
     * @return integer
     */
    public function getFirstYearContact()
    {
        return $this->firstYearContact;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAdditionalAddressDetails()
    {
        return $this->additionalAddressDetails;
    }

    /**
     * @param string $additionalAddressDetails
     */
    public function setAdditionalAddressDetails($additionalAddressDetails)
    {
        $this->additionalAddressDetails = $additionalAddressDetails;
    }

    /**
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Set facebookProfileUrl
     *
     * @param string $facebookProfile
     * @return UserProfile
     */
    public function setFacebookProfile($facebookProfile)
    {
        $this->facebookProfile = $facebookProfile;

        return $this;
    }

    /**
     * Get facebookProfile
     *
     * @return string
     */
    public function getFacebookProfile()
    {
        return $this->facebookProfile;
    }

    /**
     * Set twitterProfileUrl
     *
     * @param string $twitterProfile
     * @return UserProfile
     */
    public function setTwitterProfile($twitterProfile)
    {
        $this->twitterProfile = $twitterProfile;

        return $this;
    }

    /**
     * Get twitterProfile
     *
     * @return string
     */
    public function getTwitterProfile()
    {
        return $this->twitterProfile;
    }

    /**
     * Set linkedInProfile
     *
     * @param string $linkedInProfile
     * @return UserProfile
     */
    public function setLinkedInProfile($linkedInProfile)
    {
        $this->linkedInProfile = $linkedInProfile;

        return $this;
    }

    /**
     * Get linkedInProfile
     *
     * @return string
     */
    public function getLinkedInProfile()
    {
        return $this->linkedInProfile;
    }

    /**
     * Set personalWebsite
     *
     * @param string $personalWebsite
     * @return UserProfile
     */
    public function setPersonalWebsite($personalWebsite)
    {
        $this->personalWebsite = $personalWebsite;

        return $this;
    }

    /**
     * Get personalWebsite
     *
     * @return string
     */
    public function getPersonalWebsite()
    {
        return $this->personalWebsite;
    }

    /**
     * Set phoneNumber
     *
     * @param integer $phoneNumber
     * @return UserProfile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return integer
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set cellphoneNumber
     *
     * @param integer $cellphoneNumber
     * @return UserProfile
     */
    public function setCellphoneNumber($cellphoneNumber)
    {
        $this->cellphoneNumber = $cellphoneNumber;

        return $this;
    }

    /**
     * Get cellphoneNumber
     *
     * @return integer
     */
    public function getCellphoneNumber()
    {
        return $this->cellphoneNumber;
    }

    /**
     * Set picture
     *
     * @param Picture $picture
     *
*@return UserProfile
     */
    public function setPicture(Picture $picture = null)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return Picture
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
