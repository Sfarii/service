<?php

namespace ServiceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="sector")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\SectorRepository")
 */
class Sector
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
     * @ORM\Column(name="sectorName", type="string", length=200)
     */
    private $sectorName;

    /**
     * One Sector has Many business Directorys.
     * @ORM\OneToMany(targetEntity="BusinessDirectory", mappedBy="sector")
     */
    private $businessDirectorys;


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
     * Set sectorName
     *
     * @param string $sectorName
     *
     * @return Sector
     */
    public function setSectorName($sectorName)
    {
        $this->sectorName = $sectorName;

        return $this;
    }

    /**
     * Get sectorName
     *
     * @return string
     */
    public function getSectorName()
    {
        return $this->sectorName;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->businessDirectorys = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add businessDirectory
     *
     * @param \ServiceBundle\Entity\BusinessDirectory $businessDirectory
     *
     * @return Sector
     */
    public function addBusinessDirectory(\ServiceBundle\Entity\BusinessDirectory $businessDirectory)
    {
        $this->businessDirectorys[] = $businessDirectory;

        return $this;
    }

    /**
     * Remove businessDirectory
     *
     * @param \ServiceBundle\Entity\BusinessDirectory $businessDirectory
     */
    public function removeBusinessDirectory(\ServiceBundle\Entity\BusinessDirectory $businessDirectory)
    {
        $this->businessDirectorys->removeElement($businessDirectory);
    }

    /**
     * Get businessDirectorys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBusinessDirectorys()
    {
        return $this->businessDirectorys;
    }
}
