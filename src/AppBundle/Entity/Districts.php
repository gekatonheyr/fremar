<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Districts
 *
 * @ORM\Table(name="districts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DistrictsRepository")
 */
class Districts
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
     * @ORM\Column(name="districtName", type="string", length=100, unique=true)
     */
    private $districtName;

    /**
     * @ORM\OneToMany(targetEntity="Streets", mappedBy="district", cascade={"all"}, orphanRemoval=true)
     */
    private $streets;

    /**
     * Get Streets
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStreets()
    {
        return $this->streets;
    }

    /**
     * @param mixed $streets
     */
    public function setStreets($streets)
    {
        $this->streets = $streets;

    }

    public function __construct()
    {
        $this->streets = new ArrayCollection();
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
     * Set districtName
     *
     * @param string $districtName
     *
     * @return Districts
     */
    public function setDistrictName($districtName)
    {
        $this->districtName = $districtName;

        return $this;
    }

    /**
     * Get districtName
     *
     * @return string
     */
    public function getDistrictName()
    {
        return $this->districtName;
    }

    /**
     * Add street
     *
     * @param \AppBundle\Entity\Streets $street
     *
     * @return Districts
     */
    public function addStreet(\AppBundle\Entity\Streets $street)
    {
        $this->streets[] = $street;

        return $this;
    }

    /**
     * Remove street
     *
     * @param \AppBundle\Entity\Streets $street
     */
    public function removeStreet(\AppBundle\Entity\Streets $street)
    {
        $this->streets->removeElement($street);
    }
}
