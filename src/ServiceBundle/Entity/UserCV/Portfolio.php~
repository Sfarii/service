<?php

namespace ServiceBundle\Entity\UserCV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Portfolio
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="portfolio")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserCV\PortfolioRepository")
 * @Vich\Uploadable
 */
class Portfolio
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
     * @ORM\Column(name="projectName", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $projectName;

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
     * @ORM\Column(name="toMonth", type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 2)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $toMonth;

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
     * @var bool
     * @ORM\Column(name="projectOnGoing", type="boolean")
     */
    private $projectOnGoing;

    /**
     * @var string
     *
     * @ORM\Column(name="projectURL", type="text")
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    private $projectURL;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 500)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $description;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="portfolio_image", fileNameProperty="imageName")
     * @Assert\Image()
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

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
     * One User has Many portfolios.
     * @ORM\ManyToOne(targetEntity="\ServiceBundle\Entity\UserManagment\User" ,fetch="EXTRA_LAZY", inversedBy="portfolios")
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
     * Set projectName
     *
     * @param string $projectName
     *
     * @return Portfolio
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Portfolio
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updated = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Portfolio
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set fromYear
     *
     * @param string $fromYear
     *
     * @return Portfolio
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
     * @return Portfolio
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
     * Set toMonth
     *
     * @param string $toMonth
     *
     * @return Portfolio
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
     * Set toYear
     *
     * @param string $toYear
     *
     * @return Portfolio
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
     * Set projectOnGoing
     *
     * @param boolean $projectOnGoing
     *
     * @return Portfolio
     */
    public function setProjectOnGoing($projectOnGoing)
    {
        $this->projectOnGoing = $projectOnGoing;

        return $this;
    }

    /**
     * Get projectOnGoing
     *
     * @return bool
     */
    public function getProjectOnGoing()
    {
        return $this->projectOnGoing;
    }

    /**
     * Set projectURL
     *
     * @param string $projectURL
     *
     * @return Portfolio
     */
    public function setProjectURL($projectURL)
    {
        $this->projectURL = $projectURL;

        return $this;
    }

    /**
     * Get projectURL
     *
     * @return string
     */
    public function getProjectURL()
    {
        return $this->projectURL;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Portfolio
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Portfolio
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
     * @return Portfolio
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
     * @return Portfolio
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
