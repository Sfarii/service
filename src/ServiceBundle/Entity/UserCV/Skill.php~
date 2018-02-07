<?php

namespace ServiceBundle\Entity\UserCV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Skill
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="skills")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserCV\SkillsRepository")
 */
class Skill
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
     * @ORM\Column(name="skill", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $skill;

    /**
     * @var string
     *
     * @ORM\Column(name="progress", type="string", length=2)
     * @Assert\NotBlank()
     * @Assert\Length(min = 1, max = 2)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $progress;

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
     * One User has Many Skills.
     * @ORM\ManyToOne(targetEntity="\ServiceBundle\Entity\UserManagment\User" ,fetch="EXTRA_LAZY", inversedBy="skills")
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
     * Set skill
     *
     * @param string $skill
     *
     * @return Skill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set progress
     *
     * @param string $progress
     *
     * @return Skill
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    /**
     * Get progress
     *
     * @return string
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Skill
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
     * @return Skill
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
     * @return Skill
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
