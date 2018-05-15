<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class JobsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();
        for ($i = 1; $i <= 500; $i++) {
            $job = new Job();
            $job->setCategory($this->getReference('category_' . rand(1, 5)));
            $job->setType($faker->word);
            $job->setCompany($faker->company);
            $job->setLogo($faker->imageUrl(100, 100));
            $job->setUrl($faker->url);
            $job->setPosition($faker->randomDigit);
            $job->setLocation($faker->city);
            $job->setDescription($faker->text);
            $job->setHowToApply($faker->paragraph);
            $job->setToken(uniqid());
            $job->setPublic($faker->boolean(50));
            $job->setActivated($faker->boolean(50));
            $job->setEmail($faker->email);

            $manager->persist($job);
        }

        $manager->flush();
    }
}
