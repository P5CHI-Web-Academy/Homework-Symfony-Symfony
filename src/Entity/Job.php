<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="jobs")
 */
class Job{

    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $howToApply;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $public;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $activated;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $expiresAt;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @return string
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getHowToApply(): string
    {
        return $this->howToApply;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param string $type
     * @return Job
     */
    public function setType(string $type): Job
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param string $company
     * @return Job
     */
    public function setCompany(string $company): Job
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @param string $logo
     * @return Job
     */
    public function setLogo(string $logo): Job
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @param string $url
     * @return Job
     */
    public function setUrl(string $url): Job
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $position
     * @return Job
     */
    public function setPosition(string $position): Job
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @param string $location
     * @return Job
     */
    public function setLocation(string $location): Job
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @param string $description
     * @return Job
     */
    public function setDescription(string $description): Job
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param string $howToApply
     * @return Job
     */
    public function setHowToApply(string $howToApply): Job
    {
        $this->howToApply = $howToApply;

        return $this;
    }

    /**
     * @param string $token
     * @return Job
     */
    public function setToken(string $token): Job
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param bool $public
     * @return Job
     */
    public function setPublic(bool $public): Job
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @param bool $activated
     * @return Job
     */
    public function setActivated(bool $activated): Job
    {
        $this->activated = $activated;

        return $this;
    }

    /**
     * @param string $email
     * @return Job
     */
    public function setEmail(string $email): Job
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param DateTime $expiresAt
     * @return Job
     */
    public function setExpiresAt(DateTime $expiresAt): Job
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @param DateTime $createdAt
     * @return Job
     */
    public function setCreatedAt(DateTime $createdAt): Job
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param DateTime $updatedAt
     * @return Job
     */
    public function setUpdatedAt(DateTime $updatedAt): Job
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /*TODO: implement the column as a relation
    private $categoryId;
    */
}
