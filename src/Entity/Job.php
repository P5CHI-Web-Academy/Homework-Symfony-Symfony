<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @ORM\Table(name="jobs")
 * @ORM\HasLifecycleCallbacks()
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
     * @var string|null
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var datetime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="jobs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return null|string
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @return string|UploadedFile|null
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @return null|string
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @return null|string
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return null|string
     */
    public function getHowToApply(): ?string
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
     * @return bool|null
     */
    public function isPublic(): ?bool
    {
        return $this->public;
    }

    /**
     * @return bool|null
     */
    public function isActivated(): ?bool
    {
        return $this->activated;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return DateTime|null
     */
    public function getExpiresAt(): ?DateTime
    {
        return $this->expiresAt;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return ($this->getExpiresAt() > new \DateTime() && $this->isActivated());
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
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
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
     * @param string|UploadedFile $logo
     * @return Job
     */
    public function setLogo($logo): Job
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
     * @ORM\PreUpdate()
     */
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @param Category|null $category
     * @return Job
     */
    public function setCategory(?Category $category): Job
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersist(): void
    {
        $this->createdAt = new \DateTime();

        if (!$this->expiresAt) {
            $this->expiresAt = new \DateTime('+30 days');
        }
    }
}
