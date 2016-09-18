<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contacts
 *
 * @ORM\Table(name="contacts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactsRepository")
 */
class Contacts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="telNumber", type="string", length=255)
     */
    private $telNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="emailAddress", type="string", length=255)
     */
    private $emailAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="resPlaceName", type="string", length=255)
     */
    private $resPlaceName;

    /**
     * @var int
     *
     * @ORM\Column(name="resPlaceDistrict", type="string", length=255)
     */
    private $resPlaceDistrict;

    /**
     * @var int
     *
     * @ORM\Column(name="resPlaceStreet", type="string", length=255)
     */
    private $resPlaceStreet;

    /**
     * @var string
     *
     * @ORM\Column(name="resPlaceHouseNumber", type="string", length=255)
     */
    private $resPlaceHouseNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="resPlaceAppartNumber", type="string", length=255)
     */
    private $resPlaceAppartNumber;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Contacts
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Contacts
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set telNumber
     *
     * @param string $telNumber
     *
     * @return Contacts
     */
    public function setTelNumber($telNumber)
    {
        $this->telNumber = $telNumber;

        return $this;
    }

    /**
     * Get telNumber
     *
     * @return string
     */
    public function getTelNumber()
    {
        return $this->telNumber;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return Contacts
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;

        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set resPlaceName
     *
     * @param string $resPlaceName
     *
     * @return Contacts
     */
    public function setResPlaceName($resPlaceName)
    {
        $this->resPlaceName = $resPlaceName;

        return $this;
    }

    /**
     * Get resPlaceName
     *
     * @return string
     */
    public function getResPlaceName()
    {
        return $this->resPlaceName;
    }

    /**
     * Set resPlaceDistrict
     *
     * @param string $resPlaceDistrict
     *
     * @return Contacts
     */
    public function setResPlaceDistrict($resPlaceDistrict)
    {
        $this->resPlaceDistrict = $resPlaceDistrict;

        return $this;
    }

    /**
     * Get resPlaceDistrict
     *
     * @return string
     */
    public function getResPlaceDistrict()
    {
        return $this->resPlaceDistrict;
    }

    /**
     * Set resPlaceStreet
     *
     * @param string $resPlaceStreet
     *
     * @return Contacts
     */
    public function setResPlaceStreet($resPlaceStreet)
    {
        $this->resPlaceStreet = $resPlaceStreet;

        return $this;
    }

    /**
     * Get resPlaceStreetId
     *
     * @return string
     */
    public function getResPlaceStreet()
    {
        return $this->resPlaceStreet;
    }

    /**
     * Set resPlaceHouseNumber
     *
     * @param string $resPlaceHouseNumber
     *
     * @return Contacts
     */
    public function setResPlaceHouseNumber($resPlaceHouseNumber)
    {
        $this->resPlaceHouseNumber = $resPlaceHouseNumber;

        return $this;
    }

    /**
     * Get resPlaceHouseNumber
     *
     * @return string
     */
    public function getResPlaceHouseNumber()
    {
        return $this->resPlaceHouseNumber;
    }

    /**
     * Set resPlaceAppartNumber
     *
     * @param string $resPlaceAppartNumber
     *
     * @return Contacts
     */
    public function setResPlaceAppartNumber($resPlaceAppartNumber)
    {
        $this->resPlaceAppartNumber = $resPlaceAppartNumber;

        return $this;
    }

    /**
     * Get resPlaceAppartNumber
     *
     * @return string
     */
    public function getResPlaceAppartNumber()
    {
        return $this->resPlaceAppartNumber;
    }
}
