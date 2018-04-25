<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Job
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
     * @ORM\Column(type="string", length=255)
     */
    private $logo;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
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
    private $how_to_apply;

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
    private $expires_at;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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
        return $this->how_to_apply;
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
        return $this->expires_at;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
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
     * @param string $how_to_apply
     * @return Job
     */
    public function setHowToApply(string $how_to_apply): Job
    {
        $this->how_to_apply = $how_to_apply;

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
     * @param DateTime $expires_at
     * @return Job
     */
    public function setExpiresAt(DateTime $expires_at): Job
    {
        $this->expires_at = $expires_at;

        return $this;
    }

    /**
     * @param DateTime $created_at
     * @return Job
     */
    public function setCreatedAt(DateTime $created_at): Job
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @param DateTime $updated_at
     * @return Job
     */
    public function setUpdatedAt(DateTime $updated_at): Job
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /*TODO: implement the column as a relation
    private $category_id;
    */
}
