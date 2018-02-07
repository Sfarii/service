<?php

namespace ServiceBundle\Entity\UserCV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Experience
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserCV\ExperienceRepository")
 */
class Experience
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
     * @ORM\Column(name="title", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="fromYear", type="string", length=4)
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 4)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $fromYear;

    /**
     * @var string
     *
     * @ORM\Column(name="fromMonth", type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 2)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $fromMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="toYear", type="string", length=4)
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 4)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $toYear;

    /**
     * @var string
     *
     * @ORM\Column(name="toMonth", type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 2)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $toMonth;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 500)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $description;

    /**
     * @var bool
     * @ORM\Column(name="currentlyWorkHere", type="boolean")
     */
    private $currentlyWorkHere;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $updated;

    /**
     * One User has Many experiences.
     * @ORM\ManyToOne(targetEntity="\ServiceBundle\Entity\UserManagment\User" ,fetch="EXTRA_LAZY", inversedBy="experiences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
       $this->setUpdated(new \DateTime('now'));

       if ($this->getCreated() == null) {
           $this->setCreated(new \DateTime('now'));
       }
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
     * Set title
     *
     * @param string $title
     *
     * @return Experience
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Experience
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Experience
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set fromYear
     *
     * @param string $fromYear
     *
     * @return Experience
     */
    public function setFromYear($fromYear)
    {
        $this->fromYear = $fromYear;

        return $this;
    }

    /**
     * Get fromYear
     *
     * @return string
     */
    public function getFromYear()
    {
        return $this->fromYear;
    }

    /**
     * Set fromMonth
     *
     * @param string $fromMonth
     *
     * @return Experience
     */
    public function setFromMonth($fromMonth)
    {
        $this->fromMonth = $fromMonth;

        return $this;
    }

    /**
     * Get fromMonth
     *
     * @return string
     */
    public function getFromMonth()
    {
        return $this->fromMonth;
    }

    /**
     * Set toYear
     *
     * @param string $toYear
     *
     * @return Experience
     */
    public function setToYear($toYear)
    {
        $this->toYear = $toYear;

        return $this;
    }

    /**
     * Get toYear
     *
     * @return string
     */
    public function getToYear()
    {
        return $this->toYear;
    }

    /**
     * Set toMonth
     *
     * @param string $toMonth
     *
     * @return Experience
     */
    public function setToMonth($toMonth)
    {
        $this->toMonth = $toMonth;

        return $this;
    }

    /**
     * Get toMonth
     *
     * @return string
     */
    public function getToMonth()
    {
        return $this->toMonth;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Experience
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
     * Set currentlyWorkHere
     *
     * @param boolean $currentlyWorkHere
     *
     * @return Experience
     */
    public function setCurrentlyWorkHere($currentlyWorkHere)
    {
        $this->currentlyWorkHere = $currentlyWorkHere;

        return $this;
    }

    /**
     * Get currentlyWorkHere
     *
     * @return bool
     */
    public function getCurrentlyWorkHere()
    {
        return $this->currentlyWorkHere;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Experience
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Experience
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }


    /**
     * Set user
     *
     * @param \ServiceBundle\Entity\UserManagment\User $user
     *
     * @return Experience
     */
    public function setUser(\ServiceBundle\Entity\UserManagment\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ServiceBundle\Entity\UserManagment\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
