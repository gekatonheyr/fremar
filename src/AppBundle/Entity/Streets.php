<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Streets
 *
 * @ORM\Table(name="streets")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StreetsRepository")
 */
class Streets
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
     * @ORM\Column(name="streetName", type="string", length=100, unique=true)
     */
    private $streetName;

    /**
     * @ORM\ManyToOne(targetEntity="Districts", inversedBy="streets",)
     *
     */
    private $district;

    /**
     * @return \AppBundle\Entity\Districts
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district)
    {
        $this->district = $district;

    }

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
     * Set streetName
     *
     * @param string $streetName
     *
     * @return Streets
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

}
