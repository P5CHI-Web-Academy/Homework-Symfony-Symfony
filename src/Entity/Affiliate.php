<?php
namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

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
     * @var ArrayCollection
     * @ORM\JoinTable(name="affiliates_categories")
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="affiliates")
     */
    private $categories;

    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->categories = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    /**
     * @param Category $category
     * @return Affiliate
     */
    public function addCategory(Category $category): Affiliate
    {
        if(!$this->categories->contains($category))
        {
            $this->categories->add($category);
        }

        return $this;
    }

    /**
     * @param Category $category
     * @return Affiliate
     */
    public function removeCategory(Category $category): Affiliate
    {
        $this->categories->removeElement($category);
        return $this;
    }

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
