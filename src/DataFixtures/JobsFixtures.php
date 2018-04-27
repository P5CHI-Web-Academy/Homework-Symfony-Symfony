<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Job;
use App\Entity\Category;


class JobsFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT = 50;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::COUNT; $i++) {
            /** @var Category $category */
            $category = $this->getReference(CategoryFixtures::generateRandomKeyReference());

            $job = new Job();
            $job
                ->setCategory($category)
                ->setUrl($faker->url)
                ->setActivated($faker->boolean)
                ->setPublic($faker->boolean)
                ->setCompany($faker->company)
                ->setEmail($faker->email)
                ->setDescription($faker->text)
                ->setHowToApply($faker->text)
                ->setLocation($faker->city)
                ->setLogo($faker->imageUrl())
                ->setPosition($faker->jobTitle)
                ->setToken($faker->sha256)
                ->setType($faker->word)
                ->setExpiresAt($faker->dateTimeBetween('now', '+1 year'));

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
