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
        for ($i = 0; $i < 600; $i++) {
            $job = new Job();
            $job->setActivated(true);
            $job->setCategory($this->getReference('category_' . $faker->numberBetween(0,9)));
            $job->setCompany($faker->company);
            $job->setDescription($faker->paragraph);
            $job->setEmail($faker->email);
            $job->setExpiresAt($faker->dateTimeBetween('-10 days', '+20 days'));
            $job->setPublic($faker->boolean);
            $job->setToken($faker->password(6, 6));
            $job->setHowToApply($faker->paragraph);
            $job->setLocation($faker->city);
            $job->setPosition($faker->jobTitle);
            $job->setUrl($faker->url);
            $job->setLogo(null); // No logo by default
            $job->setType($faker->word);

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
