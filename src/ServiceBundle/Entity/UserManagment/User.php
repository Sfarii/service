<?php

namespace ServiceBundle\Entity\UserManagment;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\User\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $lastName;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * One User has Many alert & One alert has Many Users.
     * @ORM\ManyToMany(targetEntity="\ServiceBundle\Entity\Administration\Alert", mappedBy="users")
     */
    private $alerts;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     * @Assert\Date()
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text", nullable=true)
     * @Assert\Length(min = 2, max = 500)
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="current_position", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     * @Assert\Regex(pattern="/^[a-z0-9 .\-]+$/i" ,match=true)
     */
    private $currentPosition;

    /**
     * @var string
     *
     * @ORM\Column(name="left_color", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     */
    private $leftColor;

    /**
     * @var string
     *
     * @ORM\Column(name="right_color", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     */
    private $rightColor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_condidate", type="boolean")
     */
    private $isCondidate;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     * @Assert\Length(min = 8, max = 50)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=200, nullable=true)
     * @Assert\Length(min = 2, max = 199)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="code_ZIP", type="string", length=50, nullable=true)
     * @Assert\Length(min = 4, max = 50)
     * @Assert\Regex(pattern="/^[0-9.\-]+$/i" ,match=true)
     */
    private $codeZIP;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=150, nullable=true)
     * @Assert\Length(min = 2, max = 150)
     * @Assert\Regex(pattern="/^[A-Za-z0-9 .\-]+$/i" ,match=true)
     */
    private $address;

    /**
     * One user has Many educations.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Education", mappedBy="user")
     */
    private $educations;

    /**
     * One user has Many experiences.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Experience", mappedBy="user")
     */
    private $experiences;

    /**
     * One user has Many interests & One interest has Many users.
     * @ORM\ManyToMany(targetEntity="\ServiceBundle\Entity\UserCV\Interests", mappedBy="users")
     */
    private $interests;

    /**
     * One user has Many languages.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Language", mappedBy="user")
     */
    private $languages;

    /**
     * One user has Many socialMedias.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\SocialMedia", mappedBy="user")
     */
    private $socialMedias;

    /**
     * One user has Many software.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Software", mappedBy="user")
     */
    private $softwares;

    /**
     * One user has Many portfolios.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Portfolio", mappedBy="user")
     */
    private $portfolios;

    /**
     * One user has Many skills.
     * @ORM\OneToMany(targetEntity="\ServiceBundle\Entity\UserCV\Skill", mappedBy="user")
     */
    private $skills;

    /**
     * @var datetime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\PrePersist
     */
    public function updateUser()
    {
        if ($this->isSuperAdmin()){
          $this->isCondidate = false;
        }else{
          $this->roles = array(self::ROLE_DEFAULT);
          $this->isCondidate = true;
          $this->setCreated(new \DateTime('now'));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add alert
     *
     * @param \ServiceBundle\Entity\Administration\Alert $alert
     *
     * @return User
     */
    public function addAlert(\ServiceBundle\Entity\Administration\Alert $alert)
    {
        $this->alerts[] = $alert;

        return $this;
    }

    /**
     * Remove alert
     *
     * @param \ServiceBundle\Entity\Administration\Alert $alert
     */
    public function removeAlert(\ServiceBundle\Entity\Administration\Alert $alert)
    {
        $this->alerts->removeElement($alert);
    }

    /**
     * Get alerts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set summary
     *
     * @param string $summary
     *
     * @return User
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set currentPosition
     *
     * @param string $currentPosition
     *
     * @return User
     */
    public function setCurrentPosition($currentPosition)
    {
        $this->currentPosition = $currentPosition;

        return $this;
    }

    /**
     * Get currentPosition
     *
     * @return string
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    /**
     * Set leftColor
     *
     * @param string $leftColor
     *
     * @return User
     */
    public function setLeftColor($leftColor)
    {
        $this->leftColor = $leftColor;

        return $this;
    }

    /**
     * Get leftColor
     *
     * @return string
     */
    public function getLeftColor()
    {
        return $this->leftColor;
    }

    /**
     * Set rightColor
     *
     * @param string $rightColor
     *
     * @return User
     */
    public function setRightColor($rightColor)
    {
        $this->rightColor = $rightColor;

        return $this;
    }

    /**
     * Get rightColor
     *
     * @return string
     */
    public function getRightColor()
    {
        return $this->rightColor;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set codeZIP
     *
     * @param string $codeZIP
     *
     * @return User
     */
    public function setCodeZIP($codeZIP)
    {
        $this->codeZIP = $codeZIP;

        return $this;
    }

    /**
     * Get codeZIP
     *
     * @return string
     */
    public function getCodeZIP()
    {
        return $this->codeZIP;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add education
     *
     * @param \ServiceBundle\Entity\UserCV\Education $education
     *
     * @return User
     */
    public function addEducation(\ServiceBundle\Entity\UserCV\Education $education)
    {
        $this->educations[] = $education;

        return $this;
    }

    /**
     * Remove education
     *
     * @param \ServiceBundle\Entity\UserCV\Education $education
     */
    public function removeEducation(\ServiceBundle\Entity\UserCV\Education $education)
    {
        $this->educations->removeElement($education);
    }

    /**
     * Get educations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEducations()
    {
        return $this->educations;
    }

    /**
     * Add experience
     *
     * @param \ServiceBundle\Entity\UserCV\Experience $experience
     *
     * @return User
     */
    public function addExperience(\ServiceBundle\Entity\UserCV\Experience $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \ServiceBundle\Entity\UserCV\Experience $experience
     */
    public function removeExperience(\ServiceBundle\Entity\UserCV\Experience $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add interest
     *
     * @param \ServiceBundle\Entity\UserCV\Interests $interest
     *
     * @return User
     */
    public function addInterest(\ServiceBundle\Entity\UserCV\Interests $interest)
    {
        $this->interests[] = $interest;

        return $this;
    }

    /**
     * Remove interest
     *
     * @param \ServiceBundle\Entity\UserCV\Interests $interest
     */
    public function removeInterest(\ServiceBundle\Entity\UserCV\Interests $interest)
    {
        $this->interests->removeElement($interest);
    }

    /**
     * Get interests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterests()
    {
        return $this->interests;
    }

    /**
     * Add language
     *
     * @param \ServiceBundle\Entity\UserCV\Language $language
     *
     * @return User
     */
    public function addLanguage(\ServiceBundle\Entity\UserCV\Language $language)
    {
        $this->languages[] = $language;

        return $this;
    }

    /**
     * Remove language
     *
     * @param \ServiceBundle\Entity\UserCV\Language $language
     */
    public function removeLanguage(\ServiceBundle\Entity\UserCV\Language $language)
    {
        $this->languages->removeElement($language);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Add socialMedia
     *
     * @param \ServiceBundle\Entity\UserCV\SocialMedia $socialMedia
     *
     * @return User
     */
    public function addSocialMedia(\ServiceBundle\Entity\UserCV\SocialMedia $socialMedia)
    {
        $this->socialMedias[] = $socialMedia;

        return $this;
    }

    /**
     * Remove socialMedia
     *
     * @param \ServiceBundle\Entity\UserCV\SocialMedia $socialMedia
     */
    public function removeSocialMedia(\ServiceBundle\Entity\UserCV\SocialMedia $socialMedia)
    {
        $this->socialMedias->removeElement($socialMedia);
    }

    /**
     * Get socialMedias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSocialMedias()
    {
        return $this->socialMedias;
    }

    /**
     * Add software
     *
     * @param \ServiceBundle\Entity\UserCV\Software $software
     *
     * @return User
     */
    public function addSoftware(\ServiceBundle\Entity\UserCV\Software $software)
    {
        $this->softwares[] = $software;

        return $this;
    }

    /**
     * Remove software
     *
     * @param \ServiceBundle\Entity\UserCV\Software $software
     */
    public function removeSoftware(\ServiceBundle\Entity\UserCV\Software $software)
    {
        $this->softwares->removeElement($software);
    }

    /**
     * Get softwares
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoftwares()
    {
        return $this->softwares;
    }

    /**
     * Add portfolio
     *
     * @param \ServiceBundle\Entity\UserCV\Portfolio $portfolio
     *
     * @return User
     */
    public function addPortfolio(\ServiceBundle\Entity\UserCV\Portfolio $portfolio)
    {
        $this->portfolios[] = $portfolio;

        return $this;
    }

    /**
     * Remove portfolio
     *
     * @param \ServiceBundle\Entity\UserCV\Portfolio $portfolio
     */
    public function removePortfolio(\ServiceBundle\Entity\UserCV\Portfolio $portfolio)
    {
        $this->portfolios->removeElement($portfolio);
    }

    /**
     * Get portfolios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPortfolios()
    {
        return $this->portfolios;
    }

    /**
     * Add skill
     *
     * @param \ServiceBundle\Entity\UserCV\Skill $skill
     *
     * @return User
     */
    public function addSkill(\ServiceBundle\Entity\UserCV\Skill $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \ServiceBundle\Entity\UserCV\Skill $skill
     */
    public function removeSkill(\ServiceBundle\Entity\UserCV\Skill $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set isCondidate
     *
     * @param boolean $isCondidate
     *
     * @return User
     */
    public function setIsCondidate($isCondidate)
    {
        $this->isCondidate = $isCondidate;

        return $this;
    }

    /**
     * Get isCondidate
     *
     * @return boolean
     */
    public function getIsCondidate()
    {
        return $this->isCondidate;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return User
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
}
