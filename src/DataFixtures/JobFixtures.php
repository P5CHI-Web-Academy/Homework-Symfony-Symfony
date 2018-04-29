<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public const JOB_REFERENCE = 'job';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 10; $i++) {
            $job = new Job();
            $job->setActivated(true);
            $job->setCategory($this->getReference('category_' . $i));
            $job->setCompany($faker->company);
            $job->setDescription($faker->paragraph);
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTime);
            $job->setPublic($faker->boolean);
            $job->setToken($faker->password(6, 6));
            $job->setHowToApply($faker->paragraph);
            $job->setLocation($faker->city);
            $job->setPosition($faker->word);
            $job->setUrl($faker->url);
            $job->setLogo($faker->imageUrl());
            $job->setType($faker->jobTitle);

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
