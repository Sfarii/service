<?php

namespace ServiceBundle\Entity\UserCV;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Social Media
 *
 * @ORM\Table(name="social_media")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\UserCV\SocialMediaRepository")
 */
class SocialMedia
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
     * @ORM\Column(name="account", type="string", length=200)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 199)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 50)
     */
    private $type;

    /**
     * One User has Many social Media account.
     * @ORM\ManyToOne(targetEntity="\ServiceBundle\Entity\UserManagment\User" ,fetch="EXTRA_LAZY", inversedBy="socialMedias")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


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
     * Set account
     *
     * @param string $account
     *
     * @return socialMedia
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return socialMedia
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set user
     *
     * @param \ServiceBundle\Entity\UserManagment\User $user
     *
     * @return SocialMedia
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
