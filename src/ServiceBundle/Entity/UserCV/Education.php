<?php

namespace ServiceBundle\Entity\UserCV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Education
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="education")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserCV\EducationRepository")
 */
class Education
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
     * @ORM\Column(name="school", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="degree", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $degree;

    /**
     * @var string
     *
     * @ORM\Column(name="fieldOfStudy", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $fieldOfStudy;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 49)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $grade;

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
     * @ORM\Column(name="toYear", type="string", length=4)
     * @Assert\NotBlank()
     * @Assert\Length(min = 4, max = 4)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $toYear;

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
     * One User has Many educations.
     * @ORM\ManyToOne(targetEntity="\ServiceBundle\Entity\UserManagment\User" ,fetch="EXTRA_LAZY", inversedBy="educations")
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
     * Set school
     *
     * @param string $school
     *
     * @return Education
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set degree
     *
     * @param string $degree
     *
     * @return Education
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set fieldOfStudy
     *
     * @param string $fieldOfStudy
     *
     * @return Education
     */
    public function setFieldOfStudy($fieldOfStudy)
    {
        $this->fieldOfStudy = $fieldOfStudy;

        return $this;
    }

    /**
     * Get fieldOfStudy
     *
     * @return string
     */
    public function getFieldOfStudy()
    {
        return $this->fieldOfStudy;
    }

    /**
     * Set grade
     *
     * @param string $grade
     *
     * @return Education
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Education
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
     * Set fromYear
     *
     * @param string $fromYear
     *
     * @return Education
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
     * Set toYear
     *
     * @param string $toYear
     *
     * @return Education
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Education
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
     * @return Education
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
     * @return Education
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
