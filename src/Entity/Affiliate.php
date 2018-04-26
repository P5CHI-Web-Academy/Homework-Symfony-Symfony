<?php
namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="affiliates")
 */
class Affiliate
{

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
    private $url;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $token;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param string $url
     * @return Affiliate
     */
    public function setUrl(string $url): Affiliate
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $email
     * @return Affiliate
     */
    public function setEmail(string $email): Affiliate
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param string $token
     * @return Affiliate
     */
    public function setToken(string $token): Affiliate
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @param bool $active
     * @return Affiliate
     */
    public function setActive(bool $active): Affiliate
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @param DateTime $createdAt
     * @return Affiliate
     */
    public function setCreatedAt(DateTime $createdAt): Affiliate
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
