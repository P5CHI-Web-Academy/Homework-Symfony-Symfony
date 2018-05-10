<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $slug;

    /**
     * @var Job
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @var Affiliate[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Affiliate", inversedBy="categories")
     * @ORM\JoinTable(name="affiliates_categories")
     */
    private $affiliates;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->jobs = new ArrayCollection();
        $this->affiliates = new ArrayCollection();
    }

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Job[]
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
    * @return Collection|Job[]
    */
    public function getActiveJobs()
    {
        $expires = new \DateTime();

        return $this->jobs->filter(
            function (Job $job) use ($expires) {
                return $job->getExpiresAt() > $expires;
            }
        );
    }

    /**
     * @param Job $job
     * @return Category
     */
    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs[] = $job;
            $job->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Job $job
     * @return Category
     */
    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
        }

        return $this;
    }

    /**
     * @return Collection|Affiliate[]
     */
    public function getAffiliates(): Collection
    {
        return $this->affiliates;
    }

    /**
     * @param Affiliate $affiliate
     * @return Category
     */
    public function addAffiliate(Affiliate $affiliate): self
    {
        if (!$this->affiliates->contains($affiliate)) {
            $this->affiliates[] = $affiliate;
        }

        return $this;
    }

    /**
     * @param Affiliate $affiliate
     * @return Category
     */
    public function removeAffiliate(Affiliate $affiliate): self
    {
        if ($this->affiliates->contains($affiliate)) {
            $this->affiliates->removeElement($affiliate);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }
}
