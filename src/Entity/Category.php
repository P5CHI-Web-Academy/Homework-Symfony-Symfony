<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="categories")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
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
     * @var Job[]
     *
     * @ORM\OneToMany(targetEntity="Job", mappedBy="category")
     */
    private $jobs;

    /**
     * @var Affiliate[]|ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Affiliate", mappedBy="categories")
     */
    private $affiliates;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->jobs = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Category
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Job[]|Collection
     */
    public function getJobs(): Collection
    {
        return $this->jobs;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function addJob(Job $job): self
    {
        if (!$this->jobs->contains($job)) {
            $this->jobs->add($job);
            $job->setCategory($this);
        }

        return $this;
    }

    /**
     * @param Job $job
     * @return $this
     */
    public function removeJob(Job $job): self
    {
        if ($this->jobs->contains($job)) {
            $this->jobs->removeElement($job);
        }

        return $this;
    }

    /**
     * @return Affiliate[]|ArrayCollection
     */
    public function getAffiliates(): Collection
    {
        return $this->affiliates;
    }

    /**
     * @param Affiliate $affiliate
     * @return $this
     */
    public function addAffiliate(Affiliate $affiliate): self
    {
        if (!$this->affiliates->contains($affiliate)) {
            $this->affiliates->add($affiliate);
        }

        return $this;
    }

    /**
     * @param Affiliate $affiliate
     * @return $this
     */
    public function removeAffiliate(Affiliate $affiliate): self
    {
        if ($this->affiliates->contains($affiliate)) {
            $this->affiliates->removeElement($affiliate);
        }

        return $this;
    }

}
