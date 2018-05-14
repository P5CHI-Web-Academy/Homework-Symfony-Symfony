<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Job;
use App\Entity\Category;


class JobsFixtures extends Fixture implements DependentFixtureInterface
{
    const COUNT = 100;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        /** @var Category $category */
        $category = $this->getReference(CategoryFixtures::generateRandomKeyReference());

        for ($i = 1; $i <= self::COUNT; $i++) {

            if ($i % 25 == 0) {
                $category = $this->getReference(CategoryFixtures::generateRandomKeyReference());
            }

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
                ->setType($faker->word);

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
