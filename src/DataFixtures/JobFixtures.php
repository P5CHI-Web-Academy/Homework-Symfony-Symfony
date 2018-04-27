<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * Generate random jobs
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 12; $i++) {
            $job = new Job();
            $job->setType($faker->shuffleArray(['private', 'public'])[0]);
            $job->setCompany($faker->company);
            $job->setLogo($job->getCompany());
            $job->setUrl($faker->url);
            $job->setPosition($faker->jobTitle);
            $job->setLocation($faker->city);
            $job->setDescription($faker->text);
            $job->setHowToApply($faker->text);
            $job->setToken($faker->md5);
            $job->setPublic($faker->shuffleArray([true, false])[0]);
            $job->setActivated(true);
            $job->setEmail($faker->companyEmail);
            $job->setExpiresAt(new \DateTime('+2 months'));

            /** @var Category $category */
            $category = $this->getReference('category-' . rand(0, CategoryFixtures::TOTAL - 1));
            $job->setCategory($category);

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return array(
            CategoryFixtures::class,
        );
    }
}
