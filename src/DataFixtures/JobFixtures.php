<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class JobFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {

            $job = new Job();
            $job->setCategory($this->getReference('category_' . $faker->numberBetween(0,99)));

            $job->setType('full-time');
            $job->setCompany($faker->company);
            $job->setLogo('symfony.png');
            $job->setUrl($faker->url);
            $job->setPosition($faker->jobTitle);
            $job->setLocation($faker->country);
            $job->setDescription($faker->text(100));
            $job->setHowToApply($faker->text(30));
            $job->setPublic($faker->boolean);
            $job->setActivated($faker->boolean);
            $job->setToken($faker->sha256);
            $job->setEmail($faker->companyEmail);

            $manager->persist($job);
        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 2;
    }
}

